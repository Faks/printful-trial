<?php

namespace App\Http\Controllers;

use function compact;

/**
 * Class HomeController
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
 * Time: 7:37
 */
class HomeController extends BaseController
{
    /**
     * Render Quiz Listing View
     *
     * @return mixed
     */
    public function index()
    {
        //Quiz Model Instance
        $quizes = $this->quizModel()->get('*');
        //Quiz Question Models Instance
        $quiz_questions = $this->quizQuestionModel();
    
        return $this->render(
            'pages.quiz_dashboard',
            compact('quizes', 'quiz_questions')
        );
    }
}
