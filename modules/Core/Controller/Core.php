<?php
class Core_Controller_Core {

    protected $template;
    protected $updateLayout = 'core.xml';

    public function setTemplate($template) {
        if ($this->templateExists($template)) {
            $this->template = $template;
        }
    }

    public function getTemplate() {
        return $this->template;
    }

    public function templateExists($template) {

        $blockName = Core::getClassName($template, 'template');

        var_dump($blockName);

    }

    public function loadLayout() {

        $coreXml = Config::get('CORE_XML');
        $xml = new SimpleXMLElement(file_get_contents($coreXml));

        print_r($xml);
    }

}