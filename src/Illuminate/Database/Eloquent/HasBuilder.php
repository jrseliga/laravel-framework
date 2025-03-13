<?php

namespace Illuminate\Database\Eloquent;

use Illuminate\Database\Eloquent\Attributes\QueriedBy;
use ReflectionClass;

/**
 * @template TBuilder of \Illuminate\Database\Eloquent\Builder
 */
trait HasBuilder
{
    /**
     * The resolved builder class names by model.
     *
     * @var array<class-string<static>, class-string<TBuilder>>
     */
    protected static array $resolvedEloquentBuilderClasses = [];

    /**
     * Begin querying the model.
     *
     * @return TBuilder
     */
    public static function query()
    {
        return parent::query();
    }

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return TBuilder
     */
    public function newEloquentBuilder($query)
    {
        static::$resolvedEloquentBuilderClasses[static::class] ??= ($this->resolveEloquentBuilderFromAttribute() ?? static::$builder);

        return new static::$resolvedEloquentBuilderClasses[static::class]($query);
    }

    /**
     * Resolve the builder class from the QueriedBy attribute.
     *
     * @return class-string<TBuilder>|null
     */
    protected function resolveEloquentBuilderFromAttribute()
    {
        $reflectionClass = new ReflectionClass(static::class);

        $attributes = $reflectionClass->getAttributes(QueriedBy::class);

        if (! isset($attributes[0]) || ! isset($attributes[0]->getArguments()[0])) {
            return null;
        }

        return $attributes[0]->getArguments()[0];
    }

    /**
     * Get a new query builder for the model's table.
     *
     * @return TBuilder
     */
    public function newQuery()
    {
        return parent::newQuery();
    }

    /**
     * Get a new query builder that doesn't have any global scopes or eager loading.
     *
     * @return TBuilder
     */
    public function newModelQuery()
    {
        return parent::newModelQuery();
    }

    /**
     * Get a new query builder with no relationships loaded.
     *
     * @return TBuilder
     */
    public function newQueryWithoutRelationships()
    {
        return parent::newQueryWithoutRelationships();
    }

    /**
     * Get a new query builder that doesn't have any global scopes.
     *
     * @return TBuilder
     */
    public function newQueryWithoutScopes()
    {
        return parent::newQueryWithoutScopes();
    }

    /**
     * Get a new query instance without a given scope.
     *
     * @param  \Illuminate\Database\Eloquent\Scope|string  $scope
     * @return TBuilder
     */
    public function newQueryWithoutScope($scope)
    {
        return parent::newQueryWithoutScope($scope);
    }

    /**
     * Get a new query to restore one or more models by their queueable IDs.
     *
     * @param  array|int  $ids
     * @return TBuilder
     */
    public function newQueryForRestoration($ids)
    {
        return parent::newQueryForRestoration($ids);
    }

    /**
     * Begin querying the model on a given connection.
     *
     * @param  string|null  $connection
     * @return TBuilder
     */
    public static function on($connection = null)
    {
        return parent::on($connection);
    }

    /**
     * Begin querying the model on the write connection.
     *
     * @return TBuilder
     */
    public static function onWriteConnection()
    {
        return parent::onWriteConnection();
    }

    /**
     * Begin querying a model with eager loading.
     *
     * @param  array|string  $relations
     * @return TBuilder
     */
    public static function with($relations)
    {
        return parent::with($relations);
    }
}
