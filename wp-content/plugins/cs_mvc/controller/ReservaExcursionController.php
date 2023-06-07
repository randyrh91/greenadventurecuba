<?php
/**
 * Created by CS-Generator.
 * User: pr0x
 */
require_once CS_MVC_PATH_MODEL . '/ReservaExcursionModel.php';
require_once CS_MVC_PATH_MODEL . '/ExcursionModel.php';

class ReservaExcursionController extends Controller
{

    function save()
    {
        $_REQUEST['cod'] = md5($_REQUEST['fecha'] . '|' . $_REQUEST['email']);
        $_REQUEST['User_ID'] = $_REQUEST['email'];
        $arr_user = array(
            "email" => strip_tags($_REQUEST['email']),
            "nombre" => strip_tags($_REQUEST['nombre']),
            "apellido" => strip_tags($_REQUEST['apellido']),
            "pais" => strip_tags($_REQUEST['pais']),
            "lenguaje" => strip_tags($_REQUEST['lenguaje'])
        );
        $_REQUEST['User_JSON'] = json_encode($arr_user);

        $reservaExcursion = $this->_save($_REQUEST);
        if ($this->in('page') == 'site')
            $this->redirect($this->genPathSite('ReservaExcursiones-edit/?show_details=1&id=' . $reservaExcursion->id));
        $this->redirect($this->genPathVM('cs_mvc_reserva_excursiones', 'admin/ReservaExcursion_edit', 'ReservaExcursion', $reservaExcursion->id));
    }

    /**
     * @return ReservaExcursionModel
     */
    private function _save($data)
    {
        $reservaExcursion = ReservaExcursionRepo::create()->oneBy(intval($data['id']));
        if (!$reservaExcursion)
            $reservaExcursion = new ReservaExcursionModel();
        $reservaExcursion->save($data);
        return $reservaExcursion;
    }

    function remove()
    {
        if ($this->in('id')) {
            ReservaExcursionRepo::create()->oneBy($this->in_num('id'))->delete();
        }

        if ($this->in('page') == 'site')
            $this->redirect($this->genPathSite('cs_mvc_reserva_excursiones'));
        $this->redirectPage('cs_mvc_reserva_excursiones');
    }

    function removeJSON()
    {
        if ($this->in('id')) {
            ReservaExcursionRepo::create()->oneBy(array('id' => $this->in('id')))->delete();
        }
        $this->responseJSON(array('success' => 'true'));
    }

    function confirm()
    {
        if ($this->in('cod')) {
            /** @var ReservaExcursionModel $item */
            $item = ReservaExcursionRepo::create()->oneBy(array('cod' => '"' . $this->in('cod') . '"'));
            $item->EstadoReserva_id = 2;
            $excursion = $item->getExcursion();
            $item->save();
            $this->redirect(get_page_link($excursion->Post_ID) . '?r=2#bc');
//            $this->redirect($this->genPathSite('book-page') . '?id=' . $item->Excursion_id.'&r=2#bc');
        }
        /** @var ExcursionModel $excursion */
        $excursion = ExcursionRepo::create()->oneBy($_REQUEST['id'] * 1);
        $this->redirect(get_page_link($excursion->Post_ID) . '?r=1#form_reserva');
//        $this->redirect($this->genPathSite('book-page') . '?id=' . $_REQUEST['id'].'&r=1#form_reserva');
    }

