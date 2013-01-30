<?php

class Admin_Controller_Product extends Core_Controller_Core {

    public function __construct($templateName) {
        parent::__construct($templateName);

        // there has to be a more elegant way of doing this
        // will figure it out later (if ever)
        $this->setTemplate('1col-main');
        $this->setAreaTemplate('footer', '');
        $this->setAreaTemplate('left', '');
        $this->setAreaTemplate('header', 'admin/header.php');
    }

    /**
     * Show product list
     */
    public function indexAction() {
        $model = Core::getModel('admin/product');
        $products = $model->getProducts();
        $this->assign('products', $products);
        $this->render(true);
    }

    public function editAction() {
        var_dump(Config::get('get'));
        $this->render(true);
    }

}