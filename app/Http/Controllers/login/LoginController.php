<?php
namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controllers;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Model\Login;
class LoginController extends BaseController{
    //注册
    public function regapi(Request $request){
        $data=$request->input();
        unset($data['pwdd']);
        $res=Login::insertGetId($data);
        if($res){
            echo 1;
//            $token_key= md5(Str::random(16).'lyz'.time()).'xyc'.$data['username'];
//            $token_value=md5(Str::random(16).'lyz'.time());
//            Redis::set($token_key,$token_value);
//            $response= [
//                'error'=>1,
//                'username'=>$data['username'],
//                'token'=>$token_value
//            ];
//            return json_encode($response);
        }else{
            echo 2;
        }




    }

    //登录
    public function login(Request $request){
        $name=$request->input('name');
        $pass=$request->input('pass1');
        $data=User::where(['u_name'=>$name])->first();
        if($data){      //有账号判断密码
            if($data->u_pwd==$pass){        //密码正确
                echo '登录成功';
            }else{                          //密码错误
                echo '密码有误';
            }
        }else{          //没账号 先注册
            echo '请先注册';
        }
    }






}
?>