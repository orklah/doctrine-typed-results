<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Doctrine\ORM\Query;
use Webmozart\Assert\Assert;

/**
 * @template Entity
 */
class EntitiesQuery extends TypedQuery
{
    use TypedQueryTrait;

    /**
     * @psalm-var class-string<Entity>
     * @var string
     */
    private $type;

    /**
     * @param string $type
     * @psalm-param class-string<Entity> $type
     * @param Query $query
     */
    public function __construct(Query $query, $type)
    {
        parent::__construct($query);
        $this->type = $type;
    }

    /**
     * @psalm-return list<Entity>
     * @param int|string $hydrationMode
     * @return object[]
     */
    public function getResult($hydrationMode = self::HYDRATE_OBJECT)
    {
        Assert::same($hydrationMode, self::HYDRATE_ARRAY, 'Expected ' . self::HYDRATE_OBJECT . ' got "' . $hydrationMode . '"');
        $result = $this->query->getResult($hydrationMode);
        Assert::allIsInstanceOf($result, $this->type, 'Expected result to be an array of classes instance of ' . $this->type . ' got ' . $this->getDisplayableType($result) . ' instead');

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
     * @psalm-return list<Entity>
     * @return object[]
     */
    public function getEntitiesResult()
    {
        return $this->getResult();
    }
}
