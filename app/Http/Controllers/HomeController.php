<?php

namespace App\Http\Controllers;

use function modelCount;
use function request;
use function session;

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
     * View Index
     *
     * @return mixed
     */
    public function index()
    {
        if (session()->has('user') == true) {
            redirect('/dashboard');
        }
        
        /**
         * Render View
         */
        return $this->render('pages.home');
    }
    
    /**
     * Processing Request
     *
     * @return string
     */
    public function store()
    {
        if (session()->has('user') == true) {
            //set redirect path
            $this->setRedirectPath('/');
        }
        
        /**
         * Check if user exist
         */
        $user_exist_check = $this->userModel()
            ->first("COUNT(*)", 'email', '=', request()->get("email"));
        
        /**
         * Input Check
         * Based upon is based scenario: Register or Login
         */
        if (request()->has('name')) {
            /**
             * Register User
             */
            if (modelCount($user_exist_check) == 1) {
                session()->put('errors', false, 'Email has been taken.');
                //set redirect path
                $this->setRedirectPath('/');
            } else {
                //purge error messages
                session()->forget('errors');
                //set success message
                session()->put('success', false, 'User has been registered');
                
                //Create New User
                $this->userModel()->save(
                    [
                        'username',
                        'email',
                        'password',
                        'active',
                        'created_at',
                        'updated_at'
                    ], [
                        request()->get('name'),
                        request()->get('email'),
                        password_hash(request()->get('password'), 2),
                        1,
                        now(),
                        now()
                    ]
                );
                
                //set redirect path
                $this->setRedirectPath('/');
            }
        } else {
            /**
             * Check
             * Authenticate User
             */
            if (modelCount($user_exist_check) == 1) {
                //Collect All User Information
                $user = $this->userModel()
                    ->first("*", 'email', '=', request()->get("email"));
                //Checking Password Hash
                if (password_verify(request()->get('password'), $user['password'])) {
                    //purge error messages
                    session()->forget('errors');
                    //purge success messages
                    session()->forget('success');
                    //set user session
                    session()->put('user', $user);
                    //set redirect path
                    $this->setRedirectPath('/dashboard');
                } else {
                    //set error message
                    session()->put(
                        'errors',
                        false, 'password or email is incorrect'
                    );
                    //set redirect path
                    $this->setRedirectPath('/dashboard');
                }
            } else {
                //set error message
                session()->put('errors', false, 'User Not Found');
                //set redirect path
                $this->setRedirectPath('/');
            }
        }
        
        //Redirect
        return redirect($this->redirect_path);
    }
}
