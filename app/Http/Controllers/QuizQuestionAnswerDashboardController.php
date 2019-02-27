<?php

namespace App\Http\Controllers;

use function compact;
use function redirect;
use function request;

/**
 * Class QuizQuestionAnswerDashboardController
 * Created by PhpStorm.
 * User: Faks
 * GitHub: https://github.com/Faks
 *
 * @category PHP
 * @package  Custom_OOP_MVC
 * @author   Oskars Germovs <solumdesignum@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT Licence
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 * Date: 2019.02.26.
 * Time: 15:41
 */
class QuizQuestionAnswerDashboardController extends BaseController
{
    /**
     * Index
     * Quiz Question Answer
     *
     * @param int     $id          Id
     * @param integer $question_id Question Id
     *
     * @return mixed
     */
    public function index($id, $question_id)
    {
        $quiz_question_answers = $this->quizQuestionAnswerModel()
            ->get('*', 'quiz_question_id', '=', $question_id);
        
        return $this->render(
            'pages.dashboard.quiz_question_answer',
            compact('quiz_question_answers')
        );
    }
    
    /**
     * Edit
     * Quiz Question Answer
     *
     * @param integer $id          Id
     * @param integer $question_id Question Id
     *
     * @return mixed
     */
    public function create($id, $question_id)
    {
        return $this->render('pages.create.quiz_question_answer');
    }
    
    /**
     * Edit
     * Quiz Question Answer
     *
     * @param integer $id          Id
     * @param integer $question_id Question Id
     * @param integer $answer_id   Answer Id
     *
     * @return mixed
     */
    public function edit($id, $question_id, $answer_id)
    {
        $quiz_question_answer = $this->quizQuestionAnswerModel()
            ->first('*', 'id', '=', $answer_id, true);
       
        return $this->render(
            'pages.edit.quiz_question_answer',
            compact('quiz_question_answer')
        );
    }
    
    /**
     * Update
     * Quiz Question Answer
     *
     * @param integer $id          Id
     * @param integer $question_id Question Id
     * @param integer $answer_id   Answer Id
     *
     * @return mixed
     */
    public function update($id, $question_id, $answer_id)
    {
        $quiz_question_answer_update = $this->quizQuestionAnswerModel()
            ->update(
                "answer='" . (string)request()->get('answer') . "',
                quiz_id='" . (int)$id . "',
                quiz_question_id='" . (int)$question_id . "',
                status='" . (string)request()->get('status') . "' ",
                'id',
                '=',
                (int)$answer_id
            );
    
        if ($quiz_question_answer_update) {
            session()->forget('errors');
            session()->put('success', false, 'Quiz Question Answer Updated');
            $this->redirect_path
                = '/admin/quiz/' . $id . '/question/' . $question_id . '/answer';
        } else {
            session()->forget('success');
            session()->put('errors', false, 'Quiz Question Answer Failed Update');
            $this->redirect_path = request()->back();
        }
    
        //Redirect
        return redirect($this->redirect_path);
    }
    
    /**
     * Store
     * Quiz Question Answer
     *
     * @return mixed
     */
    public function store()
    {
        //Create Quiz Question Answer
        $quiz_question_store = $this->quizQuestionAnswerModel()->save(
            [
                'answer',
                'quiz_id',
                'quiz_question_id',
                'status',
                'created_at',
                'updated_at'
            ],
            [
                request()->get('answer'),
                (int)request()->segments()[3],
                (int)request()->segments()[5],
                request()->get('status'),
                now(),
                now(),
            ]
        );
    
        if ($quiz_question_store) {
            session()->forget('errors');
            session()->put('success', false, 'Quiz Question Answer Created');
            $this->redirect_path = '/admin/quiz/' . request()->segments()[3] .
                '/question/' . request()->segments()[5] . '/answer';
        } else {
            session()->forget('success');
            session()->put('errors', false, 'Quiz Question Answer Failed Create');
            $this->redirect_path = request()->back();
        }
        
        //Redirect
        return redirect($this->redirect_path);
    }
    
    /**
     * Destroy
     * Quiz Question Answer
     *
     * @param integer $id          Id
     * @param integer $question_id Question Id
     * @param integer $answer_id   Answer Id
     *
     * @return mixed
     */
    public function destroy($id, $question_id, $answer_id)
    {
        $quiz_question_answer_exist_check = $this->quizQuestionAnswerModel()
            ->first('*', 'id', '=', (int)$answer_id);
    
        if ($quiz_question_answer_exist_check) {
            //Delete Quiz Record
            $this->quizQuestionAnswerModel()
                ->destroy('id', '=', (int)$answer_id);
            //Forget Errors Messages
            session()->forget('errors');
            //Set Success Messages
            session()->put('success', false, 'Quiz Question Answer Deleted');
        } else {
            //Forget Success Messages
            session()->forget('success');
            //Set Errors Messages
            session()->put('errors', false, 'Quiz Question Answer Delete Failed');
        }

        //Redirect
        return redirect(
            '/admin/quiz/'. $id . '/question/' . $question_id . '/answer'
        );
    }
}
