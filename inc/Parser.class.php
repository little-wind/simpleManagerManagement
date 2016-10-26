<?php
  //模板解析类
  class Parser {
    private $tplContent;
    

    //构造函数，获取模板文件内容
    public function __construct($tplFile) {
      if(!$this->tplContent = file_get_contents($tplFile)) {
        exit('ERROR: 模板文件读取错误！');
      }
    }

    //解析普通变量
    private function parserVar() {
      //查找到tpl中的所有变量
      $patten = '/\{\$([\w]+)\}/';
      //+：一个或多个
      if(preg_match($patten, $this->tplContent)) {
        $this->tplContent = preg_replace($patten, "<?php echo \$this->vars['$1']; ?>", $this->tplContent);
      }
    }

    //解析系统变量
    private function parserConfig() {
      $patten = '/<!--\{([\w]+)\}-->/';
      //查找系统变量的标识
      if(preg_match($patten, $this->tplContent)) {
        $this->tplContent = preg_replace($patten, "<?php echo \$this->config['$1']; ?>", $this->tplContent);
      }
    }

    //解析if语句
    private function parserIf() {
      $pattenStartIf = '/\{if\s+\$([\w]+)\}/';
      $pattenEndIf = '/\{\/if\}/';
      $pattenElse = '/\{else\}/';
      //找到开头的if语句
      //\s+匹配一个或多个空格
      if(preg_match($pattenStartIf, $this->tplContent)) {
        //查找结束的if语句
        if(preg_match($pattenEndIf, $this->tplContent)) {
          //转换if语句开头部分
          $this->tplContent = preg_replace($pattenStartIf, "<?php if(\$this->vars['$1']) { ?>", $this->tplContent);
          //转换if语句结束部分
          $this->tplContent = preg_replace($pattenEndIf, "<?php } ?>", $this->tplContent);
          //判断是否存在else
          if(preg_match($pattenElse, $this->tplContent)) {
            //解析else
            $this->tplContent = preg_replace($pattenElse, "<?php } else {?>", $this->tplContent);
          }
        } else {
          exit('Error： if语句结尾部分不存在！');
        }
      }
    }

    //解析foreach语句
    private function parserForeach() {
      $pattenStartForeach = '/\{foreach\s+\$([\w]+)\(([\w]+),\s+([\w]+)\)\}/';
      $pattenEndForeach = '/\{\/foreach\}/';
      $pattenKey = '/\{@([\w]+)([\w\-\>]*)\}/';
      if(preg_match($pattenStartForeach, $this->tplContent)) {
        if(preg_match($pattenEndForeach, $this->tplContent)) {
          $this->tplContent = preg_replace($pattenStartForeach, "<?php foreach(\$this->vars['$1'] as \$$2 => \$$3) { ?>", $this->tplContent);
          $this->tplContent = preg_replace($pattenEndForeach, "<?php } ?>", $this->tplContent);
          //判断foreach中是否有数据，为了区别foreach $array(key, value)中的，这里的key使用@
          if(preg_match($pattenKey, $this->tplContent)) {
            $this->tplContent = preg_replace($pattenKey, "<?php echo \$$1$2; ?>", $this->tplContent);
          }
        } else {
          exit('Error：foreach必须配对！');
        }
      }
    }

    //解析include语句
    private function parserInclude() {
      $patten = '/\{include\s+file=(\"|\')([\w\.\-\/]+)(\"|\')\}/';
      //验证include是否存在
      if(preg_match($patten, $this->tplContent, $file)) { //将匹配的，存放到$file数组中
        //验证文件是否存在
        if(!file_exists($file[2]) OR empty($file)) {
          exit('Error：所包含的文件不存在！');
        }

        //标签替换
        $this->tplContent = preg_replace($patten, "<?php include '$2'; ?>", $this->tplContent);
      }
    }

    //PHP代码注释
    private function parserCommon() {
      //查找是否存在注释符号
      $patten = '/\{#\}(.*)\{#}/';
      if(preg_match($patten, $this->tplContent)) {
        $this->tplContent = preg_replace($patten, "<?php /* $1 */ ?>", $this->tplContent);
      }
    }

    public function compile($parFile) {
      $this->parserVar();
      $this->parserConfig();
      $this->parserIf();
      $this->parserForeach();
      $this->parserInclude();
      $this->parserCommon();

      //写入编译文件
      if(!file_put_contents($parFile, $this->tplContent)) {
        exit('ERROR: 编译文件生成出错！');
      }
    }
  }
?>