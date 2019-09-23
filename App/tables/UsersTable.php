<?php
    /**
     * Created by PhpStorm.
     * User: torop
     * Date: 9/22/2019
     * Time: 10:40 PM
     */

    namespace App\tables;



    use App\Libraries\Database;
    use App\Models\User;

    class UsersTable
    {

        private $db;

        public function __construct()
        {
            $this->db = new Database();
        }


        // Login User
        public function login($email, $password) {
            $this->db->query('SELECT * FROM user WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            $hashed_password = $row->password;
            if (password_verify($password, $hashed_password)) {
                return $row;
            } else {
                return false;
            }
        }

        // Register User
        public function register($data)
        {
            $this->db->query('INSERT INTO user (name, email, password) VALUES  (:name, :email, $password)');
            // Bind values
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);

            // Execute
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Find user by email
        public function findUserByEmail($email) {
            $this->db->query('SELECT * FROM user WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            // Check row
            if ($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function getUserById($id) {
            $this->db->query('SELECT * FROM user WHERE id = :id');
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            if ($row) {
                $user = new User();
                $user->setName($row->name);
                $user->setEmail($row->email);
                $user->setCreatedAt($row->created_at);

                return $user;
            } else {
                throw new \Exception('Post dosent have user');
            }
        }

        public function __toString(): string
        {
            return 'string';
        }
    }