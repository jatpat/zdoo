<?php
/**
 * The html template file of step5 method of install module of ZenTaoMS.
 *
 * @copyright   Copyright 2013-2014 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     install 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<div class='container'>
  <div class='modal-dialog' style='width: 450px'>
    <div class='modal-content'>
      <div class='modal-body'><div class='alert alert-success text-center'><h4><?php echo $lang->install->success;?></h4></div></div>
      <div class='modal-footer'>
        <?php echo html::a('index.php', $lang->install->visitFront, "class='btn btn-primary' target='_blank'");?>
        <?php echo html::a('admin.php', $lang->install->visitAdmin, "class='btn btn-primary' target='_blank'");?>
      </div>
    </div>
  </div>
</div>
<?php include './footer.html.php';?>