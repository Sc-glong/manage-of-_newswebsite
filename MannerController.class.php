<?php
/**
 * Created by PhpStorm.
 * User: ll
 * Date: 2017/10/15
 * Time: 20:52
 */

namespace Admin\Controller;


use Think\Controller;

class MannerController extends  Controller
{
    public function  _initialize(){}
    public function  test(){


    }
    public function logout(){
        //实现用户注销操作
        //销毁session数据
        session('loginedUser',null);
        $this->redirect('/admin/index/index',null,0);
    }
    public  function login(){
        //若用户已处于登录状态不允许访问该页面
        if(session('?loginedUser')){
            $this->success('您已处于登录状态','/admin/index/index',ajax3);
        }
        $this->display();
    }
    public  function  dologin(){
        //获取表单数据
        $username=I('post.username');
        $password=I('post.password');
        //校验用户名和密码的有效性
        if ($username=='test'&&$password='123456'){
            //实现用户登录
            session('loginedUser',$username);
            $this->success('用户登录成功','/admin/index/index',ajax3);
        }else{
            $this->error('用户登录失败');
        }
    }
}