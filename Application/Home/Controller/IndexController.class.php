<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        header("Content-type:text/html;charset=utf-8");
        $this->redirect('Login/index');
    }
}