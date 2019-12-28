<?php

declare(strict_types=1);


namespace DoctrineTypedResults\Paginator;

use Doctrine\ORM\Tools\Pagination\Paginator;
use DoctrineTypedResults\Query\TypedQuery;
use DoctrineTypedResults\QueryBuilder\TypedQueryBuilder;
use DoctrineTypedResults\Query\EntityQuery;
use DoctrineTypedResults\QueryBuilder\EntityQueryBuilder;

/**
 * @template T
 */
class TypedPaginator
{
    /**
     * @var Paginator
     */
    private $paginator;

    /**
     * @psalm-param EntityQuery<T>|EntityQueryBuilder<T>|TypedQuery|TypedQueryBuilder   $query
     * @phpstan-param EntityQuery<T>|EntityQueryBuilder<T>|TypedQuery|TypedQueryBuilder $query
     * @param TypedQueryBuilder|TypedQuery                           $query
     * @param bool                                                   $fetchJoinCollection
     */
    public function __construct($query, $fetchJoinCollection = true)
    {
        if ($query instanceof TypedQuery) {
            $this->paginator = new Paginator($query->get(), $fetchJoinCollection);
        } else {
            $this->paginator = new Paginator($query, $fetchJoinCollection);
        }
    }

    /**
     * @psalm-return Paginator<T>
     * @phpstan-return Paginator<T>
     * @return Paginator
     */
    public function get(){
        return $this->paginator;
    }
}
