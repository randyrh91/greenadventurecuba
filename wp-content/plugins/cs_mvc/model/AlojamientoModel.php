<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/TipoAlojamientoModel.php';
require_once CS_MVC_PATH_MODEL . '/ImagenAlojamientoModel.php';
require_once CS_MVC_PATH_MODEL . '/ReservaAlojamientoModel.php';
require_once CS_MVC_PATH_MODEL . '/ViajeModel.php';
require_once CS_MVC_PATH_MODEL . '/HabitacionModel.php';
require_once CS_MVC_PATH_MODEL . '/ServiciosModel.php';
require_once CS_MVC_PATH_MODEL . '/ServiciosAlojamientosModel.php';

class AlojamientoRepo extends ORMRepo
{
    /**
     * @return self
     */
    public static function create()
    {
        return self::_create(__CLASS__);
    }

    public function getPosts()
    {
        $args = array(
            'post_type' => 'page',
            'post_status' => 'publish',
            'order' => 'DESC',
            'post_parent' => '277',
            'posts_per_page' => 50,
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            return $query->posts;
        }
        return array();
    }

}

class AlojamientoModel extends ORMModel
{
    const TABLE = "cu_neg_alojamiento";

    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     * Randy este es el Nombre del Producto
     */
    public $nombre;
    /**
     * @var string
     * Randy este es la Descripcion Corta
     */
    public $textoCorto;
    /**
     * @var string
     * Randy este es la Descripcion Larga
     */
    public $descripcion;
    /**
     * @var string
     * Randy este es para q el administrador tenga los datos de la casa
     */
    public $contacto;
    /**
     * @var string
     * Randy este es para q el administrador tenga los datos de la casa
     */
    public $direccion;
    /**
     * @var int
     * Randy este es la Duracion
     */
    public $cantMax;
    /**
     * @var int
     * Randy este son los Pts green --: sirve para ordenar primero popular y despues los pts green
     */
    public $likes;
    /**
     * @var boolean
     * Randy este es Si Es Popular --: realmente no se debe usar pq en el diseño de dany no aparacen pero pordrian ponerse para ordenar
     */
    public $isPop;
    /**
     * @var int
     * Randy este es Id del Tipo de Alojamiento Rel m-1 Existe un metodo q te da el objeto TipoAlojamiento
     */
    public $TipoAlojamiento_id;
    /**
     * @var int
     * Randy este es ID del POST que puede ser una alojamiento, un articulo, una casa, o una pagina
     * Todo esto se configura con opciones del WP o por programacion desde el Backend
     * hay un ejemplo claro de uso de WP_Query para extraer post de wp mediante parametros como categoria(cat) y otras cosas
     * en el backend de Alojamiento_edit fijita hay si tienes duda igual la ayuda de WP
     */
    public $Post_ID;
    /**
     * Randy este te da La Id de Destino donde esta la kasa
     * @var int
     */
    public $DestinoTuristico_id;
    /**
     * @var boolean
     */
    public $active;

    /**
     * @var string
     * Randy este es el precio en la Alta --: En los alojamientos se aplica para cuando se alquila toda la casa, algunas no lo tienen
     */
    public $precio;

    /**
     * @var string
     * Randy este es el Precio en la baja
     */
    public $precioBaja;

    /**
     * @return DestinoTuristicoModel
     */
    public function getDestinoTuristico()
    {
        return $this->hasOne('DestinoTuristicoModel','DestinoTuristico_id', 'id');
    }

    /**
    * Este es un metodo de uso interno para poder acceder a los servicios
    * @return ServiciosAlojamientosModel[]
    */
    public function getServicioAlojamientos()
    {

//        return ServicioAlojamientoRepo::create()->all(null,null,'orden',array('Alojamiento_id'=>$this->id));
        return $this->hasMany('ServiciosAlojamientosModel','Alojamiento_id');
    }

    /**
     * Este es Listado de Servicios Asignados
     * @return ServiciosModel[]
     */
    public function getServicios()
    {
        $arr = array();
        foreach($this->getServicioAlojamientos() as $se) {
            $arr[] = $se->getServicio();
        }
        return $arr;
    }
    /**
     * Este es Listado de Servicios No Asignados
     * @return ServiciosModel[]
     */
    public function getServicioNoAsignados()
    {
        $servicios = ServiciosRepo::create()->all();
        $arr = array();
        foreach($this->getServicioAlojamientos() as $se) {
            $arr[$se->Servicio_id] = true;
        }
        $response = array();
        foreach($servicios as $servicio) {
            if(!isset($arr[$servicio->id]))
                $response[] = $servicio;
        }
        return $response;

    }

    /**
     * @return TipoAlojamientoModel
     */
    public function getTipoAlojamiento()
    {
        return $this->hasOne('TipoAlojamientoModel', 'TipoAlojamiento_id', 'id');
    }


    /**
     * @return ImagenAlojamientoModel[]
     */
    public function getImagenAlojamientos()
    {
        return $this->hasMany('ImagenAlojamientoModel', 'Alojamiento_id');
    }

    /**
     * Obtiene la Imagen de Referencia de la Alojamiento
     * @var ImagenAlojamientoModel[] $image
     * @return ImagenAlojamientoModel
     *     */
    public function getOneImagenAlojamientos()
    {
        $image = $this->hasMany('ImagenAlojamientoModel', 'Alojamiento_id');
        return $image[0];
    }

    /**
     * @return HabitacionModel[]
     */
    public function getHabitaciones()
    {
//        return $this->hasMany('HabitacionModel', 'Alojamiento_id');
        return HabitacionRepo::create()->all(null,null,"orden",array("Alojamiento_id"=>$this->id));
    }


    public function toArray()
    {
        $arr = parent::toArray();
        $arr['tipoalojamiento_display'] = $this->getTipoAlojamiento()->__toString();
        return $arr;

    }
    public function __toString()
    {
        return $this->nombre;
    }

}
