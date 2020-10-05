<?php

namespace App\Http\Request;

use function is_null;

/**
 * Class Request
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
 * Time: 11:29
 */
class Request
{
    /**
     * Building Custom Request Drive
     *
     * @var
     */
    protected $request;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->request = ($_POST ?? $_GET ?? $_REQUEST);
    }

    /**
     * Returns selected by name
     *
     * @param string $field_name Value
     *
     * @return mixed
     */
    public function get($field_name)
    {
        return @$this->request["$field_name"];
    }

    /**
     * Returns does field is in request
     *
     * @param string $field_name Value
     *
     * @return bool
     */
    public function has($field_name)
    {
        return @(! is_null($this->request["$field_name"])) ? true : false;
    }

    /**
     * Returns All Request
     *
     * @return mixed
     */
    public function all()
    {
        return $this->request;
    }

    /**
     * Collect all query segments
     *
     * @return array
     */
    public function segments()
    {
        $segments = explode('/', $_SERVER['REQUEST_URI']);
        return array_filter($segments);
    }

    /**
     * Return active route path
     *
     * @return string
     */
    public function path(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * @param string $path
     *
     * @return string|null
     */
    public function pathIsActive(string $path): ?string
    {
        return $this->path() === $path ? 'active' : null;
    }

    /**
     * Returns Last URL
     *
     * @return mixed
     */
    public function back()
    {
        return @$_SERVER['HTTP_REFERER'];
    }
}
