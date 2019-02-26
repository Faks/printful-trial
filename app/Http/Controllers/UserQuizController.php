<?php

namespace App\Http\Controllers;

use App\Http\Database\Connection;
use app\Http\Repositories\QuizRepository;
use function array_first;
use function compact;
use function dd;
use function dump;
use function modelCount;
use function now;
use function request;

/**
 * Class UserQuizController
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
 * Time: 9:34
 */
class UserQuizController extends BaseController
{
    /**
     * Register Quiz Render View
     *
     * @return mixed
     */
    public function index()
    {
        return $this->render('pages.quiz_begin');
    }
    
    /**
     * Run Quiz Render View
     *
     * @param int $id           Question Id
     * @param int $answer_order Question Order Id
     *
     * @return mixed
     */
    public function take($id, $answer_order)
    {
        $quiz = $this->quizModel()
            ->first('*', 'id', '=', $id, true);
        
        $quiz_question = $this->quizQuestionModel()
            ->get('count(*)', 'quiz_id', '=', $id);
        
        $quiz_question_answer = $this->quizQuestionModel()
            ->get(
                '*',
                'quiz_question_answer.quiz_id', '=', $id,
                "quiz_question.quiz_order='" . $answer_order . "' ",
                "LEFT JOIN quiz_question_answer
                ON quiz_question.id = quiz_question_answer.quiz_question_id"
            );
        
        return $this->render(
            'pages.quiz_questions',
            compact(
                'quiz', 'quiz_question', 'quiz_question_answer'
            )
        );
    }
    
    public function storeAnswer()
    {
        $user_quiz_answer_store = $this->userQuizQuestionsAnswersModel()->save(
            [
                'quiz_id',
                'quiz_question_id',
                'quiz_question_answer_id',
                'user_quiz_sign_up_id',
                'user_quiz_question_answer',
                'created_at',
                'updated_at'
            ],
            [
                request()->segments()[2],
                request()->get('quiz_question_id'),
                request()->get('answer'),
                session()->get('quiz_sign_up_id'),
                null,
                now(),
                now()
            ]
        );
    
        if ($user_quiz_answer_store) {
            $this->redirect_path = request()->get('next_url');
        } else {
            $this->redirect_path = request()->back();
        }
    
        //Redirect
        return redirect($this->redirect_path);
    }
    
    /**
     * Process Sign-up on quiz
     *
     * @param int $id Id
     *
     * @return mixed
     * @throws \Exception
     */
    public function store($id)
    {
        /**
         * Init User Repository
         * Dependency Injection
         */
        $quiz_repository = (new QuizRepository(request(), (int)$id));
        //handle all data to storage
        $quiz_sign_up = $quiz_repository->store();
        
        if ($quiz_sign_up) {
            session()->forget('errors');
            $this->redirect_path = '/quiz/' . $id . '/take/1';
        } else {
            session()->put('errors', false, 'Quiz Failed Create');
            $this->redirect_path = request()->back();
        }
        
        //Redirect
        return redirect($this->redirect_path);
    }
    
    /**
     * Review Quiz Render View
     *
     * @param int $id_review Review Id
     *
     * @return mixed
     */
    public function review($id_review)
    {
        return $this->render('pages.quiz_review');
    }
}
