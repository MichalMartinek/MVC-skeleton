<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 17.11.14
 * Time: 15:11
 */

class CalculatorController extends Controller{
    function __construct(){}
    public function index($p)
    {
        $this->template = 'calculatorForm';
        $this->header['title'] = "Calculator Controller";


    }
    public function calculate($p)
    {
        $this->template = 'calculatorShow';
        $this->header['title'] = "Calculator Controller";
        $calc = new Calculator();
        $this->data['sum'] = $calc->sum($_POST['number1'],$_POST['number2']);
        $this->data['difference'] = $calc->difference($_POST['number1'],$_POST['number2']);
        $this->data['product'] = $calc->product($_POST['number1'],$_POST['number2']);



    }

}
