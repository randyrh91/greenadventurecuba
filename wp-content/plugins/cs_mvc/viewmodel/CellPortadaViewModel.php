<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 10/05/2015
 * Time: 1:37
 */
require_once CS_MVC_PATH_MODEL . '/CellPortadaModel.php';

class cellPortadaViewModel extends ViewModel
{
    /**
     * @return array CellPortadaModel
     */
    function getArticulosPortada()
    {
        return CellPortadaRepo::create()->all(null, null, 'cell ASC');

    }

    /**
     * @return array CellPortadaModel
     */
    function getArticulosDestacados($count)
    {
        $array_post = array();
        $i = 0;
        $posts = CellPortadaRepo::create()->getPosts();
        foreach ($posts as $post) {
            $typePost = CellPortadaRepo::create()->getCSTypePostByID($post->ID);
            if ($i == $count) {
                break;
            }
            if ($typePost == CellPortadaRepo::CSTYPE_ARTICULO) {
                $array_post[] = $post;
                $i++;
            }
        }
        return $array_post;
    }

}