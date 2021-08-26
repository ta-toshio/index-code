<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

/**
 * App\Models\EnPost
 *
 * @property int $id
 * @property string $title
 * @property string|null $body
 * @property string $category
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\EnPostFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|EnPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnPost query()
 * @method static \Illuminate\Database\Eloquent\Builder|EnPost whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnPost whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnPost whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnPost whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnPost whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|AppModel sort(array $args)
 */
class EnPost extends AppModel
{
    use HasFactory;
    use Searchable;
}
