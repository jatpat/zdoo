<?php
if(!isset($lang->leave)) $lang->leave = new stdclass();
$lang->leave->common     = '请假';
$lang->leave->browse     = '请假列表';
$lang->leave->view       = '详情';
$lang->leave->create     = '申请请假';
$lang->leave->edit       = '编辑';
$lang->leave->delete     = '删除';
$lang->leave->review     = '审核';
$lang->leave->cancel     = '撤销';
$lang->leave->commit     = '提交';
$lang->leave->back       = '销假';
$lang->leave->export     = '导出请假记录';
$lang->leave->reviewBack = '审核销假';

$lang->leave->personal     = '我的请假';
$lang->leave->browseReview = '审核列表';
$lang->leave->company      = '所有请假';
$lang->leave->setReviewer  = '请假设置';
$lang->leave->batchReview  = '批量审核';
$lang->leave->batchPass    = '批量通过';

$lang->leave->id           = '编号';
$lang->leave->year         = '年';
$lang->leave->begin        = '开始';
$lang->leave->end          = '结束';
$lang->leave->start        = '开始时间';
$lang->leave->finish       = '结束时间';
$lang->leave->hours        = '总时长';
$lang->leave->backDate     = '报到时间';
$lang->leave->type         = '类型';
$lang->leave->desc         = '事由';
$lang->leave->status       = '状态';
$lang->leave->createdBy    = '申请者';
$lang->leave->createdDate  = '申请时间';
$lang->leave->reviewedBy   = '审核者';
$lang->leave->reviewedDate = '审核时间';
$lang->leave->date         = '日期';
$lang->leave->time         = '时间';
$lang->leave->rejectReason = '拒绝原因';

$lang->leave->typeList['affairs']   = '事假';
$lang->leave->typeList['sick']      = '病假';
$lang->leave->typeList['annual']    = '年假';
$lang->leave->typeList['lieu']      = '调休';
$lang->leave->typeList['home']      = '探亲假';
$lang->leave->typeList['marry']     = '婚假';
$lang->leave->typeList['maternity'] = '产假';

$lang->leave->paid   = '带薪假';
$lang->leave->unpaid = '非带薪假';

$lang->leave->statusList['draft']  = '草稿';
$lang->leave->statusList['wait']   = '等待审核';
$lang->leave->statusList['doing']  = '审核中';
$lang->leave->statusList['pass']   = '通过';
$lang->leave->statusList['reject'] = '拒绝';
$lang->leave->statusList['back']   = '销假待审';

$lang->leave->denied        = '信息访问受限';
$lang->leave->unique        = '%s 已经存在请假记录';
$lang->leave->sameMonth     = '不支持跨月份请假';
$lang->leave->wrongEnd      = '结束时间应该大于开始时间';
$lang->leave->wrongBackDate = '报到时间应该大于开始时间';
$lang->leave->nodata        = '没有选择数据';
$lang->leave->reviewSuccess = '审核成功';

$lang->leave->confirmReview['pass']   = '您确定要执行通过操作吗？';
$lang->leave->confirmReview['reject'] = '您确定要执行拒绝操作吗？';

$lang->leave->hoursTip = '小时';

$lang->leave->reviewStatusList['pass']   = '通过';
$lang->leave->reviewStatusList['reject'] = '拒绝';
