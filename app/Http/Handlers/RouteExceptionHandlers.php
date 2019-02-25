<?php

namespace app\Http\Handlers;

use App\Http\Controllers\BaseController;
use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\Handlers\IExceptionHandler;

/**
 * Class RouteExceptionHandlers
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
 * Time: 14:34
 */
class RouteExceptionHandlers extends BaseController implements IExceptionHandler
{
    /**
     * Handle Route Error
     *
     * @param Request $request Routes Request
     * @param \Exception $error Error
     *
     * @throws \Exception
     */
    public function handleError(Request $request, \Exception $error): void
    {
        /**
         * You can use the exception handler to format errors
         * depending on the request and type.
         */
        if ($request->getUrl()->contains('/api')) {
            response()->json([
                'error' => $error->getMessage(),
                'code' => $error->getCode(),
            ]);
        }
        
        /* The router will throw the NotFoundHttpException on 404 */
        if ($error instanceof NotFoundHttpException) {
            /**
             * Render your own custom 404-view, rewrite the request to another route,
             * or simply return the $request object to ignore the
             * error and continue on rendering the route
             * The code below will make the router render our page.notfound route.
             */
            $request->setRewriteCallback($this->notFound());
            return;
        }
        
        throw $error;
    }
}
