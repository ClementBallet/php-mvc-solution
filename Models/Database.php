<?php

namespace App\Models;

// On appelle les classes relatives à PDO à l'aide du namespace du langage PHP : \
use \PDO;
use \PDOException;
use \PDOStatement;

/**
 * Classe de relation avec la base de données (connexion via PDO + requêtes)
 */
class Database
{
    public static string $host;
    public static string $user;
    public static string $pass;
    public static string $dbName;
    private static ?PDO $connexion = NULL; // Le "?" devant le typage dit que la variable est bien de type PDO mais qu'elle peut être initialisée à null
    private static false|PDOStatement $request; // On peut dire qu'une variable peut avoir plusieurs types avec le pipe |

    /**
     * Connexion à la base de données à l'aide de PDO
     * @return PDO|PDOException
     */
    public static function connect(): PDO|PDOException
    {
        try
        {
            // Condition pour savoir si PDO a déjà été instancié
            // Cela permet de ne pas refaire de connexion à la base de donnée si elle a déjà été faite
            if (is_null(self::$connexion))
            {
                // Initialisation des variables nécessaires à PDO pour la connexion à la BDD
                $host = self::$host;
                $dbName = self::$dbName;
                $user = self::$user;
                $pass = self::$pass;

                $path = "mysql:host=$host;dbname=$dbName;charset=utf8";
                // Instanciation de PDO pour la connexion à la BDD
                $pdo = new PDO($path, $user, $pass);
                // Prise en compte des éventuelles erreurs renvoyées par la BDD
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // La variable statique $connexion est maintenant une instance de PDO
                self::$connexion = $pdo;
            }
            return self::$connexion;
        }
            // On "attrape" les erreurs renvoyées par la BDD. Ex. : connexion non établie, requête qui se passe mal...
        catch (PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * Requête préparée en 3 étapes :
     * - on prépare l'exécution en passant la requête SQL en paramètre
     * - on exécute la requête en lui passant un tableau avec d'éventuels paramètres (Ex: id, string...)
     * - on renvoie le nombre de lignes en BDD ramenées ou affectées par la requête
     * @param string $query La requête SQL
     * @param array $array Les valeurs associées aux variables SQL (? ou :id par exemple)
     * @return int Renvoie le nombre de lignes en BDD ramenées ou affectées par la requête
     */
    public static function prepReq(string $query, array $array = []): int
    {
        self::$request = self::connect()->prepare($query);
        self::$request->execute($array);
        return self::$request->rowCount();
    }

    /**
     * Récupère les données de la requête
     * @return bool|array Renvoie un tableau associatif contenant toutes les lignes du jeu de résultats ou false si une erreur est survenue
     */
    public static function fetchData(): bool|array
    {
        return self::$request->fetchAll(PDO::FETCH_ASSOC);
    }
}