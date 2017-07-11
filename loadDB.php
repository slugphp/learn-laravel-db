<?php

require __DIR__ . '/vendor/autoload.php';

class DB extends Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        if (!isset(self::$resolvedInstance['db'])) {
            $dbConfig = [
                // ...
                // your db config
            ];
            $capsule = new Illuminate\Database\Capsule\Manager;
            $capsule->addConnection($dbConfig);
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
            $capsule->connection()->enableQueryLog();    // debug
            self::$resolvedInstance['db'] = $capsule;
        }
        return 'db';
    }
}
