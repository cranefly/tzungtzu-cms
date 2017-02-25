create table if not exists `tz_sys_configs`(
 `id` int(11) unsigned not null auto_increment comment '配置id',
 `title` varchar(100) not null default '' comment '配置项',
 `ckey` varchar(100) not null default '' comment '配置key',
 `cvalue` varchar(500) not null default '' comment '配置值',
 `tag` varchar(50) not null default '' comment '配置标签(兼分组功能)',
 `field_type` varchar(50) not null default '' comment '表单类型',
 `comment` varchar(300) not null default '' comment '字段特殊说明',
 `is_system` tinyint(2) not null default 1 comment '是否是系统配置，0=系统，1=自定义',
 `cdate` int(11) not null default 0 comment '创建时间',
 primary key (`id`),
 index `ckey` (`ckey`),
 index `tag` (`tag`)
)engine=InnoDB default charset=utf8 comment '配置表';

create table if not exists `tz_cms_category` (
 `id` int(11) unsigned not null auto_increment comment '类别id',
 `parent_id` int(11) not null default 0 comment '父类id',
 `cname` varchar(100) not null default '' comment '分类名称',
 `cname_py` varchar(200) not null default '' comment '分类字母别名',
 `cnick` varchar(100) not null default '' comment '分类别名',
 `ctitle` varchar(100) not null default '' comment 'SEO标题',
 `ckey` varchar(200) not null default '' comment 'SEO关键词',
 `cdesc` varchar(400) not null default '' comment 'SEO描述',
 `forder` int(4) not null default 100 comment '分类排序',
 `tpl_index` varchar(50) not null default '' comment  '封面模板',
 `tpl_list` varchar(50) not null default '' comment  '列表变量模板',
 `tpl_content` varchar(50) not null default '' comment  '内容页模板',
 `model_id` int(4) not null default 0 comment '绑定模型ID',
 `nav_show` tinyint(2) not null default 0 comment '主导航显示，0=不显示，1=显示',
 `nav_show_wap` tinyint(2) not null default 0 comment 'wap端主导航显示，0=不显示，1=显示',
 `clogo` varchar(200) not null default '' comment '分类LOGO图',
 `clogo_hover` varchar(200) not null default '' comment '分类替换图',
 `cintro` varchar(1000) not null default '' comment '分类简介',
 `go_url` varchar(200) not null default '' comment '跳转URL',
 `cdomain` varchar(50) not null default '' comment '绑定域名',
 `ad_id` int(11) not null default 0 comment '绑定广告id',
 `extern` text not null default '' comment '扩展数据，json格式',
 `tags` varchar(50) not null default '' comment '关联标签组ID,如：1,3,7',
 `articles` int(8) not null default 0 comment '文章总数',
 `visitors` int(8) not null default 0 comment '浏览总数',
 `cdate` int(11) not null default 0 comment '创建时间',
 primary key (`id`),
 index `parent_id` (`parent_id`),
 index `model_id` (`model_id`)
) engine=InnoDB default charset=utf8 comment '分类表';

create table if not exists `tz_sys_resources` (
 `id` int(11) unsigned not null auto_increment comment '资源',
 `user_id` int(11) not null default 0 comment '用户id',
 `wechat_id` int(11) not null default 0 comment '微信号id',
 `url` varchar(200) not null default '' comment '资源地址', 
 `width` int(11) not null default 0 comment '资源宽度',
 `height` int(11) not null default 0 comment '资源高度',
 `size` int(11) not null default 0 comment '资源大小',
 `oname` varchar(200) not null default '' comment '原文件名，带后缀',
 `type` varchar(10) not null default '' comment '类型',
 `content` varchar(128) not null default '' comment 'md5的图片内容',
 `tag` varchar(64) not null default '' comment '标签',
 `media_id` varchar(200) not null default '' comment '微信素材id',
 `cdate` int(11) not null default 0 comment '创建时间',
 primary key (`id`),
 index `url` (`url`),
 index `tag` (`tag`),
 index `content` (`content`),
 index `media_id` (`media_id`)
) engine=InnoDB default charset=utf8 comment '资源表';

create table if not exists `tz_sys_resource_info`(
 `id` int(11) unsigned not null auto_increment,
 `info_id` int(11) not null default 0 comment '信息ID',
 `model_id` int(11) not null default 0 comment '模型ID',
 `resource_id` int(11) not null default 0 comment '资源id',
 `cdate` int(11) not null default 0 comment '关联时间',
 primary key(`id`),
 index `res_info_model` (`info_id`,`resource_id`,`model_id`)
)engine=InnoDB default charset=utf8 comment '信息资源关系表';

