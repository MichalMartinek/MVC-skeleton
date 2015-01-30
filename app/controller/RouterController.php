<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 16.11.14
 * Time: 23:21
 */

class RouterController extends Controller {

    protected $controller;

    function __construct(){}
    public function index($p)
    {
        $url = $this->parseUrl($p[0]);
        #jenom pro lokál
        #unset($url[0]);
        $url = array_values($url);

        $this->controller = $this->camelCase(array_shift($url)) . 'Controller';
        if($this->controller == 'Controller')
            $this->controller = 'DefaultController';

        if(class_exists($this->controller)) {
            $this->controller = new $this->controller();
            $method = array_shift($url);
            if ($method) {
                if(method_exists($this->controller,$method))
                    $this->controller->{$method}($url);
                else{
                    $this->controller = new ExceptionController();
                    $this->controller->index(array('header' => 'HTTP/1.0 404 Not Found', 'title' => '404 Error', 'template' => '404'));
                }
            }
            else
                $this->controller->index($url);
        }else {
            $this->controller = new ExceptionController();
            $this->controller->index(array('header' => 'HTTP/1.0 404 Not Found', 'title' => '404 Error', 'template' => '404'));
        }
        $this->data['title'] = $this->controller->header['title'];
        $this->data['description'] = $this->controller->header['description'];
        $this->data['keyWords'] = $this->controller->header['keyWords'];
        $this->template = "layout";

    }
    private function parseUrl($url)
    {
        /*$parsed = parse_url($url);
        return explode('/', trim(ltrim($parsed['path'],'/')));*/
        $naparsovanaURL = parse_url($url);
        $naparsovanaURL["path"] = ltrim($naparsovanaURL["path"], "/");
        $naparsovanaURL["path"] = trim($naparsovanaURL["path"]);
        $rozdelenaCesta = explode("/", $naparsovanaURL["path"]);
        return $rozdelenaCesta;
    }
    private function camelCase($text)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $text)));
    }

} 