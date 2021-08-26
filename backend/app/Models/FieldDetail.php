<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\FieldDetail
 *
 * @property int $id
 * @property int $field_id
 * @property string $name
 * @property int $user_id
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FieldDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FieldDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FieldDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|FieldDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FieldDetail whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FieldDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FieldDetail whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FieldDetail whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FieldDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FieldDetail whereUserId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|AppModel sort(array $args)
 */
class FieldDetail extends AppModel
{
    use HasFactory;
}
