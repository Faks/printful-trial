<?php

use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter as Route;

/**
 * Created by PhpStorm.
 * User: Faks
 * GitHub: https://github.com/Faks
 *
 * @category PHP
 * @package  Custom_OOP_MVC
 * @author   Oskars Germovs <solumdesignum@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT Licence
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 * Date: 2019.02.19.
 * Time: 12:35
 */

/**
 * Not existing
 * route redirect
 */
Route::error(function (Request $request, \Exception $exception) {
    if ($exception instanceof NotFoundHttpException) {
        return redirect('/');
    }
});

/**
 * Routes Group Controller Namespace PSR4
 */
Route::group(['namespace' => 'App\Http\Controllers'], function () {
    //Quiz Listing
    Route::get(
        '/',
        'HomeController@index'
    );
    //Quiz Sign-up
    Route::get(
        '/quiz/{id}/sign-up',
        'UserQuizController@index'
    );
    Route::post(
        '/quiz/{id}/sign-up',
        'UserQuizController@store'
    );
    //Quiz Run
    Route::get(
        '/quiz/{id}/take/{answer_order}',
        'UserQuizController@take'
    );
    //Quiz Store Sign-up
    Route::post(
        '/quiz/{id}/take/{answer_order}',
        'UserQuizController@store'
    );
    //Quiz Store Answer
    Route::post(
        '/quiz/{id}/take/{answer_order}/store',
        'UserQuizController@storeAnswer'
    );
    //Quiz Review
    Route::get(
        '/quiz/{id_review}/review',
        'UserQuizController@review'
    );
    
    //Fallback
    Route::get(
        '/admin',
        function () {
            return redirect('admin/quiz/list');
        }
    );
    
    //Quiz Dashboard
    Route::get(
        '/admin/quiz/list',
        'QuizDashboardController@index'
    );
    //Create
    Route::get(
        '/admin/quiz/create',
        'QuizDashboardController@create'
    );
    Route::post(
        '/admin/quiz/create',
        'QuizDashboardController@store'
    );
    //Edit
    Route::get(
        '/admin/quiz/{id}/edit',
        'QuizDashboardController@edit'
    );
    Route::post(
        '/admin/quiz/{id}/update',
        'QuizDashboardController@update'
    );
    //Delete
    Route::get(
        '/admin/quiz/{id}/destroy',
        'QuizDashboardController@destroy'
    );
    
    
    //Quiz Question Dashboard
    Route::get(
        '/admin/quiz/{id}/question',
        'QuizQuestionDashboardController@index'
    );
    //Create
    Route::get(
        '/admin/quiz/{id}/question/create',
        'QuizQuestionDashboardController@create'
    );
    Route::post(
        '/admin/quiz/{id}/question/create',
        'QuizQuestionDashboardController@store'
    );
    //Edit
    Route::get(
        '/admin/quiz/{id}/question/{question_id}/edit',
        'QuizQuestionDashboardController@edit'
    );
    Route::post(
        '/admin/quiz/{id}/question/{question_id}/update',
        'QuizQuestionDashboardController@update'
    );
    //Delete
    Route::get(
        '/admin/quiz/{id}/question/{question_id}/destroy',
        'QuizQuestionDashboardController@destroy'
    );
    
    
    //Quiz Question Answer Dashboard
    Route::get(
        '/admin/quiz/{id}/question/{question_id}/answer',
        'QuizQuestionAnswerDashboardController@index'
    );
    //Create
    Route::get(
        '/admin/quiz/{id}/question/{question_id}/answer/create',
        'QuizQuestionAnswerDashboardController@create'
    );
    Route::post(
        '/admin/quiz/{id}/question/{question_id}/answer/create',
        'QuizQuestionAnswerDashboardController@store'
    );
    //Edit
    Route::get(
        '/admin/quiz/{id}/question/{question_id}/answer/{answer_id}/edit',
        'QuizQuestionAnswerDashboardController@edit'
    );
    Route::post(
        '/admin/quiz/{id}/question/{question_id}/answer/{answer_id}/update',
        'QuizQuestionAnswerDashboardController@update'
    );
    //Delete
    Route::get(
        '/admin/quiz/{id}/question/{question_id}/answer/{answer_id}/destroy',
        'QuizQuestionAnswerDashboardController@destroy'
    );
});
