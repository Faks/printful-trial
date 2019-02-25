<?php
/**
 * Created by PhpStorm.
 * User: Faks
 * GitHub: https://github.com/Faks
 * PHP version 7.2 - 7.3
 *
 * @category PHP
 * @package  Custom_OOP_MVC
 * @author   Oskars Germovs <solumdesignum@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT Licence
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 * Date: 2019.02.19.
 * Time: 9:19
 */

/**
 * Init Session
 **/
session_start();

use Pecee\SimpleRouter\SimpleRouter;

/**
 * Autoload Registered Files
 **/
require_once '../vendor/autoload.php';

/**
 * Global Debug Mode
 */
if (APP_DEBUG) {
    /**
     * Request Debug All
     */
    if (APP_DEBUG_REQUEST) {
        dump(request()->all());
    }
    
    /**
     * Session Debug All
     */
    if (APP_DEBUG_SESSION) {
        dump(session()->all());
    }
    
    /**
     * Session Purge
     */
    if (APP_DEBUG_SESSION_PURGE) {
        session()->flush();
    }
}

/**
 * Load Routes
 */
SimpleRouter::start();
