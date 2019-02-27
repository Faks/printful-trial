<?php

namespace App\Http\Controllers;

use app\Http\Repositories\QuizRepository;
use function compact;
use function count;
use function is_array;
use function modelCount;
use function now;
use function request;
use function session;

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
                'quiz_question_answer.quiz_id',
                '=',
                $id,
                "quiz_question.quiz_order='" . $answer_order . "' ",
                "LEFT JOIN quiz_question_answer
                ON quiz_question.id = quiz_question_answer.quiz_question_id"
            );
    
        $next_url_type = null;
        
        if (modelCount($quiz_question[0]) === request()->segments()[4]) {
            $next_url_type = "value='/quiz/". session()->get('quiz_sign_up_id')."/review";
        } else {
            $increment = request()->segments()[4] += 1;
            $next_url_type
                = "value='/quiz/". (integer)request()->segments()[2] . "/take/". $increment . " ";
        }
    
//        dump($next_url_type);
    
        return $this->render(
            'pages.quiz_questions',
            compact(
                'quiz',
                'quiz_question',
                'quiz_question_answer',
                'next_url_type'
            )
        );
    }
    
    /**
     * Store Quiz Step
     *
     * @return mixed
     */
    public function storeAnswer()
    {
        $user_quiz_answer_store = null;
        if (is_array(request()->get('answer'))) {
            foreach (request()->get('answer') as $answer) {
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
                        $answer,
                        session()->get('quiz_sign_up_id'),
                        null,
                        now(),
                        now()
                    ]
                );
            }
        } else {
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
        }
        
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
        $user_quiz = $this->userQuizSignUpModel()
            ->first('*', 'id', '=', (integer)$id_review, true);
        
        $user_quiz_review = $this->userQuizQuestionsAnswersModel()
            ->get(
                '*',
                'user_quiz_sign_up.name',
                '=',
                $user_quiz->name,
                "user_quiz_sign_up.id='$id_review'",
                'LEFT JOIN quiz_question_answer
                    ON quiz_question_answer.id = user_quiz_question_answer.quiz_question_answer_id

                LEFT JOIN user_quiz_sign_up
                ON user_quiz_sign_up.id = user_quiz_question_answer.user_quiz_sign_up_id'
            );
        
        $answer_wrong_builder = [];
        $answer_correct_builder = [];
        $total_questions_model = [];
        foreach ($user_quiz_review as $review) {
            $total_questions_model = (array)$this->quizQuestionModel()
                ->get('count(*)', 'quiz_id', '=', $review->quiz_id);
            
            if ($review->status == 'wrong') {
                $answer_wrong_builder[] = $review->status;
            }
            
            if ($review->status == 'correct') {
                $answer_correct_builder[] = $review->status;
            }
        }
        
        $total_wrong_answers = count($answer_wrong_builder);
        $total_correct_answers = count($answer_correct_builder);
        $total_questions = modelCount((array)modelCount($total_questions_model));
    
        return $this->render(
            'pages.quiz_review',
            compact(
                'user_quiz',
                'total_correct_answers',
                'total_wrong_answers',
                'total_questions'
            )
        );
    }
}
