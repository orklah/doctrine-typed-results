<?php

declare(strict_types=1);


namespace DoctrineTypedResults\Query;

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


    public function setQueryCacheDriver($queryCache)
    {
        $this->query->setQueryCacheDriver($queryCache);
        return $this;
    }


    public function useQueryCache($bool)
    {
        $this->query->useQueryCache($bool);
        return $this;
    }


    public function getQueryCacheDriver()
    {
        return $this->query->getQueryCacheDriver();
    }


    public function setQueryCacheLifetime($timeToLive)
    {
        $this->query->setQueryCacheLifetime($timeToLive);
        return $this;
    }


    public function getQueryCacheLifetime()
    {
        return $this->query->getQueryCacheLifetime();
    }


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


    public function iterate($parameters = null, $hydrationMode = Query::HYDRATE_OBJECT)
    {
        return $this->query->iterate($parameters, $hydrationMode);
    }


    public function setHint($name, $value)
    {
        $this->query->setHint($name, $value);
        return $this;
    }


    public function setHydrationMode($hydrationMode)
    {
        $this->query->setHydrationMode($hydrationMode);
        return $this;
    }


    public function setLockMode($lockMode)
    {
        $this->query->setLockMode($lockMode);
        return $this;
    }


    public function getLockMode()
    {
        return $this->query->getLockMode();
    }
    
    
    public function setFirstResult($firstResult)
    {
        $this->query->setFirstResult($firstResult);
        return $this;
    }


    public function setMaxResults($maxResults)
    {
        $this->query->setMaxResults($maxResults);
        return $this;
    }

    public function __clone()
    {
        clone $this->query;
    }
}