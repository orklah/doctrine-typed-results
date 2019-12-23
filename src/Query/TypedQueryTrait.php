<?php

declare(strict_types=1);


namespace DoctrineTypedResults\Query;

use BadMethodCallException;
use Doctrine\ORM\Query;

trait TypedQueryTrait
{
    public function getSQL()
    {
        return $this->query->getSQL();
    }

    public function getAST()
    {
        return $this->query->getAST();
    }

    /** @return static */
    public function setQueryCacheDriver($queryCache)
    {
        $this->query->setQueryCacheDriver($queryCache);
        return $this;
    }

    /** @return static */
    public function useQueryCache($bool)
    {
        $this->query->useQueryCache($bool);
        return $this;
    }
    
    public function getQueryCacheDriver()
    {
        return $this->query->getQueryCacheDriver();
    }

    /** @return static */
    public function setQueryCacheLifetime($timeToLive)
    {
        $this->query->setQueryCacheLifetime($timeToLive);
        return $this;
    }
    
    public function getQueryCacheLifetime()
    {
        return $this->query->getQueryCacheLifetime();
    }

    /** @return static */
    public function expireQueryCache($expire = true)
    {
        $this->query->expireQueryCache($expire);
        return $this;
    }
    
    public function getExpireQueryCache()
    {
        return $this->query->getExpireQueryCache();
    }
    
    public function free()
    {
        $this->query->free();
    }

    /** @return static */
    public function setDQL($dqlQuery)
    {
        $this->query->setDQL($dqlQuery);
        return $this;
    }
    
    public function getDQL()
    {
        return $this->query->getDQL();
    }
    
    public function getState()
    {
        return $this->query->getState();
    }
    
    public function contains($dql)
    {
        return $this->query->contains($dql);
    }
    
    public function getFirstResult()
    {
        return $this->query->getFirstResult();
    }
    
    public function getMaxResults()
    {
        return $this->query->getMaxResults();
    }

    /** @return static */
    public function setLockMode($lockMode)
    {
        $this->query->setLockMode($lockMode);
        return $this;
    }
    
    public function getLockMode()
    {
        return $this->query->getLockMode();
    }

    /** @return static */
    public function setFirstResult($firstResult)
    {
        $this->query->setFirstResult($firstResult);
        return $this;
    }

    /** @return static */
    public function setMaxResults($maxResults)
    {
        $this->query->setMaxResults($maxResults);
        return $this;
    }

    public function __clone()
    {
        clone $this->query;
    }
    
    public function _doExecute()
    {
        throw new BadMethodCallException('_doExecute method should not be called directly');
    }
}
