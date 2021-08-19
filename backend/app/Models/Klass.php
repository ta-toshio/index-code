<?php

namespace App\Models;

use ElasticScoutDriverPlus\QueryDsl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

/**
 * App\Models\Klass
 *
 * @property int $id
 * @property int $file_id
 * @property string $name
 * @property string|null $description
 * @property int $existing
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Klass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Klass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Klass query()
 * @method static \Illuminate\Database\Eloquent\Builder|Klass whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Klass whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Klass whereExisting($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Klass whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Klass whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Klass whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Klass whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Klass whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attribute[] $attribute
 * @property-read int|null $attribute_count
 * @property-read \App\Models\File $file
 * @property string $namespace
 * @method static \Illuminate\Database\Eloquent\Builder|Klass whereNamespace($value)
 */
class Klass extends AppModel
{
    use HasFactory;
    use Searchable;
    use QueryDsl;

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }

    public function attribute(): HasMany
    {
        return $this->hasMany(Attribute::class);
    }

    public function toSearchableArray(): array
    {
        $search = $this->name;
        if ($this->namespace) {
            $search = rtrim($this->namespace, '\\') . '\\' . $this->name;
        }

        return array_merge(
            $this->toArray(),
            ['search' => $search]
        );
    }

}
