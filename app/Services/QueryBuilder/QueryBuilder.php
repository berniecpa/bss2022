<?php

namespace App\Services\QueryBuilder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Services\QueryBuilder\Concerns\AddsFieldsToQuery;
use App\Services\QueryBuilder\Concerns\AddsIncludesToQuery;
use App\Services\QueryBuilder\Concerns\AppendsAttributesToResults;
use App\Services\QueryBuilder\Concerns\FiltersQuery;
use App\Services\QueryBuilder\Concerns\SortsQuery;

class QueryBuilder extends Builder
{
    use FiltersQuery,
        SortsQuery,
        AddsIncludesToQuery,
        AddsFieldsToQuery,
        AppendsAttributesToResults;

    /** @var \App\Services\QueryBuilder\QueryBuilderRequest */
    protected $request;

    /**
     * QueryBuilder constructor.
     *
     * @param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Relations\Relation $builder
     * @param null|\Illuminate\Http\Request $request
     */
    public function __construct($builder, ?Request $request = null)
    {
        parent::__construct(clone $builder->getQuery());

        $this->initializeFromBuilder($builder);

        $this->request = $request
            ? QueryBuilderRequest::fromRequest($request)
            : app(QueryBuilderRequest::class);
    }

    /**
     * Create a new QueryBuilder for a request and model.
     *
     * @param string|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Relations\Relation $baseQuery Model class or base query builder
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Services\QueryBuilder\QueryBuilder
     */
    public static function for($baseQuery, ?Request $request = null): self
    {
        if (is_string($baseQuery)) {
            /** @var Builder $baseQuery */
            $baseQuery = $baseQuery::query();
        }

        return new static($baseQuery, $request ?? app(Request::class));
    }

    /**
     * {@inheritdoc}
     */
    public function get($columns = ['*'])
    {
        $results = parent::get($columns);

        if ($this->request->appends()->isNotEmpty()) {
            $results = $this->addAppendsToResults($results);
        }

        return $results;
    }

    /**
     * Add the model, scopes, eager loaded relationships, local macro's and onDelete callback
     * from the $builder to this query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     */
    protected function initializeFromBuilder(Builder $builder)
    {
        $this
            ->setModel($builder->getModel())
            ->setEagerLoads($builder->getEagerLoads());

        $builder->macro('getProtected', function (Builder $builder, string $property) {
            return $builder->{$property};
        });

        $this->scopes = $builder->getProtected('scopes');

        $this->localMacros = $builder->getProtected('localMacros');

        $this->onDelete = $builder->getProtected('onDelete');
    }
}
