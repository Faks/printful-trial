<?php

namespace App\Http\Traits;

use app\Http\Models\Quiz;
use App\Http\Models\QuizQuestion;
use app\Http\Models\QuizQuestionAnswer;
use App\Http\Models\User;
use app\Http\Models\UserQuizQuestionsAnswers;
use App\Http\Models\UserQuizSignUp;

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
    
    /**
     * Quiz Model instance
     *
     * @return Quiz
     */
    public function quizModel()
    {
        return Quiz::init();
    }
    
    /**
     * QuizQuestion Model instance
     *
     * @return QuizQuestion
     */
    public function quizQuestionModel()
    {
        return QuizQuestion::init();
    }
    
    /**
     * QuizQuestionAnswer Model instance
     *
     * @return QuizQuestionAnswer
     */
    public function quizQuestionAnswerModel()
    {
        return QuizQuestionAnswer::init();
    }
    
    /**
     * UserQuizQuestionsAnswers Model instance
     *
     * @return UserQuizQuestionsAnswers
     */
    public function userQuizQuestionsAnswersModel()
    {
        return UserQuizQuestionsAnswers::init();
    }
    
    /**
     * UserQuizSignUp Model instance
     *
     * @return UserQuizSignUp
     */
    public function userQuizSignUpModel()
    {
        return UserQuizSignUp::init();
    }
}
