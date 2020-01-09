<?php

declare(strict_types=1);

namespace DoctrineCompatibility;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\AST\DeleteStatement;
use Doctrine\ORM\Query\AST\SelectStatement;
use Doctrine\ORM\Query\AST\UpdateStatement;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\Query\Parameter;
use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\TransactionRequiredException;
use Doctrine\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;

/**
 * This class will have to test if every class exists in the assumed namespace for this version of the library.
 * (e.g. DTR v1 will assume the existence of Doctrine\Persistence\ObjectRepository instead of previous Doctrine\Common\Persistence\ObjectRepository)
 */
final class NamespacesTest extends TestCase
{
    public function testClassNamespace()
    {
        self::assertTrue(class_exists(EntityManager::class));
        self::assertTrue(class_exists(QueryBuilder::class));
        self::assertTrue(class_exists(Paginator::class));
        self::assertTrue(class_exists(NonUniqueResultException::class));
        self::assertTrue(class_exists(NoResultException::class));
        self::assertTrue(class_exists(Query::class));
        self::assertTrue(class_exists(ArrayCollection::class));
        self::assertTrue(class_exists(AbstractQuery::class));
        self::assertTrue(class_exists(DeleteStatement::class));
        self::assertTrue(class_exists(SelectStatement::class));
        self::assertTrue(class_exists(UpdateStatement::class));
        self::assertTrue(class_exists(Parameter::class));
        self::assertTrue(class_exists(TransactionRequiredException::class));
        self::assertTrue(class_exists(Criteria::class));
        self::assertTrue(class_exists(Expr::class));
        self::assertTrue(class_exists(QueryException::class));
    }

    public function testInterfaceNamespace()
    {
        self::assertTrue(interface_exists(ObjectRepository::class));
        self::assertTrue(interface_exists(EntityManagerInterface::class));
    }
}
