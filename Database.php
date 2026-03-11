<?php
namespace App\Config;

require_once __DIR__ . '/bootstrap.php';

use PDO;
use Exception;
class Database
{
    private static ?PDO $pdo = null;

    // Constructeur privé : empêche toute instanciation externe
    private function __construct()
    {
    }

    // Empêche le clonage de l'instance
    private function __clone()
    {
    }

    // Empêche la désérialisation
    public function __wakeup()
    {
    }

    // Méthode statique pour récupérer l'instance PDO
    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            try {
                $server = '127.0.0.1';
                $db = 'PHP_Rugby';
                $login = 'root';
                $mdp = '';

                self::$pdo = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $login, $mdp);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                die('Erreur de connexion : ' . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}
?>