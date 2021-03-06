<?php
/**
 * The recordEstimate view file of task module of Ranzhi.
 *
 * @copyright   Copyright 2009-2018 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      chujilu <chujilu@cnezsoft.com>
 * @package     task
 * @version     $Id$
 * @link        http://www.ranzhi.org
 */
?>
<?php include '../../../sys/common/view/header.modal.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<form method='post' id='ajaxForm' action='<?php echo $this->createLink('task', 'recordEstimate', "taskID=$task->id")?>'>
  <table class='table table-form'>
    <tr>
      <th><?php echo $lang->task->myConsumption;?></th>
      <td><?php echo html::input('consumed', $task->consumed, "class='form-control' placeholder='{$lang->task->hour}'");?></td>
    </tr>
    <tr>
      <th><?php echo $lang->task->left;?></th>
      <td><?php echo html::input('left', $left, "class='form-control'");?></td>
    </tr>
    <tr>
      <th><?php echo $lang->comment?></th>
      <td><?php echo html::textarea('comment');?></td>
    </tr>
    <tr>
      <th></th>
      <td><?php echo html::submitButton();?></td>
    </tr>
  </table>
</form>
<?php include '../../../sys/common/view/footer.modal.html.php';?>
