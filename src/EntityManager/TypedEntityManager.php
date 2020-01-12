<?php

declare(strict_types=1);

namespace DoctrineTypedResults\EntityManager;

use DoctrineTypedResults\Query\BoolQuery;
use DoctrineTypedResults\Query\BoolsQuery;
use DoctrineTypedResults\Query\EntitiesQuery;
use DoctrineTypedResults\Query\EntityQuery;
use DoctrineTypedResults\Query\FloatQuery;
use DoctrineTypedResults\Query\FloatsQuery;
use DoctrineTypedResults\Query\IntQuery;
use DoctrineTypedResults\Query\IntsQuery;
use DoctrineTypedResults\Query\StringQuery;
use DoctrineTypedResults\Query\StringsQuery;
use DoctrineTypedResults\QueryBuilder\BoolQueryBuilder;
use DoctrineTypedResults\QueryBuilder\BoolsQueryBuilder;
use DoctrineTypedResults\QueryBuilder\EntitiesQueryBuilder;
use DoctrineTypedResults\QueryBuilder\EntityQueryBuilder;
use DoctrineTypedResults\QueryBuilder\FloatQueryBuilder;
use DoctrineTypedResults\QueryBuilder\FloatsQueryBuilder;
use DoctrineTypedResults\QueryBuilder\IntQueryBuilder;
use DoctrineTypedResults\QueryBuilder\IntsQueryBuilder;
use DoctrineTypedResults\QueryBuilder\StringQueryBuilder;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use DoctrineTypedResults\QueryBuilder\StringsQueryBuilder;
use InvalidArgumentException;
use Webmozart\Assert\Assert;

