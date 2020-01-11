<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Assert\Assertion;
use Assert\AssertionFailedException;
use Doctrine\ORM\Query;

use function gettype;

/**
 * @template Entity
 */
class EntitiesQuery extends TypedQuery
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
     * @phpstan-return list<Entity>
     * @psalm-return list<Entity>
     * @param int|string $hydrationMode
     * @return object[]
     * @throws AssertionFailedException
     */
    public function getResult($hydrationMode = self::HYDRATE_ARRAY)
    {
        Assertion::same($hydrationMode, self::HYDRATE_ARRAY, 'Expected ' . self::HYDRATE_ARRAY . ' got "' . $hydrationMode . '"');
        $result = $this->query->getResult($hydrationMode);
        Assertion::allIsInstanceOf($result, $this->type, 'Expected result to be an array of classes instance of ' . $this->type . ' got ' . $this->getDisplayableType($result) . ' instead');

        return $result;
    }

    /**
     * @internal
     */
    public function getSingleScalarResult()
    {
        die('todo');
    }

    /**
     * @internal
     */
    public function getSingleResult($hydrationMode = self::HYDRATE_OBJECT)
    {
        die('todo');
    }

    /**
     * @phpstan-return list<Entity>
     * @psalm-return list<Entity>
     * @return object[]
     * @throws AssertionFailedException
     */
    public function getEntitiesResult()
    {
        return $this->getResult();
    }
}
