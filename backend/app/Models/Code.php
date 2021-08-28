<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

/**
 * App\Models\Code
 *
 * @property int $id
 * @property int $file_id
 * @property string|null $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\File $file
 * @method static \Illuminate\Database\Eloquent\Builder|Code newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Code newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Code query()
 * @method static \Illuminate\Database\Eloquent\Builder|AppModel sort(array $args)
 * @method static \Illuminate\Database\Eloquent\Builder|Code whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Code whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Code whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Code whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Code whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Code extends AppModel
{
    use HasFactory;
    use Searchable;

    /**
     * @return BelongsTo
     */
    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }

    public function toSearchableArray(): array
    {
        $subtitle = $this->file->project->name.':'.$this->file->file_path;
        return array_merge(
            $this->attributesToArray(),
            [
                'search_title' => $this->body,
                'search_subtitle' => $subtitle,
            ]
        );
    }

}
