  <?php
    class ManageAction extends Action {
      private $actionName;

      public function __construct(&$tpl, &$model) {
        parent::__construct($tpl, $model);
        $this->action();
        $this->tpl->display('index.tpl');
      }

      private function action() {
        if(isset($_GET['action'])) {
          $this->actionName = $_GET['action'];
        } else {
          $this->actionName = 'list';
        }
        switch($this->actionName) {
          case 'list':
            $this->listAll();
            break;
          case 'add':
            $this->add();
            break;
          case 'update':
            $this->update();
            break;
          case 'delete':
            $this->delete();
            break;          
        }
      }

      private function listAll() {
        $this->tpl->assign('list', true);
        $this->tpl->assign('add', false);
        $this->tpl->assign('update', false);
        $this->tpl->assign('delete', false);
        $this->tpl->assign('title', '管理员列表');
        $this->tpl->assign('AllManage', $this->model->getAllManage());
      }

      private function add() {
        if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['send'])) {
          $this->model->admin_user = $_POST['admin_user'];
          $this->model->admin_pass = $_POST['admin_pass'];
          $this->model->level = $_POST['level'];
          $this->model->addManage() ? Tool::alertLocation('恭喜你，新增管理员成功！', 'index.php?action=list')
                         : Tool::alertBack('很遗憾，新增管理员失败！');
        }
        $this->tpl->assign('list', false);
        $this->tpl->assign('add', true);
        $this->tpl->assign('update', false);
        $this->tpl->assign('delete', true);
        $this->tpl->assign('title', '新增管理员');
      }

      private function update() {
        if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['send'])) {
          $this->model->id = $_POST['id'];
          $this->model->admin_pass = $_POST['admin_pass'];
          $this->model->level = $_POST['level'];
          $this->model->updateManage() ? Tool::alertLocation('恭喜你，修改管理员信息成功！', 'index.php?action=list')
                                       : Tool::alertBack('很遗憾，修改管理员信息失败！'); 
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET' AND isset($_GET['id'])) {
          $this->model->id = $_GET['id'];
          is_object($this->model->getOneManage()) ? true : Tool::alertBack('管理员id传值有误！');
          $this->tpl->assign('title','管理员信息修改');
          $this->tpl->assign('id', $this->model->getOneManage()->id);
          $this->tpl->assign('admin_user', $this->model->getOneManage()->admin_user);
          $this->tpl->assign('level', $this->model->getOneManage()->level);
          $this->tpl->assign('list', false);
          $this->tpl->assign('add', false);
          $this->tpl->assign('update', true);
          $this->tpl->assign('delete', false);
        } else {
          Tool::alertBack('非法操作！');
        }
      }

      private function delete() {
        if($_SERVER['REQUEST_METHOD'] == 'GET' AND isset($_GET['id'])) {
          $this->model->id = $_GET['id'];
          $this->model->deleteManage() ? Tool::alertLocation('恭喜你，删除管理员成功！', 'index.php?action=list')
                            : Tool::alertBack('很遗憾，删除管理员失败！');
        }
      }
    }
  ?>