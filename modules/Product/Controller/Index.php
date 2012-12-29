<?php

class Product_Controller_Index extends Core_Controller_Core {

    public function indexAction() {
        /**
         * get the $_GET request
         */
        $params = Config::get('get');

        $this->assign('params', $params);
        $this->render(true);
    }

}