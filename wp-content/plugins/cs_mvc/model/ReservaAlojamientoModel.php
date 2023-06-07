<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/AlojamientoModel.php';
require_once CS_MVC_PATH_MODEL . '/EstadoReservaModel.php';

class ReservaAlojamientoRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

    function countTipo1_2() {
        return ReservaAlojamientoRepo::create()->count(array(
            "EstadoReserva_id <"=>3
        ));
    }

}

class ReservaAlojamientoModel extends ORMModel {
    const TABLE = "cu_neg_reserva_alojamiento";

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
	 public $Alojamiento_id;
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
     * @return AlojamientoModel
     */
    public function getAlojamiento()
    {
        return $this->hasOne('AlojamientoModel','Alojamiento_id', 'id');
    }    
	public function toArray() {
		$arr = parent::toArray();
		$arr['fecha_date'] = $this->getFecha();
		$arr['estadoreserva_display'] = $this->getEstadoReserva()->__toString();
		$arr['alojamiento_display'] = __($this->getAlojamiento()->__toString());
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
