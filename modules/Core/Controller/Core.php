<?php
class Core_Controller_Core {

    protected $template;

    public function __construct() {
        $this->template = new Core_Template_Core;
    }

    public function setTemplate($template) {
        $this->template->setTemplate($template);
    }


    public function setAreaTemplate( $areaName, $areaFile ) {

        $this->template->setAreaFile( $areaName, $areaFile );

    }

    public function getTemplate() {

        return $this->template;

    }

    public function templateExists() {

        return file_exists('views/' . $this->template);

    }

    public function assign($key, $value) {

        $this->template->assign($key, $value);

    }

    /**
     * Render the template
     */
    public function render($echo) {
        $this->template->render(null, $echo);
    }

}