<?php
/**
 * 验证码的暂时没做到，有时间在做
 */
namespace Home\Controller;
use Think\Controller;
use Vendor\Baidu\CommonCurl;
class LoginController extends Controller {
    
    public function index(){
        if (!empty($_POST['username'])) {
            $username = I('username');
            $password = I('password');
            $jarPath = str_replace('\\', '/', dirname(__FILE__)).'/cookieJar/';
            $jarName = md5($username).'.cookie';
            $cookie_jar = $jarPath.$jarName;

            $curlObj = new \Vendor\Baidu\CommonCurl();
            $url1 = 'https://passport.baidu.com/v2/?login&u=';
            $data1 = $curlObj->get($url1,$cookie_jar);
            $url2 = 'https://log.hm.baidu.com/hm.gif?cc=1&ck=1&cl=24-bit&ds=1366x768&et=0&fl=18.0&ja=0&ln=zh-CN&lo=0&nv=1&rnd=90861218&si=90056b3f84f90da57dc0f40150f005d5&st=1&su=https%3A%2F%2Fpassport.baidu.com%2Fv2%2F%3Flogin%26u%3D&v=1.0.98&lv=1&api=6_0&tt=%E7%99%BB%E5%BD%95%E7%99%BE%E5%BA%A6%E5%B8%90%E5%8F%B7&u=https%3A%2F%2Fpassport.baidu.com%2Fv2%2F%3Flogin%26u%3D';
            $data2 = $curlObj->get($url2,$cookie_jar);
            
            /* 生成token */
            $url_1 = 'https://passport.baidu.com/v2/api/?getapi&tpl=pp&apiver=v3&tt=1438152574175&class=login&logintype=basicLogin&callback=bd__cbs__27ayjq';
            $data_1 = $curlObj->get($url_1,$cookie_jar);
            preg_match('/token\"\ :\ \"(.*)\"/U', $data_1,$match);
            $token = $match[1];
            
            /* 获得验证码信息  */
            $url_2 = 'https://passport.baidu.com/v2/getpublickey?token='.$token.'&tpl=pp&apiver=v3&tt=1438153735761&callback=bd__cbs__p8g49m';
            $data_2 = $curlObj->get($url_2,$cookie_jar);
            preg_match('/\"codeString\"\ :\ \"(.*)\"/U',$data_2,$codeString);
            preg_match('/\"vcodetype\"\ :\ \"(.*)\"/U',$data_2,$vcodetype);
            $codeString = $codeString[1];
            $vcodetype = $vcodetype[1];

            /* 检查历史 */
            $url_3 = 'https://passport.baidu.com/v2/api/?loginhistory&token='.$token.'&tpl=pp&apiver=v3&tt=1438152574342&gid=593FF99-C483-4574-AC0C-4F545820216A&callback=bd__cbs__xmxa8e';
            $data_3 = $curlObj->get($url_3,$cookie_jar);
            $url_4 = 'https://passport.baidu.com/v2/api/?logincheck&token='.$token.'&tpl=pp&apiver=v3&tt=1438152574348&username=xiaogangshagua&isphone=false&callback=bd__cbs__ae8nrl';
            $data_4 = $curlObj->get($url_4,$cookie_jar);

            /* 检查验证码是否正确 */
            $url_5 = 'https://passport.baidu.com/v2/?checkvcode&token='.$token.'&tpl=mn&apiver=v3&tt=1434612173231&verifycode=zdqg&codestring='.$codeString.'&callback=bd__cbs__hvz3ml';
            $data_5 = $curlObj->get($url_5,$cookie_jar);
            
            preg_match('/\"key\":\'(.*)\'/U',$data_5,$match2);
            $key = $match2[1];

            $params = array(
                'staticpage' => 'https://www.baidu.com/cache/user/html/v3Jump.html',
                'charset' => 'UTF-8',
                'token' => $token,
                'tpl' => 'pp',
                'subpro' => '',
                'codestring' => '',
                'apiver'=> 'v3',
                'safeflg'=> 0,
                'u' => 'https://passport.baidu.com/',
                'isPhone' =>false,
                'detect' =>1,
                'quick_user'=>0,
                'logintype'=>'basicLogin',
                'logLoginType'=>'pc_loginBasic',
                'idc' => '',
                'loginmerge'=>true,
                'username' => $username,
                'password' => $password,
                'verifycode' => '',
                'mem_pass' => 'on',         
                'ppui_logintime' =>1535,
    //             'gid'   =>$gid,
                'callback' => 'parent.bd__pcbs__yzk837'
            );

            $url4 = 'https://passport.baidu.com/v2/api/?login';
            $data4 = $curlObj->post($url4, $params, $cookie_jar);
    
             $url5 = 'http://wenku.baidu.com/';
             $data5 = $curlObj->get($url5,$cookie_jar);
             preg_match_all('/'.$username.'/',$data5,$ischeck);
             if (!empty($ischeck)) {
                 $map['username'] = $username;
                 $map['password'] = $password;
                 $map['time'] = time();
                 $map['ip'] = getIP();
                 $map['loginnum'] = 1;
                 $result = D('Admin')->where(array('username'=>$username))->select();
                 if (empty($result)) {
                     $res1 = D('Admin')->add($map);
                     if ($res1) {
                         $this->success('登录成功',U('Login/index'));
                     }else{
                         $this->error('登录失败',U('Login/index'));
                     }
                 }else{
                     $map['ip'] = getIP();
                     $map['loginnum'] = $result[0]['loginnum']+1;
                     $res2 = D('Admin')->where(array('id'=>$result[0]['id']))->save($map);
                     if ($res2) {
                         $this->success('登录成功',U('Login/index'));
                     }else{
                         $this->error('登录失败',U('Login/index'));
                     }
                 }
                
             }else{
                 $this->error('登录失败',U('Login/index'));
             }
            }else{
                $this->display(); 
            }
    }
    
    /**
     * 测试用户是否登录成功
     */
    public function testLogin(){
        if (!empty(I('username'))) {
            $username = I('username');
            $user = D('Admin')->where(array('username'=>$username))->find();
            if (empty($user)) {
                $this->error('该用户未登录过系统',U('Login/index'));
            }
            $userid = $user['id'];
            $jarPath = str_replace('\\', '/', dirname(__FILE__)).'/cookieJar/';
            $jarName = md5($username).'.cookie';
            $cookie_jar = $jarPath.$jarName;

            $curlObj = new \Vendor\Baidu\CommonCurl();
            $content = $curlObj->get('http://tieba.baidu.com/i/fr=home',$cookie_jar,'');
            echo $content;
        }else{
            $this->display();
        }
    }
}