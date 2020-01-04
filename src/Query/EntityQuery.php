<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;

use UnexpectedValueException;

use function get_class;
use function gettype;
use function is_object;

/**
 * @template Entity
 */
class EntityQuery extends TypedQuery
{
    use TypedQueryTrait;
    
    /**
     * @psalm-var class-string<Entity>
     * @phpstan-var class-string<Entity>
     * @var string
     */
    private $type;

    /**
     * @param string $type
     * @psalm-param class-string<Entity> $type
     * @phpstan-param class-string<Entity> $type
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
     * @psalm-return Entity
     * @return object
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getSingleResult($hydrationMode = null)
    {
        $result = $this->query->getSingleResult($hydrationMode);
        if (!$result instanceof $this->type) {
            if (is_object($result)) {
                throw new UnexpectedValueException('Expected result to be instance of '.$this->type.' got '.get_class($result).' instead');
            }

            throw new UnexpectedValueException('Expected result to be instance of '.$this->type.' got '.gettype($result).' instead');
        }
        return $result;
    }
}
