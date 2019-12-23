<?php
declare(strict_types=1);

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use DoctrineTypedResults\EntityManager\TypedEntityManager;
use DoctrineTypedResults\QueryBuilder\IntQueryBuilder;
use PHPUnit\Framework\TestCase;

final class TypedEntityManagerTest extends TestCase
{
    public function testInvalidStringConstructor()
    {
        $this->expectException('TypeError');
        
        $tem = new TypedEntityManager('a');
    }

    public function testInvalidObjectConstructor()
    {
        // mock the repository so it returns the mock of the user (just a random string)
        $repositoryMock = $this
            ->getMockBuilder(EntityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $tem = new TypedEntityManager($repositoryMock);
        
        $this->assertInstanceOf('TypedEntityManager', $tem);
    }

    public function testIntConstructor()
    {
        $em = new EntityManager();
        $tem = new TypedEntityManager($em);
        $qb = $tem->createIntQueryBuilder();
        
        $this->assertInstanceOf(IntQueryBuilder::class, $qb);
    }
}
