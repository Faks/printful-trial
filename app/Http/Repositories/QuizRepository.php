<?php

namespace app\Http\Repositories;

use App\Http\Request\Request;
use App\Http\Traits\ModelsTrait;
use function session;

/**
 * Class QuizRepository
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
 * Time: 10:08
 */
class QuizRepository
{
    use ModelsTrait;
    
    /**
     * Request Instance
     *
     * @var Request $request Request DI
     */
    protected $request;
    
    /**
     * Quiz Id
     *
     * @var integer $id_quiz
     */
    protected $id_quiz;
    
    /**
     * QuizRepository constructor.
     *
     * @param Request $request Request Instance
     * @param integer $quiz_id Quiz Id
     */
    public function __construct(Request $request, $quiz_id)
    {
        $this->request = $request;
        $this->id_quiz = $quiz_id;
    }
    
    
    /**
     *  Store Sign-up to quiz
     *
     * @return bool
     * @throws \Exception
     */
    public function store()
    {
        //Init Model
        $user_quiz_sign_up = $this->userQuizSignUpModel();
        //Model Save
        $user_quiz_sign_up_store = $user_quiz_sign_up->save(
            [
                'name',
                'quiz_id',
                'created_at',
                'updated_at'
            ],
            [
                (string)$this->request->get('name'),
                (int)$this->id_quiz,
                now(),
                now()
            ]
        );
        
        //Set Session Last Insert Id
        session()->put('quiz_sign_up_id', $user_quiz_sign_up->last_insert_id);
        
        return $user_quiz_sign_up_store;
    }
}
