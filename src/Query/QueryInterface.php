<?php

declare(strict_types=1);


namespace DoctrineTypedResults\Query;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query;
use Doctrine\ORM\TransactionRequiredException;

interface QueryInterface
{
    /**
     * A query object is in CLEAN state when it has NO unparsed/unprocessed DQL parts.
     */
    const STATE_CLEAN  = 1;

    /**
     * A query object is in state DIRTY when it has DQL parts that have not yet been
     * parsed/processed. This is automatically defined as DIRTY when addDqlQueryPart
     * is called.
     */
    const STATE_DIRTY = 2;

    /* Query HINTS */

    /**
     * The refresh hint turns any query into a refresh query with the result that
     * any local changes in entities are overridden with the fetched values.
     *
     * @var string
     */
    const HINT_REFRESH = 'doctrine.refresh';

    /**
     * @var string
     */
    const HINT_CACHE_ENABLED = 'doctrine.cache.enabled';

    /**
     * @var string
     */
    const HINT_CACHE_EVICT = 'doctrine.cache.evict';

    /**
     * Internal hint: is set to the proxy entity that is currently triggered for loading
     *
     * @var string
     */
    const HINT_REFRESH_ENTITY = 'doctrine.refresh.entity';

    /**
     * The forcePartialLoad query hint forces a particular query to return
     * partial objects.
     *
     * @var string
     * @todo Rename: HINT_OPTIMIZE
     */
    const HINT_FORCE_PARTIAL_LOAD = 'doctrine.forcePartialLoad';

    /**
     * The includeMetaColumns query hint causes meta columns like foreign keys and
     * discriminator columns to be selected and returned as part of the query result.
     *
     * This hint does only apply to non-object queries.
     *
     * @var string
     */
    const HINT_INCLUDE_META_COLUMNS = 'doctrine.includeMetaColumns';

    /**
     * An array of class names that implement \Doctrine\ORM\Query\TreeWalker and
     * are iterated and executed after the DQL has been parsed into an AST.
     *
     * @var string
     */
    const HINT_CUSTOM_TREE_WALKERS = 'doctrine.customTreeWalkers';

    /**
     * A string with a class name that implements \Doctrine\ORM\Query\TreeWalker
     * and is used for generating the target SQL from any DQL AST tree.
     *
     * @var string
     */
    const HINT_CUSTOM_OUTPUT_WALKER = 'doctrine.customOutputWalker';

    //const HINT_READ_ONLY = 'doctrine.readOnly';

    /**
     * @var string
     */
    const HINT_INTERNAL_ITERATION = 'doctrine.internal.iteration';

    /**
     * @var string
     */
    const HINT_LOCK_MODE = 'doctrine.lockMode';

    /**
     * Gets the SQL query/queries that correspond to this DQL query.
     *
     * @return mixed The built sql query or an array of all sql queries.
     *
     * @override
     */
    public function getSQL();

    /**
     * Returns the corresponding AST for this DQL query.
     *
     * @return \Doctrine\ORM\Query\AST\SelectStatement |
     *         \Doctrine\ORM\Query\AST\UpdateStatement |
     *         \Doctrine\ORM\Query\AST\DeleteStatement
     */
    public function getAST();

    /**
     * Defines a cache driver to be used for caching queries.
     *
     * @param \Doctrine\Common\Cache\Cache|null $queryCache Cache driver.
     *
     * @return Query This query instance.
     */
    public function setQueryCacheDriver($queryCache);
    /**
     * Defines whether the query should make use of a query cache, if available.
     *
     * @param boolean $bool
     *
     * @return Query This query instance.
     */
    public function useQueryCache($bool);

    /**
     * Returns the cache driver used for query caching.
     *
     * @return \Doctrine\Common\Cache\Cache|null The cache driver used for query caching or NULL, if
     *                                           this Query does not use query caching.
     */
    public function getQueryCacheDriver();

    /**
     * Defines how long the query cache will be active before expire.
     *
     * @param integer $timeToLive How long the cache entry is valid.
     *
     * @return Query This query instance.
     */
    public function setQueryCacheLifetime($timeToLive);

    /**
     * Retrieves the lifetime of resultset cache.
     *
     * @return int
     */
    public function getQueryCacheLifetime();
    /**
     * Defines if the query cache is active or not.
     *
     * @param boolean $expire Whether or not to force query cache expiration.
     *
     * @return Query This query instance.
     */
    public function expireQueryCache($expire = true);

    /**
     * Retrieves if the query cache is active or not.
     *
     * @return bool
     */
    public function getExpireQueryCache();

    /**
     * @override
     */
    public function free();

    /**
     * Sets a DQL query string.
     *
     * @param string $dqlQuery DQL Query.
     *
     * @return \Doctrine\ORM\AbstractQuery
     */
    public function setDQL($dqlQuery);

    /**
     * Returns the DQL query that is represented by this query object.
     *
     * @return string|null
     */
    public function getDQL();

    /**
     * Returns the state of this query object
     * By default the type is Doctrine_ORM_Query_Abstract::STATE_CLEAN but if it appears any unprocessed DQL
     * part, it is switched to Doctrine_ORM_Query_Abstract::STATE_DIRTY.
     *
     * @see AbstractQuery::STATE_CLEAN
     * @see AbstractQuery::STATE_DIRTY
     *
     * @return integer The query state.
     */
    public function getState();

    /**
     * Method to check if an arbitrary piece of DQL exists
     *
     * @param string $dql Arbitrary piece of DQL to check for.
     *
     * @return boolean
     */
    public function contains($dql);

    /**
     * Sets the position of the first result to retrieve (the "offset").
     *
     * @param integer $firstResult The first result to return.
     *
     * @return Query This query object.
     */
    public function setFirstResult($firstResult);

    /**
     * Gets the position of the first result the query object was set to retrieve (the "offset").
     * Returns NULL if {@link setFirstResult} was not applied to this query.
     *
     * @return int|null The position of the first result.
     */
    public function getFirstResult();

    /**
     * Sets the maximum number of results to retrieve (the "limit").
     *
     * @param integer|null $maxResults
     *
     * @return Query This query object.
     */
    public function setMaxResults($maxResults);

    /**
     * Gets the maximum number of results the query object was set to retrieve (the "limit").
     * Returns NULL if {@link setMaxResults} was not applied to this query.
     *
     * @return integer|null Maximum number of results.
     */
    public function getMaxResults();

    /**
     * Executes the query and returns an IterableResult that can be used to incrementally
     * iterated over the result.
     *
     * @param ArrayCollection|array|null $parameters    The query parameters.
     * @param string|int                 $hydrationMode The hydration mode to use.
     *
     * @return \Doctrine\ORM\Internal\Hydration\IterableResult
     */
    public function iterate($parameters = null, $hydrationMode = self::HYDRATE_OBJECT);

    /**
     * {@inheritdoc}
     */
    public function setHint($name, $value);

    /**
     * {@inheritdoc}
     */
    public function setHydrationMode($hydrationMode);

    /**
     * Set the lock mode for this Query.
     *
     * @see \Doctrine\DBAL\LockMode
     *
     * @param int $lockMode
     *
     * @return Query
     *
     * @throws TransactionRequiredException
     */
    public function setLockMode($lockMode);

    /**
     * Get the current lock mode for this query.
     *
     * @return int|null The current lock mode of this query or NULL if no specific lock mode is set.
     */
    public function getLockMode();


    /**
     * Cleanup Query resource when clone is called.
     *
     * @return void
     */
    public function __clone();
}
