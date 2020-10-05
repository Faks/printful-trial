<?php

namespace App\Http\Database;

use PDO;
use PDOException;

use const DB_HOST;
use const DB_NAME;
use const DB_PASSWORD;
use const DB_USERNAME;

/**
 * Class Connection
 * Created by PhpStorm.
 * User: Faks
 * GitHub: https://github.com/Faks
 *
 * @category PHP
 * @package  Custom_OOP_MVC
 * @author   Oskars Germovs <solumdesignum@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT Licence
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 * Date: 2019.02.19.
 * Time: 10:21
 */
class Connection
{
    /**
     * Init MySQL Connection
     *
     * @var PDO $connection Connection
     */
    protected $connection;

    /**
     * Connection constructor.
     */
    public function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Error handling
        } catch (PDOException $e) {
            die('Failed to connect to database: ' . $e->getMessage());
        }
    }
}
