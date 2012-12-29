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

    private function __construct(){}

    public static function getFactory()
    {
        if (!self::$factory)
            self::$factory = new DB;
        return self::$factory;
    }


    public function getConnection() {
        if (!$this->db)
            $this->db = new PDO('mysql:dbname=proiect;host=localhost', 'root', '');
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
     * array)'col_name' => 'value')
     */
    public function where( $where ) {
        if (!is_array($where)) {
            throw new Exception('Where clause needs to be an array');
        }

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

        $query .= '';
        $query .= $this->get_part($this->where);

        if (strlen($this->order) > 1) {
            $query .= ' ORDER BY ' . $this->order;
        }

        if (strlen($this->limit) > 0) {
            $query .= ' LIMIT ' . $this->limit;
        }

        return $query;

    }


    protected function get_part($a) {
        if (is_array($a)) {
            return implode(',', $a);
        } else {
            return $a;
        }
    }

    public function fetchAll() {
        $db = DB::getFactory()->getConnection();
        $query = $this->getQuery();
        $return = array();

        foreach ($db->query($query) as $row) {
            $return[] = $row;
        }

        return $return;
    }


}

Config::set('db', $db);