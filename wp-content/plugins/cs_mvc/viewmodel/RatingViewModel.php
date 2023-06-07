<?php
/**
 * Created by PhpStorm.
 * User: Randy-PC
 * Date: 17/09/2016
 * Time: 1:37
 */
require_once CS_MVC_PATH_MODEL . '/RatingModel.php';

class RatingViewModel extends ViewModel
{
    private $rating;

    /**
     * @return RatingModel
     */
    function getRating()
    {
        if (!$this->rating) {
            if ($this->in('id'))
                $this->rating = RatingRepo::create()->oneBy($this->in_num('id'));
            else $this->rating = new RatingModel();
        }
        return $this->rating;
    }

    /**
     * @return RatingModel
     */
    function getRatingByExcursion($id)
    {
        /** @var ExcursionModel $excursion*/
        $excursion = ExcursionRepo::create()->oneBy(array(
            "id"=>$id
        ));
        return RatingRepo::create()->oneBy(array(
            "id"=> $excursion->Rating_id
        ));
    }

    /**
     * @return Integer
     */
    function getTotalEstrellasExcursion($model)
    {
        return $model->unaEstrella + $model->dosEstrellas + $model->tresEstrellas + $model->cuatroEstrellas + $model->cincoEstrellas;
    }

    /**
     * @return Double[]
     */
    function getPorciento($id)
    {
        $model = $this->getRatingByExcursion($id);
        $total = $this->getTotalEstrellasExcursion($model);
        $porcientos = array();
        if ($total != 0) {
            $porcientos['unaEstrella'] = round($model->unaEstrella * 100 / $total);
            $porcientos['dosEstrellas'] = round($model->dosEstrellas * 100 / $total);
            $porcientos['tresEstrellas'] = round($model->tresEstrellas * 100 / $total);
            $porcientos['cuatroEstrellas'] = round($model->cuatroEstrellas * 100 / $total);
            $porcientos['cincoEstrellas'] = round($model->cincoEstrellas * 100 / $total);
        }
        return $porcientos;
    }

} 