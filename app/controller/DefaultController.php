<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 17.11.14
 * Time: 15:11
 */

class DefaultController extends Controller{
    public function index($p)
    {
        $this->template = 'homepage';
        $this->header['title'] = "Homepage";


    }

}
