<?php

namespace app\Http\Models;

use App\Http\Database\Model;
use App\Http\Helpers\Helpers;

/**
 * Class UserQuizQuestionsAnswers
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
 * Time: 10:42
 */
class UserQuizQuestionsAnswers extends Model
{
    use Helpers;
    
    /**
     * Set Table
     *
     * @var string
     */
    protected $table = "user_quiz_question_answer";
}
