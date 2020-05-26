<?php

declare(strict_types=1);


namespace DoctrineTypedResults\Query;

use BadMethodCallException;
use Doctrine\ORM\Query;

/** @method Query getQuery() */
trait TypedQueryTrait
{
    public function getSQL()
    {
        return $this->getQuery()->getSQL();
    }

    public function getAST()
    {
        return $this->getQuery()->getAST();
    }

    /** @return static */
    public function setQueryCacheDriver($queryCache)
    {
        $this->getQuery()->setQueryCacheDriver($queryCache);
        return $this;
    }

    /** @return static */
    public function useQueryCache($bool)
    {
        $this->getQuery()->useQueryCache($bool);
        return $this;
    }

    public function getQueryCacheDriver()
    {
        return $this->getQuery()->getQueryCacheDriver();
    }

    /** @return static */
    public function setQueryCacheLifetime($timeToLive)
    {
        $this->getQuery()->setQueryCacheLifetime($timeToLive);
        return $this;
    }

    public function getQueryCacheLifetime()
    {
        return $this->getQuery()->getQueryCacheLifetime();
    }

    /** @return static */
    public function expireQueryCache($expire = true)
    {
        $this->getQuery()->expireQueryCache($expire);
        return $this;
    }

    public function getExpireQueryCache()
    {
        return $this->getQuery()->getExpireQueryCache();
    }

    public function free()
    {
        $this->getQuery()->free();
    }

    /** @return static */
    public function setDQL($dqlQuery)
    {
        $this->getQuery()->setDQL($dqlQuery);
        return $this;
    }

    public function getDQL()
    {
        return $this->getQuery()->getDQL();
    }

    public function getState()
    {
        return $this->getQuery()->getState();
    }

    public function contains($dql)
    {
        return $this->getQuery()->contains($dql);
    }

    public function getFirstResult()
    {
        return $this->getQuery()->getFirstResult();
    }

    public function getMaxResults()
    {
        return $this->getQuery()->getMaxResults();
    }

    /** @return static */
    public function setLockMode($lockMode)
    {
        $this->getQuery()->setLockMode($lockMode);
        return $this;
    }

    public function getLockMode()
    {
        return $this->getQuery()->getLockMode();
    }

    /** @return static */
    public function setFirstResult($firstResult)
    {
        $this->getQuery()->setFirstResult($firstResult);
        return $this;
    }

    /** @return static */
    public function setMaxResults($maxResults)
    {
        $this->getQuery()->setMaxResults($maxResults);
        return $this;
    }

    public function __clone()
    {
        clone $this->getQuery();
    }

    /**
     * @return void
     *
     * @psalm-suppress ImplementedReturnTypeMismatch forbidden function, marked as void to prevent usage
     */
    protected function _doExecute()
    {
        throw new BadMethodCallException('_doExecute method should not be called directly');
    }

    /** @return static */
    public function setParameter($key, $value, $type = null)
    {
        $this->getQuery()->setParameter($key, $value, $type);
        return $this;
    }
}
