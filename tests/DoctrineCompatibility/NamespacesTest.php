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
        self::assertTrue(class_exists(EntityManager::class), EntityManager::class . ' could not be autoloaded');
        self::assertTrue(class_exists(QueryBuilder::class), QueryBuilder::class . ' could not be autoloaded');
        self::assertTrue(class_exists(Paginator::class), Paginator::class . ' could not be autoloaded');
        self::assertTrue(class_exists(NonUniqueResultException::class), NonUniqueResultException::class . ' could not be autoloaded');
        self::assertTrue(class_exists(NoResultException::class), NoResultException::class . ' could not be autoloaded');
        self::assertTrue(class_exists(Query::class), Query::class . ' could not be autoloaded');
        self::assertTrue(class_exists(ArrayCollection::class), ArrayCollection::class . ' could not be autoloaded');
        self::assertTrue(class_exists(AbstractQuery::class), AbstractQuery::class . ' could not be autoloaded');
        self::assertTrue(class_exists(DeleteStatement::class), DeleteStatement::class . ' could not be autoloaded');
        self::assertTrue(class_exists(SelectStatement::class), SelectStatement::class . ' could not be autoloaded');
        self::assertTrue(class_exists(UpdateStatement::class), UpdateStatement::class . ' could not be autoloaded');
        self::assertTrue(class_exists(Parameter::class), Parameter::class . ' could not be autoloaded');
        self::assertTrue(class_exists(TransactionRequiredException::class), TransactionRequiredException::class . ' could not be autoloaded');
        self::assertTrue(class_exists(Criteria::class), Criteria::class . ' could not be autoloaded');
        self::assertTrue(class_exists(Expr::class), Expr::class . ' could not be autoloaded');
        self::assertTrue(class_exists(QueryException::class), QueryException::class . ' could not be autoloaded');
    }

    public function testInterfaceNamespace()
    {
        self::assertTrue(interface_exists(ObjectRepository::class), ObjectRepository::class . ' could not be autoloaded');
        self::assertTrue(interface_exists(EntityManagerInterface::class), EntityManagerInterface::class . ' could not be autoloaded');
    }
}
