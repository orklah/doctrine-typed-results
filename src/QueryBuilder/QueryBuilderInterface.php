<?php

declare(strict_types=1);


namespace DoctrineTypedResults\QueryBuilder;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\Query\Parameter;

interface QueryBuilderInterface
{
    /**
     * Initializes a new <tt>QueryBuilder</tt> that uses the given <tt>EntityManager</tt>.
     *
     * @param EntityManagerInterface $em The EntityManager to use.
     */
    public function __construct(EntityManagerInterface $em);

    /**
     * Gets an ExpressionBuilder used for object-oriented construction of query expressions.
     * This producer method is intended for convenient inline usage. Example:
     *
     * <code>
     *     $qb = $em->createQueryBuilder();
     *     $qb
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->where($qb->expr()->eq('u.id', 1));
     * </code>
     *
     * For more complex expression construction, consider storing the expression
     * builder object in a local variable.
     *
     * @return Query\Expr
     */
    public function expr();

    /**
     *
     * Enable/disable second level query (result) caching for this query.
     *
     * @param boolean $cacheable
     *
     * @return self
     */
    public function setCacheable($cacheable);

    /**
     * @return boolean TRUE if the query results are enable for second level cache, FALSE otherwise.
     */
    public function isCacheable();

    /**
     * @param string $cacheRegion
     *
     * @return self
     */
    public function setCacheRegion($cacheRegion);

    /**
     * Obtain the name of the second level query cache region in which query results will be stored
     *
     * @return string|null The cache region name; NULL indicates the default region.
     */
    public function getCacheRegion();

    /**
     * @return integer
     */
    public function getLifetime();

    /**
     * Sets the life-time for this query into second level cache.
     *
     * @param integer $lifetime
     *
     * @return self
     */
    public function setLifetime($lifetime);

    /**
     * @return integer
     */
    public function getCacheMode();

    /**
     * @param integer $cacheMode
     *
     * @return self
     */
    public function setCacheMode($cacheMode);

    /**
     * Gets the type of the currently built query.
     *
     * @return integer
     */
    public function getType();

    /**
     * Gets the associated EntityManager for this query builder.
     *
     * @return EntityManager
     */
    public function getEntityManager();

    /**
     * Gets the state of this query builder instance.
     *
     * @return integer Either QueryBuilder::STATE_DIRTY or QueryBuilder::STATE_CLEAN.
     */
    public function getState();

    /**
     * Gets the complete DQL string formed by the current specifications of this QueryBuilder.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u');
     *     echo $qb->getDql(); // SELECT u FROM User u
     * </code>
     *
     * @return string The DQL query string.
     */
    public function getDQL();

    /**
     * Constructs a Query instance from the current specifications of the builder.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u');
     *     $q = $qb->getQuery();
     *     $results = $q->execute();
     * </code>
     *
     * @return AbstractQuery
     */
    public function getQuery();

    /**
     * Gets the FIRST root alias of the query. This is the first entity alias involved
     * in the construction of the query.
     *
     * <code>
     * $qb = $em->createQueryBuilder()
     *     ->select('u')
     *     ->from('User', 'u');
     *
     * echo $qb->getRootAlias(); // u
     * </code>
     *
     * @deprecated Please use $qb->getRootAliases() instead.
     * @throws \RuntimeException
     *
     * @return string
     */
    public function getRootAlias();

    /**
     * Gets the root aliases of the query. This is the entity aliases involved
     * in the construction of the query.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u');
     *
     *     $qb->getRootAliases(); // array('u')
     * </code>
     *
     * @return string[]
     */
    public function getRootAliases();

    /**
     * Gets all the aliases that have been used in the query.
     * Including all select root aliases and join aliases
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->join('u.articles','a');
     *
     *     $qb->getAllAliases(); // array('u','a')
     * </code>
     * @return string[]
     */
    public function getAllAliases();

    /**
     * Gets the root entities of the query. This is the entity aliases involved
     * in the construction of the query.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u');
     *
     *     $qb->getRootEntities(); // array('User')
     * </code>
     *
     * @return string[]
     */
    public function getRootEntities();

