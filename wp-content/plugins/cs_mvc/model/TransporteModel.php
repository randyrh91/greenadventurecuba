<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ListaPrecioModel.php';
require_once CS_MVC_PATH_MODEL . '/TipoTransporteModel.php';
require_once CS_MVC_PATH_MODEL . '/ImagenTransporteModel.php';
require_once CS_MVC_PATH_MODEL . '/ViajeModel.php';

class TransporteRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

}

class TransporteModel extends ORMModel {
    const TABLE = "cu_neg_transporte";

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
     * @var string
     */    
	 public $descripcion;
	/**
     * @var string
     */    
	 public $foto;
	/**
     * @var int
     */    
	 public $TipoTransporte_id;
	/**
     * @var int
     */    
	 public $Chofer_id;
	/**
     * @return TipoTransporteModel
     */
    public function getTipoTransporte()
    {
        return $this->hasOne('TipoTransporteModel','TipoTransporte_id', 'id');
    }    
	/**
     * @return ChoferModel
     */
    public function getChofer()
    {
        return $this->hasOne('ChoferModel','Chofer_id', 'id');
    }    
	/**
     * @return ImagenTransporteModel[]
     */
    public function getImagenTransportes()
    {
        return $this->hasMany('ImagenTransporteModel','Transporte_id');
    }    
	/**
     * @return ViajeModel[]
     */
    public function getViajes()
    {
        return $this->hasMany('ViajeModel','Transporte_id');
    }    
	public function toArray() {
		$arr = parent::toArray();
		$arr['tipotransporte_display'] = $this->getTipoTransporte()->__toString();
		$arr['chofer_display'] = $this->getChofer()->__toString();
        return $arr;
		
    }

	public function __toString() {
        return $this->nombre;
    }

}
