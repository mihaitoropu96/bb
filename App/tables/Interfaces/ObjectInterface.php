<?php
    /**
     * Created by PhpStorm.
     * User: torop
     * Date: 9/23/2019
     * Time: 10:17 PM
     */

    namespace App\tables\Interfaces;


    interface ObjectInterface
    {
        public function find($id);
        public function findAll();
        public function findBy(array $criteria, ?string $orderBy = null, ?int $limit = null, ?int $offset);
        public function findOneBy(array $criteria);
        public function getClassName();
    }