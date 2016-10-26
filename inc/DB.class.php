<?php
  //数据库链接类
  class DB {
    //获取对象句柄
    static public function getDB() {
      $dbc = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
      if(mysqli_connect_errno()) {
        echo '数据库连接错误！错误代码：'.mysqli_connect_error();
        exit();
      }
      $dbc->set_charset('utf8');

      return $dbc;
    }

    static public function unDB(&$result, &$dbc) {
      //判断结果集是否为对象，防止在manage.php中结果集被销毁
      if(is_object($result)) {
        $result->free();  //清理结果集
        $result = null;   //销毁结果集对象
      }
      if(is_object($dbc)) {
        $dbc->close();    //关闭数据库
        $dbc = null;      //销毁对象句柄
      }
    }
  }
?>