-- 推荐位必须推荐同一种模型的数据
create table if not exists `tz_cms_recommend` (
 `id` int(11) unsigned not null auto_increment comment '推荐位ID',
 `title` varchar(100) not null default '' comment '位置标题',
 `url` varchar(100) not null default '' comment '跳转地址',
 `area_html` text not null  comment '描述文本',
 `area_remarks` varchar(1000) not null default '' comment '备注',
 `forder` int(4) not null default 100 comment '排序',
 `area_logo` varchar(200) not null default '' comment '位置LOGO图',
 `id_list` varchar(2000) not null default '' comment '文档ID列表，用逗号分割',
 `model_id` int(11) not null default 0 comment '模型ID',
 primary key (`id`),
 index `forder` (`forder`),
 index `list_model` (`id_list`,`model_id`)
) engine=InnoDB default charset=utf8 comment '推荐位置';

-- 专题
create table if not exists `tz_cms_special` (
 `id` int(11) unsigned not null auto_increment comment '专题ID',
 `title` varchar(100) not null default '' comment '主标题',
 `sub_title` varchar(500) not null default '' comment '副标题',
 `desc` varchar(1000) not null default '' comment '说明',
 `url` varchar(100) not null default '' comment '跳转地址',
 `numb` varchar(100) not null default '' comment '期号',
 `special_html` text not null  comment 'HTML或者描述文本',
 `remarks` varchar(1000) not null default '' comment '备注',
 `forder` int(4) not null default 100 comment '排序',
 `logo` varchar(200) not null default '' comment '专题LOGO图',
 `bg_img` varchar(100) not null default '' comment ' 背景图',
 `bg_color` varchar(20) not null default '' comment ' 背景色',
 `id_list` varchar(2000) not null default '' comment '文档ID列表，用逗号分割',
 `model_id` tinyint(2) not null default 0 comment '模型ID',
 `cdate` int(11) not null default 0 comment '创建时间',
 primary key (`id`),
 index `list_model` (`id_list`,`model_id`)
) engine=InnoDB default charset=utf8 comment '专题';

-- 广告位表
create table if not exists `tz_ad_group` (
 `id` int(11) unsigned not null auto_increment,
 `title` varchar(255) not null default '' comment '位置名称',
 `remark` varchar(1000) not null default '' comment '位置标注',
 `identification` varchar(100) NOT NULL DEFAULT '' COMMENT '标识',
 primary key (`id`)
) engine=InnoDB default charset=utf8 comment '广告位';

-- 广告列表
create table if not exists `tz_ads` (
 `id` int(11) unsigned not null auto_increment,
 `g_id` int(11) not null default 0 comment '广告位',
 `show_type` int(11) not null default 0 comment '展现方式, 0=代码,1=文字,2=图片,3=flash',
 `ad_title` varchar(255) not null default '' comment '广告主标题',
 `ad_nav_title` varchar(555) not null default '' comment '广告子标题',
 `ad_words` varchar(255) not null default '' comment '文字',
 `ad_img` text not null default '' comment '图片URL',
 `ad_url` text not null default '' comment '广告URL',
 `ad_code` text not null default '' comment '广告代码',
 `start_date` int(11) not null default 0 comment '生效时间',
 `expire_date` int(11) not null default 0 comment '到期时间',
 `cdate` int(11) not null default 0 comment '创建时间',
 `forder` int(4) not null default 0 comment '排序',
 primary key (`id`),
 index `g_id` (`g_id`)
) engine=InnoDB default charset=utf8 comment '广告表';

create table if not exists `tz_sys_model` (
 `id` int(11) unsigned not null auto_increment comment '模型ID',
 `mtitle` varchar(100) not null default '' comment '模型标题',
 `mname` varchar(100) not null default '' comment '扩展模型表名',
 `cmid` varchar(100) not null default 0 comment '模型子表的ID',
 `mtype` tinyint(2) not null default 0 comment '模型类型0=扩展，1=独立',
 `attr_content` text not null  comment '扩展属性，JSON格式数据[{"lable":"颜色","name":"color","type":"text/checkbox/radio/select/editor/date","value":["红色","蓝色"],”field_type”:”varchar(100) int(11) ”},...]',
 `forder` int(4) not null default 0 comment '排序',
 primary key (`id`),
 index `cmid` (`cmid`)
) engine=InnoDB default charset=utf8 comment '扩展模型';

