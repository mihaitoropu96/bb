<?php
    /**
     * Created by PhpStorm.
     * User: torop
     * Date: 9/23/2019
     * Time: 7:51 PM
     */

    namespace App\config;


    class appconfig
    {
        public const INTERNET = 'Internet';
        public const TELEVISION = 'Television';

        public const SERVICES = [
            self::INTERNET => 20,
            self::TELEVISION => 60
        ];
    }