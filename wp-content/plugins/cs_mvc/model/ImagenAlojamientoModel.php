<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/AlojamientoModel.php';

class ImagenAlojamientoRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

}

class ImagenAlojamientoModel extends ORMModel {
    const TABLE = "cu_neg_imagen_alojamiento";

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
	 public $Alojamiento_id;
	/**
     * @return AlojamientoModel
     */
    public function getAlojamiento()
    {
        return $this->hasOne('AlojamientoModel','Alojamiento_id', 'id');
    }    
	public function toArray() {
		$arr = parent::toArray();
		$arr['alojamiento_display'] = $this->getAlojamiento()->__toString();
        return $arr;
		
    }

	public function __toString() {
        return $this->nombre;
    }

}