create table if not exists `tz_sys_fields` (
 `id` int(11) unsigned not null auto_increment comment '字段ID',
 `pfid` int(11) not null default 0 comment '父字段id(联动功能)',
 `title` varchar(50) not null default '' comment '字段文字(如：标题)',
 `field` varchar(50) not null default '' comment '字段名称（表的字段名，如：title）',
 `attribute` varchar(100) not null default '' not null comment '字段类型SQL,如：varchar(100)',
 `form_type` varchar(100) not null default '' not null comment '表单类型(input ,textarea等)',
 `dvalue` varchar(100) not null default '' not null comment '默认值',
 `fdesc` varchar(100) not null default '' not null comment '表单说明',
 `field_remark` tinyint(3) not null default 0 not null comment '表单备注，比如不能为空等 0=无，1=不能为空 2=是数字 3=手机号 4=邮箱地址 5=身份证号 6=QQ号 7=银行卡号,可以自定义添加正则等',
 `forder` int(3) not null default 100 comment '字段显示排序',
 `is_system` int(3) not null default 1 comment '是否为系统字段，0=系统字段 ，1=扩展字段',
 `field_tag` varchar(20) not null default '' comment '标签',
 `antistop`  varchar(50) NOT NULL default '' comment '关键词',
 `display`  tinyint(2) NOT NULL default 0 comment '列表是否显示',
 primary key (`id`),
 index `pfid` (`pfid`)
) engine=InnoDB default charset=utf8 comment '模型字段';

-- 字段选用表 可以实现 分类 子分类的字段控制
create table if not exists `tz_sys_fields_picklist` (
 `id` int(11) unsigned not null auto_increment comment 'ID',
 `fid` int(11) not null default 0 comment '字段Id',
 `pid` int(11) not null default 0 comment '父值Id',
 `pname` varchar(50) not null default '' comment '文字',
 `pvalue` int(4) not null default 0 comment '字段值',
 `forder` int(4) not null default 100 comment '排序',
 primary key (`id`),
 index `pid` (`pid`),
 index `fid` (`fid`)
)engine=InnoDB default charset=utf8 comment '字段值选用表';

-- 模型字段关系表
create table if not exists `tz_sys_model_fields`(
 `id` int(11) unsigned not null auto_increment comment 'id',
 `model_id` int(11) not null default 0 comment '模型Id',
 `field_id` int(11) not null default 0 comment '字段Id',
 `forder` tinyint(4) not null default 0 comment '排序',
 primary key (`id`),
 index `m_f_rel` (`model_id`,`field_id`)
)engine=InnoDB default charset=utf8 comment '模型字段关系表';

create table if not exists `tz_flink_group` (
 `id` int(11) unsigned not null auto_increment comment '友情ID',
 `gname` varchar(100) not null default '' comment '组名称',
 `gimg` varchar(500) not null default '' comment '组图片',
 `gurl` varchar(500) not null default '' comment '地址',
 `forder` int(4) default 100 comment '排序',
 primary key(`id`)
)engine=InnoDB default charset=utf8 comment '友情链接组表';

-- 友链
create table if not exists `tz_flink` (
 `id` int(11) unsigned not null auto_increment comment '友情ID',
 `group_id` int(11) default 0 comment'友链组id',
 `flink_name` varchar(100) not null default '' comment '链接文字',
 `flink_img` varchar(500) not null default '' comment '链接图片',
 `flink_url` varchar(500) not null default '' comment '链接地址',
 `flink_is_site` int(2) default 0 comment '0=首页，1代表全站',
 `forder` int(4) default 100 comment '排序',
 `owner` varchar(100) default '' comment '所有者名称',
 primary key(`id`),
 index `g_id` (`group_id`)
)engine=InnoDB default charset=utf8 comment '友情链接表';

-- 内链
create table if not exists `tz_flink_nlink`(
  `id` int(11) unsigned not null auto_increment comment '内链ID',
  `nlink_txt` varchar(100)  not null default '' comment '名称',
  `nlink_url` varchar(500)  not null default '' comment '网址',
  `target` tinyint(2) default 0 comment '打开方式 0=当前页面 1=新页面等',
  `forder` int(4) default 100 comment '排序',
  `cdate` int(11) not null default 0 comment '创建时间',
   primary key(`id`),
   index `nlink_txt` (`nlink_txt`)
)engine=InnoDB default charset=utf8 comment '正文內链词表';

-- 评论
create table if not exists `tz_cms_comment` (
  `id` int(11) unsigned not null auto_increment comment '评论id',
  `info_id` int(11) not null default 0 comment '信息ID',
  `model_id` int(11) not null default 0 comment '模型ID',
  `content` varchar(500) not null default '' comment '评论内容',
  `cdate` int(11) not null default 0 comment '发布时间',
  `uid` int(11) not null default 0 comment '用户id',
  `uname` varchar(100) not null default '' comment '昵称',
  `avator` varchar(500) not null default '' comment '头像',
  `ip` varchar(20) not null default 0 comment 'ip地址',
  `ip_addr` varchar(200) not null default '' comment '地理位置',
  `parent_id` int(11) not null default 0 comment '上级id',
  `is_check` int(1) not null default 1 comment '是否审核',
  `son` int(11) not null default 0 comment '子评论数',
  `good` int(11) not null default 0 comment '赞',
  `bad` int(11) not null default 0 comment '踩',
  `reply` varchar(1000) not null default '' comment '评论管理员回复',
  `reply_id` int(11) not null default 0 comment '回复人id',
  `reply_name` varchar(100) not null default '' comment '回复人昵称',
  `reply_avator` varchar(500) not null default '' comment '回复人头像',
  primary key  (`id`),
  index `info_mdoel` (`info_id`,`model_id`),
  index `good` (`good`),
  index `bad` (`bad`)
) engine=InnoDB default charset=utf8 comment '评论表';

