<?php
/**
 * Created by PhpStorm.
 * User: TheLetch
 * Date: 21/12/2016
 * Time: 20:31
 */

use Phalcon\Config;

return new Config(
    [
        'database'=>[
            'adapter'=>'Mysql',
            'host'=>'localhost',
            'username'=>'yannick',
            'password'=>'admin',
            'dbname'=>'project_bd',
        ],

        'application'=>[
            'controllersDirs'=> __DIR__ . '/../../backend/controllers/',
            'modelsDirs'=> __DIR__ . '/../../backend/models/',
            'viewsDir'       => __DIR__ . '/../../backend/views/',
            'languagesDir'   => __DIR__ . '/../../app/languages/',
            'libraryDir'     => __DIR__ . '/../../app/library/',
            'cacheDir'       => __DIR__ . '/../../app/cache/',
            'baseUri'=>'/TuSofk/',
        ]
    ]
);