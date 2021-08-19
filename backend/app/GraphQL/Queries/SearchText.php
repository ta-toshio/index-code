<?php

namespace App\GraphQL\Queries;

use App\Models\Attribute;
use App\Models\Field;
use App\Models\File;
use App\Models\Klass;
use App\Models\Table;
use ElasticScoutDriverPlus\QueryMatch;

class SearchText
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $search = $args['search'] ?? null;

//        $result = File::matchSearch()
        $result = File::wildcardSearch()
            ->join(Klass::class)
            ->join(Attribute::class)
            ->join(Field::class)
            ->join(Table::class)
            ->field('search')
            ->value('*' . $search . '*')
//            ->query($search)
            ->highlight('search')
            ->size(100)
            ->execute();

        return $result->matches()->map(static function (QueryMatch $match) {
            $highlight = $match->highlight();
            $document = $match->document();
            return [
                'index_name' => $match->indexName(),
                'id' => $document->getField('id'),
                'text' => $document->getField('search'),
                'highlight' => isset($highlight) ? $highlight->getRaw()['search'][0] : null,
                'score' => $match->score(),
            ];
        });
    }
}
