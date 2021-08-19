<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
 */
class Field extends AppModel
{
    use HasFactory;
    use Searchable;

    public function searchableAs()
    {
        return 'fields';
    }

    public function toSearchableArray(): array
    {
        return array_merge(
            $this->toArray(),
            ['search' => $this->field_name]
        );
    }

}
