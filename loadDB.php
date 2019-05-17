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
            self::$resolvedInstance['db'] = $capsule->connection();
        }
        return 'db';
    }
}

class Schema extends Facade
{
    /**
     * Get a schema builder instance for a connection.
     *
     * @param  string  $name
     * @return \Illuminate\Database\Schema\Builder
     */
    public static function connection($name)
    {
        return DB::connection($name)->getSchemaBuilder();
    }

    /**
     * Get a schema builder instance for the default connection.
     *
     * @return \Illuminate\Database\Schema\Builder
     */
    protected static function getFacadeAccessor()
    {
        return DB::connection()->getSchemaBuilder();
    }
}