    /**
     * Sets a query parameter for the query being constructed.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->where('u.id = :user_id')
     *         ->setParameter('user_id', 1);
     * </code>
     *
     * @param string|integer $key   The parameter position or name.
     * @param mixed          $value The parameter value.
     * @param string|integer|null    $type  PDO::PARAM_* or \Doctrine\DBAL\Types\Type::* constant
     *
     * @return self
     */
    public function setParameter($key, $value, $type = null);

    /**
     * Sets a collection of query parameters for the query being constructed.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->where('u.id = :user_id1 OR u.id = :user_id2')
     *         ->setParameters(new ArrayCollection(array(
     *             new Parameter('user_id1', 1),
     *             new Parameter('user_id2', 2)
     *        )));
     * </code>
     * @phpstan-param ArrayCollection<array-key, Parameter>|Parameter[] $parameters
     * @psalm-param ArrayCollection<array-key, Parameter>|Parameter[] $parameters
     * @param ArrayCollection|Parameter[] $parameters The query parameters to set.
     *
     * @return self
     */
    public function setParameters($parameters);

    /**
     * Gets all defined query parameters for the query being constructed.
     *
     * @phpstan-return ArrayCollection<array-key, Parameter>
     * @psalm-return ArrayCollection<array-key, Parameter>
     * @return ArrayCollection The currently defined query parameters.
     */
    public function getParameters();

    /**
     * Gets a (previously set) query parameter of the query being constructed.
     *
     * @param mixed $key The key (index or name) of the bound parameter.
     *
     * @return Query\Parameter|null The value of the bound parameter.
     */
    public function getParameter($key);

    /**
     * Sets the position of the first result to retrieve (the "offset").
     *
     * @param integer $firstResult The first result to return.
     *
     * @return self
     */
    public function setFirstResult($firstResult);

    /**
     * Gets the position of the first result the query object was set to retrieve (the "offset").
     * Returns NULL if {@link setFirstResult} was not applied to this QueryBuilder.
     *
     * @return integer The position of the first result.
     */
    public function getFirstResult();

    /**
     * Sets the maximum number of results to retrieve (the "limit").
     *
     * @param integer|null $maxResults The maximum number of results to retrieve.
     *
     * @return self
     */
    public function setMaxResults($maxResults);

    /**
     * Gets the maximum number of results the query object was set to retrieve (the "limit").
     * Returns NULL if {@link setMaxResults} was not applied to this query builder.
     *
     * @return integer|null Maximum number of results.
     */
    public function getMaxResults();

    /**
     * Either appends to or replaces a single, generic query part.
     *
     * The available parts are: 'select', 'from', 'join', 'set', 'where',
     * 'groupBy', 'having' and 'orderBy'.
     *
     * @param string         $dqlPartName The DQL part name.
     * @param object|mixed[] $dqlPart     An Expr object.
     * @param bool           $append      Whether to append (true) or replace (false).
     *
     * @return self
     */
    public function add($dqlPartName, $dqlPart, $append = false);

    /**
     * Specifies an item that is to be returned in the query result.
     * Replaces any previously specified selections, if any.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u', 'p')
     *         ->from('User', 'u')
     *         ->leftJoin('u.Phonenumbers', 'p');
     * </code>
     *
     * @param mixed $select The selection expressions.
     *
     * @return self
     */
    public function select($select = null);

    /**
     * Adds a DISTINCT flag to this query.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->distinct()
     *         ->from('User', 'u');
     * </code>
     *
     * @param bool $flag
     *
     * @return self
     */
    public function distinct($flag = true);

    /**
     * Adds an item that is to be returned in the query result.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->addSelect('p')
     *         ->from('User', 'u')
     *         ->leftJoin('u.Phonenumbers', 'p');
     * </code>
     *
     * @param mixed $select The selection expression.
     *
     * @return self
     */
    public function addSelect($select = null);

    /**
     * Turns the query being built into a bulk delete query that ranges over
     * a certain entity type.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->delete('User', 'u')
     *         ->where('u.id = :user_id')
     *         ->setParameter('user_id', 1);
     * </code>
     *
     * @param string $delete The class/type whose instances are subject to the deletion.
     * @param string $alias  The class/type alias used in the constructed query.
     *
     * @return self
     */
    public function delete($delete = null, $alias = null);

