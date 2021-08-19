<?php

namespace App\Models;

use ElasticScoutDriverPlus\QueryDsl;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

/**
 * App\Models\File
 *
 * @property int $id
 * @property int $project_id
 * @property string $name
 * @property string $file_path
 * @property string $path
 * @property string $extension
 * @property string|null $description
 * @property int|null $parent_id
 * @property int $is_dir
 * @property int $depth
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File query()
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereIsDir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $body
 * @method static \Illuminate\Database\Eloquent\Builder|File whereBody($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Klass[] $klass
 * @property-read int|null $klass_count
 * @property-read \App\Models\Project $project
 */
class File extends AppModel
{
    use HasFactory;
    use Searchable;
    use QueryDsl;

    static array $allowedExtension = [
        'php' => 1.2,
        'twig' => 1,
        'js' => 1,
        'ts' => 1,
        'jsx' => 1,
        'tsx' => 1,
        'css' => 0.8,
        'scss' => 0.8,
        'html' => 0.5,
        'json' => 0.8,
        'yml' => 0.9,
        'yaml' => 0.9,
        'xml' => 0.5,
        'dockerignore' => 0.5,
        'editorconfig' => 0.5,
        'htaccess' => 0.5,
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function klass(): HasMany
    {
        return $this->hasMany(Klass::class);
    }

    public function searchableAs()
    {
        return 'files';
    }

    public function toSearchableArray(): array
    {
        $search = $this->name;
        if ($this->is_dir) {
            $search = $this->file_path;
        } else if ($this->file_path) {
            $search = rtrim($this->file_path, '/') . '/' . $this->name;
        }

        return array_merge(
            $this->toArray(),
            ['search' => $search]
        );
    }

    /**
     * @param  Builder  $query
     * @param  array  $args
     * @return Builder
     */
    public function scopeDepthSort(Builder $query, array $args)
    {
        return $query
            ->orderBy('depth', 'ASC')
            ->orderBy('name', 'ASC');
    }

}
