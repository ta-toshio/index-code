<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Table extends AppModel
{
    use HasFactory;
    use Searchable;

    public function searchableAs()
    {
        return 'tables';
    }

}
