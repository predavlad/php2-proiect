<?php
/**
* PDO connection
 * Attempt to create a basic ORM
*/
class DB
{
    /**
     * General singleton stuff
     */
    private static $factory;
    private $db;

    protected function __construct(){}
    protected function __clone(){}

    public static function getFactory()
    {
        if (!self::$factory)
            self::$factory = new DB;
        return self::$factory;
    }


    public function getConnection() {
        if (!$this->db)
            $this->db = new PDO('mysql:dbname=proiect;host=localhost', 'root', 'parola1!');
        return $this->db;
    }

    /**
     * Function to get started with the ORM
     */
    public static function table($tableName) {
        $db = DB::getFactory();
        $db->reset();
        $db->table = $tableName;
        return $db;
    }

    /**
     * Some ORM Stuff
     */
    protected $select = '*';
    protected $table;
    protected $where = array();
    protected $order;
    protected $limit;

    /**
     * Array containing info to be inserted or updated
     */
    protected $data = array();

    public function reset() {
        $this->select = '*';
        $this->table = '';
        $this->where = array();
        $this->order = '';
        $this->limit = '';
        $this->data = array();
    }

    /**
     * Expected array:
     * array('col = value')
     * This defeats the purpose of using an ORM
     * @TODO: change to array($key => $value, $operation = '=', $operationArray = array())
     */
    public function where( $where ) {
//        if (!is_array($where)) {
//            throw new Exception('Where clause needs to be an array');
//        }
        $this->where[] = $where;
    }

    public function select($select) {
        $this->select = $select;
    }

    public function order($order) {
        $this->order($order);
    }


    /**
     * Function that combine the query
     */
    protected function getQuery() {

        $query = 'SELECT ';

        if (strlen($this->table) < 4 ) {
            throw new Exception('Invalid table.');
        }

        $query .= $this->get_part($this->select);

        $query .= ' FROM ';
        $query .= $this->table;

        $whereQuery = $this->get_part($this->where);
        if (!empty($whereQuery) && strlen($whereQuery)) {
            $query .= ' WHERE ' . $whereQuery;
        }


        if (strlen($this->order) > 1) {
            $query .= ' ORDER BY ' . $this->order;
        }

        if (strlen($this->limit) > 0) {
            $query .= ' LIMIT ' . $this->limit;
        }

        return $query;

    }

    /**
     * @TODO: add support for OR
     * @param $a
     * @return string
     */
    protected function get_part($a) {
        if (is_array($a)) {
            return implode(' AND ', $a);
        } else {
            return $a;
        }
    }

    /**
     * Should use prepared queries vs SQL injection
     * But I'm too lazy :)
     *
     * @return array
     */
    public function fetchAll() {
        $db = DB::getFactory()->getConnection();
        $query = $this->getQuery();
        $return = array();

        foreach ($db->query($query) as $row) {
            $return[] = $row;
        }

        return $return;
    }

    /**
     * Same here
     * @return mixed
     */
    public function fetchRow() {
        $db = DB::getFactory()->getConnection();
        $query = $this->getQuery();
        $rez = $db->query($query); // @TODO grab only table names and not numeric

        return $rez->fetch();
    }


}

Config::set('db', $db);