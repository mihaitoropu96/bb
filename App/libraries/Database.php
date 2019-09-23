<?php

/*
 * PDO Database Class
 * Connect to database
 * Create prepared statements
 * Bind values
 * Return rows and results
 */
namespace App\Libraries;

use App\Config\Config;
use PDO;
use PDOException;

class Database
{

	private $host = Config::DB_HOST;

	private $user = Config::DB_USER;

	private $pass = Config::DB_PASS;

	private $dbname = Config::DB_NAME;

	private $dbhandler;

	private $stmt;

	private $error;


	public function __construct()
	{
		// Set DSN
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
		// TO DO
		$options = array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		);

		// Create PDO instance
		try {
			$this->dbhandler = new PDO($dsn, $this->user, $this->pass, $options);
		} catch (PDOException $exception) {
			$this->error = $exception->getMessage();
			echo $this->error;
		}
	}

	// Preapare statement with query

	public function query($sql)
	{
		$this->stmt = $this->dbhandler->prepare($sql);
	}

	// Bind values
	public function bind($param, $value, $type = null)
	{
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}

		$this->stmt->bindValue($param, $value, $type);
	}

	// Execute the prepared statement

	public function execute()
	{
		// TO DO
		return $this->stmt->execute();
	}

	// Get result set as array of objects
	public function resultSet()
	{
		// TO DO
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_OBJ);
	}

	// Get single record as object
	public function single()
	{
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_OBJ);
	}

	// Get row count
	public function rowCount()
	{
		return $this->stmt->rowCount();
	}
}