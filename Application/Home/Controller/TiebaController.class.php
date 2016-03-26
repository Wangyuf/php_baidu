<?php
namespace Home\Controller;
use Think\Controller;
use Org\Util\Date;
class TiebaController extends Controller {
    
    public function index(){
        header("Content-type:text/html;charset=utf-8");
        echo '系统正在维护中.....';
    }
    
    /**
     * @method 取消关注贴吧(感觉用处不大，暂不做)
     */
    public function qxgz(){
        
    }
    
    /**
     * @method 清空本地数据库贴吧数据然后再更新关注贴吧
     */
    public function gengxintb(){
        $username = $_GET['username'];
        $user = D('Admin')->where(array('username'=>$username))->find();
        if (empty($user)) {
            $this->error('该用户未登录过系统');
        }
        $userid = $user['id'];
        M('Tieba')->where(array('userid'=>$userid))->delete();
        $this->gettieba($username);
        $this->success('更新贴吧数据成功');
    }
    
    /**
     * @method 获得我所有关注的贴吧
     * 
     */
    public function gettieba($username){
        header("Content-type:text/html;charset=utf-8");
        $username = $_GET['username'] ? $_GET['username'] : $username;
        $user = D('Admin')->where(array('username'=>$username))->find();
        if (empty($user)) {
            $this->error('该用户未登录过系统',U('Login/index'));
        }
        $userid = $user['id'];
        $jarPath = str_replace('\\', '/', dirname(__FILE__)).'/cookieJar/';
        $jarName = md5($username).'.cookie';
        $cookie_jar = $jarPath.$jarName;
        $curlObj = new \Vendor\Baidu\CommonCurl();
        
        for($i=1;$i<10;$i++){
            $url2 = 'http://tieba.baidu.com/f/like/mylike?&pn='.$i;
            $data2 = $curlObj->get($url2,$cookie_jar,'http://tieba.baidu.com/i/fr=home');
            preg_match_all('/<a href=\"(.*)\" title=\"(.*)\">/U',$data2,$tiebas);
            preg_match_all('/<a class=\"cur_exp\"(.*)>(.*)<\/a>/U',$data2,$jingyan);
            preg_match_all('/<div class=\"like_badge_lv\">(.*)<\/div>/U',$data2,$level);
            
            foreach ($tiebas[2] as $k=>$v){
                $tieba[$k]['name'] = iconv("GBK", "UTF-8",  $v);
                $tieba[$k]['md5name'] = md5($tieba[$k]['name']);
                $tieba[$k]['url'] = 'http://tieba.baidu.com'.$tiebas[1][$k];
                $tieba[$k]['jingyan'] = $jingyan[2][$k];
                $tieba[$k]['level'] = $level[1][$k];
                $tieba[$k]['time'] = time();
                $tieba[$k]['userid'] = $userid;
            }
            foreach ($tieba as $k1=>$v1){
                $result = M('Tieba')->where(array('md5name'=>md5($v1['name']),'userid'=>$v1['userid']))->find();
                if (empty($result)) {
                    M('Tieba')->add($v1);
                }else{
                    M('Tieba')->where(array('id'=>$result['id']))->save($v1);
                }
            }
        }
        $this->success('常逛贴吧已入库',U('Tieba/index'));
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
        $userid = $user['id'];
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
        $data3['userid'] = $userid;
        $data3['date'] = Date('Y-m-d',time());
        $data3['status'] = 1;
        $d = Date('Y-m-d',time());
        $result = M('Tbqd')->where(array('userid'=>$userid,'date'=>$d))->find();
        if (empty($result)) {
            M('Tbqd')->add($data3);
            $this->success('签到成功',U('Tieba/index'));
        }else{
            $this->error('您今日已签到',U('Tieba/index'));
        } 
        
            
    }
       
}