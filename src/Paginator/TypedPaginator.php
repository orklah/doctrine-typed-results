<?php

declare(strict_types=1);


namespace DoctrineTypedResults\Paginator;

use Doctrine\ORM\Tools\Pagination\Paginator;
use DoctrineTypedResults\Query\EntitiesQuery;
use DoctrineTypedResults\Query\TypedQuery;
use DoctrineTypedResults\QueryBuilder\EntitiesQueryBuilder;
use DoctrineTypedResults\QueryBuilder\TypedQueryBuilder;

/**
 * @template Entity
 */
class TypedPaginator
{
    /**
     * @psalm-var Paginator<Entity>
     * @var Paginator
     */
    private $paginator;

    /**
     * @psalm-param EntitiesQuery<Entity>|EntitiesQueryBuilder<Entity>|TypedQueryBuilder|TypedQuery $query
     * @param EntitiesQuery|EntitiesQueryBuilder|TypedQueryBuilder|TypedQuery                       $query
     * @param bool                                                                                  $fetchJoinCollection
     */
    public function __construct($query, $fetchJoinCollection = true)
    {
        $this->paginator = new Paginator($query->get(), $fetchJoinCollection);
    }

    /**
     * @psalm-return Paginator<Entity>
     * @return Paginator
     */
    public function get()
    {
        return $this->paginator;
    }
}
