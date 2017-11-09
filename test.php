<?php

use Illuminate\Database\Schema\Blueprint;

require __DIR__ . '/loadDB.php';

try {
    Schema::create('users', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('age');
        $table->string('name');
        $table->string('company');
        $table->string('email')->unique();
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    });
} catch (Exception $e) {
    echo $e->getMessage(), PHP_EOL;
}

DB::table('company')->insert(
    ['name' => 'wangwl', 'age' => 18]
);

DB::table('company')->insert(
    ['name' => 'xuliang', 'age' => 18]
);

$list = DB::table('company')->get();

$count = DB::table('company')->where('name', 'wangwl')->count();

var_dump($list, $count);
