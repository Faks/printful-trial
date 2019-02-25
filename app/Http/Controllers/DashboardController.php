<?php

namespace App\Http\Controllers;

use function compact;
use function modelCount;
use function redirect;
use function request;
use function session;

/**
 * Class DashboardController
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
 * Time: 7:45
 */
class DashboardController extends BaseController
{
    /**
     * Render Index
     *
     * @return mixed
     */
    public function index()
    {
        if (session()->has('user') == true) {
            $session = session()->get('user');
            $users = $this->userModel()->get('*');
        } else {
            redirect('/');
        }
        
        return $this->render('pages.dashboard', compact('users', 'session'));
    }
    
    /**
     * Processing Request
     *
     * @return string
     */
    public function store()
    {
        if (session()->has('user') == true) {
            
            $user_update = $this->userModel()->update(
                "username='" . (string)request()->get('name') . "',
                email='" . (string)request()->get('email') . "' ",
                'id',
                '=',
                (integer)request()->get('id')
            );
            
            if ($user_update) {
                $this->redirect_path = '/dashboard';
            }
            
        } else {
            $this->redirect_path = '/';
        }
        
        return redirect($this->redirect_path);
    }
    
    /**
     * Processing Request
     *
     * @param DashboardController $id User Id
     *
     * @return mixed
     */
    public function edit($id)
    {
        if (session()->has('user') == true) {
            $get_user = $this->userModel()->first(
                '*', 'id', '=', (integer)$id, true
            );
        } else {
            $this->setRedirectPath('/');
            redirect($this->redirect_path);
        }
        
        return $this->render('pages.edit.user', compact('id', 'get_user'));
    }
    
    /**
     * Delete Member
     *
     * @param DashboardController $id User Id
     *
     * @return string
     */
    public function destroy($id)
    {
        if (session()->has('user') == true) {
            $user_exist = $this->userModel()->first('count(*)', 'id', '=', $id);
            
            if (modelCount($user_exist) == 0) {
                session()->put('errors', 'User Not Found To Delete');
            } else {
                session()->forget('errors');
                session()->put('success', 'User Has Been Delete');
                $this->userModel()->destroy('id', '=', (integer)$id);
            }
            
            $this->setRedirectPath('/dashboard');
        } else {
            $this->setRedirectPath('/');
        }
        
        return redirect($this->redirect_path);
    }
}