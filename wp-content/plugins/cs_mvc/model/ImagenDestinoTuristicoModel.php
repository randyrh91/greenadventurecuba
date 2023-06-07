<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/DestinoTuristicoModel.php';

class ImagenDestinoTuristicoRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

}

class ImagenDestinoTuristicoModel extends ORMModel {
    const TABLE = "cu_neg_imagen_destino_turistico";

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
	 public $foto;
	/**
     * @var int
     */    
	 public $Destino_Turistico_id;
	/**
     * @return DestinoTuristicoModel
     */
    public function getDestinoTuristico()
    {
        return $this->hasOne('DestinoTuristicoModel','Destino_Turistico_id', 'id');
    }    
	public function toArray() {
		$arr = parent::toArray();
		$arr['destinoturistico_display'] = $this->getDestinoTuristico()->__toString();
        return $arr;
		
    }

	public function __toString() {
        return $this->nombre;
    }

}
