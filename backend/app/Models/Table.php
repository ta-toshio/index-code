<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

/**
 * App\Models\Table
 *
 * @property int $id
 * @property int $project_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Table newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Table newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Table query()
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|AppModel sort(array $args)
 * @property-read \App\Models\Project $project
 */
class Table extends AppModel
{
    use HasFactory;
    use Searchable;

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function searchableAs(): string
    {
        return 'tables';
    }

    public function toSearchableArray(): array
    {
        $subtitle = $this->project->name;
        return array_merge(
            $this->attributesToArray(),
            [
                'search_title' => $this->name,
                'search_subtitle' => $subtitle,
            ]
        );
    }

}
