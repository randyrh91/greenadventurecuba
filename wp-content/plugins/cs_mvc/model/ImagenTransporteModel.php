<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/TransporteModel.php';

class ImagenTransporteRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

}

class ImagenTransporteModel extends ORMModel {
    const TABLE = "cu_neg_imagen_transporte";

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
	 public $Transporte_id;
	/**
     * @return TransporteModel
     */
    public function getTransporte()
    {
        return $this->hasOne('TransporteModel','Transporte_id', 'id');
    }    
	public function toArray() {
		$arr = parent::toArray();
		$arr['transporte_display'] = $this->getTransporte()->__toString();
        return $arr;
		
    }

	public function __toString() {
        return $this->nombre;
    }

}
