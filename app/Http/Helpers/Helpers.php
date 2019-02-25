<?php

namespace App\Http\Helpers;

/**
 * Traits Helpers
 * Created by PhpStorm.
 * User: Faks
 * GitHub: https://github.com/Faks *
 *
 * @category PHP
 * @package  Custom_OOP_MVC
 * @author   Oskars Germovs <solumdesignum@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT Licence
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 * Date: 2019.02.19.
 * Time: 12:12
 */
trait Helpers
{
    /**
     * Init Chaining
     *
     * @return self
     */
    public static function init()
    {
        return new self();
    }
}
