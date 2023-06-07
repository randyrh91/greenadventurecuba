<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ExcursionModel.php';
require_once CS_MVC_PATH_MODEL . '/EstadoReservaModel.php';

class ReservaExcursionRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

    function countTipo1_2() {
        return ReservaExcursionRepo::create()->count(array(
            "EstadoReserva_id <"=>3
        ));
    }

}

class ReservaExcursionModel extends ORMModel {
    const TABLE = "cu_neg_reserva_excursion";

	/**
     * @var int
     */    
	 public $id;
	/**
     * @var date
     */    
	 public $fecha;
	/**
	 * @return DateTime
	 */
	public function getFecha($format='Y-m-d') {
        $date = new DateTime($this->fecha);
        return  $date->format($format);
    }
	/**
     * @var string
     */    
	 public $hora;

	/**
     * @var float
     */    
	 public $precioOferta;
	/**
     * @var int
     */    
	 public $cantidadPersona;
	/**
     * @var string
     */    
	 public $descripcion;
	/**
     * @var int
     */    
	 public $EstadoReserva_id;
	/**
     * @var int
     */    
	 public $Excursion_id;
	/**
     * @var string
     */    
	 public $User_ID;
    /**
     * @var string
     */
    public $User_JSON;

    /**
     * @var string
     */
    public $cod;

	/**
     * @return EstadoReservaModel
     */
    public function getEstadoReserva()
    {
        return $this->hasOne('EstadoReservaModel','EstadoReserva_id', 'id');
    }    
	/**
     * @return ExcursionModel
     */
    public function getExcursion()
    {
        return $this->hasOne('ExcursionModel','Excursion_id', 'id');
    }    
	public function toArray() {
		$arr = parent::toArray();
		$arr['fecha_date'] = $this->getFecha();
		$arr['estadoreserva_display'] = $this->getEstadoReserva()->__toString();
		$arr['excursion_display'] = __($this->getExcursion()->__toString());
        return $arr;
		
    }

    public function diasRestantes() {
        $fecha = new DateTime($this->fecha);
        $now = new DateTime();
        return $now->diff($fecha)->format('%R')=='+'?$now->diff($fecha)->format('%d'):0;
    }
    public function isPass($day = 7) {
        return $this->diasRestantes()<7;
    }

	public function __toString() {
        return $this->fecha.' | '.$this->User_ID;
    }

}
