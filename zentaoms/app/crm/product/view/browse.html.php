<?php include '../../common/view/header.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
  <strong><i class="icon-list-ul"></i> <?php echo $lang->product->list;?></strong>
  <div class='panel-actions'><?php echo html::a($this->inlink('create'), '<i class="icon-plus"></i> ' . $lang->product->create, 'class="btn btn-primary"');?></div>
  </div>
  <table class='table table-hover table-striped tablesorter'>
    <thead>
      <tr class='text-center'>
        <?php $vars = "orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}";?>
        <th class='w-60px'> <?php commonModel::printOrderLink('id',          $orderBy, $vars, $lang->product->id);?></th>
        <th>                <?php commonModel::printOrderLink('name',        $orderBy, $vars, $lang->product->name);?></th>
        <th class='w-160px'><?php commonModel::printOrderLink('createdDate', $orderBy, $vars, $lang->product->createdDate);?></th>
        <th class='w-60px'> <?php commonModel::printOrderLink('type',        $orderBy, $vars, $lang->product->type);?></th>
        <th class='w-60px'> <?php commonModel::printOrderLink('status',      $orderBy, $vars, $lang->product->status);?></th>
        <th class='w-200px'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($products as $product):?>
      <tr class='text-center'>
        <td><?php echo $product->id;?></td>
        <td class='text-left'><?php echo $product->name;?></td>
        <td><?php echo $product->createdDate;?></td>
        <td><?php echo $lang->product->typeList[$product->type];?></td>
        <td><?php echo $lang->product->statusList[$product->status];?></td>
        <td>
          <?php
          echo html::a($this->createLink('product', 'edit', "productID=$product->id"), $lang->edit);
          echo html::a($this->createLink('product', 'delete', "productID=$product->id"), $lang->delete, "class='deleter'");
          echo html::a($this->inlink('adminField',  "productID=$product->id"), $lang->product->field->admin);
          echo html::a($this->inlink('adminAction', "productID=$product->id"), $lang->product->action->admin);
          echo html::a($this->inlink('adminRoles',  "productID=$product->id"), $lang->product->roles);
          ?>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='6'><?php $pager->show();?></td></tr></tfoot>
  </table>
</div>
<?php include '../../common/view/footer.html.php';?>