-- 标签组
create table if not exists `tz_cms_tag_group` (
 `id` int(11) unsigned not null auto_increment comment '标签组id',
 `gname` varchar(100) not null default '' comment '标签组名称',
 `gurl` varchar(100) not null default '' comment '链接地址',
 `gimg` varchar(200) not null default '' comment 'logo图',
 `remark` varchar(500) default '' comment'说明',
 `forder` int(4) default 100 comment'排序',
 primary key(`id`)
)engine=InnoDB default charset=utf8 comment '标签组表';

-- 标签
create table if not exists `tz_cms_tag` (
 `id` int(11) unsigned not null auto_increment comment '标签ID',
 `group_id` int(11) default 0 comment'组id',
 `tag` varchar(100) not null default '' comment '标签',
 `tag_img` varchar(200) not null default '' comment 'logo图',
 `tag_url` varchar(100) not null default '' comment '跳转地址',
 `forder` int(4) default 100 comment'排序',
 primary key(`id`),
 index `group_id` (`group_id`),
 index `tag` (`tag`),
 index `forder` (`forder`)
)engine=InnoDB default charset=utf8 comment '标签表';

-- 用户喜欢记录表
create table if not exists `tz_user_like` (
 `id` int(11) unsigned not null auto_increment,
 `uid` int(11) not null default 0 comment '用户ID',
 `model_id` int(11) not null default 0 comment '模型',
 `info_id` int(11)  not null default 0 comment '信息id',
 `cdate` int(11) not null default 0 comment '时间',
 `likes` int(5) not null default 0 comment '喜欢次数',
 primary key (`id`),
 index `u_m_i` (`uid`,`model_id`,`info_id`)
) engine=InnoDB default charset=utf8 comment '喜欢的文章表';

-- 收藏记录表
create table if not exists `tz_user_collect` (
 `id` int(11) unsigned not null auto_increment,
 `uid` int(11) not null default 0 comment '用户ID',
 `model_id` int(11) not null default 0 comment '模型',
 `info_id` int(11)  not null default 0 comment '信息id',
 `cdate` int(11) not null default 0 comment '时间',
 primary key (`id`),
 index `u_m_i` (`uid`,`model_id`,`info_id`)
) engine=InnoDB default charset=utf8 comment '会员收藏信息表';

-- 系统信息表
create table if not exists `tz_sys_message` (
  `id` int(11) unsigned not null auto_increment,
  `is_check` tinyint(2) not null default '0' comment '审核状态',
  `uid` int(11) not null default 0 comment '用户ID',
  `cdate` int(11) not null default '0' comment '创建时间',
  `name` varchar(50) not null default '' comment '联系人',
  `phone` varchar(50) not null default '' comment '联系电话',
  `content` varchar(2000) not null default '' comment '留言内容',
  `qq` varchar(50) not null default '' comment '联系人QQ',
  `gender` varchar(6) not null default '' comment '联系性别',
  `reply` varchar(1000) not null default '' comment '管理员回复留言',
  `reply_id` int(11) not null default 0 comment '回复人id',
  `reply_name` varchar(100) not null default '' comment '回复人昵称',
  primary key  (`id`),
  index `phone` (`phone`)
) engine=InnoDB default charset=utf8 comment '留言表';

-- 系统快捷链接表
create table if not exists `tz_sys_quick_link` (
  `id` int(11) unsigned not null auto_increment,
  `uid` int(11) not null default 0 comment '用户ID',
  `cdate` int(11) not null default '0' comment '创建时间',
  `link` varchar(256) not null default '' comment '链接',
  `forder` int(4) not null default '0' comment '排序',
  primary key  (`id`),
  index `uid` (`uid`)
) engine=InnoDB default charset=utf8 comment '系统快捷链接表';

