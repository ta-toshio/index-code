<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

/**
 * App\Models\Attribute
 *
 * @property int $id
 * @property int|null $klass_id
 * @property string $name
 * @property string $type
 * @property int $start_line
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereKlassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereStartLine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Klass|null $klass
 * @property int $file_id
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppModel sort(array $args)
 * @property-read \App\Models\File $file
 */
class Attribute extends AppModel
{

    use HasFactory;
    use Searchable;

    const TYPE_METHOD = 'method';
    const TYPE_PROPERTY = 'method';
    const TYPE_TRAIT = 'trait';
    const TYPE_FUNCTION = 'function';

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }

    public function klass(): BelongsTo
    {
        return $this->belongsTo(Klass::class);
    }

    public function toSearchableArray(): array
    {
        $subtitle = $this->file->project->name.':'.$this->file->file_path;
        return array_merge(
            $this->attributesToArray(),
            [
                'search_title' => $this->name,
                'search_subtitle' => $subtitle,
            ]
        );
    }

}
