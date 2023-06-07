<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ReservaExcursionModel.php';

class EstadoReservaRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

}

class EstadoReservaModel extends ORMModel {
    const TABLE = "cu_neg_estado_reserva";

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
     * @return ReservaExcursionModel[]
     */
    public function getReservaExcursiones()
    {
        return $this->hasMany('ReservaExcursionModel','EstadoReserva_id');
    }    
	public function toArray() {
		$arr = parent::toArray();
        return $arr;
		
    }

	public function __toString() {
        return $this->nombre;
    }

}
