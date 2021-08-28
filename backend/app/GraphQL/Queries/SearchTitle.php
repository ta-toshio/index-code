<?php

namespace App\GraphQL\Queries;

use App\Models\Attribute;
use App\Models\Code;
use App\Models\Field;
use App\Models\File;
use App\Models\Klass;
use App\Models\Table;
use ElasticScoutDriverPlus\QueryMatch;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SearchTitle
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $search = $args['search'] ?? null;

        $result = File::matchSearch()
            ->join(Klass::class)
            ->join(Attribute::class)
            ->join(Code::class)
            ->join(Field::class)
            ->join(Table::class)
            ->field('search_title')
//            ->value('*' . $search . '*')
            ->query($search)
            ->highlight('search_title')
            ->size(100)
            ->execute();

        return $result->matches()->map(static function (QueryMatch $match) {
            $highlight = $match->highlight();
            $document = $match->document();
            return array_merge(
                $document->getContent(),
                [
                    'id' => $document->getField('id'),
                    '__typename' => Str::ucfirst(Str::singular($match->indexName())),
                ]
            );
        });
    }
}
