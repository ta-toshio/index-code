<?php

namespace App\GraphQL\Mutations;

use App\Exceptions\SystemErrorException;
use App\Models\Memo;
use App\Repositories\MemoRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class DeleteMemo
{

    /**
     * @var MemoRepository
     */
    private MemoRepository $memoRepository;

    public function __construct(MemoRepository $memoRepository)
    {
        $this->memoRepository = $memoRepository;
    }

    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $memoId = $args['id'];

        /** @var Memo $memo */
        $memo = $this->memoRepository->find($memoId);
        if (!$memo) {
            throw (new ModelNotFoundException)->setModel(Memo::class, $memoId);
        }

//        if ($memo->user_id !== Auth::id()) {
//            throw new SystemErrorException();
//        }

        return (bool) $this->memoRepository->delete($memoId);
    }
}
