<?php
/**
 * The view view file of task module of RanZhi.
 *
 * @copyright   Copyright 2013-2014 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     LGPL
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     task
 * @version     $Id$
 * @link        http://www.ranzhi.org
 */
?>
<?php include $app->getModuleRoot() . 'common/view/header.html.php';?>
<div class='panel'>
  <div class='panel-heading'><i class='icon-list-alt'></i> <strong><?php echo $lang->task->kanban;?></strong></div>
  <div class='panel-body boards-container'>
    <div class='boards task-boards'>
    <?php $colsWidth = 100/(count($lang->task->statusList) - 1); ?>
    <?php foreach ($lang->task->statusList as $key => $value):?>
    <?php if(empty($key)) continue; ?>
      <div class='board panel task-board' style="width: <?php echo $colsWidth;?>%">
        <div class='panel-heading'>
          <strong><?php echo $value?></strong>
          <div class='panel-actions pull-right'><button class='btn'><i class='icon-plus'></i></button></div>
        </div>
        <div class='panel-body'>
          <div class='board-list'>
            <?php foreach($tasks as $task):?>
            <?php if($task->status != $key) continue;?>
            <div class='board-item task task-pri-<?php echo $task->pri; ?>'>
              <div class='task-heading'>
                <?php if(!empty($task->type)):?>
                <div class='pull-right text-muted task-type'><?php echo $lang->task->typeList[$task->type];?></div>
                <?php endif;?>
                <strong class='task-name'><?php echo $task->name;?></strong>
              </div>
              <div class='task-info clearfix'>
              <?php if(!empty($task->assignedTo)):?>
                <div class='task-assignedTo text-muted pull-left'><i class='icon-user'></i> <small><?php echo $task->assignedTo;?></small></div>
              <?php endif;?>
              <?php if(!empty($task->deadline) and $task->deadline != '0000-00-00'):?>
                <div class='task-deadline text-warning pull-right'><i class='icon-time'></i> <small><?php echo $task->deadline;?></small></div>
              <?php endif;?>
              </div>
              <div class='task-actions'>
                <?php echo $this->task->buildOperateMenu($task);?>
              </div>
            </div>
            <?php endforeach;?>
          </div>
        </div>
      </div>
    <?php endforeach;?>
      <!-- <div class='board panel board-empty'></div> -->
    </div>
  </div>
</div>
<?php include $app->getModuleRoot() . 'common/view/footer.html.php';?>
