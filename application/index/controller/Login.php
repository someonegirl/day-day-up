<?php

/**
 * User:goodtimp
 * LastDate:2018/11/23
 */

namespace app\index\controller;

use app\index\model\answer as answer;
use think\Controller;
use app\index\model\teacher as teacher;
use think\facade\Session;

class Login extends Controller{
  public function index(){
    if(Session::has("Id",'teacher'))//如果session已经有了，就直接跳转
    {
      return redirect('index/index');
    }
    $this->assign([
      'msg'=>'',
    ]);
    if(request()->post())
    {
      $data=input("post.");
      if(!self::verifyLogin($data))
      {
        $this->assign([
          'msg'=>'用户名密码不正确或用户名重复。请检查是否正确，建议改用id或昵称登录.',
        ]);
        return view();
      }
      return redirect('index/index');
    }
    return view();
  }
  /**
   * 检验登陆信息是否正确
   */
  function verifyLogin($data)
  {
    $arr=teacher::get_teacher($data['username']);
    $f=false;
    
    foreach($arr as $row)
    {
      if($row['password']==$data["password"])
      { 
        if($f)
        {
          return false; 
        }
        Session::set("Id",$row['Id'],'teacher');
        Session::set("name",$row['name'],'teacher');
        Session::set("loginId",$row['loginId'],'teacher');
        $f=true;
      }
    }
    return $f;
  }
   /**
   * 退出
   */
  public function exit_user()
  {
    Session::clear('teacher');
    return redirect('index');
  }

}