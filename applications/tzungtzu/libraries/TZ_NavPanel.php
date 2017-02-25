<?php

/**
 * TzungTzu CMS
 *
 * 功能导航类
 *
 * @package     TzungTzu
 * @author      TZ Dev Team
 * @copyright   Copyright (c) 2012-2024, TzungTzu.com.
 * @license     http://tzungtzu.com/doucmentss/license.html
 * @link        http://tzungtzu.com/
 * @since       Version 1.0.0
 */
// ------------------------------------------------------------------------

/**
 * TZ_NavPanel Class
 *
 * @package		TzungTzu
 * @subpackage		Libraries
 * @category		Libraries
 * @author			TZ Dev Team
 */

class TZ_NavPanel {
    
    private static $_instance 	= NULL;
    
	private $_lang_path 		= 'system/nvapanel';
	
	private $_ci 				= NULL;
	
	private $_lang_current 		= NULL;
	
	//后台目录名称
	private $_webmaster 		= 'webmaster';
	
	/**
	 * @access public
	 * @return array
	 */
	public function set_menus()
	{
		return $menu = array(
			array(
				'title' => $this->_lang_current['system'], //功能导航分类
				'url' 	=> base_url("{$this->_webmaster}/home"),
				'level' => 'A',
				'bgimg' => '', //导航的样式图片
				'menu'  => array(
					array(
						'title'	=> $this->_lang_current['home'],
						'url' 	=> base_url("{$this->_webmaster}/home"),
						'level' => 'A01', //页面权限，也就是列表权限
						'menu' 	=> array(
							//array('title' => '', 'level' => ''), //按钮功能配置
							array('title'=>'PHPINFO','level' => ''),
						),
					),
					array(
						'title'	=> $this->_lang_current['setted_list_title'],
						'url' 	=> base_url("{$this->_webmaster}/system/setted"),
						'level' => 'A02', //页面权限
						'menu' 	=> array(
							array( 
								'title' => $this->_lang_current['btn_setted_save'], 
								'level' => 'A0201'
							), //按钮功能配置
						),
					),
//					array(
//						'title'	=>'缓存管理',
//						'url' 	=> '/admin/cache',
//						'level' => 'A03', //页面权限
//						'menu' 	=> array(
//							array('title' => '清理缓存', 'level' => 'A0301'), //按钮功能配置
//						),
//					),

				),
			),

			array(
				'title' => $this->_lang_current['user_title'],
				'url' 	=> base_url("{$this->_webmaster}/accounts/users"),
				'level'	=>'B',
				'bgimg' => '',
				'menu'  => array(
					// 用户组
					array( 
						'title'	=> $this->_lang_current['user_group_title'],
						'url' 	=> base_url("{$this->_webmaster}/accounts/ugroup"),
						'level' => 'B01', //页面权限
						'menu' 	=> array(
							array(
								'title' => $this->_lang_current['btn_add_edit'], 
								'level' => 'B0101'
							), 
							//array('title' => '删除用户组', 'level' => 'B0102'), 
							array(
								'title' => $this->_lang_current['btn_state'], 
								'level' => 'B0103'
							), 
							array(
								'title' => $this->_lang_current['btn_authority'], 
								'level' => 'B0104'
							),
						),
					),
					// 用户
					array( 
						'title'	=> $this->_lang_current['user_list_title'],
						'url' 	=> base_url("{$this->_webmaster}/accounts/users"),
						'level' => 'B02', //页面权限
						'menu' 	=> array(
							array(
								'title' => $this->_lang_current['btn_add_edit'],
								'level' => 'B0201'
							),
							//array('title' =>  '删除用户', 'level' => 'B0202'),
							array(
								'title' => $this->_lang_current['btn_state'], 
								'level' => 'B0203'
							),
							array(
								'title' => $this->_lang_current['btn_authority'], 
								'level' => 'B0204'
							),
						),
					),
					// 权限
					array(
						'title'	=>$this->_lang_current['user_rank_title'],
						'url' 	=> base_url("{$this->_webmaster}/accounts/rank"),
						'level' => 'B03', //页面权限
						'menu' 	=> array(
							array(
								'title' => $this->_lang_current['btn_user_rank'], 
								'level' => 'B0301'
							)
						),
					),
				),
			),

			array(
				'title' => $this->_lang_current['cms_title'],
				'url' 	=> base_url("{$this->_webmaster}/articles/article"),
				'level'	=>'C',
				'bgimg' => '',
				'menu'  => array(
					array(
						'title'	=> $this->_lang_current['cms_article'],
						'url' 	=> base_url("{$this->_webmaster}/articles/article"),
						'level' => 'C01', //页面权限
						'menu' 	=> array(
							array(
								'title' => $this->_lang_current['btn_add_edit'], 
								'level' => 'C0101'
							), 
							array(
								'title' => $this->_lang_current['btn_delete_article'], 
								'level' => 'C0102'
							),
							array(
								'title' => $this->_lang_current['btn_pass_article'], 
								'level' => 'C0103'
							),
							array(
								'title' => $this->_lang_current['cms_son_model'], 
								'level' => 'C0104'
							),
						),
					),
					array(
						'title'	=> $this->_lang_current['cms_category'],
						'url' 	=> base_url("{$this->_webmaster}/articles/category"),
						'level' => 'C02', //页面权限
						'menu' 	=> array(
							array(
                                'title' => $this->_lang_current['btn_add_edit'], 
                                'level' => 'C0201'
                            ), //按钮功能配置
							array(
                                'title' => $this->_lang_current['btn_cate_delete'],
                                'level' => 'C0202'
                            ),
							array(
                                'title' => $this->_lang_current['btn_order'],
                                'level' => 'C0203'
                            ),
						),
					),
//					array(
//						'title' => $this->_lang_current['cms_recommend'], 
//						'url' 	=> base_url("{$this->_webmaster}/articles/recommend"), //推荐位
//						'level'	=> 'C03',
//						'menu'	=> array(
//							array(
//                                'title' => $this->_lang_current['btn_add_edit'],
//                                'level' => 'C0301'
//                            ),
//							array(
//                                'title' => $this->_lang_current['btn_delete'],
//                                'level' => 'C0302'
//                            ),
//						),
//					),
//					array(
//						'title' => $this->_lang_current['cms_special'], 
//						'url'   => base_url("{$this->_webmaster}/articles/special"), // 专题
//						'level' => 'C04',
//						'menu'  => array(
//							array(
//                                'title' => $this->_lang_current['btn_add_edit'],
//                                'level' => 'C0401'
//                            ),
//							array(
//                                'title' => $this->_lang_current['btn_delete'],
//                                'level' => 'C0402'
//                            ),
//						),
//					),

				),
			),
            
            //模型
			array(
				'title' => $this->_lang_current['model_title'],
				'url'   => base_url("{$this->_webmaster}/moulds/model"),
				'level' =>'D',
				'bgimg' => '',
				'menu'  => array(
					array(
						'title' => $this->_lang_current['model_list'], //模型管理
						'url'   => base_url("{$this->_webmaster}/moulds/model"),
						'level' => 'D01', //页面权限
						'menu'  => array(
							array(
                                'title' => $this->_lang_current['btn_add_edit'],
                                'level' => 'D0101'
                            ), 
							array(
                                'title' => $this->_lang_current['btn_delete'], 
                                'level' => 'D0102'
                            ),
							array(
								'title' => $this->_lang_current['btn_model_field'], 
								'level' => 'D0103'
							),
							array(
								'title' => $this->_lang_current['btn_create_model'], 
								'level' => 'D0104'
							),
							array(
								'title' => $this->_lang_current['btn_update_model'],
								'level' => 'D0105'
							),
						),
					),
					array( // 字段管理
						'title' => $this->_lang_current['field_title'], 
						'url'   => base_url("{$this->_webmaster}/moulds/field"),
						'level' =>'D02',
						'menu'  =>array(
							array(
                                'title' => $this->_lang_current['btn_add_edit'],
                                'level' => 'D0201'
                            ), // 按钮功能配置
							array(
                                'title' => $this->_lang_current['btn_delete'], 
                                'level' => 'D0202'
                            ),
						),
					),
				),
			),

			array(
				'title' => $this->_lang_current['extend_title'],
				'url'   => base_url("{$this->_webmaster}/extends/flinks"),
				'level' => 'E',
				'bgimg' => '',
				'menu'  => array(
					array( // 友链组
						'title' => $this->_lang_current['flinkg_title'], //友链组
						'url'   => base_url("{$this->_webmaster}/extends/flinkg"),
						'level' => 'E01', //页面权限
						'menu'  => array(
							array(
                                'title' => $this->_lang_current['btn_add_edit'], 
                                'level' => 'E0101'
                            ), 
							array(
                                'title' => $this->_lang_current['btn_delete'], 
                                'level' => 'E0102'
                            ),
						),
					),

					array( // 友链
						'title' => $this->_lang_current['flink_title'], 
						'url'   => base_url("{$this->_webmaster}/extends/flinks"),
						'level' => 'E02',
						'menu'  => array(
							array(
                                'title' => $this->_lang_current['btn_add_edit'], 
                                'level' => 'E0201'
                            ), 
							array(
                                'title' => $this->_lang_current['btn_delete'], 
                                'level' => 'E0202'
                            ),
						),
					),
					 array( // 广告组
						'title' => $this->_lang_current['adg_title'],
						'url'   => base_url("{$this->_webmaster}/extends/adg"),
						'level' => 'E03', //页面权限
						'menu'  => array(
							array(
                                'title' => $this->_lang_current['btn_add_edit'], 
                                'level' => 'E0301'
                            ),
							array(
                                'title' => $this->_lang_current['btn_delete'], 
                                'level' => 'E0302'
                            ),
						),
					),

					array( // 广告
						'title' => $this->_lang_current['ad_title'], 
						'url'   => base_url("{$this->_webmaster}/extends/adverts"),
						'level' =>'E04',
						'menu'  =>array(
							array(
                                'title' => $this->_lang_current['btn_add_edit'], 
                                'level' => 'E0401'
                            ), 
							array(
                                'title' => $this->_lang_current['btn_delete'], 
                                'level' => 'E0402'
                            ),
                            array(
                                'title' => $this->_lang_current['btn_ad_status'], 
                                'level' => 'E0403'
                            ),
						),
					),
					array( // 标签组
						'title' => $this->_lang_current['tagg_title'],
						'url'   => base_url("{$this->_webmaster}/extends/tagg"),
						'level' => 'E05', //页面权限
						'menu'  => array(
							array(
                                'title' => $this->_lang_current['btn_add_edit'], 
                                'level' => 'E0501'
                            ),
							array(
                                'title' => $this->_lang_current['btn_delete'], 
                                'level' => 'E0502'
                            ),
						),
					),
                    // 标签管理
					array(
						'title' => $this->_lang_current['tag_title'], 
						'url'   => base_url("{$this->_webmaster}/extends/tags"),
						'level' =>'E06',
						'menu'  =>array(
							array(
                                'title' => $this->_lang_current['btn_add_edit'], 
                                'level' => 'E0601'
                            ),
							array(
                                'title' => $this->_lang_current['btn_delete'], 
                                'level' => 'E0602'
                            ),
						),
					),
                    // 内链管理
//					array( 
//						'title' => $this->_lang_current['nlink_title'],
//						'url'   => base_url("{$this->_webmaster}/extends/nlink"),
//						'level' => 'E07', 
//						'menu'  => array(
//							array(
//                                'title' => $this->_lang_current['btn_add_edit'], 
//                                'level' => 'E0701'
//                            ), 
//							array(
//                                'title' => $this->_lang_current['btn_delete'], 
//                                'level' => 'E0702'
//                            ),
//						),
//					),

					array( // 评论管理
						'title' => $this->_lang_current['comment_title'], 
						'url'   => base_url("{$this->_webmaster}/extends/comments"),
						'level' => 'E08',
						'menu'  => array( 
                            array(
                                'title' => $this->_lang_current['btn_delete'], 
                                'level' => 'E0902'
                            ),
							array(
                                'title' => $this->_lang_current['btn_comment_status'], 
                                'level' => 'E0803'
                            ),
						),
					),

					array( // 资源管理
						'title' => $this->_lang_current['resource_title'], 
						'url'   => base_url("{$this->_webmaster}/extends/resources"),
						'level' => 'E09',
						'menu'  => array(
                            array(
                                'title' => $this->_lang_current['btn_delete'], 
                                'level' => 'E0902'
                            ),
						),
					),
				),
			),
            //商城
            /*
            array(
                'title' => $this->_lang_current['mall_title'],
                'url'   => base_url("{$this->_webmaster}/mall/orders"),
                'level' =>'F',
				'bgimg' => '',
				'menu'  => array(
					array(
						'title' => $this->_lang_current['order_title'],
						'url'   => base_url("{$this->_webmaster}/mall/orders"),
						'level' => 'F01', //页面权限
						'menu'  => array(
							array(
                                'title' => $this->_lang_current['btn_add_edit'], 
                                'level' => 'F0901'
                            ),
							array(
                                'title' => $this->_lang_current['btn_comment_status'], 
                                'level' => 'F0903'
                            ),
						),
					),
				),
            ),
            */
			/*
			array(
				'title' => '插 件',
				'url' => '/back/plug',
				'level'=>'F',
				'bgimg' => '',
				'menu'  => array(
					array(
						'title'=>'插件管理',
						'url' => '/back/plug',
						'level' => 'D01', //页面权限
						'menu' => array(
							array('title' => '添加编辑', 'level' => 'D0101'), //按钮功能配置
							array('title' => '删除字段', 'level' => 'D0102'),
							array('title' => '字段管理', 'level' => 'D0103'),
							array('title' => '保存模型', 'level' => 'D0104'),
							array('title' => '更新表', 'level' => 'D0105'),
						),
					),
				),
			),
			*/
            
			array(
				'title' => $this->_lang_current['wechat'],
				'url'   => base_url( $this->_webmaster . '/wechat/material'), // 微信素材
				'level' => 'W',
				'bgimg' => '',
				'menu'  => array(
					array(
						'title' => $this->_lang_current['material_title'],
						'url'   => base_url( $this->_webmaster . '/wechat/material'),
						'level' => 'W01', //页面权限
						'menu'  => array(
							array('title' => $this->_lang_current['btn_add_edit'], 'level' => 'W0101'),
							array('title' => $this->_lang_current['btn_delete'], 'level' => 'W0102'),
						),
					),
                    array(
						'title'=> $this->_lang_current['message_title'],
						'url' => base_url($this->_webmaster . '/wechat/autoreply'),
						'level' => 'W03', //页面权限
						'menu' => array(
							array('title' => '用户分组', 'level' => 'W0101'), //按钮功能配置
							array('title' => '删除字段', 'level' => 'W0102'),
						),
					),
					array(
						'title'=>'自定义菜单',
						'url' => '/back/wxmenu',
						'level' => 'W05', //页面权限
						'menu' => array(
							array('title' => '菜单列表', 'level' => 'W0501'),
							array('title' => '添加菜单', 'level' => 'W0502'),
						),
					),
					array(
						'title'=>'客服管理',
						'url' => '/back/kfaccount',
						'level' => 'W06', //页面权限
						'menu' => array(
							array('title' => '客服列表', 'level' => 'W0601'),
							array('title' => '添加修改客服', 'level' => 'W0602'),
							array('title' => '删除', 'level' => 'W0603'),
						),
					),
				),
			),
		);
	}
    /**
     * 用户中心功能
     * @access
     * @var type 
     * $return array
     */
    public function set_manage_menus(){
        return array(
            array(
                'title' => $this->_lang_current['article_title'], //功能导航分类
                'url'   => base_url('manage/accounts/article'),
                'level' => 'M',
                'bgimg' => '/style/manage/img/icon/icon1.png', //导航的样式图片
                'menu'  => array(
                    array(
                        'title' => $this->_lang_current['public_article_title'],
                        'url'   => base_url('manage/accounts/article'),
                        'level' => 'M01', //页面权限，也就是列表权限
                        'menu'  => array(
                            //array('title' => '', 'level' => ''), //按钮功能配置
                        ),
                    ),
                    array(
                       'title'  => $this->_lang_current['collection_article_title'],
                        'url'   => base_url('manage/accounts/collection'),
                        'level' => 'M02', //页面权限，也就是列表权限
                        'menu'  => array(
                            //array('title' => '', 'level' => ''), //按钮功能配置
                        ), 
                    ),
//                    array(
//                       'title'  => $this->_lang_current['message_article_title'],
//                        'url'   => base_url('manage/accounts/message'),
//                        'level' => 'M03', //页面权限，也就是列表权限
//                        'menu'  => array(
//                            //array('title' => '', 'level' => ''), //按钮功能配置
//                        ), 
//                    ),
                ),
            ),
            array(
                'title' => $this->_lang_current['account_title'], //功能导航分类
                'url'   => base_url('manage/accounts/user'),
                'level' => 'N',
                'bgimg' => '/style/manage/img/icon/icon4.png', //导航的样式图片
                'menu'  => array(
                    array(
                        'title' => $this->_lang_current['info_title'],
                        'url'   => base_url('manage/accounts/user/information'),
                        'level' => 'N01', //页面权限，也就是列表权限
                        'menu'  => array(
                            //array('title' => '', 'level' => ''), //按钮功能配置
                        ),
                    ),
                    array(
                       'title'  => $this->_lang_current['safe_title'],
                        'url'   => base_url('manage/accounts/user/safe'),
                        'level' => 'N02', //页面权限，也就是列表权限
                        'menu'  => array(
                            //array('title' => '', 'level' => ''), //按钮功能配置
                        ), 
                    ),
                    array(
                       'title'  => $this->_lang_current['binding_title'],
                        'url'   => base_url('manage/accounts/user/binding'),
                        'level' => 'N03', //页面权限，也就是列表权限
                        'menu'  => array(
                            //array('title' => '', 'level' => ''), //按钮功能配置
                        ), 
                    ),
                    array(
                       'title'  => $this->_lang_current['address_title'],
                        'url'   => base_url('manage/accounts/address'),
                        'level' => 'N04', //页面权限，也就是列表权限
                        'menu'  => array(
                            //array('title' => '', 'level' => ''), //按钮功能配置
                        ), 
                    ),
                ),
            ),
            array(
                'title' => $this->_lang_current['newhelp_title'], //功能导航分类
                'url'   => base_url('manage/help/newhelp'),
                'level' => 'O',
                'bgimg' => '/style/manage/img/icon/icon2.png', //导航的样式图片
                'menu'  => array(
                    array(
                       'title'  => $this->_lang_current['help_article_title'],
                        'url'   => base_url('manage/help/article'),
                        'level' => 'O01', //页面权限，也就是列表权限
                        'menu'  => array(
                            //array('title' => '', 'level' => ''), //按钮功能配置
                        ), 
                    ),
                    array(
                       'title'  => $this->_lang_current['opinion_title'],
                        'url'   => base_url('manage/help/opinion'),
                        'level' => 'O02', //页面权限，也就是列表权限
                        'menu'  => array(
                            //array('title' => '', 'level' => ''), //按钮功能配置
                        ), 
                    ),
                ),
            ),
        );
    }
    /**
     * 取得实例
     *
     * @return NavPanel
     */
    public static function getInstance() {

        if (!(self::$_instance instanceof self)) {
            $className = __CLASS__;
            self::$_instance = new $className();
        }

        return self::$_instance;
    }
    