-- 订单记录表
create table if not exists `tz_user_order`(
  `id` int(11) not null auto_increment comment '订单id', 
  `out_trade_no` varchar(56) not null default '' comment '外部支付单号',
  `trade_no` varchar(50) not null default '' comment '本站订单号 唯一',
  `uid` int(11) not null default 0 comment '用户id', 
  `model_id` int(11) not null default 0 comment '模型',
  `info_id` int(11)  not null default 0 comment '信息id',
  `price` double not null default 0 comment '单价',
  `amount` int(8) not null default 0 comment '数量',
  `pay_type` int(11) not null default 0 comment '支付方式（支付宝=1，微信=2）',
  `order_state` int(11) not null default 0 comment '订单状态(0=等待付款,1=已经付款，等待发货,2=已发货，等待确认收货,3=交易成功)', 
  `invoice_number` varchar(100) not null default '' comment '发货单号',
  `consignee` varchar(60) not null comment '收货人的姓名',
  `address` varchar(255) not null comment '收货人的详细地址',
  `mobile` varchar(60) not null comment '收货人的手机',
  `telphone` varchar(50) not null default '' comment '电话号码',
  `email` varchar(60) not null comment '收货人的邮箱',
  `postscript` varchar(255) not null comment '订单附言',
  `tohours` varchar(50) not null default '' comment '送到时间段',
  `shipping_id` tinyint(3) not null DEFAULT '0' comment '用户选择的配送方式id，取值表_shipping',
  `shipping_name` varchar(120) not null comment '用户选择的配送方式的名称，取值表_shipping',
  `shipping_fee` int(11) not null default 0  comment '配送费用',
  `is_gift` smallint(5) unsigned not null DEFAULT '0' comment '是否有优惠 0=无，1=有',
  `gift_id` smallint(5) unsigned not null DEFAULT '0' comment '优惠id',
  `gift_detail`  varchar(120) not null default '' comment '优惠说明',
  `gift_price`  double not null default '0' comment '优惠金额',
  `order_cate` int(4) not null default 0 comment '订单分类', 
  `order_money_count` decimal(11,2) not null default 0 comment '总计（单价*数量+配送费-优惠）',
  `create_time` int(11) not null default 0 comment '订单创建时间',
  `pay_time_complete` int(11) not null default 0 comment '完成付款时间',
  primary key (`id`),
  index `idx_uid`(`uid`),
  index `idx_model_info`(`model_id`, `info_id`),
  index `idx_trade_no`(`trade_no`),
  index `idx_out_trade_no`(`out_trade_no`)
)engine=InnoDB default charset=utf8 comment='订单记录表';

-- 收货地址表
create table if not exists `tz_user_address`(
  `id` int(11) not null auto_increment comment '地址id', 
  `uid` int(11) not null default 0 comment '用户id', 
  `country` varchar(36) not null default '' comment '国家',
  `province` varchar(36) not null default '' comment '省',
  `city` varchar(36) not null default '' comment '市',
  `district` varchar(36) not null default '' comment '区县',
  `address` varchar(255) not null default '' comment '收货地址',
  `contact` varchar(20) not null default '' comment '联系人',
  `cellphone` varchar(20) not null default '' comment '手机号',
  `tel` varchar(50) not null default '' comment '电话号码',
  `postcode` varchar(20) not null default '' comment '邮政编码',
  `email` varchar(20) not null default '' comment '邮箱',
  `is_default` tinyint(2) not null default 0 comment '是否为默认收货地址',
  `cdate` int(11) not null default 0 comment '创建时间',
  `update_time` int(11) not null default 0 comment '修改时间',
  primary key (`id`),
  index `uid` (`uid`)
)engine=InnoDB default charset=utf8 comment='收货地址表';

create table if not exists `tz_wechat_reply`(
 `id` int(11) unsigned not null auto_increment comment 'id',
 `keyword` varchar(256) not null default '' comment '关键字',
 `type` tinyint(2) not null default 0 comment '回复类型，1=文本，2=链接，3=图片，4=语音',
 `reply` varchar(1000) not null default '' comment '回复内容',
 `url` varchar(1000) not null default '' comment '链接地址',
 `cdate` int(11) not null default 0 comment '创建时间',
 `total` int(11) not null default 0 comment '回复次数',
 primary key (`id`),
 index `keyword` (`keyword`),
 index `type` (`type`)
)engine=InnoDB default charset=utf8 comment '微信自动回复配置';

-- 多图文素材
create table if not exists `tz_wechat_media_more`(
    `id` int(11) unsigned not null auto_increment comment 'id',
    `user_id` int(11) not null default 0 comment '用户id',
    `wechat_id` int(11) not null default 0 comment '微信号id',
    `title` varchar(256) not null default '' comment '标题',
    `content` varchar(100)  not null default '' comment '内容,图文信息内容id,用,分隔，如：1,3,10',
    `cdate` int(11) not null default 0 comment '创建时间',
    `total` int(6) not null default 0 comment '推送次数',
    primary key (`id`),
    index `idx_total` (`total`),
    index `idx_title` (`title`)
)engine=InnoDB default charset=utf8 comment '多图文素材';

