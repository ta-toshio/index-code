<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
 */
class Table extends AppModel
{
    use HasFactory;
    use Searchable;

    public function searchableAs()
    {
        return 'tables';
    }

    public function toSearchableArray(): array
    {
        return array_merge(
            $this->toArray(),
            ['search' => $this->name]
        );
    }

}
