<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

/**
 * @template T
 */
abstract class TypedQueryBuilder extends QueryBuilder implements QueryBuilderInterface
{
    /**
     * @phpstan-var class-string<T>
     * @psalm-var class-string<T>
     * @var string
     */
    protected $type;

    /**
     * @phpstan-param class-string<T> $type
     * @psalm-param class-string<T> $type
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }
}