    /**
     * Turns the query being built into a bulk update query that ranges over
     * a certain entity type.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->update('User', 'u')
     *         ->set('u.password', '?1')
     *         ->where('u.id = ?2');
     * </code>
     *
     * @param string $update The class/type whose instances are subject to the update.
     * @param string $alias  The class/type alias used in the constructed query.
     *
     * @return self
     */
    public function update($update = null, $alias = null);

    /**
     * Creates and adds a query root corresponding to the entity identified by the given alias,
     * forming a cartesian product with any existing query roots.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u');
     * </code>
     *
     * @param string $from    The class name.
     * @param string $alias   The alias of the class.
     * @param string $indexBy The index for the from.
     *
     * @return self
     */
    public function from($from, $alias, $indexBy = null);

    /**
     * Updates a query root corresponding to an entity setting its index by. This method is intended to be used with
     * EntityRepository->createQueryBuilder(), which creates the initial FROM clause and do not allow you to update it
     * setting an index by.
     *
     * <code>
     *     $qb = $userRepository->createQueryBuilder('u')
     *         ->indexBy('u', 'u.id');
     *
     *     // Is equivalent to...
     *
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u', 'u.id');
     * </code>
     *
     * @param string $alias   The root alias of the class.
     * @param string $indexBy The index for the from.
     *
     * @return self
     *
     * @throws Query\QueryException
     */
    public function indexBy($alias, $indexBy);

    /**
     * Creates and adds a join over an entity association to the query.
     *
     * The entities in the joined association will be fetched as part of the query
     * result if the alias used for the joined association is placed in the select
     * expressions.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->join('u.Phonenumbers', 'p', Expr\Join::WITH, 'p.is_primary = 1');
     * </code>
     *
     * @param string      $join          The relationship to join.
     * @param string      $alias         The alias of the join.
     * @param string|null $conditionType The condition type constant. Either ON or WITH.
     * @param string|null $condition     The condition for the join.
     * @param string|null $indexBy       The index for the join.
     *
     * @return self
     */
    public function join($join, $alias, $conditionType = null, $condition = null, $indexBy = null);

    /**
     * Creates and adds a join over an entity association to the query.
     *
     * The entities in the joined association will be fetched as part of the query
     * result if the alias used for the joined association is placed in the select
     * expressions.
     *
     *     [php]
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->innerJoin('u.Phonenumbers', 'p', Expr\Join::WITH, 'p.is_primary = 1');
     *
     * @param string      $join          The relationship to join.
     * @param string      $alias         The alias of the join.
     * @param string|null $conditionType The condition type constant. Either ON or WITH.
     * @param string|null $condition     The condition for the join.
     * @param string|null $indexBy       The index for the join.
     *
     * @return self
     */
    public function innerJoin($join, $alias, $conditionType = null, $condition = null, $indexBy = null);

    /**
     * Creates and adds a left join over an entity association to the query.
     *
     * The entities in the joined association will be fetched as part of the query
     * result if the alias used for the joined association is placed in the select
     * expressions.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->leftJoin('u.Phonenumbers', 'p', Expr\Join::WITH, 'p.is_primary = 1');
     * </code>
     *
     * @param string      $join          The relationship to join.
     * @param string      $alias         The alias of the join.
     * @param string|null $conditionType The condition type constant. Either ON or WITH.
     * @param string|null $condition     The condition for the join.
     * @param string|null $indexBy       The index for the join.
     *
     * @return self
     */
    public function leftJoin($join, $alias, $conditionType = null, $condition = null, $indexBy = null);

    /**
     * Sets a new value for a field in a bulk update query.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->update('User', 'u')
     *         ->set('u.password', '?1')
     *         ->where('u.id = ?2');
     * </code>
     *
     * @param string $key   The key/field to set.
     * @param mixed  $value The value, expression, placeholder, etc.
     *
     * @return self
     */
    public function set($key, $value);
    /**
     * Specifies one or more restrictions to the query result.
     * Replaces any previously specified restrictions, if any.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->where('u.id = ?');
     *
     *     // You can optionally programmatically build and/or expressions
     *     $qb = $em->createQueryBuilder();
     *
     *     $or = $qb->expr()->orX();
     *     $or->add($qb->expr()->eq('u.id', 1));
     *     $or->add($qb->expr()->eq('u.id', 2));
     *
     *     $qb->update('User', 'u')
     *         ->set('u.password', '?')
     *         ->where($or);
     * </code>
     *
     * @param mixed $predicates The restriction predicates.
     *
     * @return self
     */
    public function where($predicates);