    function saveJSON()
    {
        $token=wp_get_session_token();
//        if (isset($_REQUEST['tokenForm1']) && isset($_REQUEST['tokenForm2']) && isset($_REQUEST['tokenForm1'])) {
        if (isset($_REQUEST['tokenForm1']) ) {
//            if ($_REQUEST['tokenForm1']==$token) {
                /** @var ExcursionModel $exc */
                $exc = ExcursionRepo::create()->oneBy($this->in_num('Excursion_id'));
                $_REQUEST['precioOferta'] = $exc->precio;
                $_REQUEST['EstadoReserva_id'] = 1;
                $_REQUEST['Excursion_nombre'] = $exc->nombre;
                $_REQUEST['cod'] = md5($_REQUEST['fecha'] . '|' . $_REQUEST['email']);
                $_REQUEST['User_ID'] = $_REQUEST['email'];
                $arr_user = array(
                    "email" =>  strip_tags($_REQUEST['email']),
                    "nombre" => strip_tags($_REQUEST['nombre']),
                    "apellido" => strip_tags($_REQUEST['apellido']),
                    "pais" => strip_tags($_REQUEST['pais']),
                    "lenguaje" =>strip_tags($_REQUEST['lenguaje'])
                );
                $_REQUEST['User_JSON'] = json_encode($arr_user);
                $data = $_REQUEST;
                $nombre = strip_tags($data['nombre'] . ' ' . $data['apellido']);

                $reservaExcursion = $this->_save($data);
                if (!$reservaExcursion->id)
                    $reservaExcursion = ReservaExcursionRepo::create()->oneBy(array('cod' => '"' . $this->in('cod') . '"'));

                //preparando href
                $href = $this->genPathSite('book-page') . '?id=' . $exc->id . '&controller=ReservaExcursion.confirm&cod=' . $reservaExcursion->cod;
                $num = sprintf('%d', $reservaExcursion->id);
                //preparando el mensaje
                $html = "<h2 style='width: 100%;color: #FFF;background-color: #4b8df8; padding: 6px; margin: 0'>";
                $html .= "#$num " . __(CS_L_RESERVANDO) . sprintf(" %s <span style='float:right'><a href='$href' style='color: #CA333E'>%s</a></span>", __($exc->nombre), __(CS_L_CLICKCONFIRM));
                $html .= "<div style='clear: both'></div></h2>";
                $html .= "<div style='width: 100%;background-color: #F5F3F0; padding: 6px; margin: 0'>";
                $html .= "<strong>$nombre</strong> " . __(CS_L_AGRADECIMIENTOS);
                $html .= "</div>";
                $html .= "<hr>";
                $html .= "<div style='width: 100%; text-align: center;'>";
                $html .= sprintf("<span style='color: #CA333E'>%s</span>", __(CS_L_RECORDAR));
                $html .= "</div>";

                $this->sendEmail($data['email'], __(CS_L_SUBJECT), $html);
                /** @var WP_User $user */
                $emails = array();
                foreach (get_users(array("role" => "bookmanager")) as $user) {
                    $emails[] = $user->user_email;
                }
                $html =
                    '<h2>Reserva desde el Sitio contactar de inmediato!</h2><br>' .
                    '<h2>Reserva A <u>' . __($exc->nombre) . '</u>!</h2><br>' .
                    '<b>Nombre:</b> ' . $data['nombre'] . ' ' . $data['apellido'] . '<br>' .
                    '<b>Fecha:</b> ' . $data['fecha'] . ' &nbsp;<b>Email:</b> ' . $data['email'] . '<br>' .
                    '<b>Pa&iacute;s:</b> ' . $data['pais'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Lenguaje:</b> ' . $data['lenguaje'] . '<br>' .
                    '<b>Pax:</b> ' . $data['cantidadPersona'] . ' &nbsp;<b>Direcci&oacute;n:</b> ' . $data['hora'] . '<br><hr>' .
                    $_REQUEST['descripcion'];
//        $this->sendEmail($emails,'R '.$_REQUEST['Excursion_id'].' - '.$_REQUEST['email'],'<b>Contactar rapido con cliente!</b><br>'.$_REQUEST['descripcion']);
                $this->sendEmail($emails, 'R#' . $reservaExcursion->id . ' por ' . $data['nombre'] . ' ' . $data['apellido'] . ' : ' . $_REQUEST['email'], $html);
//        var_dump($_REQUEST);
//        echo($html); die;
//                $this->responseJSON(array(
//                    "item" => $reservaExcursion->toArray(),
//                    "success" => true,
//                ));
//            } else {
//                $this->responseJSON(array(
//                    "item" => '',
//                    "success" => false));
//            }
            $this->redirect(get_page_link($exc->Post_ID) . '?r=1#form_reserva');
        } else {
//            $this->responseJSON(array(
//                "item" => '',
//                "success" => false,));
            $this->redirect(get_page_link($exc->Post_ID) . '?r=1#form_reserva');
        }
    }

    function existNew()
    {
        $old_count = $this->in('count');
        $count = ReservaExcursionRepo::create()->countTipo1_2();
        $exist = $count > $old_count;
        $items = array();
        if ($exist)
            foreach (ReservaExcursionRepo::create()->all(0, $count - $old_count, 'id DESC') as $item) {
                $items[] = $item->toArray();
            }
        $this->responseJSON(array(
            "success" => true,
            "exist" => $exist,
            "items" => $items
        ));
    }

} 
