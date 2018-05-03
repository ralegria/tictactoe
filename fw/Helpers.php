<?php
class Helpers extends App{
    
    /**
    * @param String $notify msg
    */
    public function throwErrorPage($notify){
        $notify['class'] = 'NOTIFY::Error[0]';
        $notify['notify_title'] = 'Oh snap!';
        $notify['icon'] = 'NOTIFY::Error[1]';
        require_once APPDIR::Views . 'error.php'; exit;
    }
    
    /**
    * Construye el link complementando con el dominio y protocolo
    */
    public function linkTo($route, $dir = '', $type = ''){
        $d = (empty($dir)) ? '' : APPDIR::getDir($dir);
        $link = (empty($type)) ? $this->BASEDIR : '';
        $link .= $d . $route;
        return $link;
    }
}