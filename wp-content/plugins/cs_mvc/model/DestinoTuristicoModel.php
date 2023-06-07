<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/TipoDestinoModel.php';
require_once CS_MVC_PATH_MODEL . '/ImagenDestinoTuristicoModel.php';
require_once CS_MVC_PATH_MODEL . '/ViajeModel.php';

class DestinoTuristicoRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

}

class DestinoTuristicoModel extends ORMModel {
    const TABLE = "cu_neg_destino_turistico";

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
	 public $TipoDestino_id;
	/**
     * @return TipoDestinoModel
     */
    public function getTipoDestino()
    {
        return $this->hasOne('TipoDestinoModel','TipoDestino_id', 'id');
    }    
	/**
     * @return ImagenDestinoTuristicoModel[]
     */
    public function getImagenDestinoTuristicos()
    {
        return $this->hasMany('ImagenDestinoTuristicoModel','Destino_Turistico_id');
    }    
	/**
     * @return ViajeModel[]
     */
    public function getViajes()
    {
        return $this->hasMany('ViajeModel','DestinoTuristico_id');
    }    
	public function toArray() {
		$arr = parent::toArray();
		$arr['tipodestino_display'] = $this->getTipoDestino()->__toString();
        return $arr;
		
    }

	public function __toString() {
        return $this->nombre;
    }

}
