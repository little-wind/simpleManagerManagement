<?php
  
  header('Content-Type:text/html; charset=utf-8');    //设置字符编码
  define('ROOT_PATH', dirname(__FILE__));             //设置网站根目录
  
  require ROOT_PATH . '\\config\\profile.inc.php';    //引入配置信息
  require 'cache.inc.php';                            //引入缓存
  require ROOT_PATH . '\\inc\\Templates.class.php';   //引入模板类
  require ROOT_PATH . '\\inc\\DB.class.php';          //引入数据库
  require ROOT_PATH . '\\Model\\Model.class.php';     //引入Model基类
  require ROOT_PATH . '\\Model\\ManageModel.class.php'; //引入管理员Model类
  require ROOT_PATH . '\Control\\Action.class.php';   //引入Control基类
  require ROOT_PATH . '\\Control\\ManageAction.class.php'; //引入管理员Control类
  require ROOT_PATH . '\\inc\\Tool.class.php';         //引入工具类
  
  new ManageAction(new Templates(), new ManageModel());
?>