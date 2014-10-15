<?php
/**
 * The index view file of index module of ZenTaoMS.
 *
 * @copyright   Copyright 2013-2014 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     index 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
include "../../common/view/header.lite.html.php";
css::import($themeRoot . 'default/ips.css');
js::import($jsRoot . 'jquery/ips.js');
?>
<!-- Desktop -->
<div id='desktop' class='fullscreen-mode' unselectable='on' style='-moz-user-select:none;-webkit-user-select:none;' onselectstart='return false;'>
  <div id='leftBar' class='dock-left'>
    <button id='start' class='dock-bottom'>
      <?php echo html::image($themeRoot . 'default/images/ips/avatar.jpg', "class='avatar-img'");?>
    </button>
    <ul id='startMenu' class='dropdown-menu'>
      <li><?php echo html::a('###', html::image($themeRoot . 'default/images/ips/avatar.jpg', "class='avatar-img'") . "<strong>{$app->user->realname}</strong>", "class='app-btn' data-id='profile'");?></li>
      <li class="divider"></li>
      <li><?php echo html::a($this->createLink('entry', 'create'), "<i class='icon icon-plus'></i> {$lang->index->addEntry}", "target='_blank'"  )?></li>
      <li><a href='###' class='fullscreen-btn' data-id='allapps'><i class='icon icon-th-large'></i> <?php echo $lang->index->allEntries?><div class='pull-right'><span class='label label-badge entries-count'></span></div></a></li>
    </ul>
    <div id='apps-menu'>
      <ul class='bar-menu'></ul>
    </div>
  </div>
  <div id='bottomBar' class='dock-bottom'>
    <div id='taskbar'><ul class='bar-menu'></ul></div>
    <div id='bottomRightBar' class='dock-right'>
      <ul class='bar-menu'>
        <li><button id='showDesk' class='fullscreen-btn icon-home' data-id='home' data-toggle='tooltip' title='<?php echo $lang->index->showDesk; ?>'></button></li>
      </ul>
    </div>
  </div>
  <div id='home' class='fullscreen fullscreen-active'>
    <div class='btn-toolbar actions'>
      <button data-toggle='tooltip' data-placement='bottom' data-id='addblock' title='<?php echo $lang->index->addBlock; ?>' class='btn btn-pure app-btn'><i class='icon-plus'></i></button>
    </div>
    <div class='panels-container dashboard' id='dashboard'>
      <div class='row'>
        <?php $index = 0;?>
        <?php foreach($blocks as $key => $block):?>
        <?php
        $index = str_replace('b', '', $key);
        $block = json_decode($block);
        ?>
        <div class='col-sm-6 col-md-4'>
          <div class='panel' id='block<?php echo $index?>' data-id='<?php echo $index?>' data-name='<?php echo $block->name?>'>
            <div class='panel-heading'>
              <?php echo $block->name?>
              <div class='panel-actions'>
                <div class='dropdown'>
                  <button role="button" class="btn btn-mini" data-toggle="dropdown"><span class="caret"></span></button>
                  <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                    <li><a href="<?php echo $this->createLink("block", "admin", "index=$index"); ?>" class='edit-block window-btn' data-name='<?php echo $block->name; ?>' data-icon='icon-pencil'><i class="icon-pencil"></i> <?php echo $lang->edit; ?></a></li>
                    <li><a href="javascript:;" class="remove-panel"><i class="icon-remove"></i> <?php echo $lang->close; ?></a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class='panel-body no-padding'>
              <?php echo html::image("{$themeRoot}default/images/ips/loading.gif", "style='display:block;margin:40px auto;'")?>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
  <div id='allapps' class='fullscreen'>
    <header>
      <div class='row'>
        <div class='col-md-4'>
          <h4><i class='icon-th-large'></i> <?php echo $lang->index->allEntries?> &nbsp;<small class='muted'><?php echo $lang->index->countEntries?></small></h4>
        </div>
        <div class='col-md-4'>
          <div class='search-input'>
            <i class='icon-search icon'></i>
            <input id='search' type='text' class='form-control-pure form-control'>
            <button id='cancelSearch' class='btn btn-pure btn-mini'><i class='icon-remove'></i></button>
          </div>
        </div>
        <div class='col-md-4 text-right'>
          <?php echo html::a($this->createLink('entry', 'create'), "<i class='icon-plus'></i> {$lang->index->addEntry}", "target='_blank' class='btn btn-pure'")?>
        </div>
      </div>
    </header>
    <div class='all-apps-list' id='allAppsList'>
      <ul class='bar-menu'>
      </ul>
    </div>
  </div>
  <div id='deskContainer'></div>
  <div id='modalContainer'></div>
</div>
<script>
var entries = new Array(
{
    id       : 'profile',
    url      : '<?php echo $this->createLink('user', 'profile')?>',
    name     : '<?php echo $lang->user->profile?>',
    open     : 'iframe',
    desc     : '<?php echo $lang->index->profile?>',
    display  : 'modal',
    size     : 'default',
    menu     : 'list',
    position : 'center',
    control  : 'full',
},
{
    id       : 'allapps',
    name     : '<?php echo $lang->index->allEntries?>',
    display  : 'fullscreen',
    desc     : '<?php echo $lang->index->allEntries?>',
    menu     : 'menu',
    icon     : 'icon-th-large'
},
{
    id       : 'addblock',
    url      : '<?php echo $this->createLink("block", "admin", "index=" . ($index + 1)); ?>',
    name     : '<?php echo $lang->index->addBlock; ?>',
    open     : 'iframe',
    display  : 'modal',
    size     : 'default',
    menu     : false,
    control  : 'full',
    icon     : 'icon-plus'
});

var ipsLang = {};
<?php
foreach ($lang->index->ips as $key => $value)
{
    echo 'ipsLang["' . $key . '"] = "' . $value . '";';
}
?>

<?php echo $allEntries;?>
</script>
<?php
include "../../common/view/footer.lite.html.php";
?>
</body>
</html>