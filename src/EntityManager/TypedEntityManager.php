<?php

declare(strict_types=1);

namespace DoctrineTypedResults\EntityManager;

use DoctrineTypedResults\QueryBuilder\BoolQueryBuilder;
use DoctrineTypedResults\QueryBuilder\CustomQueryBuilder;
use DoctrineTypedResults\QueryBuilder\EntityQueryBuilder;
use DoctrineTypedResults\QueryBuilder\FloatQueryBuilder;
use DoctrineTypedResults\QueryBuilder\IntQueryBuilder;
use DoctrineTypedResults\QueryBuilder\StringQueryBuilder;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Persistence\ObjectRepository;
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
     * @template T
     * @psalm-param class-string<T> $type
     * @psalm-return EntityQueryBuilder<T>
     *
     * @param string $type
     * @return EntityQueryBuilder
     */
    public function createEntityQueryBuilder(string $type)
    {
        if (!class_exists($type)) {
            throw new InvalidArgumentException('Expecting existing class, got '.$type);
        }

        $qb = new EntityQueryBuilder($this->em);
        $qb->setType($type);
        return $qb;
    }

    /*public function createEntitiesQueryBuilder($type)
    {
        assert(class_exists($type));

        return new EntityQueryBuilder($this->em, $type, true);
    }*/

    /**
     * @param string $type
     * @return CustomQueryBuilder
     */
    public function createCustomQueryBuilder(string $type)
    {
        $qb = new CustomQueryBuilder($this->em);
        $qb->setType($type);
        return $qb;
    }

    /*public function createCustomsQueryBuilder($type)
    {
        return new CustomQueryBuilder($this->em, $type, true);
    }*/

    /**
     * @return IntQueryBuilder
     */
    public function createCountQueryBuilder()
    {
        return new IntQueryBuilder($this->em);
    }

    /**
     * @return QueryBuilder
     */
    public function createQueryBuilder()
    {
        return $this->em->createQueryBuilder();
    }

    /**
     * @template T
     *
     * @psalm-param class-string<T> $entityName
     * @phpstan-param class-string<T> $entityName
     * @template-typeof T $entityName
     *
     * @return EntityRepository
     * @psalm-return ObjectRepository<T>
     * @phpstan-return ObjectRepository<T>
     */
    public function getRepository(string $entityName)
    {
        return $this->em->getRepository($entityName);
    }

    /**
     * @template T
     *
     * @param class-string<T> $entityName
     * @template-typeof T $entityName
     *
     * @param mixed $id
     *
     * @return EntityManager|null
     * @psalm-return T|null
     * @phpstan-return T|null
     */
    public function find(string $entityName, $id, ?int $lockMode = null, ?int $lockVersion = null)
    {
        return $this->em->find($entityName, $id, $lockMode, $lockVersion);
    }

    /**
     * @template T
     *
     * @param class-string<T> $entityName
     *
     * @param mixed $id
     *
     * @return EntityManager|null
     * @psalm-return T|null
     * @phpstan-return T|null
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
