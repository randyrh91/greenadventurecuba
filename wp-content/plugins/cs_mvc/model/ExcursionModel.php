<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/AccionModel.php';
require_once CS_MVC_PATH_MODEL . '/RatingModel.php';
require_once CS_MVC_PATH_MODEL . '/TipoExcursionModel.php';
require_once CS_MVC_PATH_MODEL . '/ImagenExcursionModel.php';
require_once CS_MVC_PATH_MODEL . '/ReservaExcursionModel.php';
require_once CS_MVC_PATH_MODEL . '/ViajeModel.php';
require_once CS_MVC_PATH_MODEL . '/ObservacionesModel.php';
require_once CS_MVC_PATH_MODEL . '/ListaPrecioModel.php';
require_once CS_MVC_PATH_MODEL . '/ModalidadExcursionesModel.php';
require_once CS_MVC_PATH_MODEL . '/ServiciosModel.php';
require_once CS_MVC_PATH_MODEL . '/ServiciosExcursionesModel.php';

class ExcursionRepo extends ORMRepo
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
            'post_parent' => '280',
            'posts_per_page' => 1000,
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            return $query->posts;
        }
        return array();
    }

    public function observaciones_arr($exc_id,$tipo=null) {
        $item = ExcursionRepo::create()->oneBy($exc_id);
        $arr = array();
        $obs = $item->getObservaciones();
        foreach($obs as $ob) {
            if(($tipo===0 && !$ob->isIncluye) || ($tipo===1 && $ob->isIncluye) || $tipo===null)
                $arr[] = $ob->toArray();
        }
        return $arr;
    }

}

class ExcursionModel extends ORMModel
{
    const TABLE = "cu_neg_excursion";

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
     * Randy este es precio --: se usa mientras no se implementa el listado de precios
     */
    public $precio;
    /**
     * @var int
     * Randy este es la Cantidad de Noche --: real no hace falta ya q se calcula con la cantidad de day -1
     */
    public $cantNoches;
    /**
     * @var int
     * Randy este es la Duracion
     */
    public $cantDias;
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
     * Randy este es Id del Tipo de Excursion Rel m-1 Existe un metodo q te da el objeto TipoExcursion
     */
    public $TipoExcursion_id;
    /**
     * @var int
     * Randy este es ID del POST que puede ser una excursion, un articulo, una casa, o una pagina
     * Todo esto se configura con opciones del WP o por programacion desde el Backend
     * hay un ejemplo claro de uso de WP_Query para extraer post de wp mediante parametros como categoria(cat) y otras cosas
     * en el backend de Excursion_edit fijita hay si tienes duda igual la ayuda de WP
     */
    public $Post_ID;
    /**
     * Bueno lo hiciste tu --: igual aki no se esta usando
     * @var int
     */
    public $Rating_id;
    /**
     * @var boolean
     */
    public $active;

