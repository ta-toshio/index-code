<?php

namespace App\GraphQL\Queries;

use App\Models\Attribute;
use App\Models\Code;
use App\Models\Field;
use App\Models\File;
use App\Models\Klass;
use App\Models\Table;
use ElasticScoutDriverPlus\QueryMatch;
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
        $type = $args['type'] ?? null;

//        $result = File::matchSearch()
////        $result = File::wildcardSearch()
//            ->join(Klass::class)
//            ->join(Attribute::class)
//            ->join(Code::class)
//            ->join(Field::class)
//            ->join(Table::class)
//            ->field('search_title')
////            ->value('*' . $search . '*')
//            ->query($search)
//            ->highlight('search_title')
//            ->size(100)
//            ->execute();

        $query = File::boolSearch();

        if ($type === 'NAME') {
            $query = $query
                ->join(Klass::class)
                ->join(Attribute::class)
                ->join(Table::class)
                ->join(Field::class);

            foreach (explode(' ', $search) as $searchTitle) {
                $query = $query->must('wildcard', ['search_title' => '*'.$searchTitle.'*']);
            }
        }

        if ($type === 'CODE') {
            $query = $query->join(Code::class);

            foreach (explode(' ', $search) as $searchTitle) {
                $query = $query->must('match', ['search_title' => $searchTitle]);
            }
        }

        $result = $query
            ->highlight('search_title')
            ->size(1000)
            ->execute();

        return $result->matches()->map(static function (QueryMatch $match) {
            $highlight = $match->highlight();
            $document = $match->document();
            return array_merge(
                $document->getContent(),
                [
                    'id' => $document->getField('id'),
                    'highlight' => isset($highlight) ? $highlight->getRaw()['search_title'][0] : null,
                    '__typename' => Str::ucfirst(Str::singular($match->indexName())),
                ]
            );
        });
    }
}
