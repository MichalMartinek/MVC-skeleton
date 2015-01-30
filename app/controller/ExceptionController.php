<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 17.11.14
 * Time: 15:37
 */

class ExceptionController extends Controller {
    public function index($p){
        $this->template = $p['template'];
        header($p['header']);
        $this->header['title'] = $p['title'];
    }
} 