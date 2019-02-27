<?php

namespace App\Http\Controllers;

use function compact;
use function redirect;
use function request;

/**
 * Class QuizQuestionDashboardController
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
class QuizQuestionDashboardController extends BaseController
{
    /**
     * Index
     * Quiz Question
     *
     * @param int $id Id
     *
     * @return mixed
     */
    public function index($id)
    {
        $quiz_questions = $this->quizQuestionModel()
            ->get('*', 'quiz_id', '=', $id);
        
        return $this->render(
            'pages.dashboard.quiz_question',
            compact('quiz_questions')
        );
    }
    
    /**
     * Create
     * Quiz Question
     *
     * @param integer $id Id
     *
     * @return mixed
     */
    public function create($id)
    {
        return $this->render('pages.create.quiz_question');
    }
    
    /**
     * Edit
     * Quiz Question
     *
     * @param integer $id      Id
     * @param integer $quiz_id Quiz Id
     *
     * @return mixed
     */
    public function edit($id, $quiz_id)
    {
        $quiz_questions = $this->quizQuestionModel()
            ->first('*', 'id', '=', $quiz_id, true);
        
        return $this->render(
            'pages.edit.quiz_question',
            compact('quiz_questions')
        );
    }
    
    /**
     * Update
     * Quiz Question
     *
     * @param integer $id      Id
     * @param integer $quiz_id Quiz Id
     *
     * @return mixed
     */
    public function update($id, $quiz_id)
    {
        $quiz_question_update = $this->quizQuestionModel()
            ->update(
                "question='" . (string)request()->get('question') . "',
                quiz_id='" .  (integer)$id . "' ",
                'id',
                '=',
                (int)$quiz_id
            );
    
        if ($quiz_question_update) {
            session()->forget('errors');
            session()->put('success', false, 'Quiz Question Updated');
            $this->redirect_path = '/admin/quiz/'. $id . '/question';
        } else {
            session()->forget('success');
            session()->put('errors', false, 'Quiz Question Failed Update');
            $this->redirect_path = request()->back();
        }
    
        //Redirect
        return redirect($this->redirect_path);
    }
    
    /**
     * Store
     * Quiz Question
     *
     * @param integer $id Id
     *
     * @return mixed
     */
    public function store($id)
    {
        //Create Quiz Question
        $quiz_question_store = $this->quizQuestionModel()->save(
            [
                'question',
                'quiz_id',
                'created_at',
                'updated_at'
            ],
            [
                request()->get('question'),
                (int)$id,
                now(),
                now(),
            ]
        );
        
        if ($quiz_question_store) {
            session()->forget('errors');
            session()->put('success', false, 'Quiz Question Created');
            $this->redirect_path = '/admin/quiz/' . request()->segments()[3] . '/question';
        } else {
            session()->forget('success');
            session()->put('errors', false, 'Quiz Question Failed Create');
            $this->redirect_path =  '/admin/quiz/' . request()->segments()[3] . '/question/create';
        }
    
        //Redirect
        return redirect($this->redirect_path);
    }
    
    /**
     * Destroy
     * Quiz Question
     *
     * @param integer $id      Id
     * @param integer $quiz_id Quiz Id
     *
     * @return mixed
     */
    public function destroy($id, $quiz_id)
    {
        $quiz_question_exist_check = $this->quizQuestionModel()
            ->first('*', 'id', '=', (int)$quiz_id);
    
        if ($quiz_question_exist_check) {
            //Delete Quiz Question Record
            $this->quizQuestionModel()->destroy('id', '=', (int)$quiz_id);
            //Forget Errors Messages
            session()->forget('errors');
            //Set Success Messages
            session()->put('success', false, 'Quiz Question Deleted');
        } else {
            //Forget Success Messages
            session()->forget('success');
            //Set Errors Messages
            session()->put('errors', false, 'Quiz Question Delete Failed');
        }
        
        return redirect('/admin/quiz/' . request()->segments()[3] . '/question');
    }
}
