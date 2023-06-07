<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 10/05/2015
 * Time: 5:45
 */
final class View extends ViewModel {
    public  $view;
    private function __construct() {}
    private static $i;
    public static function create() {
        if(null === self::$i) self::$i = new self;
        return self::$i;
    }

    function render($view,$data=array()) {
           $this->view = $view;
           foreach($data as $key => $v) {
               $this->$key = $v;
           }
           include CS_MVC_PATH.'/view/'.$view.'.php';
    }

    /**
     * Sin implementar aun No usar
     * @param $view
     * @param array $data
     */
    function output($view,$data=array()) {
        $this->view = $view;
        foreach($data as $key => $v) {
            $this->$key = $v;
        }
        include CS_MVC_PATH.'/view/'.$view.'.php';
    }
} 