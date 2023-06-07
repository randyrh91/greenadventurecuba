<?php
class AccionRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

}

class AccionModel extends ORMModel {
    const TABLE = "cu_neg_accion";

    /**
     * Randy este es el orden con se realiza las Actividades
     * @var int
     */
    public $orden;


    /**
     * @var string
     */
    public $nombre;

    /**
     * @var string
     */
    public $descripcion;

    /**
     * Randy este Attr esta quemao alguien lo puso mal y ahi se quedo pues hay se queda a ti no te hace falta
     * @var int
     */
    public $Excursion_id;

    /**
     * @var int
     */
    public $Viaje_id;

    public function __toString() {
        return __($this->nombre).": ".__($this->descripcion);
    }

    /**
     * @return ViajeModel
     */
    public function getViaje()
    {
        return $this->hasOne('ViajeModel','Viaje_id', 'id');
    }


} // Accion
