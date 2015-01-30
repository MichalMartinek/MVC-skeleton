<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 16.11.14
 * Time: 23:12
 */

abstract class Controller {
    protected $data = array();
    protected $template;
    protected $header = array('title' => '',
        'keyWords' => '',
        'description' => '');
    abstract function index($pa);
    public function show()
    {
        if($this->template)
        {
            extract($this->treat($this->data));
            require("../app/template/$this->template.phtml");
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
        header("Connection: close");
        exit;
    }
    protected function treat($x = null)
    {
        if (!isset($x))
            return null;
        elseif (is_string($x))
            return htmlspecialchars($x, ENT_QUOTES);
        elseif (is_array($x))
        {
            foreach($x as $k => $v)
            {
                $x[$k] = $this->treat($v);
            }
            return $x;
        }
        else
            return $x;
    }


}
