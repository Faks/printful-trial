<?php

namespace App\Http\Controllers;

use App\Http\Traits\ModelsTrait;
use Jenssegers\Blade\Blade;

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
 * Date: 2019.02.19.
 * Time: 12:49
 */
class BaseController
{
    /**
     * Load Model Instances
     */
    use ModelsTrait;
    
    /**
     * Set Blade Instance
     *
     * @return Blade Instance
     */
    protected $blade;
    
    /**
     * Set Redirect Path
     *
     * @var $redirect_path
     */
    public $redirect_path = false;
    
    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        /**
         * Set Blade Views Directory
         * Set Blade Cache Directory
         */
        $this->blade = new Blade(
            ['../resources/views'],
            '../storage/cache'
        );
    }
    
    /**
     * Blade Render
     *
     * @param string $viewRender Render
     * @param array  $data       Data
     * @param array  $mergeData  Data Merged
     *
     * @return mixed
     */
    public function render($viewRender, $data = [], $mergeData = [])
    {
        return $this->blade->render($viewRender, $data, $mergeData);
    }
    
    /**
     *  Blade Render Not Found View
     *
     * @return mixed
     */
    public function notFound()
    {
        return $this->render('errors.404');
    }
    
    /**
     * Set Redirect Path
     *
     * @param string $path Set Redirect
     *
     * @return mixed
     */
    public function setRedirectPath($path)
    {
        return $this->redirect_path = $path;
    }
}
