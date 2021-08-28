<?php

namespace App\Observers;

use App\Models\Code;
use App\Models\File;

class FileObserver
{
    /**
     * Handle the File "created" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function created(File $file)
    {
        Code::create([
            'file_id' => $file->id,
            'body' => $file->body,
        ]);
    }

    /**
     * Handle the File "updated" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function updated(File $file)
    {
        Code::upsert([
            'file_id' => $file->id,
        ], [
            'file_id' => $file->id,
            'body' => $file->body,
        ]);
    }

    /**
     * Handle the File "deleted" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function deleted(File $file)
    {
        $code = Code::query()->where('file_id', $file->id)->firstOrFail();
        $code->delete();
    }

    /**
     * Handle the File "force deleted" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function forceDeleted(File $file)
    {
        $code = Code::query()->where('file_id', $file->id)->firstOrFail();
        $code->delete();
    }
}
