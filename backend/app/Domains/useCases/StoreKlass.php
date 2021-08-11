<?php

namespace App\Domains\useCases;

use App\Exceptions\SystemErrorException;
use App\Models\Attribute;
use App\Models\File;
use App\Repositories\AttributeRepository;
use App\Repositories\FileRepository;
use App\Repositories\KlassRepository;
use App\Repositories\ProjectRepository;
use PhpParser\{Node, NodeFinder, ParserFactory};

class StoreKlass
{

    private ProjectRepository $projectRepository;
    private FileRepository $fileRepository;
    private KlassRepository $klassRepository;
    private AttributeRepository $attributeRepository;

    public function __construct(
        ProjectRepository $projectRepository,
        FileRepository $fileRepository,
        KlassRepository $klassRepository,
        AttributeRepository $attributeRepository
    )
    {
        $this->projectRepository = $projectRepository;
        $this->fileRepository = $fileRepository;
        $this->klassRepository = $klassRepository;
        $this->attributeRepository = $attributeRepository;
    }

    public function handle(string $repo)
    {
        $repo = trim($repo, '/');
        $url = 'https://github.com/'.$repo;
        $project = $this->projectRepository->findByUrl($url);
        if (!$project) {
            throw new SystemErrorException('Could not find project');
        }

        $conditions = [
            'extension' => ['php'],
        ];
        $this->fileRepository->chunkBy(100, function ($files) {
            /** @var File $file */
            foreach ($files as $file) {
                $this->store($file);
            }
        }, $conditions);
    }

    public function store(File $file)
    {
        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
        $stmts = $parser->parse($file->body);

//        $nodeFinder = new NodeFinder();
//        $methods = $nodeFinder->findInstanceOf($stmts, Node\Stmt\ClassMethod::class);
//        $nodeFinder = new NodeFinder();
//        $results = $nodeFinder->findInstanceOf($stmts, Node\Stmt\Property::class);

        $nodeFinder = new NodeFinder();
        $classes = $nodeFinder->findInstanceOf($stmts, Node\Stmt\Class_::class);
        if (empty($classes)) {
            return;
        }

        echo $file->name . "\n";

        $results = $nodeFinder->findInstanceOf($stmts, Node\Stmt\Namespace_::class);
        $namespace = $this->getNamespace($results[0] ?? null);

        foreach ($classes as $class) {
            if (!$class->name) {
                var_dump('Could not find class name');
                var_dump($file->id, $file->name);
                continue;
            }
            $className = $class->name->name;
            $klass = $this->klassRepository->updateOrCreate($file->id, $className, ['namespace' => $namespace]);

            foreach ($class->stmts as $node) {

                switch (get_class($node)) {
                    case Node\Stmt\ClassMethod::class:
                        $this->storeMethod($file->id, $klass->id, $node);
                        break;
                    case Node\Stmt\Property::class:
                        $this->storeProperty($file->id, $klass->id, $node);
                        if (count($node->props) > 1) {
                            var_dump('-----------unexpected props count');
                            var_dump($node);
                        }
                        break;
                    default:
                        var_dump('-----------unexpected node');
                        var_dump(get_class($node));
                }
            }
        }
    }

    private function getNamespace($namespace): string
    {
        if (!$namespace) {
            return '';
        }

        return implode('\\', $namespace->name->parts);
    }

    private function storeMethod(int $fileId, int|null $klassId, $node): Attribute
    {
        $name = $node->name->name;
        $data = [
            'type' => Attribute::TYPE_METHOD,
            'start_line' => $node->name->getStartLine(),
        ];
        return $this->attributeRepository->updateOrCreate($fileId, $klassId, $name, $data);
    }

    private function storeProperty(int $fileId, int|null $klassId, $node): Attribute
    {
        $property = $node->props[0];
        $name = $property->name->name;
        $data = [
            'type' => Attribute::TYPE_PROPERTY,
            'start_line' => $property->name->getStartLine(),
        ];
        return $this->attributeRepository->updateOrCreate($fileId, $klassId, $name, $data);
    }
}
