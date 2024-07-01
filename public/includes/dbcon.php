<?php
$loader = require_once __DIR__ . '/../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();
$dotenv->required([
    "DATABASE_HOST",
    "DATABASE_USER",
    "DATABASE_PASS",
    "DATABASE_NAME",
])->notEmpty();

class DBCon {
	private $con;
	private $host;
	private $user;
	private $pass;
	private $name;

	public function __construct() {
		$this->host = $_ENV['DATABASE_HOST'];
        $this->user = $_ENV['DATABASE_USER'];
        $this->pass = $_ENV['DATABASE_PASS'];
        $this->name = $_ENV['DATABASE_NAME'];

		$this->con = mysqli_connect(
			$this->host,
			$this->user,
			$this->pass,
			$this->name
		);

		if (mysqli_connect_errno()) {
			exit('Failed to connect to MySQL: ' . mysqli_connect_error());
		}

	}

	public function getCon() {
		return $this->con;
	}
}
