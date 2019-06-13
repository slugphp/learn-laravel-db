<?php

use Illuminate\Database\Schema\Blueprint;

require __DIR__ . '/loadDB.php';

try {
    Schema::create('users', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('age');
        $table->string('name');
        $table->string('company');
        $table->string('email');
        // $table->string('email')->unique();
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    });
} catch (Exception $e) {
    echo $e->getMessage(), PHP_EOL;
}

DB::table('users')->insert(
    ['name' => 'wangwl', 'age' => 18, 'email' => 'aa']
);

DB::table('users')->insert(
    ['name' => 'xuliang', 'age' => 18, 'email' => 'bb']
);

$list = DB::table('users')->get();

$count = DB::table('users')->where('name', 'wangwl')->count();

var_dump($list, $count);
