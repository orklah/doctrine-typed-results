<?php

declare(strict_types=1);


namespace DoctrineTypedResults\QueryBuilder;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr;

use Doctrine\ORM\Query\Parameter;
use Doctrine\ORM\Query\QueryException;

use function func_get_args;

trait TypedQueryBuilderTrait
{
    /**
     * @param mixed|null $select
     * @return static
     */
    public function select($select = null)
    {
        $this->getQueryBuilder()->select($select);
        return $this;
    }
    /**
     * @param mixed|null $select
     * @return static
     */
    public function addSelect($select = null)
    {
        $this->getQueryBuilder()->addSelect($select);
        return $this;
    }
    /** @return static */
    public function from($from, $alias, $indexBy = null)
    {
        $this->getQueryBuilder()->from($from, $alias, $indexBy);
        return $this;
    }
    /** @return static */
    public function where($predicates)
    {
        $this->getQueryBuilder()->where($predicates);
        return $this;
    }
    /**
     * @param mixed $where
     * @return static
     */
    public function andWhere()
    {
        $args = func_get_args(); // Local variable to help PSALM detect func_get_args
        $this->getQueryBuilder()->andWhere(...$args);
        return $this;
    }
    /**
     * @param mixed $where
     * @return static
     */
    public function orWhere()
    {
        $args = func_get_args(); // Local variable to help PSALM detect func_get_args
        $this->getQueryBuilder()->orWhere(...$args);
        return $this;
    }
    /** @return static */
    public function having($having)
    {
        $this->getQueryBuilder()->having($having);
        return $this;
    }
    /** @return static */
    public function andHaving($having)
    {
        $this->getQueryBuilder()->andHaving($having);
        return $this;
    }
    /** @return static */
    public function orHaving($having)
    {
        $this->getQueryBuilder()->orHaving($having);
        return $this;
    }

    /**
     * @param string|Expr\OrderBy $sort The ordering expression.
     * @param string $order The ordering direction.
     *
     * @return static
     */
    public function orderBy($sort, $order = null)
    {
        $this->getQueryBuilder()->orderBy($sort, $order);

        return $this;
    }

    /**
     * @param int|null $maxResults
     * @return static
     */
    public function setMaxResults($maxResults)
    {
        $this->getQueryBuilder()->setMaxResults($maxResults);
        return $this;
    }

    /**
     * @param int $firstResult
     * @return static
     */
    public function setFirstResult($firstResult)
    {
        $this->getQueryBuilder()->setFirstResult($firstResult);
        return $this;
    }








    
    
    
    
    
    

    /**
     * @return Expr
     */
    public function expr()
    {
        return $this->getQueryBuilder()->expr();
    }

    /**
     * @param bool $cacheable
     * @return static
     */
    public function setCacheable($cacheable)
    {
        $this->getQueryBuilder()->setCacheable($cacheable);
        return $this;
    }

    /**
     * @return bool
     */
    public function isCacheable()
    {
        return $this->getQueryBuilder()->isCacheable();
    }

    /**
     * @param string $cacheRegion
     * @return static
     */
    public function setCacheRegion($cacheRegion)
    {
        $this->getQueryBuilder()->setCacheRegion($cacheRegion);
        return $this;
    }

    /**
     * @return string|null 
     */
    public function getCacheRegion()
    {
        return $this->getQueryBuilder()->getCacheRegion();
    }

    /**
     * @return int
     */
    public function getLifetime()
    {
        return $this->getQueryBuilder()->getLifetime();
    }

    /**
     * @param int $lifetime
     * @return static
     */
    public function setLifetime($lifetime)
    {
        $this->getQueryBuilder()->setLifetime($lifetime);
        return $this;
    }

    /**
     * @return int
     */
    public function getCacheMode()
    {
        return $this->getQueryBuilder()->getCacheMode();
    }

    /**
     * @param int $cacheMode
     * @return static
     */
    public function setCacheMode($cacheMode)
    {
        $this->getQueryBuilder()->setCacheMode($cacheMode);
        return $this;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->getQueryBuilder()->getType();
    }

    /**
     * @return EntityManager 
     */
    public function getEntityManager()
    {
        return $this->getQueryBuilder()->getEntityManager();
    }

    /**
     * @return int
     */
    public function getState()
    {
        return $this->getQueryBuilder()->getState();
    }

    /**
     * @return string
     */
    public function getDQL()
    {
        return $this->getQueryBuilder()->getDQL();
    }

    /**
     * @return string
     * @deprecated
     */
    public function getRootAlias()
    {
        return $this->getQueryBuilder()->getRootAlias();
    }

    /**
     * @return string[]
     */
    public function getRootAliases()
    {
        return $this->getQueryBuilder()->getRootAliases();
    }

    /**
     * @return string[] 
     */
    public function getAllAliases()
    {
        return $this->getQueryBuilder()->getAllAliases();
    }

    /**
     * @return string[]
     */
    public function getRootEntities()
    {
        return $this->getQueryBuilder()->getRootEntities();
    }

    /**
     * @param string|int $key
     * @param mixed          $value
     * @param string|int|null    $type
     *
     * @return static
     */
    public function setParameter($key, $value, $type = null)
    {
        $this->getQueryBuilder()->setParameter($key, $value, $type);
        return $this;
    }

