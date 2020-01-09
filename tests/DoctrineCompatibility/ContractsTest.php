<?php

declare(strict_types=1);

namespace DoctrineCompatibility;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use DoctrineTypedResults\Query\QueryInterface;
use DoctrineTypedResults\QueryBuilder\QueryBuilderInterface;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

/**
 * This class will have to test the compatibility between contracts.
 * Each public function of substituted class(or its contract) must exists in the contract.
 */
final class ContractsTest extends TestCase
{
    /**
     * @throws ReflectionException
     * @todo: it should not be necessary to check AbstractQuery. Every method in Query should be in contract
     */
    public function testQueryContract()
    {
        $refl = new ReflectionClass(Query::class);
        foreach ($refl->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->getName() !== '__construct') {
                self::assertTrue(
                    method_exists(QueryInterface::class, $method->getName()) || (method_exists(AbstractQuery::class, $method->getName()) && !$method->isAbstract()),
                    $method->getName().' was not found in '.QueryInterface::class
                );
            }
        }
    }

    
    public function testQueryBuilderContract()
    {
        $refl = new ReflectionClass(QueryBuilder::class);
        foreach ($refl->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->getName() !== '__construct') {
                self::assertTrue(
                    method_exists(QueryBuilderInterface::class, $method->getName()),
                    $method->getName().' was not found in '.QueryBuilderInterface::class
                );
            }
        }
    }
}
