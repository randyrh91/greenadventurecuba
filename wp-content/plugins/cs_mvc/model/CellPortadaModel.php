<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/AlojamientoModel.php';
require_once CS_MVC_PATH_MODEL . '/ExcursionModel.php';

class CellPortadaRepo extends ORMRepo {
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
            return CellPortadaRepo::CSTYPE_EXCURSION;
        if(AlojamientoRepo::create()->oneBy(array("Post_ID"=>$Post_ID)))
            return CellPortadaRepo::CSTYPE_ALOJAMIENTO;
        return CellPortadaRepo::CSTYPE_ARTICULO;
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

    public function getAllPosts()
    {
        $arr = array();
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'order' => 'DESC',
            'posts_per_page' => 1000,
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            $arr = $query->posts;
        }
        $args = array(
            'post_type' => 'page',
            'post_parent' => 280,
            'post_status' => 'publish',
            'order' => 'DESC',
            'posts_per_page' => 1000,
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            $arr = array_merge($query->posts,$arr);
        }
        $args = array(
            'post_type' => 'page',
            'post_parent' => 277,
            'post_status' => 'publish',
            'order' => 'DESC',
            'posts_per_page' => 1000,
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            $arr = array_merge($query->posts,$arr);
        }
        return $arr;
    }

    public function getPosts()
    {
        $arr = array();
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'order' => 'DESC',
            'posts_per_page' => 1000,
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            $arr = $query->posts;
        }

        return $arr;
    }

}

class CellPortadaModel extends ORMModel {
    const TABLE = "cu_neg_cell_portada";

    public $id;

	/**
     * Randy este Representa la posicion en la portada --: 1 - Seria el 1er Art principal 2 y 3 serian las columnas y asi cuantos se pongan
     * pero bueno en este caso solo con tres basta pero pensando en un futuro si se quieren poner mas articulos
     * @var int
     */    
	 public $cell;

    /**
     * Randy este es La Excursion o Articulo o Casa q se publicita en el Slide Show
     * @var int
     */
    public $Post_ID;

	/**
     * Randy este pordra ser el tituolo q va en portada en caso de q se defenina pero normalmente iria el titulo del Articulo
     * @var string
     */    
	 public $nombre;
	/**
     * Randy estr pordra ser la foto q va en portada en caso de q se defenina pero normalmente iria el foto del Articulo
     * @var string
     */    
	 public $foto;
	/**
     * Randy estr pordra ser la foto q va en portada en caso de q se defenina pero normalmente iria el foto del Articulo
     * No te compliques con estos tres ultimos atributos solo q me parecio una buena idea y hay q guardarla
     * @var string
     */    
	 public $textoCorto;

    /**
     * Randy este Representa la cantidad de culmnas q se lleva  --: 1 - Seria el 1er Art principal 2 y 3
     * no te clientes con eso ahora q realmente no es necesario solo esta ahi, si te da tiempo hacer algo eso es cosa tuya
     *
     * Si quieres poner varias filas tendrias q ponerlo en la misma celda entonces saldria abajo la configaracion para GAC es de
     * cell 1 cell_column 1  --: col-md-12
     * cell 2 cell_column 2 --: col-md-6
     * cell 3 cell_column 2 --: col-md-6
     * @var int
     */
    public $cell_column;

    public function toArray() {
		$arr = parent::toArray();
        return $arr;
		
    }

	public function __toString() {
        return $this->nombre;
    }

}
