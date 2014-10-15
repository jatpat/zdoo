<?php
/**
 * The browse view file of block module of ZenTaoMS.
 *
 * @copyright   Copyright 2013-2014 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-columns'></i> <?php echo $lang->block->browseRegion;?></strong></div>
  <table class='table table-bordered table-hover table-striped'>
    <tr>
      <th style='width: 200px'><?php echo $lang->block->page;?></th>
      <th class='text-center'><?php echo $lang->block->regionList;?></th>
    </tr>
    <?php foreach($this->lang->block->pages as $page => $name):?>
    <?php if(empty($lang->block->regions->$page)) continue;?>
    <tr>
      <td><?php echo $name;?></td>
      <td>
      <?php
      $regions = $lang->block->regions->$page;
      foreach($regions as $region => $regionName)
      {
          echo html::a($this->inlink('setregion', "page={$page}&region={$region}"), $regionName);
      }
      ?>
      </td>
    </tr>
    <?php endforeach;?>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>