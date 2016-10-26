<?php
  //管理员实体类
  class ManageModel extends Model {
    public $id;
    public $admin_user;
    public $admin_pass;
    public $level;


    //查询单个管理员
    public function getOneManage() {
      $sql = "SELECT id, admin_user, level FROM cms_manage WHERE id = '$this->id' LIMIT 1";
      return parent::getOne($sql);
    }

    //查询所有管理员
    public function getAllManage() {
      $sql = "SELECT m.id, m.admin_user, m.login_count, m.last_login_ip, m.last_login_time, l.level_name
                FROM cms_manage as m,
                     cms_level as l
               WHERE m.level = l.level";
      return parent::getALL($sql);
    }

    public function addManage() {
      $sql = "INSERT INTO cms_manage(admin_user, admin_pass, level, register_time) 
              VALUES ('$this->admin_user', '$this->admin_pass', '$this->level', now())";
      return parent::aud($sql);
    }

    public function updateManage() {
      $sql = "UPDATE cms_manage SET 
                                    admin_pass = '$this->admin_pass', 
                                    level = '$this->level' 
                              WHERE id = '$this->id' 
                              LIMIT 1";
      return parent::aud($sql);
    }

    public function deleteManage() {
      $sql = "DELETE FROM cms_manage WHERE id = '$this->id' LIMIT 1";
      return parent::aud($sql);
    }
  }
?> 