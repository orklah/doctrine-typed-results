<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Doctrine\ORM\AbstractQuery;
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
     * @param Query $query For testability reasons, we have to accept AbstractQuery
     *                     But the real type has to be a Query
     */
    public function __construct(AbstractQuery $query, $type)
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
        Assert::same($hydrationMode, self::HYDRATE_OBJECT);
        $result = $this->query->getResult($hydrationMode);
        Assert::allIsInstanceOf($result, $this->type);

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