    /**
     * Adds one or more restrictions to the query results, forming a logical
     * conjunction with any previously specified restrictions.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->where('u.username LIKE ?')
     *         ->andWhere('u.is_active = 1');
     * </code>
     *
     * @param mixed $where The query restrictions.
     *
     * @return self
     *
     * @see where()
     */
    public function andWhere();

    /**
     * Adds one or more restrictions to the query results, forming a logical
     * disjunction with any previously specified restrictions.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->where('u.id = 1')
     *         ->orWhere('u.id = 2');
     * </code>
     *
     * @param mixed $where The WHERE statement.
     *
     * @return self
     *
     * @see where()
     */
    public function orWhere();

    /**
     * Specifies a grouping over the results of the query.
     * Replaces any previously specified groupings, if any.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->groupBy('u.id');
     * </code>
     *
     * @param string $groupBy The grouping expression.
     *
     * @return self
     */
    public function groupBy($groupBy);

    /**
     * Adds a grouping expression to the query.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->groupBy('u.lastLogin')
     *         ->addGroupBy('u.createdAt');
     * </code>
     *
     * @param string $groupBy The grouping expression.
     *
     * @return self
     */
    public function addGroupBy($groupBy);

    /**
     * Specifies a restriction over the groups of the query.
     * Replaces any previous having restrictions, if any.
     *
     * @param mixed $having The restriction over the groups.
     *
     * @return self
     */
    public function having($having);

    /**
     * Adds a restriction over the groups of the query, forming a logical
     * conjunction with any existing having restrictions.
     *
     * @param mixed $having The restriction to append.
     *
     * @return self
     */
    public function andHaving($having);

    /**
     * Adds a restriction over the groups of the query, forming a logical
     * disjunction with any existing having restrictions.
     *
     * @param mixed $having The restriction to add.
     *
     * @return self
     */
    public function orHaving($having);

    /**
     * Specifies an ordering for the query results.
     * Replaces any previously specified orderings, if any.
     *
     * @param string|Expr\OrderBy $sort  The ordering expression.
     * @param string              $order The ordering direction.
     *
     * @return self
     */
    public function orderBy($sort, $order = null);

    /**
     * Adds an ordering to the query results.
     *
     * @param string|Expr\OrderBy $sort  The ordering expression.
     * @param string              $order The ordering direction.
     *
     * @return self
     */
    public function addOrderBy($sort, $order = null);

    /**
     * Adds criteria to the query.
     *
     * Adds where expressions with AND operator.
     * Adds orderings.
     * Overrides firstResult and maxResults if they're set.
     *
     * @param Criteria $criteria
     *
     * @return self
     *
     * @throws Query\QueryException
     */
    public function addCriteria(Criteria $criteria);

    /**
     * Gets a query part by its name.
     *
     * @param string $queryPartName
     *
     * @return mixed $queryPart
     *
     * @todo Rename: getQueryPart (or remove?)
     */
    public function getDQLPart($queryPartName);

    /**
     * Gets all query parts.
     *
     * @return mixed[] $dqlParts
     *
     * @todo Rename: getQueryParts (or remove?)
     */
    public function getDQLParts();


    /**
     * Resets DQL parts.
     *
     * @param string[]|null $parts
     *
     * @return self
     */
    public function resetDQLParts($parts = null);

    /**
     * Resets single DQL part.
     *
     * @param string $part
     *
     * @return self
     */
    public function resetDQLPart($part);

    /**
     * Gets a string representation of this QueryBuilder which corresponds to
     * the final DQL query being constructed.
     *
     * @return string The string representation of this QueryBuilder.
     */
    public function __toString();

    /**
     * Deep clones all expression objects in the DQL parts.
     *
     * @return void
     */
    public function __clone();
}
