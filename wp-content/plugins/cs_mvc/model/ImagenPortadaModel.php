<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/AlojamientoModel.php';
require_once CS_MVC_PATH_MODEL . '/ExcursionModel.php';

class ImagenPortadaRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

    const CSTYPE_EXCURSION = 1;
    const CSTYPE_ALOJAMIENTO = 2;
    const CSTYPE_ARTICULO = 3;

    /**
     * Randy este metedo t sera super importante ya q te ayudara a determinar si post es una exc, hostal o articulo
     * @param $Post_ID
     * @return int
     */
    public function getCSTypePostByID($Post_ID) {
        if(ExcursionRepo::create()->oneBy(array("Post_ID"=>$Post_ID)))
            return ImagenPortadaRepo::CSTYPE_EXCURSION;
        if(AlojamientoRepo::create()->oneBy(array("Post_ID"=>$Post_ID)))
            return ImagenPortadaRepo::CSTYPE_ALOJAMIENTO;
        return ImagenPortadaRepo::CSTYPE_ARTICULO;
    }

    /**
     * Randy este metedo t sera super importante ya q te ayudara a determinar y obetener una exc, hostal o articulo segun el $Post_ID
     * @param $Post_ID
     * @return int
     */
    public function getCSPostByID($Post_ID) {
        $item = ExcursionRepo::create()->oneBy(array("Post_ID"=>$Post_ID));
        if($item)
            return $item;
        $item = AlojamientoRepo::create()->oneBy(array("Post_ID"=>$Post_ID));
        if($item)
            return $item;

        return get_post($Post_ID);
    }

}

class ImagenPortadaModel extends ORMModel {
    const TABLE = "cu_neg_imagen_portada";

	/**
     * @var int
     */    
	 public $id;

    /**
     * @var int
     */
    public $active;

	/**
     * Randy este es La Excursion o Articulo o Casa q se publicita en el Slide Show
     * @var int
     */
    public $Post_ID;

	/**
     * @var string
     */    
	 public $nombre;
	/**
     * @var string
     */    
	 public $foto;
	/**
     * @var string
     */    
	 public $textoCorto;


	public function toArray() {
		$arr = parent::toArray();
        return $arr;
		
    }

	public function __toString() {
        return $this->nombre;
    }

}
