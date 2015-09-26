<?php
/**
 * The control file of customer module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     customer 
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
class customer extends control
{
    /** 
     * The index page, locate to the browse page.
     * 
     * @access public
     * @return void
     */
    public function index()
    {
        $this->locate(inlink('browse'));
    }

    /**
     * Browse customer.
     * 
     * @param string $orderBy     the order by
     * @param int    $recTotal 
     * @param int    $recPerPage 
     * @param int    $pageID 
     * @access public
     * @return void
     */
    public function browse($mode = 'all', $param = '', $orderBy = 'id_desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {   
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        /* Auto move customer to public. */
        $this->customer->moveCustomerPool();

        $this->session->set('customerList', $this->app->getURI(true));
        $this->session->set('contactList',  '');

        /* Build search form. */
        $this->loadModel('search', 'sys');
        $this->config->customer->search['actionURL'] = $this->createLink('customer', 'browse', 'mode=bysearch');
        $this->config->customer->search['params']['industry']['values'] = array('' => '') + $this->loadModel('tree')->getOptionMenu('industry');
        $this->config->customer->search['params']['area']['values']     = array('' => '') + $this->loadModel('tree')->getOptionMenu('area');
        $this->search->setSearchParams($this->config->customer->search);

        $customers = $this->customer->getList($mode = $mode, $param = $param, $relation = 'client', $orderBy, $pager);

        $this->session->set('customerQueryCondition', $this->dao->get());

        /* Set allowed edit customer ID list. */
        $this->app->user->canEditCustomerIdList = ',' . implode(',', $this->customer->getCustomersSawByMe('edit', array_keys($customers))) . ',';
        
        $this->view->title     = $this->lang->customer->list;
        $this->view->users     = $this->loadModel('user')->getPairs();
        $this->view->mode      = $mode;
        $this->view->customers = $customers;
        $this->view->pager     = $pager;
        $this->view->orderBy   = $orderBy;

        $this->display();
    }   

    /**
     * Get option menu.
     * 
     * @param  int    $current 
     * @access public
     * @return void
     */
    public function getOptionMenu($current = 0)
    {
        $options = $this->customer->getPairs('client');
        foreach($options as $value => $text)
        {
            $selected = $value == $current ? 'selected' : '';
            echo "<option value='{$value}' {$selected}>{$text}</option>";
        }
        exit;
    }

    /**
     * Create a customer.
     * 
     * @access public
     * @return void
     */
    public function create()
    {
        if($_POST)
        {
            $result = $this->customer->create();
            return $this->send($result);
        }

        unset($this->lang->customer->menu);
        $this->view->title     = $this->lang->customer->create;
        $this->view->sizeList  = $this->customer->combineSizeList();
        $this->view->levelList = $this->customer->combineLevelList();
        $this->display();
    }

    /**
     * Edit a customer.
     * 
     * @param  int    $customerID 
     * @access public
     * @return void
     */
    public function edit($customerID)
    {
        $customer = $this->customer->getByID($customerID);
        $this->loadModel('common', 'sys')->checkPrivByCustomer(empty($customer) ? '0' : $customerID, 'edit');

        if($_POST)
        {
            $return = $this->customer->update($customerID);
            $this->send($return);
        }

        $this->view->title        = $this->lang->customer->edit;
        $this->view->customer     = $customer;
        $this->view->areaList     = $this->loadModel('tree')->getOptionMenu('area');
        $this->view->industryList = $this->tree->getOptionMenu('industry');
        $this->view->sizeList     = $this->customer->combineSizeList();
        $this->view->levelList    = $this->customer->combineLevelList();

        $this->display();
    }

    /**
     * View a customer.
     * 
     * @param  int    $customerID 
     * @access public
     * @return void
     */
    public function view($customerID)
    {
        $customer = $this->customer->getByID($customerID);
        $this->loadModel('common', 'sys')->checkPrivByCustomer(empty($customer) ? '0' : $customerID);

        /* Set allowed edit customer ID list. */
        $this->app->user->canEditCustomerIdList = ',' . implode(',', $this->customer->getCustomersSawByMe('edit', (array)$customerID)) . ',';

        $uri = $this->app->getURI(true);
        $this->session->set('orderList',    $uri);
        $this->session->set('contractList', $uri);
        $this->session->set('contactList',  $uri);
        if(!$this->session->contactList or $this->session->customerList == $this->session->contactList) $this->session->set('contactList', $this->app->getURI(true));

        $this->app->loadLang('resume');

        $this->view->title        = $this->lang->customer->view;
        $this->view->customer     = $customer;
        $this->view->orders       = $this->loadModel('order')->getList($mode = 'query', "customer=$customerID");
        $this->view->contacts     = $this->loadModel('contact')->getList($customerID);
        $this->view->contracts    = $this->loadModel('contract')->getList($customerID);
        $this->view->addresses    = $this->loadModel('address')->getList('customer', $customerID);
        $this->view->actions      = $this->loadModel('action')->getList('customer', $customerID);
        $this->view->products     = $this->loadModel('product')->getPairs();
        $this->view->users        = $this->loadModel('user')->getPairs();
        $this->view->areaList     = $this->loadModel('tree')->getPairs('', 'area');
        $this->view->industryList = $this->tree->getPairs('', 'industry');
        $this->view->currencySign = $this->loadModel('common', 'sys')->getCurrencySign();
        $this->view->preAndNext   = $this->common->getPreAndNextObject('customer', $customerID);
        $this->display();
    }

    /**
     * Assign an customer function.
     *
     * @param  int    $customerID
     * @param  null   $table  
     * @access public
     * @return void
     */
    public function assign($customerID, $table = null)
    {
        $this->loadModel('common', 'sys')->checkPrivByCustomer($customerID, 'edit');

        if($_POST)
        {
            $this->customer->assign($customerID);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));

            if($this->post->assignedTo) $this->loadModel('action')->create('customer', $customerID, 'Assigned', $this->post->comment, $this->post->assignedTo);

            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => $this->server->http_referer));
        }

        $this->view->title      = $this->lang->customer->assignedTo;
        $this->view->customerID = $customerID;
        $this->view->customer   = $this->customer->getByID($customerID);
        $this->view->members    = $this->loadModel('user')->getPairs('noclosed, nodeleted, devfirst');
        $this->display();
    }

    /**
     * Browse orders of the customer.
     * 
     * @param  int    $customerID 
     * @access public
     * @return void
     */
    public function order($customerID)
    {
        $this->view->title      = $this->lang->customer->order;
        $this->view->modalWidth = 'lg';
        $this->view->orders     = $this->loadModel('order')->getList($mode = 'query', "customer=$customerID");
        $this->view->products   = $this->loadModel('product')->getPairs();
        $this->display();
    }

    /**
     * Browse contacts of the customer.
     * 
     * @param  int    $customerID 
     * @access public
     * @return void
     */
    public function contact($customerID)
    {
        $this->app->loadLang('resume');
        $this->app->user->canEditContactIdList = ',' . implode(',', $this->loadModel('contact')->getContactsSawByMe('edit')) . ',';

        $this->view->title      = $this->lang->customer->contact;
        $this->view->modalWidth = 'lg';
        $this->view->contacts   = $this->loadModel('contact')->getList($customerID);
        $this->view->customerID = $customerID;
        $this->display();
    }

    /**
     * Link contact.
     * 
     * @param  int    $customerID 
     * @access public
     * @return void
     */
    public function linkContact($customerID)
    {
        if($_POST)
        {
            $return = $this->customer->linkContact($customerID);
            $this->send($return);
        }

        $this->view->title      = $this->lang->customer->linkContact;
        $this->view->contacts   = $this->loadModel('contact')->getPairs();
        $this->view->customerID = $customerID;
        $this->display();
    }

    /**
     * Browse contracts of the customer.
     * 
     * @param  int    $customerID 
     * @access public
     * @return void
     */
    public function contract($customerID)
    {
        $this->view->title      = $this->lang->customer->contract;
        $this->view->contracts  = $this->loadModel('contract')->getList($customerID);
        $this->view->modalWidth = 'lg';
        $this->display();
    }

    /**
     * Delete a customer.
     *
     * @param  int    $customerID
     * @access public
     * @return void
     */
    public function delete($customerID)
    {
        $customer = $this->customer->getByID($customerID);
        if(!$customer) $this->loadModel('common', 'sys')->checkPrivByCustomer('0');

        $this->customer->delete(TABLE_CUSTOMER, $customerID);
        if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
        $this->send(array('result' => 'success', 'locate' => inlink('browse')));
    }

    /**
     * get data to export.
     * 
     * @param  string $range 
     * @param  string $mode 
     * @param  string $orderBy 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function export($mode = 'all', $orderBy = 'id_desc')
    { 
        if($_POST)
        {
            $customerLang   = $this->lang->customer;
            $customerConfig = $this->config->customer;

            /* Create field lists. */
            $fields = explode(',', $customerConfig->list->exportFields);
            foreach($fields as $key => $fieldName)
            {
                $fieldName = trim($fieldName);
                $fields[$fieldName] = isset($customerLang->$fieldName) ? $customerLang->$fieldName : $fieldName;
                unset($fields[$key]);
            }

            $customers = array();
            if($mode == 'all')
            {
                $customerQueryCondition = $this->session->customerQueryCondition;
                if(strpos($customerQueryCondition, 'limit') !== false) $customerQueryCondition = substr($customerQueryCondition, 0, strpos($customerQueryCondition, 'limit'));
                $stmt = $this->dbh->query($customerQueryCondition);
                while($row = $stmt->fetch()) $customers[$row->id] = $row;
            }
            if($mode == 'thisPage')
            {
                $stmt = $this->dbh->query($this->session->customerQueryCondition);
                while($row = $stmt->fetch()) $customers[$row->id] = $row;
            }

            $users        = $this->loadModel('user')->getPairs('noletter');
            $areaList     = $this->loadModel('tree')->getOptionMenu('area');
            $industryList = $this->tree->getOptionMenu('industry');

            foreach($customers as $customer)
            {
                $customer->desc = htmlspecialchars_decode($customer->desc);
                $customer->desc = str_replace("<br />", "\n", $customer->desc);
                $customer->desc = str_replace('"', '""', $customer->desc);

                $customer->public = $customer->public ? $this->lang->yes : $this->lang->no;

                /* fill some field with useful value. */
                if(isset($customerLang->statusList[$customer->status]))     $customer->status   = $customerLang->statusList[$customer->status];
                if(isset($customerLang->typeList[$customer->type]))         $customer->type     = $customerLang->typeList[$customer->type];
                if(isset($customerLang->sizeNameList[$customer->size]))     $customer->size     = $customerLang->sizeNameList[$customer->size];
                if(isset($customerLang->levelNameList[$customer->level]))   $customer->level    = $customerLang->levelNameList[$customer->level];
                if(isset($customerLang->relationList[$customer->relation])) $customer->relation = $customerLang->relationList[$customer->relation];
                if(isset($areaList[$customer->area]))                       $customer->area     = $areaList[$customer->area];
                if(isset($industryList[$customer->industry]))               $customer->industry = $industryList[$customer->industry];

                if(isset($users[$customer->createdBy]))   $customer->createdBy   = $users[$customer->createdBy];
                if(isset($users[$customer->editedBy]))    $customer->editedBy    = $users[$customer->editedBy];
                if(isset($users[$customer->assignedTo]))  $customer->assignedTo  = $users[$customer->assignedTo];
                if(isset($users[$customer->assignedBy]))  $customer->assignedBy  = $users[$customer->assignedBy];
                if(isset($users[$customer->contactedBy])) $customer->contactedBy = $users[$customer->contactedBy];

                $customer->createdDate    = substr($customer->createdDate, 0, 10);
                $customer->editedDate     = substr($customer->editedDate, 0, 10);
                $customer->assignedDate   = substr($customer->assignedDate, 0, 10);
                $customer->contactedDate  = substr($customer->contactedDate, 0, 10);
                $customer->nextDate       = substr($customer->contactedDate, 0, 10);
            }

            $this->post->set('fields', $fields);
            $this->post->set('rows', $customers);
            $this->post->set('kind', 'customer');
            $this->fetch('file', 'export2CSV' , $_POST);
        }

        $this->display();
    }

    /**
     * ajax get customers for todo.
     * 
     * @param  string $account    not used.
     * @param  string $id 
     * @param  string $type       select|json|board 
     * @access public
     * @return void
     */
    public function ajaxGetTodoList($account = '', $id = '', $type = 'select')
    {
        $this->app->loadClass('date', $static = true);
        $customerIdList = $this->loadModel('customer', 'crm')->getCustomersSawByMe();
        $thisMonth      = date::getThisMonth();
        $customers      = array();

        $sql = $this->dao->select('c.id, c.name, c.nextDate, t.id as todo')->from(TABLE_CUSTOMER)->alias('c')
            ->leftjoin(TABLE_TODO)->alias('t')->on("t.type='customer' and c.id = t.idvalue")
            ->where('c.deleted')->eq(0)
            ->andWhere('c.relation')->ne('provider')
            ->andWhere('c.nextDate')->between($thisMonth['begin'], $thisMonth['end'])
            ->andWhere('c.nextDate')->ne('0000-00-00')
            ->andWhere('c.id')->in($customerIdList)
            ->orderBy('c.nextDate_asc');
        $stmt = $sql->query();
        while($customer = $stmt->fetch())
        {    
            if($customer->todo) continue;
            $customers[$customer->id] = $customer->name . '(' . $customer->nextDate . ')';
        } 

        if($type == 'select')
        {
            if($id) die(html::select("idvalues[$id]", $customers, '', 'class="form-control"'));
            die(html::select('idvalue', $customers, '', 'class=form-control'));
        }
        if($type == 'board')
        {
            die($this->loadModel('todo', 'oa')->buildBoardList($customers, 'task'));
        }
        die(json_encode($customers));
    }
}
