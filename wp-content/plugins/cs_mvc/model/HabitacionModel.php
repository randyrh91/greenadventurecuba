<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ImagenHabitacionModel.php';
require_once CS_MVC_PATH_MODEL . '/TipoHabitacionModel.php';
require_once CS_MVC_PATH_MODEL . '/ServiciosModel.php';
require_once CS_MVC_PATH_MODEL . '/AlojamientoModel.php';
require_once CS_MVC_PATH_MODEL . '/ServiciosHabitacionesModel.php';

class HabitacionRepo extends ORMRepo
{
    /**
     * @return self
     */
    public static function create()
    {
        return self::_create(__CLASS__);
    }
}

class HabitacionModel extends ORMModel
{
    const TABLE = "cu_neg_habitacion";

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
     * @var int
     * Randy este es la Duracion
     */
    public $cantMax;

    /**
     * @var int
     * Randy este es el Orden
     */
    public $orden;

    /**
     * @var string
     * Randy este es el precio en la Alta
     */
    public $precio;

    /**
     * @var string
     * Randy este es el Precio en la baja
     */
    public $precioBaja;


    
    /**
     * @var int
     * Randy este es Id del Tipo de Habitacion Rel m-1 Existe un metodo q te da el objeto TipoHabitacion
     */
    public $TipoHabitacion_id;
    
    /**
     * Randy este te da La Id de Destino donde esta la kasa
     * @var int
     */
    public $Alojamiento_id;

    /**
     * @return AlojamientoModel
     */
    public function getAlojamiento()
    {
        return $this->hasOne('AlojamientoModel','Alojamiento_id', 'id');
    }

    /**
     * Actualmente no se usa
    * @return ServiciosHabitacionesModel[]
    */
    public function getServicioHabitaciones()
    {

//        return ServicioHabitacionRepo::create()->all(null,null,'orden',array('Habitacion_id'=>$this->id));
        return $this->hasMany('ServiciosHabitacionesModel','Habitacion_id');
    }

    /**
     * Randy Este Metodo te da los servicios
     * @return ServiciosModel[]
     */
    public function getServicios()
    {
        $arr = array();
        foreach($this->getServicioHabitaciones() as $se) {
            $arr[] = $se->getServicio();
        }
        return $arr;
    }
    /**
     * Actualemento no se usa
     * @return ServiciosModel[]
     */
    public function getServicioNoAsignados()
    {
        $servicios = ServiciosRepo::create()->all();
        $arr = array();
        foreach($this->getServicioHabitaciones() as $se) {
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
     * @return TipoHabitacionModel
     */
    public function getTipoHabitacion()
    {
        return $this->hasOne('TipoHabitacionModel', 'TipoHabitacion_id', 'id');
    }


    /**
     * @return ImagenHabitacionModel[]
     */
    public function getImagenHabitaciones()
    {
        return $this->hasMany('ImagenHabitacionModel', 'Habitacion_id');
    }

    /**
     * Obtiene la Imagen de Referencia de la Habitacion
     * @var ImagenHabitacionModel[] $image
     * @return ImagenHabitacionModel
     *     */
    public function getOneImagenHabitaciones()
    {
        $image = $this->hasMany('ImagenHabitacionModel', 'Habitacion_id');
        return $image[0];
    }


    public function toArray()
    {
        $arr = parent::toArray();
        $arr['tipohabitacion_display'] = $this->getTipoHabitacion()->__toString();
        return $arr;

    }
    public function __toString()
    {
        return $this->nombre;
    }

}
