<?php include '../../common/view/header.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
  <strong><i class="icon-list-ul"></i> <?php echo $lang->customer->list;?></strong>
  <div class='panel-actions'><?php echo html::a($this->inlink('create'), '<i class="icon-plus"></i> ' . $lang->customer->create, 'class="btn btn-primary"');?></div>
  </div>
  <table class='table table-hover table-striped tablesorter'>
    <thead>
      <tr class='text-center'>
        <?php $vars = "orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}";?>
        <th class='w-60px'> <?php commonModel::printOrderLink('id',          $orderBy, $vars, $lang->customer->id);?></th>
        <th>                <?php commonModel::printOrderLink('name',        $orderBy, $vars, $lang->customer->name);?></th>
        <th class='w-160px'><?php commonModel::printOrderLink('createdDate', $orderBy, $vars, $lang->customer->createdDate);?></th>
        <th class='w-100px'><?php commonModel::printOrderLink('type',        $orderBy, $vars, $lang->customer->type);?></th>
        <th class='w-60px'> <?php commonModel::printOrderLink('status',      $orderBy, $vars, $lang->customer->status);?></th>
        <th class='w-60px'> <?php commonModel::printOrderLink('size',        $orderBy, $vars, $lang->customer->size);?></th>
        <th class='w-60px'> <?php commonModel::printOrderLink('level',       $orderBy, $vars, $lang->customer->level);?></th>
        <th class='w-100px'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($customers as $customer):?>
      <tr class='text-center'>
        <td><?php echo $customer->id;?></td>
        <td class='text-left'><?php echo $customer->name;?></td>
        <td><?php echo $customer->createdDate;?></td>
        <td><?php echo $lang->customer->typeList[$customer->type];?></td>
        <td><?php echo $lang->customer->sizeList[$customer->size];?></td>
        <td><?php echo $customer->level;?></td>
        <td><?php echo $lang->customer->statusList[$customer->status];?></td>
        <td>
          <?php
          echo html::a($this->createLink('customer', 'edit', "customerID=$customer->id"), $lang->edit);
          echo html::a($this->createLink('customer', 'delete', "customerID=$customer->id"), $lang->delete, "class='deleter'");
          ?>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='8'><?php $pager->show();?></td></tr></tfoot>
  </table>
</div>
<?php include '../../common/view/footer.html.php';?>