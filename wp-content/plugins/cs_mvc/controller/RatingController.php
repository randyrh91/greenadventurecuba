<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 10/05/2015
 * Time: 1:37
 */
require_once CS_MVC_PATH_MODEL . '/RatingModel.php';
require_once CS_MVC_PATH_MODEL . '/ExcursionModel.php';

class RatingController extends Controller
{

    function save()
    {
        $rat = RatingRepo::create()->oneBy($this->in_num('id', 0));
        if (!$rat)
            $rat = new RatingModel();
        $rat->save($_REQUEST);
    }

    function saveJSON()
    {
        $rating = $this->_save($this->in_ajax());
        $this->responseJSON($rating->toArray());
    }

    /**
     * @return RatingModel
     */
    private function _save($data)
    {
        /** @var RatingModel $rating */
        $rating = RatingRepo::create()->oneBy(intval($data['id']));
        if (!$rating)
            $rating = new RatingRepo();
        $rating->save($data);
        return $rating;
    }

    function remove()
    {
        if ($this->in('id')) {
            RatingRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            RatingRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success' => 'true'));
    }

    function votar()
    {
        $entro=null;
        $id=$this->in('id');
        $estrellas=$this->in('estrellas');
        if ($id) {
            /**@var RatingModel $rating */
            $rating = RatingRepo::create()->oneBy(intval($id));
            /** @var ExcursionModel $exc */
            $exc = ExcursionRepo::create()->oneBy(array('Rating_id'=>$rating->id));
            switch (intval($estrellas)) {
                case 1: {
                    $cantEstrellas = ($rating->unaEstrella) + 1;
                    $rating->save(array('unaEstrella' => $cantEstrellas));
                    $exc->likes-=2;
                    break;
                }
                case 2: {
                    $cantEstrellas = ($rating->dosEstrellas) + 1;
                    $rating->save(array('dosEstrellas' => $cantEstrellas));
                    $exc->likes-=1;
                    break;
                }
                case 3: {
                    $cantEstrellas = ($rating->tresEstrellas) + 1;
                    $rating->save(array('tresEstrellas' => $cantEstrellas));
                    $exc->likes+=1;
                    break;
                }
                case 4: {
                    $cantEstrellas = ($rating->cuatroEstrellas) + 1;
                    $rating->save(array('cuatroEstrellas' => $cantEstrellas));
                    $exc->likes+=2;
                    break;
                }
                case 5: {
                    $cantEstrellas = ($rating->cincoEstrellas) + 1;
                    $rating->save(array('cincoEstrellas' => $cantEstrellas));
                    $exc->likes+=3;
                    break;
                }
            }
            $exc->save();
        }
        $this->responseJSON(array('success' => true));
    }
} 