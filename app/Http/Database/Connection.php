<?php

namespace App\Http\Database;

use Exception;
use mysqli;
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
     * @var mysqli $connection Connection
     */
    protected $connection;
    
    /**
     * Connection constructor.
     */
    public function __construct()
    {
        $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        
        if (mysqli_connect_errno() > 0) {
            throw new Exception("Database Can't Connect!");
        }
    }
}
