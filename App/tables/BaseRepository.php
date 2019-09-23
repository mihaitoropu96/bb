<?php
    /**
     * Created by PhpStorm.
     * User: torop
     * Date: 9/23/2019
     * Time: 10:20 PM
     */

    namespace App\tables;


    use App\Libraries\Database;
    use App\tables\Interfaces\ObjectInterface;

    class BaseRepository implements ObjectInterface
    {
        private $modelClass;

        public function __construct($modelClass, $db)
        {
            $this->modelClass = $modelClass;
            /** @var Database  db */
            $this->db = $db;
        }

        public function find($id)
        {
            $sql = 'SELECT * FROM %s;';

            $this->db->query(sprintf($sql, lcfirst(self::getClassName())));

            return $this->db->resultSet();
        }

        public function findAll()
        {
            // TODO: Implement findAll() method.
        }

        public function findBy(array $criteria, ?string $orderBy = null, ?int $limit = null, ?int $offset)
        {
            // TODO: Implement findBy() method.
        }

        public function findOneBy(array $criteria)
        {
            // TODO: Implement findOneBy() method.
        }

        public function getClassName()
        {
            $exp = explode('\\', $this->modelClass);
            return end($exp);
        }
    }