    /**
     * 构造函数
     */
    public function __construct() {
        
        $this->_ci = & get_instance();
		
		$this->_ci->lang->load($this->_lang_path,'chinese');
		$this->_lang_current = $this->_ci->lang->language;
    }
    
    /**
     * 取得列表菜单
     * @param type $navType
     * @param type $activeModule
     * @return array
     */
    public function get_menus($activeModule = '',$level = 'A01') {
        
        $item 	= array();
        $nav 	= array();
        $minNav = array();
        foreach ($this->set_menus() as $cate){
            if(substr($level, 0,1) == $cate["level"]){
                $nav = $cate["menu"];
                array_push($minNav, array("url"=>$cate['url'],'title'=>$cate['title']));
                
                foreach($cate['menu'] as $v){
                    if($level == $v['level']){
                        array_push($minNav, array("url"=>$v['url'],'title'=>$v['title']));
                    }
                }
            }
            unset($cate["menu"]);
            array_push($item, $cate);
            
            
        }
        
        $data['items'] = $item;
        $data["nav_items"] = $nav;
        $data['min_nav'] = $minNav;
        unset($item, $nav, $minNav);
        return $data;
    }
    /**
     * 获取到用户功能
     * @param type $activeModule
     * @param type $level
     * @return array
     */
    public function get_manage_menus($activeModule, $level = 'A01'){
        $item 	= array();
        $nav 	= array();
        $minNav = array();
        foreach ($this->set_manage_menus() as $row => $cate){
            if(substr($level, 0,1) == $cate["level"]){
                $nav = $cate["menu"];
                array_push($minNav, array("url"=>$cate['url'],'title'=>$cate['title']));
                
                foreach($cate['menu'] as $v){
                    if($level == $v['level']){
                        array_push($minNav, array("url"=>$v['url'],'title'=>$v['title']));
                    }
                }
            }
            //unset($cate["menu"]);
            array_push($item, $cate);
            //$item['nav'] = $nav;
        }
        
        $data['item'] = $item;
        //$data["nav"] = $nav;
        $data['minNav'] = $minNav;
        return $data;
    }

