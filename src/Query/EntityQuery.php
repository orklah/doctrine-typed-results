<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;
use Webmozart\Assert\Assert;

use function gettype;
use function is_string;

/**
 * @template Entity of object
 */
class EntityQuery extends TypedQuery
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
     * @internal
     */
    public function getSingleScalarResult()
    {
        die('todo');
    }

    /**
     * @param string|int|null $hydrationMode
     * @psalm-return Entity
     * @return object
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getSingleResult($hydrationMode = self::HYDRATE_OBJECT)
    {
        Assert::same($hydrationMode, self::HYDRATE_OBJECT);
        $result = $this->query->getSingleResult($hydrationMode);
        Assert::isInstanceOf($result, $this->type);

        return $result;
    }
}
