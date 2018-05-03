<?php
class index_controller extends base_controller{

    public function index(){
        require_once $this->_helpers->linkTo('index.php', 'Views', 'require');
    }
	
}