-- 公众号图文素材
create table if not exists `tz_wechat_article` (
`id` int(11) unsigned not null auto_increment,
`media_id` varchar(128) not null default '' comment '素材id',
`user_id` int(11) not null default 0 comment '用户id',
`title` varchar(128)  not null default '' comment '标题',
`replay` varchar(56)  not null default '' comment '回复推送关键字',
`cover` varchar(256)  not null default '' comment '封面',
`description` varchar(256)  not null default '' comment '描述',
`content` text  not null comment '内容',
`link` varchar(256)  not null default '' comment '原文链接',
`author` varchar(26)  not null default '' comment '作者',
`visited` int(7)  not null default 1 comment '访问量',
`type` int(4)  not null default 1 comment '类型',
`good` int(7)  not null default 1 comment '点赞数',
`is_public` tinyint(2)  not null default 1 comment '1=不公开，2=公开',
`update_date` int(11) not null default 0 comment '最近更新时间',
`public_date` int(11) not null default 0 comment '最近推送时间',
`cdate` int(11) not null default 0 comment '创建时间',
primary key(`id`),
index `idx_user_id` (`user_id`),
index `idx_title` (`title`),
index `idx_is_public` (`is_public`),
index `idx_media_id` (`media_id`),
index `idx_cdate` (`cdate`)
)engine=InnoDB default charset=utf8 comment '图文素材';

-- 微信图片素材
create table if not exists `tz_wechat_image`(
    `id` int(11) unsigned not null auto_increment comment 'id',
    `user_id` int(11) not null default 0 comment '用户id',
    `wechat_id` int(11) not null default 0 comment '微信号id',
    `material_id` varchar(256) not null default '' comment '图片素材ID',
    `material_url` varchar(256) not null default '' comment '图片素材地址',
    `image_url` varchar(256) not null default '' comment '图片链接地址',
    `name` varchar(256) not null default '' comment '图片名称',
	`type` int(4)  not null default 1 comment '类型',
    `tag` varchar(128)  not null default '' comment '标签',
    `group` varchar(56)  not null default '' comment '分类名称',
    `group_id` int(11)  not null default 0 comment '分类ID',
    `used` int(6) not null default 0 comment '使用次数',
    `is_public` tinyint(2)  not null default 1 comment '1=不公开，2=公开',  
    `cdate` int(11) not null default 0 comment '创建时间',
    primary key (`id`),
    index `idx_used` (`used`),
    index `idx_user_id` (`user_id`),
    index `idx_wechat_id` (`wechat_id`),
    index `idx_group_id` (`group_id`),
    index `idx_group` (`group`),
    index `idx_tag` (`tag`),
    index `idx_user_wechat_id` (`user_id`, `wechat_id`),
    index `idx_cdate` (`cdate`),
    index `idx_name` (`name`)
)engine=InnoDB default charset=utf8 comment '微信图片素材';

-- 微信图片分组
create table if not exists `tz_wechat_image_group`(
    `id` int(11) unsigned not null auto_increment comment 'id',
    `user_id` int(11) not null default 0 comment '用户id',
    `wechat_id` int(11) not null default 0 comment '微信号id',
    `name` varchar(256) not null default '' comment '组名称',
    `total` int(6) not null default 0 comment '图片总数', 
    `cdate` int(11) not null default 0 comment '创建时间',
    primary key (`id`),
    index `idx_total` (`total`),
    index `idx_user_id` (`user_id`),
    index `idx_wechat_id` (`wechat_id`),
    index `idx_cdate` (`cdate`)
)engine=InnoDB default charset=utf8 comment '微信图片素材';

-- 公众号
create table if not exists `tz_wechat` (
 `id` int(11) unsigned not null auto_increment,
 `user_id` int(11) not null default 0 comment '用户id',
 `uuid` char(64) not null default '' comment '唯一标识',
 `name` varchar(100) not null default '' comment '公众号名称',
 `avatar` varchar(256) not null default '' comment '头像',
 `qr_code` varchar(256) not null default '' comment '二维码',
 `account` varchar(64) not null default '' comment '账号',
 `desc` varchar(512) not null default '' comment '简介',
 `auth_status` tinyint(2) not null default 1 comment '1=未认证，2=已认证',
 `customer_tel` varchar(20) not null default '' comment '客服电话',
 `address` varchar(256) not null default '' comment '所在地',
 `subject` varchar(256) not null default '' comment '主体信息',
 `operator` varchar(20) not null default '' comment '运营人员',
 `login_email` varchar(64) not null default '' comment '登录邮箱',
 `original_id` varchar(24) not null default '' comment '原始ID',
 `appid` varchar(64) not null default '' comment 'appid',
 `appsecret` varchar(128) not null default '' comment 'appsecret',
 `service_url` varchar(256) not null default '' comment '服务器地址',
 `token` varchar(32) not null default '' comment 'token',
 `encodingaeskey` varchar(64) not null default '' comment 'EncodingAESKey',
 `encode_type` tinyint(2) not null default 1 comment '1=明文模式,2=兼容模式,3=安全模式',
 `update_time` int(11) not null default 0 comment '最新更新时间',
 `cdate` int(11) not null default 0 comment '创建时间',
 primary key(`id`),
 index `idx_uuid` (`uuid`),
 index `idx_name` (`name`),
 index `idx_token` (`token`),
 index `idx_cdate` (`cdate`)
)engine=InnoDB default charset=utf8 comment '公众号';

