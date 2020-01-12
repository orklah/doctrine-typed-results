<?php

declare(strict_types=1);

namespace Functionnalities;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use DoctrineTypedResults\EntityManager\TypedEntityManager;
use DoctrineTypedResults\Query\BoolQuery;
use DoctrineTypedResults\Query\BoolsQuery;
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
use DoctrineTypedResults\QueryBuilder\StringsQueryBuilder;
use PHPUnit\Framework\TestCase;


/**
 * This class check that TypedEntityManager behave as expected
 */
final class TypedEntityManagerTest extends TestCase
{
    public function testQueryCreation(): void
    {
        $em = $this->createMock(EntityManager::class);

        $config = $this->createMock(Configuration::class);
        $em->method('getConfiguration')->willReturn($config);

        $q = $this->createMock(AbstractQuery::class);
        $q->method('getEntityManager')->willReturn($em);

        $em->method('createQuery')->willReturn($q);

        $tem = new TypedEntityManager($em);

        self::assertInstanceOf(IntQuery::class, $tem->createIntQuery(''));
        self::assertInstanceOf(IntsQuery::class, $tem->createIntsQuery(''));
        self::assertInstanceOf(FloatQuery::class, $tem->createFloatQuery(''));
        self::assertInstanceOf(FloatsQuery::class, $tem->createFloatsQuery(''));
        self::assertInstanceOf(StringQuery::class, $tem->createStringQuery(''));
        self::assertInstanceOf(StringsQuery::class, $tem->createStringsQuery(''));
        self::assertInstanceOf(BoolQuery::class, $tem->createBoolQuery(''));
        self::assertInstanceOf(BoolsQuery::class, $tem->createBoolsQuery(''));
        self::assertInstanceOf(EntityQuery::class, $tem->createEntityQuery(self::class, ''));
        self::assertInstanceOf(IntQuery::class, $tem->createCountQuery(''));
    }

    public function testQueryBuilderCreation(): void
    {
        $em = $this->createMock(EntityManager::class);
        $q = $this->createMock(AbstractQuery::class);
        $em->method('createQuery')->willReturn($q);
        $qb = $this->createMock(QueryBuilder::class);
        $em->method('createQueryBuilder')->willReturn($qb);
        $tem = new TypedEntityManager($em);

        self::assertInstanceOf(IntQueryBuilder::class, $tem->createCountQueryBuilder());
        self::assertInstanceOf(EntityQueryBuilder::class, $tem->createEntityQueryBuilder(self::class));
        self::assertInstanceOf(EntitiesQueryBuilder::class, $tem->createEntitiesQueryBuilder(self::class));
        self::assertInstanceOf(QueryBuilder::class, $tem->createQueryBuilder());
        self::assertInstanceOf(BoolQueryBuilder::class, $tem->createBoolQueryBuilder());
        self::assertInstanceOf(BoolsQueryBuilder::class, $tem->createBoolsQueryBuilder());
        self::assertInstanceOf(StringQueryBuilder::class, $tem->createStringQueryBuilder());
        self::assertInstanceOf(StringsQueryBuilder::class, $tem->createStringsQueryBuilder());
        self::assertInstanceOf(FloatQueryBuilder::class, $tem->createFloatQueryBuilder());
        self::assertInstanceOf(FloatsQueryBuilder::class, $tem->createFloatsQueryBuilder());
        self::assertInstanceOf(IntQueryBuilder::class, $tem->createIntQueryBuilder());
        self::assertInstanceOf(IntsQueryBuilder::class, $tem->createIntsQueryBuilder());
    }
}
