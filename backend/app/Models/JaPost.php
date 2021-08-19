<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * App\Models\JaPost
 *
 * @property int $id
 * @property string $title
 * @property string|null $body
 * @property string $category
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\JaPostFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|JaPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JaPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JaPost query()
 * @method static \Illuminate\Database\Eloquent\Builder|JaPost whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JaPost whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JaPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JaPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JaPost whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JaPost whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JaPost whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class JaPost extends Model
{
    use HasFactory;
    use Searchable;
}
