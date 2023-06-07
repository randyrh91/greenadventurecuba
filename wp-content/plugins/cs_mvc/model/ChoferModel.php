<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/TransporteModel.php';

class ChoferRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

}

class ChoferModel extends ORMModel {
    const TABLE = "cu_neg_chofer";

	/**
     * @var int
     */    
	 public $id;
	/**
     * @var string
     */    
	 public $nombre;
	/**
     * @var string
     */    
	 public $telefono;
	/**
     * @var int
     */    
	 public $anosExperiencia;
	/**
     * @var string
     */    
	 public $foto;
	/**
     * @return TransporteModel[]
     */
    public function getTransportes()
    {
        return $this->hasMany('TransporteModel','Chofer_id');
    }    
	public function toArray() {
		$arr = parent::toArray();
        return $arr;
		
    }

	public function __toString() {
        return $this->nombre;
    }

}
