<?php
namespace Home\Controller;
use Think\Controller;
class TiebaController extends Controller {
    
    public function index(){
        header("Content-type:text/html;charset=utf-8");
        echo '系统正在维护中.....';
    }
    
    /**
     * @method 获得所有的贴吧(这里处理会有点问题，待更新，目前手动添加贴吧)
     * 
     */
    public function gettieba(){
//         header("Content-type:text/html;charset=utf-8");
        header("Content-type:text/html;charset=gbk");
        $username = $_GET['username'];
        $user = D('Admin')->where(array('username'=>$username))->find();
        if (empty($user)) {
            $this->error('该用户未登录过系统');
        }
        $userid = $user['id'];
        $jarPath = str_replace('\\', '/', dirname(__FILE__)).'/cookieJar/';
        $jarName = md5($username).'.cookie';
        $cookie_jar = $jarPath.$jarName;
        $curlObj = new \Vendor\Baidu\CommonCurl();
        
        $url1 = 'http://tieba.baidu.com/';
        $data1 = $curlObj->get($url1,$cookie_jar);      
        preg_match_all('/id=\"likeforumwraper\">(.*)more-wraper/U',$data1,$tiebaArr);       
        preg_match_all('/href=\"(.*)\"\  title=\"(.*)\"(.*)lv(.*)\"/U',$tiebaArr[1][0],$tieba1);
        preg_match_all('/a><a(.*)href=\"(.*)\"\  class=\"u-f-item\ unsign\">(.*)<span(.*)lv(.*)\"/U',$tiebaArr[1][0],$tieba2);
        
        $tieba[0]['name'] = iconv("GBK", "UTF-8",  $tieba1[2][0]);          //注意这里需要将GBK编码转换成utf-8
        $tieba[0]['md5name'] = md5($tieba[0]['name']);
        $tieba[0]['url'] = 'http://tieba.baidu.com'.$tieba1[1][0];
        $tieba[0]['level'] = $tieba1[4][0];
        $tieba[0]['userid'] = $userid;
        $tieba[0]['time'] = time();
        
        foreach ($tieba2[2] as $k=>$v){
            $tieba[$k+1]['name'] = iconv("GBK", "UTF-8",  $tieba2[3][$k]);        //注意这里需要将GBK编码转换成utf-8  
            $tieba[$k+1]['md5name'] = md5($tieba[$k+1]['name']);
            $tieba[$k+1]['url'] = 'http://tieba.baidu.com'.$v;
            $tieba[$k+1]['level'] = $tieba2[5][$k];
            $tieba[$k+1]['userid'] = $userid;
            $tieba[$k+1]['time'] = time();
        }

        foreach ($tieba as $k1=>$v1){
            $result = M('Tieba')->where(array('md5name'=>md5($v1['name']),'userid'=>$v1['userid']))->find();
            if (empty($result)) {
                M('Tieba')->add($v1);
            }else{
                M('Tieba')->where(array('id'=>$result['id']))->save($v1);
            }
        }
        $this->success('常逛贴吧已入库');
        
    }
    
    /**
     * @method 测试贴吧签到
     * @todo 解决贴吧中文问题
     */
    public function testqiandao(){
        
        $jarPath = str_replace('\\', '/', dirname(__FILE__)).'/cookieJar/';
        $jarName = md5('xiaogangshagua').'.cookie';
        $cookie_jar = $jarPath.$jarName;
        $curlObj = new \Vendor\Baidu\CommonCurl();
    
        $url1 = 'http://tieba.baidu.com/f?kw=%C0%EE%D2%E3&fr=index';
        $data1 = $curlObj->get($url1,$cookie_jar);
        preg_match_all('/\'tbs\':\'(.*)\'/U',$data1,$tbsArr);
        $tbs = $tbsArr[1][0];
         
        $url2 = 'http://tieba.baidu.com/sign/add';
        $params = array(
            'i'=>'utf-8',
            'kw'=>iconv("UTF-8", "GBK", '李毅'),          //注意这里
            'tbs'=>$tbs,
        );
        $data2 = $curlObj->post($url2,$params,$cookie_jar,$v['url']);
edump($data2); 
    }
    
    /**
     * @method 贴吧签到
     */
    public function qiandao(){
        $username = $_GET['username'];
        $jarPath = str_replace('\\', '/', dirname(__FILE__)).'/cookieJar/';
        $jarName = md5($username).'.cookie';
        $cookie_jar = $jarPath.$jarName;
        $curlObj = new \Vendor\Baidu\CommonCurl();
        
        $user = M('Admin')->where(array('username'=>$username))->find();
        if (empty($user)) {
            $this->error('该用户未登录');
        }else{
            $tiebaArr = M('Tieba')->where(array('userid'=>$user['id']))->select();
            foreach ($tiebaArr as $k=>$v){
                $url1 = $v['url'];
                $data1 = $curlObj->get($url1,$cookie_jar);
                preg_match_all('/\'tbs\':\'(.*)\'/U',$data1,$tbsArr);
                $tbs = $tbsArr[1][0];
                 
                $url2 = 'http://tieba.baidu.com/sign/add';
                $params = array(
                    'i'=>'utf-8',
                    'kw'=>iconv("UTF-8", "GBK", $v['name']),
                    'tbs'=>$tbs,
                );
                $data2 = $curlObj->post($url2,$params,$cookie_jar,$v['url']);
            }
        }
        $this->success('签到成功');    
    }
       
}