<?php

require __DIR__ . '/loadDB.php';

$createSql = <<<EOF
    CREATE TABLE TT_COMPANY
    (
        ID INTEGER AUTO_INCREMENT,
        NAME TEXT NOT NULL,
        AGE INT NOT NULL,
        ADDRESS CHAR(50),
        SALARY REAL
    );
EOF;

try {
    DB::connection()->statement($createSql);
} catch (Exception $e) {
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
