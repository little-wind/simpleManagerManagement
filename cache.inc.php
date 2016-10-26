<?php
  //是否开启缓冲区，默认开启
  define('IS_CACHE', false);
  //判断是否开启缓冲区
  IS_CACHE ? ob_start() : NULL;
?>