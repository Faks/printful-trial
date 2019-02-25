<?php

namespace App\Http\Traits;

use App\Http\Models\User;

/**
 * Class ModelsTrait
 * Created by PhpStorm.
 * User: Faks
 * GitHub: https://github.com/Faks
 *
 * @category PHP
 * @package  Custom_OOP_MVC
 * @author   Oskars Germovs <solumdesignum@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT Licence
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 * Date: 2019.02.25.
 * Time: 07:40
 */
trait ModelsTrait
{
    /**
     * User Model instance
     *
     * @return User
     */
    public function userModel()
    {
        return User::init();
    }
}