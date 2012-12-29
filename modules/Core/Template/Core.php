<?php
class Core_Template_Core {
    protected $template;
    protected $areas = array();
    protected $data = array();


    public function __construct($template = '2col') {

        $template = Config::get($template);

        $this->template = $template['main'];
        $this->areas = $template['areas'];

    }

    public function setTemplate( $template ) {

        $this->template = $template;

    }

    public function getTemplate() {
        return $this->template;
    }

    public function assign($key, $value = '') {

        $this->data[$key] = $value;

    }


    public function __get($key) {

        return $this->data[$key];

    }


    public function setAreaFile($areaName, $areaFile) {
        $this->areas[$areaName] = $areaFile;
    }

    public function getAreaFile($areaName) {
        return $this->areas[$areaName];
    }

    protected function getTemplateFile($area = null) {

        if (!is_null($area)) {
            return "views/{$this->getAreaFile($area)}";
        } else {
            return "views/{$this->template}.php";
        }


    }

    public function render($template = null, $echo = false) {

        ob_start();
        include $this->getTemplateFile($template);
        $return = ob_get_clean();


        if ($echo) {

            echo $return;
        } else {
            return $return;
        }



    }

    /**
     * And in here we will have the methods that will be used in all views. Or most views
     */
    public function getProducts($filter = array()) {
        $select = DB::table('produse');
        $products = $select->fetchAll();

//        var_dump($products);

        if (!empty($filter)) {
            /**
             * stuff to do when we filter the products
             */
        }



    }

}