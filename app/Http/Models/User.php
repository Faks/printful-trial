<?php

namespace App\Http\Models;

use App\Http\Database\Model;
use App\Http\Helpers\Helpers;
use const MAIL_FROM;
use const MAIL_TO;

/**
 * Class User
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
 * Time: 7:40
 */
class User extends Model
{
    use Helpers;
    
    /**
     * Set Table
     *
     * @var string
     */
    protected $table = "users";
    
    /**
     * After Registration
     * Send an email to Member
     *
     * @return mixed
     */
    public function notify()
    {
        $mail = mail(MAIL_FROM, MAIL_TO, 'Member Has been registered');
        return $mail;
    }
}
