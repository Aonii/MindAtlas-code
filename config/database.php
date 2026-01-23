<?php
declare(strict_types=1);

class Database
{
  private static ?PDO $connection = null;

  /**
   * Get PDO database connection
   * 
   * @return PDO
   * @throws Exception
   */
  public static function getConnection(): PDO
  {
    if (self::$connection === null) {
        self::$connection = self::createConnection();
    }

    return self::$connection;
  }

  /**
   * Create a new PDO connection
   * 
   * @return PDO
   * @throws Exception
   */
  private static function createConnection(): PDO
  {
    $host = 'localhost';
    $dbName = 'course_report';
    $username = 'root';
    $password = '326326Fan';

    $dsn = sprintf(
      'mysql:host=%s;dbname=%s;charset=utf8mb4',
      $host,
      $dbName
    );

    try {
      $pdo = new PDO($dsn, $username, $password, [
          PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES   => false,
      ]);

      return $pdo;
    } catch (PDOException $e) {
      error_log($e->getMessage());
      throw new Exception('Database connection failed.');
    }
  }
}