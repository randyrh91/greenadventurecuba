<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/AlojamientoModel.php';

class TipoAlojamientoRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

}

class TipoAlojamientoModel extends ORMModel {
    const TABLE = "cu_neg_tipo_alojamiento";

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
	 public $textoCorto;
	/**
     * @return AlojamientoModel[]
     */
    public function getAlojamientos()
    {
        return $this->hasMany('AlojamientoModel','TipoAlojamiento_id');
    }    
	public function toArray() {
		$arr = parent::toArray();
        return $arr;
		
    }

	public function __toString() {
        return $this->nombre;
    }

}
