<?php

namespace App\Http\Middlewares;

use Pecee\Http\Middleware\BaseCsrfVerifier;

/**
 * Class CsrfVerifier
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
 * Time: 14:40
 */
class CsrfVerifier extends BaseCsrfVerifier
{
    /**
     * CSRF validation will be ignored on the following urls.
     */
    protected $except = ['/api/*'];
}
