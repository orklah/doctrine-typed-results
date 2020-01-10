<?php

declare(strict_types=1);


namespace DoctrineTypedResults\Query;

use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Cache\QueryCacheProfile;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Internal\Hydration\IterableResult;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\AST\DeleteStatement;
use Doctrine\ORM\Query\AST\SelectStatement;
use Doctrine\ORM\Query\AST\UpdateStatement;
use Doctrine\ORM\Query\Parameter;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\TransactionRequiredException;

interface QueryInterface
{
    /**
     * @return mixed
     */
    public function getSQL();

    /**
     * @return SelectStatement|UpdateStatement|DeleteStatement
     */
    public function getAST();

    /**
     * @param Cache|null $queryCache
     * @return AbstractQuery
     */
    public function setQueryCacheDriver($queryCache);

    /**
     * @param bool $bool
     * @return AbstractQuery
     */
    public function useQueryCache($bool);

    /**
     * @return Cache|null
     */
    public function getQueryCacheDriver();

    /**
     * @param int $timeToLive
     * @return AbstractQuery
     */
    public function setQueryCacheLifetime($timeToLive);

    /**
     * @return int
     */
    public function getQueryCacheLifetime();

    /**
     * @param bool $expire
     * @return AbstractQuery
     */
    public function expireQueryCache($expire = true);

    /**
     * @return bool
     */
    public function getExpireQueryCache();

    public function free();

    /**
     * @param string $dqlQuery
     * @return AbstractQuery
     */
    public function setDQL($dqlQuery);

    /**
     * @return string|null
     */
    public function getDQL();

    /**
     * @return int
     */
    public function getState();

    /**
     * @param string $dql
     * @return bool
     */
    public function contains($dql);

    /**
     * @param int $firstResult
     * @return AbstractQuery
     */
    public function setFirstResult($firstResult);

    /**
     * @return int|null
     */
    public function getFirstResult();

    /**
     * @param int|null $maxResults
     * @return AbstractQuery
     */
    public function setMaxResults($maxResults);

    /**
     * @return int|null
     */
    public function getMaxResults();

    /**
     * @phpstan-param ArrayCollection<array-key, Parameter>|Parameter[]|null $parameters
     * @psalm-param ArrayCollection<array-key, Parameter>|Parameter[]|null $parameters
     * @param ArrayCollection|Parameter[]|null $parameters
     * @param string|int                       $hydrationMode
     * @return IterableResult
     */
    public function iterate($parameters = null, $hydrationMode = Query::HYDRATE_OBJECT);

    /**
     * @param string $name
     * @param mixed  $value
     * @return static
     */
    public function setHint($name, $value);

    /**
     * @param string|int $hydrationMode
     * @return static
     */
    public function setHydrationMode($hydrationMode);

    /**
     * @param int $lockMode
     * @return AbstractQuery
     * @throws TransactionRequiredException
     */
    public function setLockMode($lockMode);

    /**
     * @return int|null
     */
    public function getLockMode();


    /**
     * @return void
     */
    public function __clone();


    /**
     * @param bool $cacheable
     * @return static
     */
    public function setCacheable($cacheable);

    /**
     * @return bool
     */
    public function isCacheable();

    /**
     * @param string $cacheRegion
     * @return static
     */
    public function setCacheRegion($cacheRegion);

    /**
     * @return string|null
     */
    public function getCacheRegion();

    /**
     * @return int
     */
    public function getLifetime();

    /**
     * @param int $lifetime
     * @return AbstractQuery
     */
    public function setLifetime($lifetime);

    /**
     * @return int
     */
    public function getCacheMode();

    /**
     * @param int $cacheMode
     * @return AbstractQuery
     */
    public function setCacheMode($cacheMode);

    /**
     * @return EntityManager
     */
    public function getEntityManager();

    /**
     * @phpstan-return ArrayCollection<array-key, Parameter>
     * @psalm-return ArrayCollection<array-key, Parameter>
     * @return ArrayCollection
     */
    public function getParameters();

    /**
     * @param mixed $key
     * @return Query\Parameter|null
     */
    public function getParameter($key);

