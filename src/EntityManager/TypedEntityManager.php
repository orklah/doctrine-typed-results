<?php

declare(strict_types=1);

namespace DoctrineTypedResults\EntityManager;

use DoctrineTypedResults\Query\BoolQuery;
use DoctrineTypedResults\Query\EntityQuery;
use DoctrineTypedResults\Query\FloatQuery;
use DoctrineTypedResults\Query\IntQuery;
use DoctrineTypedResults\Query\StringQuery;
use DoctrineTypedResults\QueryBuilder\BoolQueryBuilder;
use DoctrineTypedResults\QueryBuilder\EntityQueryBuilder;
use DoctrineTypedResults\QueryBuilder\FloatQueryBuilder;
use DoctrineTypedResults\QueryBuilder\IntQueryBuilder;
use DoctrineTypedResults\QueryBuilder\StringQueryBuilder;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use InvalidArgumentException;

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

    /*public function createIntsQueryBuilder()
    {
        return new IntQueryBuilder($this->em, true);
    }*/

    /**
     * @param $dql
     * @return IntQuery
     */
    public function createIntQuery(string $dql)
    {
        $query = $this->em->createQuery($dql);

        return new IntQuery($query);
    }

    /**
     * @return FloatQueryBuilder
     */
    public function createFloatQueryBuilder()
    {
        return new FloatQueryBuilder($this->em);
    }

    /*public function createFloatsQueryBuilder($type)
    {
        assert($this->isSupportedType($type));

        return new FloatQueryBuilder($this->em, $type, true);
    }*/

    /**
     * @param $dql
     * @return FloatQuery
     */
    public function createFloatQuery(string $dql)
    {
        $query = $this->em->createQuery($dql);

        return new FloatQuery($query);
    }
    
    /**
     * @return StringQueryBuilder
     */
    public function createStringQueryBuilder()
    {
        return new StringQueryBuilder($this->em);
    }

    /*public function createStringsQueryBuilder($type)
    {
        assert($this->isSupportedType($type));

        return new StringQueryBuilder($this->em, $type, true);
    }*/

    /**
     * @param $dql
     * @return StringQuery
     */
    public function createStringQuery(string $dql)
    {
        $query = $this->em->createQuery($dql);

        return new StringQuery($query);
    }
    
    /**
     * @return BoolQueryBuilder
     */
    public function createBoolQueryBuilder()
    {
        return new BoolQueryBuilder($this->em);
    }

    /*public function createBoolsQueryBuilder($type)
    {
        assert($this->isSupportedType($type));

        return new BoolQueryBuilder($this->em, $type, true);
    }*/

    /**
     * @param $dql
     * @return BoolQuery
     */
    public function createBoolQuery(string $dql)
    {
        $query = $this->em->createQuery($dql);

        return new BoolQuery($query);
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

    /*public function createEntitiesQueryBuilder($type)
    {
        assert(class_exists($type));

        return new EntityQueryBuilder($this->em, $type, true);
    }*/

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
        if (!class_exists($type)) {
            throw new InvalidArgumentException('Expecting existing class, got '.$type);
        }
        $query = $this->em->createQuery($dql);

        return new EntityQuery($query, $type);
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
     * @phpstan-param class-string<Entity> $entityName
     *
     * @return ObjectRepository
     * @psalm-return ObjectRepository<Entity>
     * @phpstan-return ObjectRepository<Entity>
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
     * @psalm-return Entity|null
     * @phpstan-return Entity|null
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
     * @psalm-return Entity|null
     * @phpstan-return Entity|null
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

    /**
     * @param string $type
     *
     * @return bool
     */
    private function isSupportedType($type)
    {
        return in_array($type, ['string', 'int', 'bool', 'float'], true);
    }
}
