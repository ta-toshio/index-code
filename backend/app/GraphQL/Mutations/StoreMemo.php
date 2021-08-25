<?php

namespace App\GraphQL\Mutations;

use App\Models\File;
use App\Repositories\FileRepository;
use App\Repositories\MemoRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class StoreMemo
{

    /**
     * @var FileRepository
     */
    private FileRepository $fileRepository;

    /**
     * @var MemoRepository
     */
    private MemoRepository $memoRepository;

    public function __construct(FileRepository $fileRepository, MemoRepository $memoRepository)
    {
        $this->fileRepository = $fileRepository;
        $this->memoRepository = $memoRepository;
    }

    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     * @throws \Throwable
     */
    public function __invoke($_, array $args)
    {
        $input = $args['input'];
        $id = $input['id'] ?? null;
        $fileId = $input['file_id'];
        $lineNum = +$input['line'];
        $body = $input['body'];

        $file = $this->fileRepository->findById($fileId);
        if (!$file) {
            throw (new ModelNotFoundException)->setModel(File::class, $fileId);
        }

        $lines = explode("\n", str_replace(["\r\n", "\r", "\n"], "\n", $file->body));
        $index = $lineNum > 0 ? $lineNum - 1 : $lineNum;

        if (!isset($lines[$index])) {
            throw new \OutOfBoundsException();
        }
        $targetLine = $lines[$index];
        $startLIndex = $index - 5 >= 0 ? $index - 5 :  0;
        $targetLines = array_slice($lines, $startLIndex, 11);

        $data = [
//            'user_id' => Auth::user()->id,
            'user_id' => 1,
            'file_id' => $fileId,
            'line' => $lineNum,
            'code' => $targetLine,
            'codes' => implode("\n", $targetLines),
            'body' => $body,
            'version' => $file->project->version,
        ];
        return $this->memoRepository->storeMemo($data, $id);
    }
}
