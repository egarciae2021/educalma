<?php
class Database
{

  /*
  //Credenciales para la WEB
  private static $dbName = 'educalma' ;
  private static $dbHost = 'mysqleducalma';
	private static $dbUsername = '994896741';
  private static $dbUserPassword = 'HVc$DhzpSweC';
  */

  private static $dbName = 'educalma' ;
  private static $dbHost = '20.226.29.168';
  //private static $dbHost = 'localhost';
	private static $dbUsername = 'root';
  private static $dbUserPassword = '';
// datooooo


	private static $cont  = null;

	public function __construct() {
		die('No esta Permitido Instanciar la Conexion');
	}

	public static function connect()
	{
       if ( null == self::$cont )
       {
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
          $dbh = self::$cont;
          $dbh -> exec("set names utf8");
          $dbh -> exec("SET lc_time_names = 'es_PE'");

        }
        catch(PDOException $e)
        {
          die($e->getMessage());
        }
       }
       return self::$cont;
	}

	public static function disconnect()
	{
		self::$cont = null;
	}
}
?>
