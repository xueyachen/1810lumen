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
        }else{
            echo 2;
        }
    }

    //登录
    public function loginapi(Request $request){
        $data=$request->all();
        $username=Login::where(['username'=>$data['username']])->first();
        if(!empty($username)){
            if($data['pwd']!=$username->pwd){
                $arr=[
                    'code'=>2,
                    'font'=>'账号或密码有误'
                ];
                return json_encode($arr);
            }else{
                $token_key='xyc_token:id:'.$username->id;
                $token_value=md5(Str::random(6).'xyc'.time());

                Redis::setex($token_key,10,$token_value);//存
//                $a=Redis::get($token_key);//取
                $response= [
                    'code'=>1,
                    'id'=>$username->id,
                    'token'=>$token_value,
                    'font'=>'登录成功'
                ];
                return json_encode($response);
            }
        }else{
            $arr=[
                'code'=>3,
                'font'=>'该账号还未注册，请先注册'
            ];
            return json_encode($arr);
        }
    }

    //个人中心
    public function indexapi(){
        $token=$_GET['token'];
        $id=$_GET['id'];

        $token_key='xyc_token:id:'.$id;
        $a=Redis::get($token_key);//取
        if($a==$token){
            $res=Login::where(['id'=>$id])->first()->toArray();
            $username=$res['username'];
        }
        return view('index.index',compact('username'));
    }






}
?>