<?php

namespace Engine\Map;

use Engine\LinkViews;
use Engine\LinkViewsQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'link_views' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class LinkViewsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Engine.Map.LinkViewsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'engine';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'link_views';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Engine\\LinkViews';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Engine.LinkViews';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the id field
     */
    const COL_ID = 'link_views.id';

    /**
     * the column name for the link_id field
     */
    const COL_LINK_ID = 'link_views.link_id';

    /**
     * the column name for the ip field
     */
    const COL_IP = 'link_views.ip';

    /**
     * the column name for the user_agent field
     */
    const COL_USER_AGENT = 'link_views.user_agent';

    /**
     * the column name for the add_time field
     */
    const COL_ADD_TIME = 'link_views.add_time';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'LinkId', 'Ip', 'UserAgent', 'AddTime', ),
        self::TYPE_CAMELNAME     => array('id', 'linkId', 'ip', 'userAgent', 'addTime', ),
        self::TYPE_COLNAME       => array(LinkViewsTableMap::COL_ID, LinkViewsTableMap::COL_LINK_ID, LinkViewsTableMap::COL_IP, LinkViewsTableMap::COL_USER_AGENT, LinkViewsTableMap::COL_ADD_TIME, ),
        self::TYPE_FIELDNAME     => array('id', 'link_id', 'ip', 'user_agent', 'add_time', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'LinkId' => 1, 'Ip' => 2, 'UserAgent' => 3, 'AddTime' => 4, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'linkId' => 1, 'ip' => 2, 'userAgent' => 3, 'addTime' => 4, ),
        self::TYPE_COLNAME       => array(LinkViewsTableMap::COL_ID => 0, LinkViewsTableMap::COL_LINK_ID => 1, LinkViewsTableMap::COL_IP => 2, LinkViewsTableMap::COL_USER_AGENT => 3, LinkViewsTableMap::COL_ADD_TIME => 4, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'link_id' => 1, 'ip' => 2, 'user_agent' => 3, 'add_time' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('link_views');
        $this->setPhpName('LinkViews');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Engine\\LinkViews');
        $this->setPackage('Engine');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 32, null);
        $this->addForeignKey('link_id', 'LinkId', 'INTEGER', 'links', 'id', true, 32, null);
        $this->addColumn('ip', 'Ip', 'VARCHAR', true, 64, null);
        $this->addColumn('user_agent', 'UserAgent', 'VARCHAR', true, 255, null);
        $this->addColumn('add_time', 'AddTime', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Links', '\\Engine\\Links', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':link_id',
    1 => ':id',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? LinkViewsTableMap::CLASS_DEFAULT : LinkViewsTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (LinkViews object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = LinkViewsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LinkViewsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LinkViewsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LinkViewsTableMap::OM_CLASS;
            /** @var LinkViews $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LinkViewsTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = LinkViewsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LinkViewsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var LinkViews $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LinkViewsTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(LinkViewsTableMap::COL_ID);
            $criteria->addSelectColumn(LinkViewsTableMap::COL_LINK_ID);
            $criteria->addSelectColumn(LinkViewsTableMap::COL_IP);
            $criteria->addSelectColumn(LinkViewsTableMap::COL_USER_AGENT);
            $criteria->addSelectColumn(LinkViewsTableMap::COL_ADD_TIME);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.link_id');
            $criteria->addSelectColumn($alias . '.ip');
            $criteria->addSelectColumn($alias . '.user_agent');
            $criteria->addSelectColumn($alias . '.add_time');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(LinkViewsTableMap::DATABASE_NAME)->getTable(LinkViewsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(LinkViewsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(LinkViewsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new LinkViewsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a LinkViews or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or LinkViews object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LinkViewsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Engine\LinkViews) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LinkViewsTableMap::DATABASE_NAME);
            $criteria->add(LinkViewsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = LinkViewsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LinkViewsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LinkViewsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the link_views table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return LinkViewsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a LinkViews or Criteria object.
     *
     * @param mixed               $criteria Criteria or LinkViews object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LinkViewsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from LinkViews object
        }

        if ($criteria->containsKey(LinkViewsTableMap::COL_ID) && $criteria->keyContainsValue(LinkViewsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LinkViewsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = LinkViewsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // LinkViewsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
LinkViewsTableMap::buildTableMap();