-- 用户组
create table if not exists `tz_user_group` (
 `id` int(11) unsigned not null auto_increment,
 `g_name` varchar(100) not null default '' comment '组名称',
 `g_urank` varchar(5000) not null default '' comment '组权限',
 `g_remark` varchar(1000) not null default '' comment '备注',
 `g_discount` float(4) not null default 0 comment '用户组默认折扣',
 `g_state` int(11) not null default 0 comment '组状态（正常=0，停用=1）',
 `cdate` int(11) not null default 0 comment '创建时间',
 `is_admin_g` tinyint(2) not null default 0 comment '0=前台用户组，1=后台用户组',
 primary key(`id`)
)engine=InnoDB default charset=utf8 comment '用户组表';

-- 用户表
create table if not exists `tz_user` (
 `id` int(11) unsigned not null auto_increment,
 `uuid` char(64) not null default '' comment '唯一标识',
 `uname` varchar(100) not null default '' comment '用户名',
 `group_id` int(11) not null default 0 comment '用户所在组id',
 `upass` varchar(100) not null default '' comment '密码',
 `uavatar` varchar(256) not null default '' comment '头像地址',
 `uemail` varchar(100) not null default '' comment '邮箱',
 `uemail_verify` int(1) not null default 0 comment '邮箱是否验证',
 `uqq` varchar(100) not null default '' comment 'QQ',
 `uqq_verify` int(1) not null default 0 comment 'QQ是否验证',
 `uphone` varchar(100) not null default '' comment '手机',
 `uphone_verify` int(1) not null default 0 comment '手机是否验证',
 `true_name` varchar(20) not null default '' comment '真实姓名',
 `uweixin` varchar(50) not null default '' comment '微信',
 `unick` varchar(50) not null default '' comment '昵称',
 `ustate` int(11) not null default 0 comment '用户状态（正常=0，停用=1）',
 `gender` int(2) not null default 0 comment '性别（女=1，男=0）',
 `birth_day` int(11) not null default 0 comment '出生年月日',
 `province` varchar(100) not null default '' comment '省',
 `city` varchar(100) not null default '' comment '城市',
 `area` varchar(100) not null default '' comment '区',
 `address` varchar(500) not null default '' comment '详细地址',
 `motto` varchar(500) not null default '' comment '个性签名',
 `reg_date` int(11) not null default 0 comment '注册日期',
 `reg_ip` varchar(100) not null default '' comment '注册IP地址',
 `upoint` int(10) not null default 0 comment '用户积分',
 `article` int(10) not null default 0 comment '文章数',
 `login_num` int(11) not null default 0 comment '登录次数',
 `last_login_date` int(11) not null default 0 comment '最后登录时间',
 `last_login_ip` varchar(100) not null default '' comment '最后登录IP地址',
 `qqid` varchar(100) not null default '' comment 'QQ绑定字段ID',
 `discount` float(5) not null default 0 comment '会员折扣',
 `rank` varchar(1000) not null default '' comment '用户权限 数据结构 "A10","A11"',
 `is_admin` tinyint(2) not null default 0 comment '0=前台用户组，1=后台用户组',
 `openid` varchar(64) not null default '' comment '微信的openid',
 `unionid` varchar(64) not null default '' comment '微信的unionid',
 `signs` int(4) not null default '0' comment '签到次数',
 `cdate` int(11) not null default 0 comment '创建时间',  
 primary key (`id`),
 index `idx_openid` (`openid`),
 index `idx_uname` (`uname`),
 index `idx_uphone` (`uphone`),
index `idx_cdate` (`cdate`)
) engine=InnoDB default charset=utf8 comment '会员表';

-- 标签组
create table if not exists `tz_cms_tag_group` (
 `id` int(11) unsigned not null auto_increment comment '标签组id',
 `gname` varchar(20) not null default '' comment '标签组名称',
 `gurl` varchar(256) not null default '' comment '链接地址',
 `gimg` varchar(256) not null default '' comment 'logo图',
 `remark` varchar(500) default '' comment'说明',
 `forder` int(4) default 0 comment'排序',
 primary key(`id`)
)engine=InnoDB default charset=utf8 comment '标签组表';

-- 标签
create table if not exists `tz_cms_tag` (
 `id` int(11) unsigned not null auto_increment comment '标签ID',
 `group_id` int(11) default 0 comment'组id',
 `tag` varchar(20) not null default '' comment '标签',
 `tagimg` varchar(256) not null default '' comment 'logo图',
 `tagurl` varchar(256) not null default '' comment '跳转地址',
 `forder` int(4) default 0 comment'排序',
 primary key(`id`),
 index `idx_group_id` (`group_id`),
 index `idx_tag` (`tag`),
 index `idx_forder` (`forder`)
)engine=InnoDB default charset=utf8 comment '标签表';

