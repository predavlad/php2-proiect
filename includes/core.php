<?php 

final class Core {
    
    /**
     * Start the application 
     */
    public static function run() {

        $route = Core::getRoute();

        // get the controller object
        $controller = Core::getController($route['module'] . '/' . $route['controller']);

        $action = $route['action'] . 'Action';

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

            if (!isset($parts[2])) { $parts[2] = 'index'; }
            if (!isset($parts[1])) { $parts[1] = 'index'; }
            if (!isset($parts[0])) { $parts[0] = 'index'; }

        }

        // get the module / controller / action that need to be called
        $route['module'] = $parts[0];
        $route['controller'] = $parts[1];
        $route['action'] = $parts[2];

        return $route;

    }


    /**
     * Check if module is registered and active
     * @TODO
     */
    public static function isRegisteredModule($moduleName) {
        return true;
    }

    /**
     * Autoload stuff
     */
    public static function autoload($className) {
        $parts = explode('_', $className);

        if (Core::isRegisteredModule($parts[0])) {
            $path = 'modules/' . implode('/', $parts) . '.php';
            echo $path;
            include ($path);
        } else {
            throw new Exception('Trying to access an unregistered/inexistent module. STOP IT !!!');
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

        return new $className;

    }


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
?>