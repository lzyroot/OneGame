<?php
// +---------------------------------------------------------------------+
// | OneBase    | [ WE CAN DO IT JUST THINK ]                            |
// +---------------------------------------------------------------------+
// | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )           |
// +---------------------------------------------------------------------+
// | Author     | Bigotry <3162875@qq.com>                               |
// +---------------------------------------------------------------------+
// | Repository | https://gitee.com/Bigotry/OneBase                      |
// +---------------------------------------------------------------------+

namespace app\index\controller;

/**
 * 前台首页控制器
 */
class Index extends IndexBase
{
    
    // 首页方法
    public function index()
    {

        set_url();
        
        $this->assign('data', $this->logicIndex->getIndexData());
        
        $this->setTitle('首页');
        
        return $this->fetch('index');
    }
    
    // 游戏推广渠道页面
    public function channel($code = '')
    {
        
        $this->view->engine->layout(false);
        
        if (!empty($this->param['channel']) && !empty($this->param['game_code'])) {
            
            session('channel_param', $this->param);
        }
        
        if  (!empty($code)) {
            
            session('register_code', $code);

            cookie('register_code', $code);
            
            $game_info = $this->logicIndex->getGameByCode($code);
            
            $this->assign('game_info', $game_info);
            
            if (!empty($this->param['sid'])) {
                
                session('channel_sid', $this->param['sid']);
            }
            
            return $this->fetch('channel');
        } else {
            
            $this->error('推广号码不存在');
        }
    }
    
    /**
     * 获取服务器选项
     */
    public function getServerOption($game_id = 0)
    {
        
        echo $this->logicIndex->getServerOption($game_id);
    }
    
    /**
     * 获取角色选项
     */
    public function getRoleOption($game_id = 0, $server_id = 0)
    {
        
        exit($this->logicIndex->getRoleOption($game_id, $server_id));
    }
}
