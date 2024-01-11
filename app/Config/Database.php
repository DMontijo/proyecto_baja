<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
	/**
	 * The directory that holds the Migrations
	 * and Seeds directories.
	 *
	 * @var string
	 */
	public $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

	/**
	 * Lets you choose which connection group to
	 * use if no other is specified.
	 *
	 * @var string
	 */
	public $defaultGroup = 'default';

	/**
	 * The default database connection.
	 * Read and write
	 * @var array
	 */

	public $default = [
		'DSN'      => '',
		'hostname' => 'database-video-denuncia-baja-california-instance-1.cenwfxggsegs.us-east-1.rds.amazonaws.com',
		'username' => 'fgebc_admin',
		'password' => 'fgebc_dba0wner',
		'database' => 'cdtec',
		'DBDriver' => 'MySQLi',
		'DBPrefix' => '',
		'pConnect' => false,
		'DBDebug'  => (ENVIRONMENT !== 'production'),
		'charset'  => 'utf8',
		'DBCollat' => 'utf8_general_ci',
		'swapPre'  => '',
		'encrypt'  => false,
		'compress' => false,
		'strictOn' => false,
		'failover' => [],
		'port'     => 3306,
	];

	/**
	 * The default database connection.
	 * Only read
	 * @var array
	 */

	public $default_read = [
		'DSN'      => '',
		'hostname' => 'database-video-denuncia-baja-california-instance-1-us-east-1b.cenwfxggsegs.us-east-1.rds.amazonaws.com',
		'username' => 'fgebc_admin',
		'password' => 'fgebc_dba0wner',
		'database' => 'cdtec',
		'DBDriver' => 'MySQLi',
		'DBPrefix' => '',
		'pConnect' => false,
		'DBDebug'  => (ENVIRONMENT !== 'production'),
		'charset'  => 'utf8',
		'DBCollat' => 'utf8_general_ci',
		'swapPre'  => '',
		'encrypt'  => false,
		'compress' => false,
		'strictOn' => false,
		'failover' => [],
		'port'     => 3306,
	];

	/**
	 * This database connection is used when
	 * enviroment is development
	 * Read and write
	 * @var array
	 */

	public $development = [
		'DSN'      => '',
		'hostname' => 'database-video-denuncia-baja-california-dev-cluster.cluster-cenwfxggsegs.us-east-1.rds.amazonaws.com',
		'username' => 'fgebc_admin',
		'password' => 'fgebc_dba0wner',
		'database' => 'cdtec_testing',
		'DBDriver' => 'MySQLi',
		'DBPrefix' => '',
		'pConnect' => false,
		'DBDebug'  => (ENVIRONMENT !== 'production'),
		'charset'  => 'utf8',
		'DBCollat' => 'utf8_general_ci',
		'swapPre'  => '',
		'encrypt'  => false,
		'compress' => false,
		'strictOn' => false,
		'failover' => [],
		'port'     => 3306,
	];

	/**
	 * This database connection is used when
	 * enviroment is development
	 * Only read
	 * @var array
	 */

	public $development_read = [
		'DSN'      => '',
		'hostname' => 'database-video-denuncia-baja-california-dev-cluster.cluster-ro-cenwfxggsegs.us-east-1.rds.amazonaws.com',
		'username' => 'fgebc_admin',
		'password' => 'fgebc_dba0wner',
		'database' => 'cdtec_testing',
		'DBDriver' => 'MySQLi',
		'DBPrefix' => '',
		'pConnect' => false,
		'DBDebug'  => (ENVIRONMENT !== 'production'),
		'charset'  => 'utf8',
		'DBCollat' => 'utf8_general_ci',
		'swapPre'  => '',
		'encrypt'  => false,
		'compress' => false,
		'strictOn' => false,
		'failover' => [],
		'port'     => 3306,
	];

	/**
	 * This database connection is used for videocall registers
	 * Only read
	 * @var array
	 */

	public $videocall_read = [
		'DSN'      => '',
		'hostname' => 'database-video-denuncia-baja-california-instance-1-us-east-1b.cenwfxggsegs.us-east-1.rds.amazonaws.com',
		'username' => 'fgebc_admin',
		'password' => 'fgebc_dba0wner',
		'database' => 'video_service',
		'DBDriver' => 'MySQLi',
		'DBPrefix' => '',
		'pConnect' => false,
		'DBDebug'  => (ENVIRONMENT !== 'production'),
		'charset'  => 'utf8',
		'DBCollat' => 'utf8_general_ci',
		'swapPre'  => '',
		'encrypt'  => false,
		'compress' => false,
		'strictOn' => false,
		'failover' => [],
		'port'     => 3306,
	];

	/**
	 * This database connection is used when generate reports
	 * Only read
	 * @var array
	 */

	public $reporte_read = [
		'DSN'      => '',
		'hostname' => 'database-video-denuncia-baja-california-instance-3-us-east-1a.cenwfxggsegs.us-east-1.rds.amazonaws.com',
		'username' => 'fgebc_admin',
		'password' => 'fgebc_dba0wner',
		'database' => 'cdtec',
		'DBDriver' => 'MySQLi',
		'DBPrefix' => '',
		'pConnect' => false,
		'DBDebug'  => (ENVIRONMENT !== 'production'),
		'charset'  => 'utf8',
		'DBCollat' => 'utf8_general_ci',
		'swapPre'  => '',
		'encrypt'  => false,
		'compress' => false,
		'strictOn' => false,
		'failover' => [],
		'port'     => 3306,
	];




	/**
	 * This database connection is used when
	 * running PHPUnit database tests.
	 *
	 * @var array
	 */
	public $tests = [
		'DSN'      => '',
		'hostname' => '127.0.0.1',
		'username' => '',
		'password' => '',
		'database' => ':memory:',
		'DBDriver' => 'SQLite3',
		'DBPrefix' => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
		'pConnect' => false,
		'DBDebug'  => (ENVIRONMENT !== 'production'),
		'charset'  => 'utf8',
		'DBCollat' => 'utf8_general_ci',
		'swapPre'  => '',
		'encrypt'  => false,
		'compress' => false,
		'strictOn' => false,
		'failover' => [],
		'port'     => 3306,
	];


	//--------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();

		// Ensure that we always set the database group to 'tests' if
		// we are currently running an automated test suite, so that
		// we don't overwrite live data on accident.
		if (ENVIRONMENT === 'testing') {
			$this->defaultGroup = 'tests';
		}

		if (ENVIRONMENT === 'development') {
			$this->defaultGroup = 'development';
		}
	}

	//--------------------------------------------------------------------

}
