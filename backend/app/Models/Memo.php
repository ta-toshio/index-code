<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Memo extends AppModel
{

    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }

    public function scopeMy(Builder $query, array $args)
    {
        $userId = $args['user_id'] ?? null;
        $userId = 1; // @TODO delete
        return $query->where('user_id', $userId);
    }

}
