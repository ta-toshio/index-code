<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Memo
 *
 * @property int $id
 * @property int $user_id
 * @property int $file_id
 * @property int $line
 * @property string $code
 * @property string|null $codes
 * @property string|null $body
 * @property string $version
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\File $file
 * @property-read \App\Models\User $user
 * @method static Builder|Memo my(array $args)
 * @method static Builder|Memo newModelQuery()
 * @method static Builder|Memo newQuery()
 * @method static Builder|Memo query()
 * @method static \Illuminate\Database\Eloquent\Builder|AppModel sort(array $args)
 * @method static Builder|Memo whereBody($value)
 * @method static Builder|Memo whereCode($value)
 * @method static Builder|Memo whereCodes($value)
 * @method static Builder|Memo whereCreatedAt($value)
 * @method static Builder|Memo whereFileId($value)
 * @method static Builder|Memo whereId($value)
 * @method static Builder|Memo whereLine($value)
 * @method static Builder|Memo whereUpdatedAt($value)
 * @method static Builder|Memo whereUserId($value)
 * @method static Builder|Memo whereVersion($value)
 * @mixin \Eloquent
 */
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
