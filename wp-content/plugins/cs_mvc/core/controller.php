<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 10/05/2015
 * Time: 5:45
 */
include_once(ABSPATH . WPINC . '/class-phpmailer.php');

abstract class Controller
{
    const IMG_EXCURSION = 1;
    const IMG_ALOJAMIENTO = 2;
    const IMG_ARTICULO = 3;
    const IMG_PORTADA = 4;
    const IMG_HABITACION = 5;
    const IMG_DESTINO = 6;
    const IMG_SERVICIO = 7;

    /**
     * Ger value of request
     * @param $key
     * @param null $default
     * @return mixed
     */
    static function in($key, $default = null)
    {
        if ($key == null) return array_merge($_REQUEST, self::in_ajax());
        if (isset($_REQUEST[$key]))
            return $_REQUEST[$key];
        else {
            $val = self::in_ajax($key);
            if ($val) return $val;
        }
        return $default;
    }

    static function in_num($key, $default = null)
    {
        return intval(self::in($key, $default));
    }

    static $ajax_vars = null;

    static function in_ajax($key = null, $in_array = true)
    {
        $params = &self::$ajax_vars;
        if (!self::$ajax_vars) {
            //leeyendo del file input
            $raw = '';
            $httpContent = fopen('php://input', 'r');
            while ($kb = fread($httpContent, 1024)) {
                $raw .= $kb;
            }
            fclose($httpContent);
            self::$ajax_vars = json_decode($raw, false, 512, JSON_UNESCAPED_UNICODE);
            $params = &self::$ajax_vars;
        }
        if ($params && $key && isset($params->$key)) {
            $params = $params->$key;
        }
        return $in_array && is_object($params) ? get_object_vars($params) : $params;
    }

    static function genPathSite($page)
    {
        return get_site_url() . '/' . $page;
    }

    static function genPathCA($page, $controller, $action)
    {
        $href = "?page=$page&controller=$controller.$action";
        return $href;
    }

    static function genPathVMInSection($section_name, $page, $view = '', $viewmodel = '', $id = '')
    {
        if ($view) $view = "&view=$view";
        if ($viewmodel) $viewmodel = "&viewmodel=$viewmodel";
        if ($id) $id = "&id=$id";
        $href = "#$section_name?page=$page$view$viewmodel$id";
        return $href;
    }

    static function genPathVM($page, $view = '', $viewmodel = '', $id = '')
    {
        if ($view) $view = "&view=$view";
        if ($viewmodel) $viewmodel = "&viewmodel=$viewmodel";
        if ($id) $id = "&id=$id";
        $href = "?page=$page$view$viewmodel$id";
        return $href;
    }

    function redirectPage($page)
    {
        $this->redirect('?page=' . $page);
    }

    function redirect($path, $code = 302)
    {
        header("Location: $path", false, $code);
        exit;
    }

    function render($view, $data = array())
    {
        View::create()->render($view, $data);
        exit;
    }

    function responseJSON($data)
    {
        header('Content-type: application/json');
        echo wp_json_encode($data, JSON_UNESCAPED_UNICODE);
        die;
    }