    /**
     * @phpstan-param ArrayCollection<array-key, Parameter>|Parameter[] $parameters
     * @psalm-param ArrayCollection<array-key, Parameter>|Parameter[] $parameters
     * @param ArrayCollection|Parameter[] $parameters The query parameters to set.
     * @return static
     */
    public function setParameters($parameters)
    {
        $this->getQueryBuilder()->setParameters($parameters);
        return $this;
    }

    /**
     * @phpstan-return ArrayCollection<array-key, Parameter>
     * @psalm-return ArrayCollection<array-key, Parameter>
     * @return ArrayCollection
     */
    public function getParameters()
    {
        return $this->getQueryBuilder()->getParameters();
    }

    /**
     * @param mixed $key
     * @return Parameter|null
     */
    public function getParameter($key)
    {
        return $this->getQueryBuilder()->getParameter($key);
    }

    /**
     * @return int
     */
    public function getFirstResult()
    {
        return $this->getQueryBuilder()->getFirstResult();
    }

    /**
     * @return int|null
     */
    public function getMaxResults()
    {
        return $this->getQueryBuilder()->getMaxResults();
    }

    /**
     * @param string         $dqlPartName
     * @param object|mixed[] $dqlPart
     * @param bool           $append
     * @return static
     */
    public function add($dqlPartName, $dqlPart, $append = false)
    {
        $this->getQueryBuilder()->add($dqlPartName, $dqlPart, $append);
        return $this;
    }

    /**
     * @param bool $flag
     * @return static
     */
    public function distinct($flag = true)
    {
        $this->getQueryBuilder()->distinct($flag);
        return $this;
    }

    /**
     * @param string $delete
     * @param string $alias
     *
     * @return static
     */
    public function delete($delete = null, $alias = null)
    {
        $this->getQueryBuilder()->delete($delete, $alias);
        return $this;
    }

    /**
     * @param string $update
     * @param string $alias
     *
     * @return static
     */
    public function update($update = null, $alias = null)
    {
        $this->getQueryBuilder()->update($update, $alias);
        return $this;
    }

    /**
     * @param string $alias
     * @param string $indexBy
     *
     * @return static
     *
     * @throws QueryException
     */
    public function indexBy($alias, $indexBy)
    {
        $this->getQueryBuilder()->indexBy($alias, $indexBy);
        return $this;
    }

    /**
     * @param string      $join
     * @param string      $alias
     * @param string|null $conditionType
     * @param string|null $condition
     * @param string|null $indexBy
     *
     * @return static
     */
    public function join($join, $alias, $conditionType = null, $condition = null, $indexBy = null)
    {
        $this->getQueryBuilder()->join($join, $alias, $conditionType, $condition, $indexBy);
        return $this;
    }

    /**
     * @param string      $join
     * @param string      $alias
     * @param string|null $conditionType
     * @param string|null $condition
     * @param string|null $indexBy
     *
     * @return static
     */
    public function innerJoin($join, $alias, $conditionType = null, $condition = null, $indexBy = null)
    {
        $this->getQueryBuilder()->innerJoin($join, $alias, $conditionType, $condition, $indexBy);
        return $this;
    }

    /**
     * @param string      $join
     * @param string      $alias
     * @param string|null $conditionType
     * @param string|null $condition
     * @param string|null $indexBy
     *
     * @return static
     */
    public function leftJoin($join, $alias, $conditionType = null, $condition = null, $indexBy = null)
    {
        $this->getQueryBuilder()->leftJoin($join, $alias, $conditionType, $condition, $indexBy);
        return $this;
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return static
     */
    public function set($key, $value)
    {
        $this->getQueryBuilder()->set($key, $value);
        return $this;
    }

    /**
     * @param string $groupBy
     *
     * @return static
     */
    public function groupBy($groupBy)
    {
        $this->getQueryBuilder()->groupBy($groupBy);
        return $this;
    }

    /**
     * @param string $groupBy
     *
     * @return static
     */
    public function addGroupBy($groupBy)
    {
        $this->getQueryBuilder()->addGroupBy($groupBy);
        return $this;
    }

    /**
     * @param string|Expr\OrderBy $sort
     * @param string              $order
     *
     * @return static
     */
    public function addOrderBy($sort, $order = null)
    {
        $this->getQueryBuilder()->addOrderBy($sort, $order);
        return $this;
    }

    /**
     * @param Criteria $criteria
     *
     * @return static
     *
     * @throws QueryException
     */
    public function addCriteria(Criteria $criteria)
    {
        $this->getQueryBuilder()->addCriteria($criteria);
        return $this;
    }

    /**
     * @param string $queryPartName
     *
     * @return mixed $queryPart
     */
    public function getDQLPart($queryPartName)
    {
        return $this->getQueryBuilder()->getDQLPart($queryPartName);
    }

    /**
     * @return mixed[]
     */
    public function getDQLParts()
    {
        return $this->getQueryBuilder()->getDQLParts();
    }

    /**
     * @param string[]|null $parts
     *
     * @return static
     */
    public function resetDQLParts($parts = null)
    {
        $this->getQueryBuilder()->resetDQLParts($parts);
        return $this;
    }

    /**
     * @param string $part
     *
     * @return static
     */
    public function resetDQLPart($part)
    {
        $this->getQueryBuilder()->resetDQLPart($part);
        return $this;
    }

    /**
     * @return string 
     */
    public function __toString()
    {
        return $this->getQueryBuilder()->__toString();
    }
    
    public function __clone()
    {
        clone $this->getQueryBuilder();
    }
}
