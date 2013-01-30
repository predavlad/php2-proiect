<?php 

final class Core {
    
    /**
     * Start the application 
     */
    public static function run() {

        /**
         * Get the route
         */
        $route = Core::getRoute();

        /*
         * Instantiate the controller object
         */
        $controller = Core::getController($route['module'] . '/' . $route['controller']);

        $action = $route['action'] . 'Action';

        /*
         * Set the content file for the current route
         */
        $controller->setAreaTemplate('content', Core::getViewFile($route));

        /**
         * call the action of that controller
         * from here on - it's the controllers job
         */
        call_user_func( array($controller, $action) );

    }
    
    
    /**
     * Get the route ( module / controller / action
     */
    public static function getRoute() {

        $uri = getenv('REQUEST_URI');
        $uri = ltrim($uri, '/');

        $folder = Config::get('FOLDER');
        $uri = str_replace($folder, '', $uri);

        $uri = rtrim(ltrim($uri, '/'), '/');

        $parts = explode('/', $uri);

        // get the URL params
        if (count($parts) > 3) {
            $get = array();
            for ($i = 3; $i < count($parts); $i+=2) {
                $get[$parts[$i]] = $parts[$i+1];
            }

            Config::set('get', $get);

        } else if(count($parts) < 3) {

            $parts = Core::getUrl($parts);

        }

        /**
         * This is to prevent errors from using the very strict registry singleton
         */
        if (!Config::exists('get')) {
            Config::set('get', array());
        }

        // get the module / controller / action that need to be called
        $route['module'] = $parts[0];
        $route['controller'] = $parts[1];
        $route['action'] = $parts[2];

        return $route;

    }

    /**
     * Expects an array with the module/controller/action
     * @param $parts
     */
    public static function getUrl($parts) {
        if (!isset($parts[2]) || $parts[0] == '') {
            $parts[2] = 'index';
        }
        if (!isset($parts[1]) || $parts[0] == '') {
            $parts[1] = 'index';
        }
        if (!isset($parts[0]) || $parts[0] == '') {
            $parts[0] = 'product';
        }
        return $parts;
    }

    /**
     * @param $url expects module/controller/action
     * @param $params expects array('key' => 'action', ...)
     */
    public static function formUrl($url, $params = array()) {
        $parts = explode('/', $url);
        $url = Core::getUrl($parts);
        if (is_array($params) && count($params) > 0) {
            foreach ($params as $key => $value) {
                $url .= "/{$key}/{$value}";
            }
        }
        return $url;
    }

    public static function redirect($url, $params = array()) {
        $parts = Core::formUrl($url, $params);
        $url = implode('/', $parts);
        header("Location:{$url}");
        // just in case php redirect fails
        echo "<script type='text/javascript'>window.location.href='{$url}'</script>";
        die; // motherfucker !!!
    }



    /**
     * Check if module is registered and active
     * Always returns true
     * @TODO: everything about this
     */
    public static function isRegisteredModule($moduleName) {
        return true;
    }

    /**
     * Autoload stuff
     * Should check for XSS injection, but I'm waaaay too lazy
     */
    public static function autoload($className) {
        $parts = explode('_', $className);
        $path = 'modules/' . implode('/', $parts) . '.php';
        if (Core::isRegisteredModule($parts[0]) && file_exists($path)) {
            include_once $path;
        }
    }


    /**
     * Autoloader for libraries
     * @param $className
     */
    public static function libAutoload($className) {
        $parts = explode('_', $className);
        $path = 'lib/' . implode('/', $parts) . '.php';
        if (file_exists($path)) {
            include $path;
        }
    }

    /**
     * Model factory
     */
    public static function getModel($class) {

        $className = Core::getClassName($class, 'model');

        return new $className;

    }

    /**
     * Controller factory
     */
    public static function getController($class) {

        $className = Core::getClassName($class, 'controller');
        $templateName = Core::getClassName($class, 'template');

        return new $className($templateName);

    }


    /**
     * @Get the content file for current route
     */
    public static function getViewFile($route) {

        return "{$route['module']}/{$route['controller']}/{$route['action']}.php";

    }

    /**
     * Form the class name from the given class short name
     * for example, if $class = "product/view", and $type = "model", the result will be
     * Product_Model_View
     */
    public static function getClassName($class, $type) {

        $parts = explode('/', $class);
        array_unshift($parts, '');
        $parts[0] = $parts[1];
        $parts[1] = $type;

        foreach ($parts as &$part) {
            $part = ucwords($part);
        }


        $className = implode('_', $parts);

        return $className;
    }


}