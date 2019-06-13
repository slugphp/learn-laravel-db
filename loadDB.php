<?php

require __DIR__ . '/vendor/autoload.php';

class DB extends Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        if (!isset(self::$resolvedInstance['db'])) {
            $dbConfig = [
                'driver' => getenv('DB_DRIVER'),
                'host' => getenv('DB_HOST'),
                'port' => getenv('DB_PORT'),
                'database' => getenv('DB_DATABASE'),
                'modes' => [],
                'username' => getenv('DB_USERNAME'),
                'password' => getenv('DB_PASSWORD'),
                'charset' => getenv('DB_CHARSET'),
                'collation' => getenv('DB_COLLATION'),
                'prefix' => getenv('DB_PREFIX'),
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

class Schema extends Illuminate\Support\Facades\Facade
{
    /**
     * Get a schema builder instance for the default connection.
     *
     * @return \Illuminate\Database\Schema\Builder
     */
    protected static function getFacadeAccessor()
    {
        return DB::getSchemaBuilder();
    }
}
