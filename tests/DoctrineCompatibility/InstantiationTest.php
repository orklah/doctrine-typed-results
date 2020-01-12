<?php

declare(strict_types=1);

namespace DoctrineCompatibility;

use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use DoctrineTypedResults\Paginator\TypedPaginator;
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
use DoctrineTypedResults\QueryBuilder\StringsQueryBuilder;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * This class will create an instance of each class to ensure every contract is respected
 * and no signature issue will happen
 */
final class InstantiationTest extends TestCase
{

    public function testInstantiation(): void
    {
        $em = $this->createMock(EntityManager::class);
        $config = $this->createMock(Configuration::class);
        $em->method('getConfiguration')->willReturn($config);
        $query = new Query($em);


        self::assertIsObject(new BoolQuery($query));
        self::assertIsObject(new BoolsQuery($query));
        self::assertIsObject(new EntitiesQuery($query, stdClass::class));
        self::assertIsObject(new EntityQuery($query, stdClass::class));
        self::assertIsObject(new FloatQuery($query));
        self::assertIsObject(new FloatsQuery($query));
        self::assertIsObject(new IntQuery($query));
        self::assertIsObject(new IntsQuery($query));
        self::assertIsObject(new StringQuery($query));
        self::assertIsObject(new StringsQuery($query));

        self::assertIsObject(new BoolQueryBuilder($em));
        self::assertIsObject(new BoolsQueryBuilder($em));
        self::assertIsObject(new EntitiesQueryBuilder($em, stdClass::class));
        self::assertIsObject(new EntityQueryBuilder($em, stdClass::class));
        self::assertIsObject(new FloatQueryBuilder($em));
        self::assertIsObject(new FloatsQueryBuilder($em));
        self::assertIsObject(new IntQueryBuilder($em));
        self::assertIsObject(new IntsQueryBuilder($em));
        self::assertIsObject(new StringQueryBuilder($em));
        self::assertIsObject(new StringsQueryBuilder($em));

        self::assertIsObject(new TypedPaginator(new StringQuery($query)));
    }
}
