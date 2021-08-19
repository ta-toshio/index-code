<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\TableDetail
 *
 * @property int $id
 * @property int $table_id
 * @property string $name
 * @property int $user_id
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TableDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TableDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TableDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|TableDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TableDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TableDetail whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TableDetail whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TableDetail whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TableDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TableDetail whereUserId($value)
 * @mixin \Eloquent
 */
class TableDetail extends AppModel
{
    use HasFactory;
}
