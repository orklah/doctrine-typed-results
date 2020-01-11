<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query;

abstract class TypedQuery extends AbstractQuery implements QueryInterface
{
    /**
     * @var Query
     */
    protected $query;

    /**
     * @param Query $query
     */
    public function __construct(Query $query)
    {
        parent::__construct($query->getEntityManager());
        $this->query = $query;
    }

    public function getQuery(): Query
    {
        return $this->query;
    }

    /**
     * Alias of getQuery
     */
    public function get(): Query
    {
        return $this->getQuery();
    }

    /**
     * @psalm-param object|array|scalar|mixed $type
     * @param mixed $type
     * @return string
     */
    protected function getDisplayableType($type): string
    {
        if (is_scalar($type)) {
            return (string)$type;
        }

        if (is_object($type)) {
            return gettype($type);
        }

        if (is_array($type)) {
            if (count($type) === 0) {
                return 'empty-array';
            }

            return 'array('.$this->getDisplayableType(array_shift($type)).')';
        }

        return 'unknown type';
    }
}
