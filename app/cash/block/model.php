<?php
/**
 * The model file of block module of RanZhi.
 *
 * @copyright   Copyright 2013-2014 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     LGPL
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
helper::import(realpath('../../sys/block/model.php'));
class cashblockModel extends blockModel
{
    /**
     * Get block list.
     * 
     * @access public
     * @return string
     */
    public function getAvailableBlocks()
    {
        return json_encode($this->lang->block->availableBlocks);
    }

    /**
     * Get depositor params.
     * 
     * @access public
     * @return string
     */
    public function getDepositorParams()
    {
        $params = new stdclass();

        return json_encode($params);
    }

    /*
     * Get trade params.
     * 
     * @access public
     * @return string
     */
    public function getTradeParams()
    {
        $this->app->loadLang('trade', 'cash');

        $params = new stdclass();

        $params->num['name']        = $this->lang->block->num;
        $params->num['default']     = 15; 
        $params->num['control']     = 'input';

        $params->orderBy['name']    = $this->lang->block->orderBy;
        $params->orderBy['default'] = 'id_desc';
        $params->orderBy['options'] = $this->lang->block->orderByList->trade;
        $params->orderBy['control'] = 'select';

        return json_encode($params);
    }

    /*
     * Get provider params.
     * 
     * @access public
     * @return string
     */
    public function getProviderParams()
    {
        $this->app->loadLang('Provider', 'cash');

        $params = new stdclass();

        $params->num['name']        = $this->lang->block->num;
        $params->num['default']     = 15; 
        $params->num['control']     = 'input';

        $params->orderBy['name']    = $this->lang->block->orderBy;
        $params->orderBy['default'] = 'id_desc';
        $params->orderBy['options'] = $this->lang->block->orderByList->provider;
        $params->orderBy['control'] = 'select';

        return json_encode($params);
    }
}
