<?php
namespace App\Services;

class Module
{
    protected static $config = null;
    protected static $loadedServices = [];
    protected static $loadedModules = [];
    protected static $loaded = [];

    public static function all()
    {
        $config = (self::$config == null) ? self::getFileConfig() : self::$config;
        return $config->modules;
    }

    public static function load($step = 'register')
    {
        $config = (self::$config == null) ? self::getFileConfig() : self::$config;
        $load_modules = $config->load;
        
        if ($step == 'boot')
        {
            $load_modules = self::handleLoadedModule($load_modules);
        }

        $config_path = app_path() . '/Modules';

        // 
            foreach($load_modules as $item)
            {
                /**
                 * Load Config
                 * 
                 * If error, check a path module
                 * or check file module.json must exist
                 */
                $path_config = $config_path . '/' . $item . '/module.json';
                if (!is_file($path_config)) 
                {
                    throw new \App\Exceptions\ModuleException('Config Module "'. $item .'" Not Found in ('. $path_config .')');
                }

                $module_config = self::getFileConfig($path_config);
                $service_provider_file = $config_path . '/' . $item . '/' . $module_config->service . '.php';

                $service_provider ='Modules\\' . $module_config->namespace . '\\' . $module_config->service;
                

                /**
                 * Load Module
                 * 
                 * If error, try to change config
                 * module.json on this module
                 */
                if ($step == 'register')
                {
                    app()->bind($service_provider, function ($app) use ($service_provider, $service_provider_file, $item) {
                        if (!is_file($service_provider_file)) 
                        {
                            throw new \App\Exceptions\ModuleException('Service Module "'. $item .'" Not Found in ('. $service_provider_file .')');
                        }
                        
                        if (!is_readable($service_provider_file)) 
                        {
                            throw new \App\Exceptions\ModuleException('Service Module "'. $item .'" isnt readable! ('. $service_provider_file .')');
                        }

                        @require_once $service_provider_file;
                        return new $service_provider($app);
                    });
                    self::$loadedServices[] = $service_provider;
                    self::$loadedModules[] = $item;
                }

                    
                // run service modules
                $service = app($service_provider);
                if ($step == 'register')
                {
                    $service->register(app());
                } else {
                    $service->boot();
                }
            }

    }

    public static function handleLoadedModule($load_modules)
    {
        $newLoaded = [];
        $provider = self::getLoadedServices();
        foreach ($provider as $index => $item) {

            // config
            $config_path = app_path() . '/Modules';
            $path_config = $config_path . '/' . (self::$loadedModules[$index]) . '/module.json';
            $module_config = self::getFileConfig($path_config);

            // 
            $result = app($item)->checkInstalled();
            if ($result['status'] == 'error')
            {
                self::$loaded[] = (object) [
                    'name' => self::$loadedModules[$index],
                    'service' => $item,
                    'status' => 'error',
                    'error' => $result['error'],
                    'info' => $module_config,
                ];
                unset(self::$loadedServices[$item]);
                unset(self::$loadedModules[$index]);
                
            } else if ($result['status'] == 'ready') {
                self::$loaded[] = (object) [
                    'name' => self::$loadedModules[$index],
                    'service' => $item,
                    'status' => 'ready',
                    'info' => $module_config,
                ];

            } else if ($result['status'] == 'not_ready') {
                self::$loaded[] = (object) [
                    'name' => self::$loadedModules[$index],
                    'service' => $item,
                    'status' => 'not_ready',
                    'setup' => $result['setup'],
                    'info' => $module_config,
                ];
            } else {
                unset(self::$loadedServices[$item]);
                unset(self::$loadedModules[$index]);
            }
        }
        return self::$loadedModules;
    }

    protected static function getFileConfig($path = null)
    {
        if (self::$config != null && $path == null) return self::$config;

        // 
        $config_path = ($path == null) ? app_path() . '/Modules/module.json' : $path;
        $string = file_get_contents( $config_path );
        $result = (object) json_decode($string, true);

        if ($path == null) self::$config = $result;
        return $result;
    }

    public static function getLoadedModules()
    {
        return self::$loadedModules;
    }

    public static function getLoadedServices()
    {
        return self::$loadedServices;
    }

    public static function getLoaded()
    {
        return self::$loaded;
    }

    public static function getAllWithLoaded()
    {
        $new = [];
        $arr = self::getLoaded();
        $module_load = [];
        foreach($arr as $item) { $module_load[] = $item->name; }
        foreach(self::all() as $item)
        {
            // config
            $config_path = app_path() . '/Modules';
            $path_config = $config_path . '/' . ($item) . '/module.json';
            $module_config = self::getFileConfig($path_config);

            // 
            if (!in_array($item, $module_load)) $new[] =  (object) [
                'name' => $item,
                'service' => $module_config->service,
                'status' => 'disable',
                'info' => $module_config,
            ];
        }

        // dd(array_merge($arr, $new));
        return array_merge($arr, $new);
    }

    public static function enable($module)
    {
        $modules = self::all();
        if (in_array($module, $modules))
        {    
            // 
            $config_path = app_path() . '/Modules/module.json';
            $string = file_get_contents( $config_path );
            $result = (object) json_decode($string, true);
            array_push($result->load, $module);

            $result = json_encode((array) $result);
            $result = (array) json_decode($result, true);
            $result = json_encode((array) $result);
            return file_put_contents($config_path, $result);
        }
    }

    public static function disable($module)
    {
        $modules = self::all();
        if (in_array($module, $modules))
        {    
            // 
            $config_path = app_path() . '/Modules/module.json';
            $string = file_get_contents( $config_path );
            $result = json_decode($string, true);
            unset($result['load'][array_search( $module, $result['load'] )]);

            $result = json_encode((array) $result);
            return file_put_contents($config_path, $result);
        }
    }

    public static function path($file)
    {
        return app_path('Modules/' . $file);
    }
}