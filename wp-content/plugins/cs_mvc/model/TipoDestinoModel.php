<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/DestinoTuristicoModel.php';

class TipoDestinoRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

}

class TipoDestinoModel extends ORMModel {
    const TABLE = "cu_neg_tipo_destino";

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
     * @return DestinoTuristicoModel[]
     */
    public function getDestinoTuristicos()
    {
        return $this->hasMany('DestinoTuristicoModel','TipoDestino_id');
    }    
	public function toArray() {
		$arr = parent::toArray();
        return $arr;
		
    }

	public function __toString() {
        return $this->nombre;
    }

}
