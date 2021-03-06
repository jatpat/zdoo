<?php
/**
 * The project module zh-tw file of RanZhi.
 *
 * @copyright   Copyright 2009-2018 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     project
 * @version     $Id: zh-tw.php 824 2010-05-02 15:32:06Z wwccss $
 * @link        http://www.ranzhi.org
 */
if(!isset($lang->project)) $lang->project = new stdclass();
$lang->project->common     = '項目視圖';
$lang->project->browse     = '項目列表';
$lang->project->index      = '項目首頁';
$lang->project->create     = "創建項目";
$lang->project->edit       = '修改項目';
$lang->project->view       = '項目詳情';
$lang->project->finish     = '完成項目';
$lang->project->delete     = '刪除項目';
$lang->project->enter      = '進入';
$lang->project->suspend    = '掛起';
$lang->project->activate   = '激活';
$lang->project->mine       = '我負責:';
$lang->project->other      = '其他：';
$lang->project->deleted    = '已刪除';
$lang->project->finished   = '已結束';
$lang->project->suspended  = '已掛起';
$lang->project->noMatched  = '找不到包含"%s"的項目';
$lang->project->search     = '搜索';
$lang->project->import     = '導入';
$lang->project->importTask = '導入任務';
$lang->project->role       = '角色';
$lang->project->project    = '項目';
$lang->project->dateRange  = '起止日期';

$lang->project->id          = '編號';
$lang->project->name        = '項目名稱';
$lang->project->status      = '狀態';
$lang->project->desc        = '項目描述';
$lang->project->begin       = '開始日期';
$lang->project->manager     = '負責人';
$lang->project->member      = '團隊';
$lang->project->end         = '結束日期';
$lang->project->createdBy   = '由誰創建';
$lang->project->createdDate = '創建時間';
$lang->project->fromproject = '所屬項目';
$lang->project->whitelist   = '參觀者';
$lang->project->doc         = '文檔';

$lang->project->confirm = new stdclass();
$lang->project->confirm->activate = '確認激活此項目？';
$lang->project->confirm->suspend  = '確認掛起此項目？';

$lang->project->activateSuccess = '激活操作成功';
$lang->project->suspendSuccess  = '掛起操作成功';
$lang->project->selectProject   = '請選擇項目';

$lang->project->note = new stdclass();
$lang->project->note->rate = '按工時計算';
$lang->project->note->task = '任務數';

$lang->project->statusList['doing']    = '進行中';
$lang->project->statusList['finished'] = '已完成';
$lang->project->statusList['suspend']  = '已掛起';

$lang->project->roleList['member']  = '預設';
$lang->project->roleList['senior']  = '管理員';
$lang->project->roleList['limited'] = '受限';

$lang->project->whitelistTip        = '參觀者可以查看項目和任務';
$lang->project->roleTip             = "管理員擁有所有權限，預設成員不可刪除與自己無關的任務，受限成員僅可操作自己相關任務。";
$lang->project->roleTips['senior']  = "管理員：可以查看、編輯、刪除所有任務。";
$lang->project->roleTips['member']  = "預設：可以查看、編輯所有任務，刪除與自己相關的任務。";
$lang->project->roleTips['limited'] = "受限：只能查看、編輯與自己相關的任務。";
