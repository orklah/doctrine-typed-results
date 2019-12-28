<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;

use UnexpectedValueException;

use function get_class;

/**
 * @template T
 */
class EntityQuery extends TypedQuery
{
    use TypedQueryTrait;
    
    /** @var string */
    private $type;

    /**
     * @param string $type
     * @param Query $query
     */
    public function __construct(Query $query, $type)
    {
        parent::__construct($query);
        $this->type = $type;
    }

    /**
     * @throws NoResultException
     * @throws NonUniqueResultException
     *
     * @return string
     */
    public function getSingleScalarResult()
    {
        die('todo');
    }

    /**
     * @param string|int $hydrationMode
     * @psalm-return T
     * @return object
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getSingleResult($hydrationMode = null)
    {
        $entity = $this->query->getSingleResult($hydrationMode);
        if (!$entity instanceof $this->type) {
            throw new UnexpectedValueException('Expected result to be instance of '.$this->type.' got '.get_class($entity).' instead');
        }
        return $entity;
    }
}
