<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class EnPost extends AppModel
{
    use HasFactory;
    use Searchable;
}
