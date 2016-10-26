<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>管理员管理首页</title>
  <link rel="stylesheet" href="./style/index.css">
  <script src="./js/adminManageOption.js"></script>
</head>
<body id="main">
  <p class="center">{$title}</p>

  {if $list}
  <!-- 管理员列表 -->
  <table>
    <tr>
      <th>编号</th>
      <th>用户名</th>
      <th>等级</th>
      <th>登录次数</th>
      <th>最近登录ip</th>
      <th>最近登录时间</th>
      <th>操作</th>
    </tr>
    {foreach $AllManage(key, value)}
      <tr>
        <td>{@value->id}</td>
        <td>{@value->admin_user}</td>
        <td>{@value->level_name}</td>
        <td>{@value->login_count}</td>
        <td>{@value->last_login_ip}</td>
        <td>{@value->last_login_time}</td>
        <td>
          <a href="index.php?action=update&id={@value->id}">修改</a> |
          <a href="index.php?action=delete&id={@value->id}" onclick="return confirm('你真的要删除这个管理员吗？') ? true : false;">删除</a>
        </td>
      </tr>
    {/foreach}
  </table>
  <p class="center">[<a href="index.php?action=add">新增管理员</a>]</p>
  {/if}

  {if $add}
  <!-- 新增管理员 -->
  <form method="post">
    <table cellspacing="0" class="left">
      <tr><td>用户名：<input type="text" name="admin_user" class="text" /></td></tr>
      <tr><td>密　码：<input type="password" name="admin_pass" class="text" /></td></tr>
      <tr><td>等　级：<select name="level">
                        <option value="1">后台游客</option>
                        <option value="2">会员专员</option>
                        <option value="3">评论专员</option>
                        <option value="4">发帖专员</option>
                        <option value="5">普通管理员</option>
                        <option value="6">超级管理员</option>
                      </select>
      </td></tr>
      <tr><td><input type="submit" name="send" value="新增管理员" class="submit" /> [ <a href="index.php?action=list">返回列表</a> ]</td></tr>
    </table>
  </form>
  {/if}

  <!-- 修改页面 -->
  {if $update}
    <form method="post">
      <input type="hidden" value="{$id}" name="id">
      <input id="level" type="hidden" value="{$level}">
      <table cellspacing="0" class="left">
        <tr><td>用户名：<input type="text" name="admin_user" class="text" value="{$admin_user}" readonly="readonly" /></td></tr>
        <tr><td>密　码：<input type="password" name="admin_pass" class="text" /></td></tr>
        <tr><td>等　级：<select name="level">
                          <option value="1">后台游客</option>
                          <option value="2">会员专员</option>
                          <option value="3">评论专员</option>
                          <option value="4">发帖专员</option>
                          <option value="5">普通管理员</option>
                          <option value="6">超级管理员</option>
                        </select>
        </td></tr>
        <tr><td><input type="submit" name="send" value="修改管理员" class="submit" /> [ <a href="index.php?action=list">返回列表</a> ]</td></tr>
      </table>
    </form>
  {/if}

  <!-- 删除页面 -->
  {if $delete}
  {/if}
</body>
</html>