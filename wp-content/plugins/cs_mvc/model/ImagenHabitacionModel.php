<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/HabitacionModel.php';

class ImagenHabitacionRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

}

class ImagenHabitacionModel extends ORMModel {
    const TABLE = "cu_neg_imagen_habitacion";

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
	 public $Habitacion_id;
	/**
     * @return HabitacionModel
     */
    public function getHabitacion()
    {
        return $this->hasOne('HabitacionModel','Habitacion_id', 'id');
    }    
	public function toArray() {
		$arr = parent::toArray();
        $arr['habitacion_display'] = $this->getHabitacion()->__toString();
        return $arr;
		
    }

	public function __toString() {
        return $this->nombre;
    }

}
