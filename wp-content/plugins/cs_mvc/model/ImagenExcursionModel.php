<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ExcursionModel.php';

class ImagenExcursionRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

}

class ImagenExcursionModel extends ORMModel {
    const TABLE = "cu_neg_imagen_excursion";

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
	 public $Excursion_id;
	/**
     * @return ExcursionModel
     */
    public function getExcursion()
    {
        return $this->hasOne('ExcursionModel','Excursion_id', 'id');
    }    
	public function toArray() {
		$arr = parent::toArray();
		$arr['excursion_display'] = $this->getExcursion()->__toString();
        return $arr;
		
    }

	public function __toString() {
        return $this->nombre;
    }

}
