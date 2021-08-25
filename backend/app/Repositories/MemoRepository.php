<?php

namespace App\Repositories;

use App\Models\Memo;

class MemoRepository
{

    /**
     * @param $data
     * @param $id
     * @return Memo
     * @throws \Throwable
     */
    public function storeMemo(array $data, ?int $id): Memo
    {
        if ($id) {
            $memo = Memo::findOrFail($id);
        } else {
            $memo = new Memo();
        }

        $memo->fill($data);
        $memo->saveOrFail();
        return $memo;
    }

}