class TypedEntityManager
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        if (!$em instanceof EntityManager) {
            throw new InvalidArgumentException('Expecting EntityManager, got '.\gettype($em));
        }
        $this->em = $em;
    }

    /**
     * @return IntQueryBuilder
     */
    public function createIntQueryBuilder()
    {
        return new IntQueryBuilder($this->em);
    }

    /**
     * @return IntsQueryBuilder
     */
    public function createIntsQueryBuilder()
    {
        return new IntsQueryBuilder($this->em);
    }

    /**
     * @param string $dql
     * @return IntQuery
     */
    public function createIntQuery(string $dql)
    {
        $query = $this->em->createQuery($dql);

        return new IntQuery($query);
    }

    /**
     * @param string $dql
     * @return IntsQuery
     */
    public function createIntsQuery(string $dql)
    {
        $query = $this->em->createQuery($dql);

        return new IntsQuery($query);
    }

    /**
     * @return FloatQueryBuilder
     */
    public function createFloatQueryBuilder()
    {
        return new FloatQueryBuilder($this->em);
    }

    /**
     * @return FloatsQueryBuilder
     */
    public function createFloatsQueryBuilder()
    {
        return new FloatsQueryBuilder($this->em);
    }

    /**
     * @param string $dql
     * @return FloatQuery
     */
    public function createFloatQuery(string $dql)
    {
        $query = $this->em->createQuery($dql);

        return new FloatQuery($query);
    }

    /**
     * @param string $dql
     * @return FloatsQuery
     */
    public function createFloatsQuery(string $dql)
    {
        $query = $this->em->createQuery($dql);

        return new FloatsQuery($query);
    }

    /**
     * @return StringQueryBuilder
     */
    public function createStringQueryBuilder()
    {
        return new StringQueryBuilder($this->em);
    }

    /**
     * @return StringsQueryBuilder
     */
    public function createStringsQueryBuilder()
    {
        return new StringsQueryBuilder($this->em);
    }

    /**
     * @param string $dql
     * @return StringQuery
     */
    public function createStringQuery(string $dql)
    {
        $query = $this->em->createQuery($dql);

        return new StringQuery($query);
    }

    /**
     * @param string $dql
     * @return StringsQuery
     */
    public function createStringsQuery(string $dql)
    {
        $query = $this->em->createQuery($dql);

        return new StringsQuery($query);
    }

    /**
     * @return BoolQueryBuilder
     */
    public function createBoolQueryBuilder()
    {
        return new BoolQueryBuilder($this->em);
    }

    /**
     * @return BoolsQueryBuilder
     */
    public function createBoolsQueryBuilder()
    {
        return new BoolsQueryBuilder($this->em);
    }

    /**
     * @param string $dql
     * @return BoolQuery
     */
    public function createBoolQuery(string $dql)
    {
        $query = $this->em->createQuery($dql);

        return new BoolQuery($query);
    }

    /**
     * @param string $dql
     * @return BoolsQuery
     */
    public function createBoolsQuery(string $dql)
    {
        $query = $this->em->createQuery($dql);

        return new BoolsQuery($query);
    }

    /**
     * @template Entity
     * @psalm-param class-string<Entity> $type
     * @psalm-return EntityQueryBuilder<Entity>
     *
     * @param string $type
     * @return EntityQueryBuilder
     */
    public function createEntityQueryBuilder(string $type)
    {
        if (!class_exists($type)) {
            throw new InvalidArgumentException('Expecting existing class, got '.$type);
        }

        return new EntityQueryBuilder($this->em, $type);
    }

    /**
     * @template Entity
     * @psalm-param class-string<Entity> $type
     * @psalm-return EntitiesQueryBuilder<Entity>
     *
     * @param string $type
     * @return EntitiesQueryBuilder
     */
    public function createEntitiesQueryBuilder(string $type)
    {
        Assert::classExists($type, "Expecting existing class, got '{$type}'");

        return new EntitiesQueryBuilder($this->em, $type);
    }

    /**
     * @template Entity
     * @psalm-param class-string<Entity> $type
     * @psalm-return EntityQuery<Entity>
     *
     * @param string $type
     * @param string $dql
     * @return EntityQuery
     */
    public function createEntityQuery(string $type, string $dql)
    {
        Assert::classExists($type, "Expecting existing class, got '{$type}'");
        $query = $this->em->createQuery($dql);

        return new EntityQuery($query, $type);
    }

    /**
     * @template Entity
     * @psalm-param class-string<Entity> $type
     * @psalm-return EntitiesQuery<Entity>
     *
     * @param string $type
     * @param string $dql
     * @return EntitiesQuery
     */
    public function createEntitiesQuery(string $type, string $dql)
    {
        Assert::classExists($type, "Expecting existing class, got '{$type}'");
        $query = $this->em->createQuery($dql);

        return new EntitiesQuery($query, $type);
    }

    /**
     * @return IntQueryBuilder
     */
    public function createCountQueryBuilder()
    {
        return new IntQueryBuilder($this->em);
    }

    /**
     * @param string $dql
     * @return IntQuery
     */
    public function createCountQuery(string $dql)
    {
        $query = $this->em->createQuery($dql);

        return new IntQuery($query);
    }

    /**
     * @return QueryBuilder
     */
    public function createQueryBuilder()
    {
        return $this->em->createQueryBuilder();
    }

    /**
     * @template Entity
     *
     * @psalm-param class-string<Entity> $entityName
     *
     * @return ObjectRepository
     * @psalm-return ObjectRepository<Entity>
     */
    public function getRepository(string $entityName)
    {
        return $this->em->getRepository($entityName);
    }

    /**
     * @template Entity
     *
     * @param class-string<Entity> $entityName
     *
     * @param mixed $id
     *
     * @return object|null
     * @psalm-return ?Entity
     */
    public function find(string $entityName, $id, ?int $lockMode = null, ?int $lockVersion = null)
    {
        return $this->em->find($entityName, $id, $lockMode, $lockVersion);
    }

    /**
     * @template Entity
     *
     * @param class-string<Entity> $entityName
     *
     * @param mixed $id
     *
     * @return object|null
     * @psalm-return ?Entity
     */
    public function getReference(string $entityName, $id)
    {
        return $this->em->getReference($entityName, $id);
    }

    /**
     * @return EntityManager
     */
    public function get()
    {
        return $this->em;
    }
}