    public function getAllMenu(){
        return $this->menu;
    }

   /**
    * 检查用户是否有合法的操作权限
    * 如果没有权限 直接die('{"":""}');成功则返回true
    * 如果在组权限中有判断到权限就直接返回。如果组权限没有判断到就再判断用户权限。这样就可以给管理员设置超出组的部分权限
    *
    * @param  $level 需要判断的权限值
    * @return boolean 成功返回true 没有权限直接die成json数据
    */
    public function checkPrem($reak) {
        
        // 先判断组权限
        if (!$this->checkGroupPrem($reak)) {
            // 判断用户权限
            if (!$this->checkAccountPrem($reak)){
                return false;
                //RKit::printJson(array('code'=>401,'msg'=>'没有权限操作'));
            }
               
        }
        return true;
    }
    /**
     * 检查用户的操作权限
     *
     * @param  $level 要验证的用户权限
     * @return boolean 成功返回true 失败返回false
     */
    public function checkAccountPrem($level) {
        
        // 在session里面的当前用户拥有的权限
        $ulevel = $_SESSION['admin']['info']['userRoleAccess'];
        // 超级管理员权限直接用特殊常量SUPERADMIN标记，拥有所有权限，如果匹配到直接返回true
        if (in_array(SUPER_ADMIN, $ulevel)) {
            return true;
        }
        // 判断权限
        if (in_array($level, $ulevel)) return true;
        return false;
    }

    /**
     * 检查用户所在组的权限
     *
     * @param  $level 需要判断的权限值
     * @param  $_SESSION ['admin']['group_id'] 所在组ID 在登陆时保存在session中
     * @return boolean 有权限返回true 没有权限返回 false
     */
    function checkGroupPrem($level) {
        
        $group_level = $_SESSION['admin']['info']['userRoleAccess'];
        if (in_array(SUPER_ADMIN, $group_level)) {
            return true;
        }
        
        // 判断权限
        if (in_array($level, $group_level)) return true;
        return false;
    }
}


/* End of file TZ_NavPanel.php */
/* Location: ./application/libraries/TZ_NavPanel.php */