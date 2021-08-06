<?php

namespace App\Console\Commands;

use App\Domains\useCases\StoreKlass;
use App\Models\File;
use Illuminate\Console\Command;
use PhpParser\{Node, NodeFinder, ParserFactory};

class StoreKlassCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index-code:store-klass {repo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var StoreKlass
     */
    private StoreKlass $storeKlass;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(StoreKlass $storeKlass)
    {
        parent::__construct();

        $this->storeKlass = $storeKlass;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $repo = $this->argument('repo');
        $this->storeKlass->handle($repo);

//        $file = File::query()->where('id', 946)->first();
//        $file = File::query()->where('id', 952)->first();
//        $file = File::query()->where('id', 829)->first();
//        $file = File::query()->where('id', 1870)->first();

//        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
//        $stmts = $parser->parse($file->body);

//        $nodeFinder = new NodeFinder();
//        $methods = $nodeFinder->findInstanceOf($stmts, Node\Stmt\ClassMethod::class);
//        $nodeFinder = new NodeFinder();
//        $results = $nodeFinder->findInstanceOf($stmts, Node\Stmt\Property::class);

//        $nodeFinder = new NodeFinder();
//        $classes = $nodeFinder->findInstanceOf($stmts, Node\Stmt\Class_::class);
//        if (empty($classes)) {
//            return;
//        }
//        foreach ($classes as $i => $class) {
//            $className = $class->name;
//            $className = $class->name->name;
//        }

//        foreach ($methods as $method) {
//            var_dump($method);
//            var_dump($method->name->name);
//            var_dump($method->name->name);
//        }

//        foreach ($results as $result) {
//            var_dump($result->props[0]->name->name);
//            var_dump($result->isPublic());
//            var_dump($result->isProtected());
//            var_dump($result->isPrivate());
//        }

        return 0;
    }
}
