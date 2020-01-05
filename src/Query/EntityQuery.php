<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Assert\Assertion;
use Assert\AssertionFailedException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;

use function gettype;
use function is_string;

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
     * @internal
     */
    public function getSingleScalarResult()
    {
        die('todo');
    }

    /**
     * @param string|int $hydrationMode
     * @psalm-return Entity
     * @return object
     * @throws AssertionFailedException
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getSingleResult($hydrationMode = self::HYDRATE_OBJECT)
    {
        Assertion::true($hydrationMode === self::HYDRATE_OBJECT, 'Expected ' . self::HYDRATE_OBJECT . ' got "' . $hydrationMode . '"');
        $result = $this->query->getSingleResult($hydrationMode);
        Assertion::isInstanceOf($result, $this->type, 'Expected result to be instance of ' . $this->type . ' got ' . gettype($result) . '('. (is_string($result) ? $result : '') . ')' . ' instead');

        return $result;
    }
}
