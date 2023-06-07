<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 28/04/2015
 * Time: 12:56
 */

/**
 * @inheritdoc Se debe definir el metodo create de la siguiete forma.
 * public static function create() { return self::_create(__CLASS__);}
 */
abstract class  ORMRepo {

    static private $arr_i=array();
    static protected  function _create($class) {
        if(!isset(self::$arr_i[$class])) {
            self::$arr_i[$class] = new $class;
        }
        return self::$arr_i[$class];
    }
    /**
     * @inheritdoc Obligatorio definir el este metodo de la siguiete forma
     * public static function create() { return self::_create(__CLASS__);}
     */
    static public function  create(){ trigger_error("No esta definodo en clase hija. Debe definir el metodo en una clase hija de la siguiente forma\n public static function create() { return self::_create(__CLASS__);}",E_CORE_ERROR);}

    public function __construct() {
        $this->getModelClass();
    }
    static private function prepareSQL($table="",$class=null,$start=null,$count=null,$ordenby=null,$where=array(),$fields="*") {
        $sql = "select $fields from $table ";
        if(count($where)) {
            $sql.="where ";
            $isFirst = true;
            foreach ($where as $cond => $val) {
                if($isFirst) {
                    $c = self::prepareOprLogLast($cond);
                    $isFirst = false;
                } else  $c = self::prepareOprLog($cond);
                $sql.=$c.' '.$val.' ';
            }
        }
        $sql.=$ordenby ? "order by ".$ordenby." ":"";
        $sql.=(is_int($start) && !$count) ? "limit $start " : (is_int($start) && $count) ? "limit $start, $count " : "";
//        var_dump($sql); die;
        return $sql;

    }
    static private function prepareOprLogLast($exp,$opr="AND ") {
        if(!preg_match("/(>|=|>=|<=|<| LIKE| BETWEEN| IN)$/i",$exp)) {
            $exp = $exp.' =';
        }
      return $exp;
    }
    static private function prepareOprLog($exp,$opr="AND ") {
        if(!preg_match("/^(OR |AND )/",$exp)) {
            $exp = $opr.' '.$exp;
        }
        $exp = self::prepareOprLogLast($exp,$opr);

        return $exp;
    }


    protected function _all($table="",$class=null,$start=null,$count=null,$ordenby=null,$where=array()) {
        global $wpdb;
        $sql = self::prepareSQL($table,$class,$start,$count,$ordenby,$where);
        $arr = $wpdb->get_objects($sql,$class);
        return $arr;
    }
    public function allfrom($table,$where=array(),$start=null,$count=null,$ordenby=null)
    {
        return $this->_all($table,$this->getModelClass(),$start,$count,$ordenby,$where);
    }
    public function all($start=null,$count=null,$ordenby=null,$where=array())
    {
//        var_dump($start);
//        var_dump($count);
//        var_dump($ordenby);
//        var_dump($where);
        return $this->_all($this->getModelTable(),$this->getModelClass(),$start,$count,$ordenby,$where);
    }
    public function allBy($where=array(),$start=null,$count=null,$ordenby=null)
    {
        if(is_integer($where)) $where = array("id"=>$where);
        if(is_string($where)) {$where = array("$where"=>$start); $start=null;}
        return $this->_all($this->getModelTable(),$this->getModelClass(),$start,$count,$ordenby,$where);
    }

    public function get_objects($sql) {
        global $wpdb;
        $class = $this->getModelClass();
        $arr = $wpdb->get_objects($sql,$class);
        return $arr;
    }

    protected function _oneBy($table="",$class=null,$where=array(),$start=null,$count=null,$ordenby=null) {
        global $wpdb;
        $sql = self::prepareSQL($table,$class,$start,$count,$ordenby,$where);
        $arr = $wpdb->get_objects($sql,$class);
        $obj = count($arr)? $arr[0] : null;
        return $obj;
    }
    public function oneBy($where=array(),$start=null,$count=null,$ordenby=null)
    {
        if(is_integer($where)) $where = array("id"=>$where);
        if(is_string($where)) {$where = array("$where"=>$start); $start=null;}
        return $this->_oneBy($this->getModelTable(),$this->getModelClass(),$where,$start,$count,$ordenby);
    }
    private function getRealWhere($where) {

    }

    protected function _count($table="",$start=null,$count=null,$where=array()) {
        global $wpdb;
        $sql = self::prepareSQL($table,null,$start,$count,null,$where,"count(*)");
        $v = $wpdb->get_var($sql);
        return $v;
    }

    public function count($where=array(),$start=null,$count=null)
    {
        return $this->_count($this->getModelTable(),$start,$count,$where);
    }

    public $modelclass;
    public  $table;
    private function getModelClass() {
        if(!$this->modelclass) {
            $class = get_class($this);
            $this->modelclass = preg_replace("/Repo$/i", "", $class, 1);
        }
        if(class_exists($this->modelclass.'Model',false))
            $this->modelclass .= 'Model';
        return $this->modelclass;

    }
    private function getModelTable() {
        if(!$this->table) {
            $rclass = new ReflectionClass($this->modelclass);
            $this->table = &$rclass->getConstant('TABLE');
//            $this->table = &$rclass->getDefaultProperties()['table'];
        }
        return $this->table;
    }

}