    /**
     * @phpstan-param ArrayCollection<array-key, Parameter>|Parameter[] $parameters
     * @psalm-param ArrayCollection<array-key, Parameter>|Parameter[] $parameters
     * @param ArrayCollection|mixed[] $parameters
     * @return static
     */
    public function setParameters($parameters);

    /**
     * @param string|int  $key
     * @param mixed       $value
     * @param string|null $type
     * @return static
     */
    public function setParameter($key, $value, $type = null);

    /**
     * @param mixed $value
     * @return mixed[]|string
     * @throws ORMInvalidArgumentException
     */
    public function processParameterValue($value);

    /**
     * @param ResultSetMapping $rsm
     * @return static
     */
    public function setResultSetMapping(ResultSetMapping $rsm);

    /**
     * @param QueryCacheProfile $profile
     * @return static
     */
    public function setHydrationCacheProfile(QueryCacheProfile $profile = null);

    /**
     * @return QueryCacheProfile
     */
    public function getHydrationCacheProfile();

    /**
     * @param QueryCacheProfile $profile
     * @return static
     */
    public function setResultCacheProfile(QueryCacheProfile $profile = null);

    /**
     * @param Cache|null $resultCacheDriver
     * @return static
     * @throws ORMException
     */
    public function setResultCacheDriver($resultCacheDriver = null);

    /**
     * @return Cache
     */
    public function getResultCacheDriver();

    /**
     * @param bool   $useCache
     * @param int    $lifetime
     * @param string $resultCacheId
     * @return static
     */
    public function useResultCache($useCache, $lifetime = null, $resultCacheId = null);

    /**
     * @param int|null    $lifetime
     * @param string|null $resultCacheId
     * @return AbstractQuery
     */
    public function enableResultCache(?int $lifetime = null, ?string $resultCacheId = null): AbstractQuery;

    /**
     * @return AbstractQuery
     */
    public function disableResultCache(): AbstractQuery;

    /**
     * @param int $lifetime
     * @return static
     */
    public function setResultCacheLifetime($lifetime);

    /**
     * @return int
     */
    public function getResultCacheLifetime();

    /**
     * @param bool $expire
     * @return static
     */
    public function expireResultCache($expire = true);

    /**
     * @return bool
     */
    public function getExpireResultCache();

    /**
     * @return QueryCacheProfile
     */
    public function getQueryCacheProfile();

    /**
     * @param string $class
     * @param string $assocName
     * @param int    $fetchMode
     * @return static
     */
    public function setFetchMode($class, $assocName, $fetchMode);

    /**
     * @return string|int
     */
    public function getHydrationMode();

    /**
     * @param string|int $hydrationMode
     * @return mixed
     */
    public function getResult($hydrationMode = AbstractQuery::HYDRATE_OBJECT);

    /**
     * @return mixed[]
     */
    public function getArrayResult();

    /**
     * @phpstan-return scalar
     * @psalm-return scalar
     * @return mixed
     */
    public function getScalarResult();

    /**
     * @param string|int $hydrationMode
     * @return mixed
     * @throws NonUniqueResultException
     */
    public function getOneOrNullResult($hydrationMode = null);

    /**
     * @param string|int $hydrationMode
     * @return mixed
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getSingleResult($hydrationMode = null);

    /**
     * @return mixed
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getSingleScalarResult();

    /**
     * @param string $name
     * @return mixed
     */
    public function getHint($name);

    /**
     * @param string $name
     * @return bool
     */
    public function hasHint($name);

    /**
     * @return mixed[]
     */
    public function getHints();

    /**
     * @phpstan-param ArrayCollection<array-key, Parameter>|Parameter[]|null $parameters
     * @psalm-param ArrayCollection<array-key, Parameter>|Parameter[]|null $parameters
     * @param ArrayCollection|Parameter[]|null $parameters
     * @param string|int|null                  $hydrationMode
     * @return mixed
     */
    public function execute($parameters = null, $hydrationMode = null);

    /**
     * @param string $id
     * @return static
     */
    public function setResultCacheId($id);

    /**
     * @return string
     */
    public function getResultCacheId();
}