    /**
     * Actualmente no se usa
    * @return ServiciosExcursionesModel[]
    */
    public function getServicioExcursiones()
    {

//        return ServicioExcursionRepo::create()->all(null,null,'orden',array('Excursion_id'=>$this->id));
        return $this->hasMany('ServiciosExcursionesModel','Excursion_id');
    }
    /**
     * Actualmento no se Usa
     * @return ServiciosModel[]
     */
    public function getServicio()
    {
        $arr = array();
        foreach($this->getServicioExcursiones() as $se) {
            $arr[] = $se->getServicio();
        }
        return $arr;
    }
    /**
     * Actualemente no se usa
     * @return ServiciosModel[]
     */
    public function getServicios()
    {
        $arr = array();
        foreach($this->getServicioExcursiones() as $se) {
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
        foreach($this->getServicioExcursiones() as $se) {
            $arr[$se->Servicio_id] = true;
        }
        $response = array();
        foreach($servicios as $servicio) {
            if(!isset($arr[$servicio->id]))
                $response[] = $servicio;
        }
//        var_dump($response); die;
        return $response;

    }

    /**
    * Randy este es de uso Interno devuelve los registro de la Tabla intermedia
    * @return ModalidadExcursionesModel[]
    */
    public function getModalidadExcursiones()
    {

//        return ModalidadExcursionRepo::create()->all(null,null,'orden',array('Excursion_id'=>$this->id));
        return $this->hasMany('ModalidadExcursionesModel','Excursion_id');
    }
    /**
     * Randy este es Modalidades --: se mete en la tabla intermedia y t da el obejos ModalidadModel
     * @return ModalidadModel[]
     */
    public function getModalidades()
    {
        $arr = array();
        foreach($this->getModalidadExcursiones() as $se) {
            $arr[] = $se->getModalidad();
        }
        return $arr;
    }

    /**
     * Randy este es Modalidades que no se marcaron
     * @return ModalidadModel[]
     */
    public function getModalidadesNoAsignadas()
    {
        $mds = ModalidadRepo::create()->all();
        $arr = array();
        foreach($this->getModalidadExcursiones() as $se) {
            $arr[$se->Modalidad_id] = true;
        }
        $response = array();
        foreach($mds as $md) {
            if(!isset($arr[$md->id]))
                $response[] = $md;
        }
        return $response;

    }

    /**
     * Se usa para ver si se incluye o no en la excursion pero este te da todo usa mejor los de abajos
     * @return ObservacionesModel[]
     */
    public function getObservaciones()
    {
        return $this->hasMany('ObservacionesModel', 'Excursion_id');
    }
    /**
     * Se usa para ver si se incluye o no en la excursion
     * @return ObservacionesModel[]
     */
    public function getServicioIncluye()
    {
        return ObservacionesRepo::create()->allBy(array("Excursion_id"=>$this->id,"isIncluye"=>1));
    }

    /**
     * Se usa para ver si se incluye o no en la excursion
     * @return ObservacionesModel[]
     */
    public function getServiciosNoIncluye()
    {
        return ObservacionesRepo::create()->allBy(array("Excursion_id"=>$this->id,"isIncluye"=>0));
    }

    /**
     * Lo Hiciste tu Randir recuerda q el nombre de la Clase hace referencia a la Instancia de Un Obj, "de uno solo" por
     * eso tu creas un "precio" no una lista de precio, en el caso de que ListaPrecioModel Fuera una clase contenedora
     * entonces si se le llamaria en plurar.
     * @return ListaPrecioModel[]
     */
    public function getListadoPrecios()
    {
        return $this->hasMany('ListaPrecioModel', 'Excursion_id');
    }
    /**
     * @return TipoExcursionModel
     */
    public function getTipoExcursion()
    {
        return $this->hasOne('TipoExcursionModel', 'TipoExcursion_id', 'id');
    }

    /**
     * @return RatingModel
     */
    public function getRating()
    {
        return $this->hasOne('RatingModel', 'Rating_id', 'id');
    }

    /**
     * @return ImagenExcursionModel[]
     */
    public function getImagenExcursiones()
    {
        return $this->hasMany('ImagenExcursionModel', 'Excursion_id');
    }

    /**
     * @return ReservaExcursionModel[]
     */
    public function getReservaExcursiones()
    {
        return $this->hasMany('ReservaExcursionModel', 'Excursion_id');
    }

    /**
     * Este metodo y el otro son la misma kk ninguno de los 2 se debe usar
     * Lo mejor es acceder a los viajes y de hay acceder a los programas ok!!!!
     * @return AccionModel[]
     */
    public function getAcciones()
    {
        return $this->hasMany('AccionModel', 'Excursion_id');
    }
    /**
     * Este metodo y el de arriba son la misma kk ninguno de los 2 se debe usar, pero bueno
     * @return AccionModel[]
     */
    public function getPrograma()
    {
        return AccionRepo::create()->all(null, null, 'orden', array('Excursion_id' => $this->id));
    }

    /**
     * Obtiene la Imagen de Referencia de la Excursion
     * @var ImagenExcursionModel[] $image
     * @return ImagenExcursionModel
     *     */
    public function getOneImagenExcursiones()
    {
        $image = $this->hasMany('ImagenExcursionModel', 'Excursion_id');
        return $image[0];
    }

    /**
     * Randy este Obtiene los Viajes --: Q en realidad son los Dias Muy Importante!!
     * @return ViajeModel[]
     */
    public function getViajes()
    {
        return ViajeRepo::create()->all(null, null, 'orden', array('Excursion_id' => $this->id));
    }


    public function toArray()
    {
        $arr = parent::toArray();
        $arr['tipoexcursion_display'] = $this->getTipoExcursion()->__toString();
        return $arr;

    }
    public function __toString()
    {
        return $this->nombre;
    }

}
