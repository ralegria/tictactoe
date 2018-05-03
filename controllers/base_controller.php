<?php
class base_controller extends App{
    public $request;#Request params(post, get)
    public $params;#Route params
    public $_helpers;
    
    function __construct($params, $request){
        $this->params = $params;
        $this->request = $request;
        $this->_helpers = new Helpers();
    }
}