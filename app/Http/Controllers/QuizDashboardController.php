<?php

namespace App\Http\Controllers;

use function compact;
use function redirect;
use function request;
use function session;

/**
 * Class QuizDashboardController
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
 * Time: 14:41
 */
class QuizDashboardController extends BaseController
{
    /**
     * Quiz Listing Index
     *
     * @return mixed
     */
    public function index()
    {
        $quizes = $this->quizModel()->get('*');
        
        return $this->render('pages.dashboard.quiz', compact('quizes'));
    }
    
    /**
     * Create
     * Quiz
     *
     * @return mixed
     */
    public function create()
    {
        return $this->render('pages.create.quiz');
    }
    
    /**
     * Edit
     * Quiz
     *
     * @param integer $id Id
     *
     * @return mixed
     */
    public function edit($id)
    {
        $quiz = $this->quizModel()->first('*', 'id', '=', $id, true);
        
        return $this->render('pages.edit.quiz', compact('quiz'));
    }
    
    /**
     * Update
     * Quiz
     *
     * @param integer $id Id
     *
     * @return mixed
     */
    public function update($id)
    {
        $quiz_update = $this->quizModel()
            ->update(
                "name='" . (string)request()->get('name') . "',
                etm='" .  (string)request()->get('etm') . "',
                type='" . (string)request()->get('type') . "' ",
                'id',
                '=',
                (int)$id
            );
    
        if ($quiz_update) {
            session()->forget('errors');
            session()->put('success', false, 'Quiz Updated');
            $this->redirect_path = '/admin/quiz/list';
        } else {
            session()->forget('success');
            session()->put('errors', false, 'Quiz Failed Update');
            $this->redirect_path = request()->back();
        }
    
        //Redirect
        return redirect($this->redirect_path);
    }
    
    /**
     * Store
     * Quiz
     *
     * @return mixed
     */
    public function store()
    {
        //Create Quiz
        $quiz_store = $this->quizModel()->save(
            [
                'name',
                'etm',
                'type',
                'created_at',
                'updated_at'
            ],
            [
                request()->get('name'),
                request()->get('etm'),
                request()->get('type'),
                now(),
                now(),
            ]
        );
        
        if ($quiz_store) {
            session()->forget('errors');
            session()->put('success', false, 'Quiz Created');
            $this->redirect_path = '/admin/quiz/list';
        } else {
            session()->forget('success');
            session()->put('errors', false, 'Quiz Failed Create');
            $this->redirect_path = '/admin/quiz/create';
        }
        
        //Redirect
        return redirect($this->redirect_path);
    }
    
    /**
     * Destroy
     * Quiz
     *
     * @param integer $id Id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        $quiz_exist_check = $this->quizModel()->first('*', 'id', '=', (int)$id);
        
        if ($quiz_exist_check) {
            //Delete Quiz Record
            $this->quizModel()->destroy('id', '=', (int)$id);
            //Forget Errors Messages
            session()->forget('errors');
            //Set Success Messages
            session()->put('success', false, 'Quiz Deleted');
        } else {
            //Forget Success Messages
            session()->forget('success');
            //Set Errors Messages
            session()->put('errors', false, 'Quiz Delete Failed');
        }
        
        return redirect('/admin/quiz/list');
    }
}
