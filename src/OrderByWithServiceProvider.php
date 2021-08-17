<?php

namespace HaoSheng;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class OrderByWithServiceProvider extends ServiceProvider
{
    public function register()
    {
        Builder::macro('orderByWith', function ($relation, $column, $direction = 'asc') {
            /** @var Builder $this */
            if (is_string($relation)) {
                $relation = $this->getRelationWithoutConstraints($relation);
            }

            return $this->orderBy(
                $relation->getRelationExistenceQuery(
                    $relation->getRelated()->newQueryWithoutRelationships(),
                    $this,
                    $column
                ),
                $direction
            );
        });
    }
}
