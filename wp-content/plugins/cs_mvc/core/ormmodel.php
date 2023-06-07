<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 28/04/2015
 * Time: 12:56
 */

abstract class  ORMModel {
    public $id=0;
    protected $__pks = array('id');

    public $__isnew = true;
//    function __construct() { $this->isnew = true;}

    private $__table="";
    private $__map_attr = array();
    private $__map_attr_pks = array();
    private $__map_attr_no_pks = array();

    function save($data = null) {
        //generando los campos que se guardaran en la BD
        $this->generte_fields();
        //Reyenado con valores si pasamos un arreglo
        $is_modify = false;
        foreach($this->__map_attr as $attr => $v)
            if(isset($data[$attr]) && $data[$attr] != $v) {$this->$attr = $data[$attr]; $is_modify=true;}
        //si se modifico con el arrglo pasodo se vuelve a llenar los valores
        if($is_modify) $this->generte_fields();

        global $wpdb;
        //generando la consulta sql
        if($this->__isnew) {
            $wpdb->insert( $this->__table, $this->__map_attr);
            $this->id = $wpdb->insert_id;
            $this->__isnew = false;
        }
        else {
            if($this->id)
                $this->__map_attr_pks['id'] = $this->id;
            $wpdb->update($this->__table, $this->__map_attr_no_pks,$this->__map_attr_pks);
        }

    }

    function delete() {
        global $wpdb;
        if(!$this->__isnew) {
            $this->generte_fields();
            if($this->id) $this->__map_attr_pks['id'] = $this->id;
            $wpdb->delete($this->__table, $this->__map_attr_pks);
            $this->__isnew = true;
            $this->id = 0;
        }
    }

    private function generte_fields() {
        //generando los campos que se guardaran en la BD
        $class = get_class($this);
        $rclass = new ReflectionClass($class);
        $this->__table = &$rclass->getConstant('TABLE');
        foreach($rclass->getProperties() as $prop) {
            if($prop->isPublic() && !$prop->isStatic() && $prop->getDeclaringClass()->getName()==$class) {
                $propname = $prop->getName(); $propvalue = $prop->getValue($this);
                $this->__map_attr[$propname] = $propvalue;
                if(in_array($propname,$this->__pks)) {
                    $this->__map_attr_pks[$propname] = $propvalue;
                } else $this->__map_attr_no_pks[$propname] = $propvalue;
            }

        }
        $this->__map_attr['id'] = $this->id;
    }

    public function toArray() {
        $this->generte_fields();
        return $this->__map_attr;
    }

    //ralations
    public function hasOne($modelClass,$fk,$pk='id') {
        $repo = $this->getRepoClass($modelClass);
        $repo = call_user_func(array($repo,'create'));
        return $repo->oneBy(array($pk=>'"'.$this->$fk.'"'));
    }
    public function hasMany($modelClass,$fk,$pk='id') {
        $repo = $this->getRepoClass($modelClass);
        $repo = call_user_func(array($repo,'create'));
        return $repo->allBy(array($fk=>'"'.$this->$pk.'"'));
    }
    private function getRepoClass($modelClass) {
        return preg_replace("/Model$/i", "", $modelClass, 1).'Repo';
    }
}