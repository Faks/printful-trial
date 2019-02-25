<?php

namespace App\Http\Session;

use function session_destroy;

/**
 * Class Session
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
 * Time: 11:32
 */
class Session
{
    /**
     * Returns selected by name
     *
     * @param string $name Value
     *
     * @return mixed
     */
    public function get($name)
    {
        if (isset($_SESSION["$name"])) {
            $value = $_SESSION["$name"];
        } else {
            $value = false;
        }
        return $value;
    }
    
    /**
     * Session Set Value
     *
     * @param string $name Value
     * @param string $value Value
     * @param boolean $array_values Build Array
     *
     * @return mixed
     */
    public function put($name, $value = false, $array_values = false)
    {
        if ($array_values) {
            $value = [$array_values];
        }
        
        return $_SESSION["$name"] = $value;
    }
    
    /**
     * Session all
     *
     * @return array
     */
    public function all()
    {
        return $_SESSION;
    }
    
    /**
     * Session value check exist check
     *
     * @param string $name Value
     *
     * @return bool
     */
    public function has($name)
    {
        if (isset($_SESSION["$name"])) {
            $status = true;
        } else {
            $status = false;
        }
        
        return $status;
    }
    
    /**
     * Destroy All Session
     *
     * @return mixed
     */
    public function flush()
    {
        return session_destroy();
    }
    
    /**
     * Destroy Specified Session Value
     *
     * @param string $name Value
     *
     * @return mixed
     */
    public function forget($name)
    {
        unset($_SESSION[$name]);
    }
}
