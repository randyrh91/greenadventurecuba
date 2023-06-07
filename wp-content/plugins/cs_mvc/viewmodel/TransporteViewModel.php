<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/TransporteModel.php';
require_once CS_MVC_PATH_MODEL . '/ListaPrecioModel.php';
require_once CS_MVC_PATH_MODEL . '/TipoTransporteModel.php';

class TransporteViewModel extends ViewModel
{
    private $transportes;
    private $transporte;

    /**
     * @return array TransporteModel
     */
    function getTransportes()
    {
        $q = $this->in('q');
        if (!$q && !$this->transportes) $this->transportes = TransporteRepo::create()->all();
        elseif ($q) {
            $this->transportes = TransporteRepo::create()->allBy(array(
                "id LIKE" => "'%$q%'",
                "OR nombre LIKE" => "'%$q%'",
                "OR textoCorto LIKE" => "'%$q%'",
                "OR descripcion LIKE" => "'%$q%'",
                "OR foto LIKE" => "'%$q%'",
            ));
        }
        return $this->transportes;
    }

    /**
     * @return TransporteModel
     */
    function getTransporte()
    {
        if (!$this->transporte) {
            if ($this->in('id'))
                $this->transporte = TransporteRepo::create()->oneBy($this->in_num('id'));
            else $this->transporte = new TransporteModel();
        }
        return $this->transporte;

    }

    function getChoferes()
    {
        return ChoferRepo::create()->all();
    }

    function getTipoTransportes()
    {
        return TipoTransporteRepo::create()->all();
    }
    /**
     * @return TransporteModel[]
     */
    function getAllTranspotes()
    {
        return TransporteRepo::create()->all();
    }

}  