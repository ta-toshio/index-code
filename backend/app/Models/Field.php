<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Field extends AppModel
{
    use HasFactory;
    use Searchable;

    public function searchableAs()
    {
        return 'fields';
    }

}