-- 系统菜单管理
create table if not exists `tz_sys_menu` (
`id` int(11) unsigned not null auto_increment,
`pid` int(11) default 0 comment '父id',
`title` varchar(20) not null default '' comment '菜单标题',
`url` varchar(56) not null default '' comment '系统链接地址，不包括域名',
`icon` varchar(128) not null default '' comment '菜单图标',
`display` tinyint(2) not null default 1 comment '1=显示，2=隐藏',
`forder` tinyint(4) not null default 0 comment '排序，系统从大到小排序',
`cdate` int(11) not null default 0 comment '创建时间',
primary key(`id`),
index `idx_pid` (`pid`),
index `idx_title` (`title`)
)engine=InnoDB default charset=utf8 comment '系统菜单管理';

-- 日志表
create table if not exists `tz_sys_log` (
 `id` int(11) unsigned not null auto_increment,
 `uid` int(11) not null default 0 comment '操作者id',
 `uname`  varchar(100) not null default '' comment '操作者名称',
 `content` varchar(1000) not null default '' comment '操作内容',
 `cdate` int(11) not null default 0 comment '创建时间',
 `ip` varchar(24) not null default '' comment '操作者ip',
 `tag`  varchar(100) not null default '' comment '标签',
 `info_id` int(11) not null default 0 comment '内容id',
 `model_id` int(11) not null default 0 comment '模型id',
 primary key (`id`),
 index `idx_info_mdoel` (`info_id`,`model_id`),
 index `idx_uid` (`uid`),
 index `idx_cdate` (`cdate`)
) engine=InnoDB default charset=utf8 comment '后台操作日志表';

-- session
CREATE TABLE IF NOT EXISTS `tz_sessions` (
    `id` varchar(40) NOT NULL,
    `ip_address` varchar(45) NOT NULL,
    `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
    `data` blob NOT NULL,
    primary key (`id`),
    KEY `ci_sessions_timestamp` (`timestamp`)
);

-- start install data
-- 管理组
INSERT INTO tz_user_group
(id, g_name, g_urank, g_remark, g_state, cdate, is_admin_g) 
VALUES 
(1, '系统管理组', 'SUPER', '', 0, 1),
(2, '运维管理组', 'SUPER', '', 0, 1),
(3, '普通用户组', '', '', 0, 0);

-- 用户
INSERT INTO tz_user
(id, uname, group_id, upass, unick, cdate, is_admin) 
VALUES 
(1, 'admin', '1', '31bd59df36f5f3048a0d48b534463ef7', '赛亚人', 0, 1),
(2, 'webmaster', '2', '56263ab2ca50c045a1b6c8ec81306d05', '行走的树', 1);

-- 默认模型字段
INSERT INTO tz_sys_fields 
(title, field, attribute, form_type, dvalue, fdesc, field_remark, is_system,field_tag, display) 
VALUES 
('标题', 'title', 'varchar(128)', 'input', '', '标题不能为空', 1, 1, '系统', 1),
('描述', 'descript', 'varchar(256)', 'textarea', '', '默认取文章前64个字符', 1, 1, '系统', 0),
('缩略图', 'thumb_image', 'varchar(256)', 'upload', '', '缩略图不能为空', 1, 1, '系统', 0),
('封面', 'cover', 'varchar(256)', 'upload', '', '封面不能为空', 1, 1, '系统', 0),
('详情', 'content', 'text', 'editor', '', '详情不能为空', 1, 1, '系统', 0),
('来源地址', 'form_url', 'varchar(256)', 'input', '', '', 1, 1, '系统', 0),
('标签', 'tag', 'varchar(56)', 'input', '', '', 1, 1, '系统', 0);
-- 默认模型
INSERT INTO tz_sys_model
(mtitle, mname, mtype) 
VALUES 
('文章', 'article',  '1'),
('产品', 'product',  '1'),
('系统', 'system',  '1');

-- 系统默认配置信息
INSERT INTO tz_sys_configs (title, ckey, cvalue, tag, field_type) VALUES
('网站名称', 'site_name', 'Tzungtzu CMS', '系统', 'input'),
('网站名称', 'site_title', 'Tzungtzu CMS,粽子cms', '系统', 'input'),
('首页seo关键词', 'seo_keywords', '粽子cms,tzungtzu, tzungtzu cms,PHP CMS, php cms, 文章管理系统,最自由的php cms', '系统', 'input'),
('首页seo描述', 'seo_description', '这是基于CI框架最自由的php CMS-Tzungtzu CMS,粽子cms', '系统', 'input'),
('公司名称', 'company_name', '默谷资产管理（上海）有限公司', '企业', 'input');
-- end install data