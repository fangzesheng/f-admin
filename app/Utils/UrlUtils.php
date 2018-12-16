<?php
/**
 * User: HUANGXIANG
 * Date: 2017-06-26 16:47
 */

namespace App\Utils;

use Request;

class UrlUtils
{
    const URL                   = 'url';
    const ACTION                = 'action';
    const CONTROLLER            = 'controller';
    const CLASS_NAME            = 'class_name';
    const CLASS_METHOD          = 'class_method';
    const METHOD                = 'method';
    const REAL_METHOD           = 'real_method';
    public static function toRestfulParams()
    {
        $params = [];
        // 如: App\Http\Controllers\IndexController@getIndex
        $action = (Request::route()->getActionName());
        // 如: [App\Http\Controllers\IndexController, getIndex]
        $tmp = explode("@", $action);
        // 如: App\Http\Controllers\IndexController
        $controller = $tmp[0];
        // 如: getIndex
        $classMethod = count($tmp) > 1 ? $tmp[1] : '';
        $paths = explode("\\", $controller);
        // 如: IndexController
        $className = $paths[count($paths) - 1];
        // 如: GET | POST | PUT | DELETE , PUT跟DELETE方法可以通过_method参数传
        $method = Request::getMethod();
        // 如: GET | POST
        $realMethod = Request::getRealMethod();
        $url = Request::getRequestUri();

        $params[static::ACTION] = $action;
        $params[static::CONTROLLER] = $controller;
        $params[static::CLASS_NAME] = $className;
        $params[static::CLASS_METHOD] = $classMethod;
        $params[static::METHOD] = $method;
        $params[static::REAL_METHOD] = $realMethod;
        $params[static::URL] = $url;
        return $params;
    }

}