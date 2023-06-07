<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 10/05/2015
 * Time: 1:37
 */
require_once CS_MVC_PATH_MODEL . '/ExcursionModel.php';
class SiteViewModel extends ViewModel {

    /**
     * @return ExcursionModel
     */
    function getPopularExcursiones($cant) {
//          $items =  ExcursionRepo::create()->all();
        $items = ExcursionRepo::create()->allBy(array(
            'isPop'=>true
        ),0,$cant);
        return $items;
    }

}