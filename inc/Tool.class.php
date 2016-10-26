<?php
  class Tool {
    //弹窗，跳转
    static public function alertLocation($info, $url) {
      echo "<script type='text/javascript'>alert('$info');location.href='$url';</script>";
      exit();
    }

    //弹窗，返回上一层
    static public function alertBack($info) {
      echo "<script type='text/javascript'>alert('$info');history.back();</script>";
      exit();
    }
  }
?>