    function JSON($data)
    {
        return wp_json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    function uploadFoto($item, $delete_old = true, $key = 'foto')
    {
        if (isset($_FILES[$key]) && $_FILES[$key]['name']) {
            //elimanar foto antigua
            if ($delete_old && $item->$key && file_exists(CS_MVC_PATH . '/foto/' . $item->$key)) {
                $filename = CS_MVC_PATH . '/foto/' . $item->$key;
                unlink($filename);
            }
            //creando foto nueva
            $nname = $item->id . '_' . md5(date('now')) . '_' . $_FILES[$key]['name'];
            $folder = '';
            if($item instanceof ImagenExcursionModel) $folder = "excursiones/";
            if($item instanceof ImagenAlojamientoModel) $folder = "alojamientos/";
            if($item instanceof ImagenPortadaModel) $folder = "portada/";
            if($item instanceof CellPortadaModel) $folder = "articulos/";
            if($item instanceof ImagenHabitacionModel) $folder = "habitaciones/";
            if($item instanceof ServiciosModel) $folder = "servicios/";
            move_uploaded_file($_FILES[$key]['tmp_name'], CS_MVC_PATH . '/foto/'.$folder . $nname);
            $item->$key = $nname;
            $item->save();
        }
    }

    function deleteFoto($item, $key = 'foto')
    {
        $folder = '';
        if($item instanceof ImagenExcursionModel) $folder = "excursiones/";
        if($item instanceof ImagenAlojamientoModel) $folder = "alojamientos/";
        if($item instanceof ImagenPortadaModel) $folder = "portada/";
        if($item instanceof CellPortadaModel) $folder = "articulos/";
        $filename = CS_MVC_PATH . '/foto/' .$folder. $item->$key;
        if (file_exists($filename))
            unlink($filename);
    }

    static function getFoto($tipo, $foto)
    {
        if (preg_match('/^http:|https:/', $foto))
            return $foto;
        switch ($tipo) {
            case 1:
                $coletilla = 'excursiones/';
                break;
            case 2:
                $coletilla = 'alojamientos/';
                break;
            case 3:
                $coletilla = 'articulos/';
                break;
            case 4:
                $coletilla = 'portada/';
                break;
            case 5:
                $coletilla = 'habitaciones/';
                break;
            case 6:
                $coletilla = 'destinos/';
                break;
            case 7:
                $coletilla = 'servicios/';
                break;
            default:
                $coletilla = '';
        }
        return $foto ? CS_MVC_URL_ASSETIC . '/../foto/' . $coletilla . $foto : "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIwAAACMCAYAAACuwEE+AAACdUlEQVR4nO3YMW7iQBiA0dz/KO7cuaGjo6T3EXwFbzUoYVllP4lsYvYVr4ABTcT/eTB527Zth7/19t1/AMciGBLBkAiGRDAkgiERDIlgSARDIhgSwZAIhkQwJIIhEQyJYEgEQyIYEsGQCIZEMCSCIREMiWBIBEMiGBLBkAiGRDAkgiERDIlgSARDIhgSwZAIhkQwJIIhEQyJYEgEQyIYEsGQCIZEMCSCIREMiWBIBEMiGBLBkAiGRDAkgiERDIlgSARDIhgSwZAIhkQwJIIhEQzJSwSzLMs+TdPDtev1uk/TtJ/P59tz67ru0zTdrOv6o/f7SQ4fzPtBPFqf5/m3Ac7zvJ9Op9vw53n+sfv9NIcN5v1VO4Z0/5rz+Xx7zRjgOAEul8u+bdt+uVz2aZr26/V6WxvDPZ1Ot7Wv2O+7P8P/LphxpT76ihgDHkMcA7wf2Hg8BjoiGe8b8XzVfkdz2GDeezTAZVn2ZVk+DPLRAO9PgG37/Gvn2fsdyUsGM4a0ruunA3x0xY9TZpwuX73fkbxkMOPxvWVZPr2nGOvDo3uNZ+53NC8ZzHv3V/y2bR9Oj/tfLeOGdrzv0S+aZ+53NP9lMH/6v8i4YR2nwf0N7LP3O6KXCIZ/RzAkgiERDIlgSARDIhgSwZAIhkQwJIIhEQyJYEgEQyIYEsGQCIZEMCSCIREMiWBIBEMiGBLBkAiGRDAkgiERDIlgSARDIhgSwZAIhkQwJIIhEQyJYEgEQyIYEsGQCIZEMCSCIREMiWBIBEMiGBLBkAiGRDAkgiERDIlgSARDIhgSwZAIhkQwJIIhEQyJYEgEQyIYEsGQCIZEMCSCIfkFXTZF/8aAvbAAAAAASUVORK5CYII=";
    }

    static function sendEmail($to, $subject, $body, $attachments = array(), $from = "admin@cubaporfavor.com", $name = "Cuba, por favor")
    {
        $correo = new PHPMailer(); //Creamos una instancia en lugar usar mail()

        //Usamos el SetFrom para decirle al script quien envia el correo
        $correo->SetFrom($from, $name);

        //Usamos el AddReplyTo para decirle al script a quien tiene que responder el correo
        $correo->AddReplyTo($from, $name);

        //Usamos el AddAddress para agregar un destinatario
//        $correo->AddAddress("yofrenyahima@gmail.com", "Yofren");
        if (is_array($to)) {
            foreach ($to as $email) {
                $correo->AddAddress($email);
            }
        } else $correo->AddAddress($to);

        //Ponemos el asunto del mensaje
        $correo->Subject = $subject;

        /*
         * Si deseamos enviar un correo con formato HTML utilizaremos MsgHTML:
         * $correo->MsgHTML("<strong>Mi Mensaje en HTML</strong>");
         * Si deseamos enviarlo en texto plano, haremos lo siguiente:
         * $correo->IsHTML(false);
         * $correo->Body = "Mi mensaje en Texto Plano";
         */
        $correo->MsgHTML($body);

        //Si deseamos agregar un archivo adjunto utilizamos AddAttachment
        //$correo->AddAttachment("images/phpmailer.gif");

        $errors = array();
        //Enviamos el correo
        if (!$correo->Send()) {
            $errors[] = "Email Hubo un error: " . $correo->ErrorInfo;
        }

        return $errors;
    }

    static function getLanguages()
    {
        global $q_config;
        return $q_config['windows_locale'];
    }

    static function getLenguaje()
    {
        global $q_config;
        return $q_config['language'];
    }

    static $params = array(
        "item_x_page" => 15
    );

    function getParam($key)
    {

        return self::$params[$key];
    }
} 