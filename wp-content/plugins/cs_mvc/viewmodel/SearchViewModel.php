<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 10/05/2015
 * Time: 1:37
 */
require_once CS_MVC_PATH_MODEL . '/ExcursionModel.php';

class SearchViewModel extends ViewModel {
    private $excursiones;
    /**
     * @return ExcursionModel
     */
    function findExcursionById() {
        $id = 7;
        $items = ExcursionRepo::create()->oneBy(array(
            'id'=>$id
        ));
        return $items;
    }
    function getSearchResult() {
        $q = $this->in('find_q');
        $tipo = $this->in('find_tipo');
        if(!$q && !$this->excursiones) $this->excursiones = ExcursionRepo::create()->all();
        elseif($q) {
            $filter = array(
                "TipoExcursion_id".($tipo>0?'':' >')=>$this->in('find_tipo',0),
                "AND (id LIKE"=>"'%$q%'",
                "OR nombre LIKE"=>"'%$q%'",
                "OR descripcion LIKE"=>"'%$q%'",
                "OR textoCorto LIKE"=>"'%$q%')",
            );
            $this->excursiones = ExcursionRepo::create()->allBy($filter);
        }
        return $this->excursiones;
    }

}