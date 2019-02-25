<?php

use App\Http\Request;

/**
 * Created by PhpStorm.
 * User: Faks
 * GitHub: https://github.com/Faks
 * PHP version 7.x
 *
 * @category PHP
 * @package  Custom_OOP_MVC
 * @author   Oskars Germovs <solumdesignum@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT Licence
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 * Date: 2019.02.19.
 * Time: 9:00
 */

/**
 * Return Server
 *
 * @return mixed
 */
function url()
{
    return $_SERVER;
}

/**
 * Redirect to specified path
 *
 * @param string $url Redirect To
 *
 * @return mixed
 */
function redirect(string $url)
{
    header('Location: ' . $url);
    exit();
}

/**
 * Returns Request Instance
 *
 * @return Request\Request
 */
function request()
{
    return (new App\Http\Request\Request());
}

/**
 * Return Session Instance
 *
 * @return \App\Http\Session\Session
 */
function session()
{
    return (new App\Http\Session\Session());
}

/**
 * Callback helper with single quotes
 *
 * @param string $str Value
 *
 * @return string
 */
function quote($str)
{
    return sprintf("'%s'", $str);
}

/**
 * Date Helper Now
 *
 * @return false|string
 */
function now()
{
    return date('Y-m-d H:i:s');
}

/**
 * Returns Model Count
 *
 * @param $model
 * @return mixed
 */
function modelCount($model)
{
    return array_first($model);
}
