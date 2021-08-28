<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

/**
 * App\Models\Field
 *
 * @property int $id
 * @property int $table_id
 * @property string $table_name
 * @property string $field_name
 * @property string $field_type
 * @property string $field_param
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Field newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Field newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Field query()
 * @method static \Illuminate\Database\Eloquent\Builder|Field whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Field whereFieldName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Field whereFieldParam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Field whereFieldType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Field whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Field whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Field whereTableName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Field whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|AppModel sort(array $args)
 * @property-read \App\Models\Table $table
 */
class Field extends AppModel
{
    use HasFactory;
    use Searchable;

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    public function searchableAs(): string
    {
        return 'fields';
    }

    public function toSearchableArray(): array
    {
        $subtitle = $this->table->project->name;
        return array_merge(
            $this->attributesToArray(),
            [
                'search_title' => $this->field_name,
                'search_subtitle' => $subtitle,
            ]
        );
    }

}
