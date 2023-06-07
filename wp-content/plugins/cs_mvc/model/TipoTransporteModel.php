<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/TransporteModel.php';

class TipoTransporteRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

}

class TipoTransporteModel extends ORMModel {
    const TABLE = "cu_neg_tipo_transporte";

	/**
     * @var int
     */    
	 public $id;
	/**
     * @var string
     */    
	 public $nombre;
	/**
     * @return TransporteModel[]
     */
    public function getTransportes()
    {
        return $this->hasMany('TransporteModel','TipoTransporte_id');
    }    
	public function toArray() {
		$arr = parent::toArray();
        return $arr;
		
    }

	public function __toString() {
        return $this->nombre;
    }

}
