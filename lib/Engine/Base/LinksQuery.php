<?php

namespace Engine\Base;

use \Exception;
use \PDO;
use Engine\Links as ChildLinks;
use Engine\LinksQuery as ChildLinksQuery;
use Engine\Map\LinksTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'links' table.
 *
 *
 *
 * @method     ChildLinksQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildLinksQuery orderByOriginal($order = Criteria::ASC) Order by the original column
 * @method     ChildLinksQuery orderByShorted($order = Criteria::ASC) Order by the shorted column
 * @method     ChildLinksQuery orderByAccessibility($order = Criteria::ASC) Order by the accessibility column
 * @method     ChildLinksQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildLinksQuery orderByAddTime($order = Criteria::ASC) Order by the add_time column
 *
 * @method     ChildLinksQuery groupById() Group by the id column
 * @method     ChildLinksQuery groupByOriginal() Group by the original column
 * @method     ChildLinksQuery groupByShorted() Group by the shorted column
 * @method     ChildLinksQuery groupByAccessibility() Group by the accessibility column
 * @method     ChildLinksQuery groupByUserId() Group by the user_id column
 * @method     ChildLinksQuery groupByAddTime() Group by the add_time column
 *
 * @method     ChildLinksQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLinksQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLinksQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLinksQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildLinksQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildLinksQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildLinksQuery leftJoinLinkViews($relationAlias = null) Adds a LEFT JOIN clause to the query using the LinkViews relation
 * @method     ChildLinksQuery rightJoinLinkViews($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LinkViews relation
 * @method     ChildLinksQuery innerJoinLinkViews($relationAlias = null) Adds a INNER JOIN clause to the query using the LinkViews relation
 *
 * @method     \Engine\UsersQuery|\Engine\LinkViewsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLinks findOne(ConnectionInterface $con = null) Return the first ChildLinks matching the query
 * @method     ChildLinks findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLinks matching the query, or a new ChildLinks object populated from the query conditions when no match is found
 *
 * @method     ChildLinks findOneById(int $id) Return the first ChildLinks filtered by the id column
 * @method     ChildLinks findOneByOriginal(string $original) Return the first ChildLinks filtered by the original column
 * @method     ChildLinks findOneByShorted(string $shorted) Return the first ChildLinks filtered by the shorted column
 * @method     ChildLinks findOneByAccessibility(string $accessibility) Return the first ChildLinks filtered by the accessibility column
 * @method     ChildLinks findOneByUserId(int $user_id) Return the first ChildLinks filtered by the user_id column
 * @method     ChildLinks findOneByAddTime(string $add_time) Return the first ChildLinks filtered by the add_time column *

 * @method     ChildLinks requirePk($key, ConnectionInterface $con = null) Return the ChildLinks by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLinks requireOne(ConnectionInterface $con = null) Return the first ChildLinks matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLinks requireOneById(int $id) Return the first ChildLinks filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLinks requireOneByOriginal(string $original) Return the first ChildLinks filtered by the original column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLinks requireOneByShorted(string $shorted) Return the first ChildLinks filtered by the shorted column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLinks requireOneByAccessibility(string $accessibility) Return the first ChildLinks filtered by the accessibility column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLinks requireOneByUserId(int $user_id) Return the first ChildLinks filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLinks requireOneByAddTime(string $add_time) Return the first ChildLinks filtered by the add_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLinks[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLinks objects based on current ModelCriteria
 * @method     ChildLinks[]|ObjectCollection findById(int $id) Return ChildLinks objects filtered by the id column
 * @method     ChildLinks[]|ObjectCollection findByOriginal(string $original) Return ChildLinks objects filtered by the original column
 * @method     ChildLinks[]|ObjectCollection findByShorted(string $shorted) Return ChildLinks objects filtered by the shorted column
 * @method     ChildLinks[]|ObjectCollection findByAccessibility(string $accessibility) Return ChildLinks objects filtered by the accessibility column
 * @method     ChildLinks[]|ObjectCollection findByUserId(int $user_id) Return ChildLinks objects filtered by the user_id column
 * @method     ChildLinks[]|ObjectCollection findByAddTime(string $add_time) Return ChildLinks objects filtered by the add_time column
 * @method     ChildLinks[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LinksQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Engine\Base\LinksQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'engine', $modelName = '\\Engine\\Links', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLinksQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLinksQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLinksQuery) {
            return $criteria;
        }
        $query = new ChildLinksQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildLinks|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LinksTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LinksTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLinks A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, original, shorted, accessibility, user_id, add_time FROM links WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildLinks $obj */
            $obj = new ChildLinks();
            $obj->hydrate($row);
            LinksTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildLinks|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildLinksQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LinksTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLinksQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LinksTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLinksQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LinksTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LinksTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LinksTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the original column
     *
     * Example usage:
     * <code>
     * $query->filterByOriginal('fooValue');   // WHERE original = 'fooValue'
     * $query->filterByOriginal('%fooValue%'); // WHERE original LIKE '%fooValue%'
     * </code>
     *
     * @param     string $original The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLinksQuery The current query, for fluid interface
     */
    public function filterByOriginal($original = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($original)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $original)) {
                $original = str_replace('*', '%', $original);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LinksTableMap::COL_ORIGINAL, $original, $comparison);
    }

    /**
     * Filter the query on the shorted column
     *
     * Example usage:
     * <code>
     * $query->filterByShorted('fooValue');   // WHERE shorted = 'fooValue'
     * $query->filterByShorted('%fooValue%'); // WHERE shorted LIKE '%fooValue%'
     * </code>
     *
     * @param     string $shorted The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLinksQuery The current query, for fluid interface
     */
    public function filterByShorted($shorted = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($shorted)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $shorted)) {
                $shorted = str_replace('*', '%', $shorted);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LinksTableMap::COL_SHORTED, $shorted, $comparison);
    }

    /**
     * Filter the query on the accessibility column
     *
     * Example usage:
     * <code>
     * $query->filterByAccessibility('fooValue');   // WHERE accessibility = 'fooValue'
     * $query->filterByAccessibility('%fooValue%'); // WHERE accessibility LIKE '%fooValue%'
     * </code>
     *
     * @param     string $accessibility The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLinksQuery The current query, for fluid interface
     */
    public function filterByAccessibility($accessibility = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($accessibility)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $accessibility)) {
                $accessibility = str_replace('*', '%', $accessibility);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LinksTableMap::COL_ACCESSIBILITY, $accessibility, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @see       filterByUsers()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLinksQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(LinksTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(LinksTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LinksTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the add_time column
     *
     * Example usage:
     * <code>
     * $query->filterByAddTime('2011-03-14'); // WHERE add_time = '2011-03-14'
     * $query->filterByAddTime('now'); // WHERE add_time = '2011-03-14'
     * $query->filterByAddTime(array('max' => 'yesterday')); // WHERE add_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $addTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLinksQuery The current query, for fluid interface
     */
    public function filterByAddTime($addTime = null, $comparison = null)
    {
        if (is_array($addTime)) {
            $useMinMax = false;
            if (isset($addTime['min'])) {
                $this->addUsingAlias(LinksTableMap::COL_ADD_TIME, $addTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($addTime['max'])) {
                $this->addUsingAlias(LinksTableMap::COL_ADD_TIME, $addTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LinksTableMap::COL_ADD_TIME, $addTime, $comparison);
    }

    /**
     * Filter the query by a related \Engine\Users object
     *
     * @param \Engine\Users|ObjectCollection $users The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLinksQuery The current query, for fluid interface
     */
    public function filterByUsers($users, $comparison = null)
    {
        if ($users instanceof \Engine\Users) {
            return $this
                ->addUsingAlias(LinksTableMap::COL_USER_ID, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LinksTableMap::COL_USER_ID, $users->toKeyValue('Id', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUsers() only accepts arguments of type \Engine\Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Users relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLinksQuery The current query, for fluid interface
     */
    public function joinUsers($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Users');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Users');
        }

        return $this;
    }

    /**
     * Use the Users relation Users object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Engine\UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Users', '\Engine\UsersQuery');
    }

    /**
     * Filter the query by a related \Engine\LinkViews object
     *
     * @param \Engine\LinkViews|ObjectCollection $linkViews the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLinksQuery The current query, for fluid interface
     */
    public function filterByLinkViews($linkViews, $comparison = null)
    {
        if ($linkViews instanceof \Engine\LinkViews) {
            return $this
                ->addUsingAlias(LinksTableMap::COL_ID, $linkViews->getLinkId(), $comparison);
        } elseif ($linkViews instanceof ObjectCollection) {
            return $this
                ->useLinkViewsQuery()
                ->filterByPrimaryKeys($linkViews->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLinkViews() only accepts arguments of type \Engine\LinkViews or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LinkViews relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLinksQuery The current query, for fluid interface
     */
    public function joinLinkViews($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LinkViews');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'LinkViews');
        }

        return $this;
    }

    /**
     * Use the LinkViews relation LinkViews object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Engine\LinkViewsQuery A secondary query class using the current class as primary query
     */
    public function useLinkViewsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLinkViews($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LinkViews', '\Engine\LinkViewsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildLinks $links Object to remove from the list of results
     *
     * @return $this|ChildLinksQuery The current query, for fluid interface
     */
    public function prune($links = null)
    {
        if ($links) {
            $this->addUsingAlias(LinksTableMap::COL_ID, $links->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the links table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LinksTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LinksTableMap::clearInstancePool();
            LinksTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LinksTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LinksTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LinksTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LinksTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LinksQuery
