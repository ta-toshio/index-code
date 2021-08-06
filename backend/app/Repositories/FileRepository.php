<?php

namespace App\Repositories;

use App\Models\File;

class FileRepository
{

    public function storeBySplFileInfo(\SplFileInfo $file, int $projectId, string $workingDir)
    {
        $path = ltrim(str_replace($workingDir, '', $file->getPath()), DIRECTORY_SEPARATOR);
        $filePath = ltrim(str_replace($workingDir, '', $file->getRealPath()), DIRECTORY_SEPARATOR);
        $depth = substr_count($filePath, DIRECTORY_SEPARATOR);

        $fileModel = File::query()
            ->where('project_id', $projectId)
            ->where('file_path', $path)
            ->first();

        return File::updateOrCreate([
            'project_id' => $projectId,
            'file_path' => $filePath,
        ], [
            'project_id' => $projectId,
            'name'=> $file->getFilename(),
            'file_path' => $filePath,
            'path' => $path,
            'body' => $file->isFile() && in_array(strtolower($file->getExtension()), array_keys(File::$allowedExtension))
                ? file_get_contents($file->getRealPath())
                : null,
            'extension' => $file->isFile() ? (strtolower($file->getExtension()) ?? '') : '',
            'parent_id' => $fileModel?->id,
            'is_dir' => $file->isDir(),
            'depth' => $depth,
        ]);
    }

    public function chunkBy(int $count, \Closure $closure, array $conditions = [])
    {
        $query = File::query();

        foreach ($conditions as $key => $value) {
            $query->whereIn($key, $value);
        }

        $query->chunk($count, $closure);
    }

}
