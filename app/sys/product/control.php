<?php
/**
 * The control file of product module of RanZhi.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
class product extends control
{
    /** 
     * The index page, locate to browse.
     * 
     * @access public
     * @return void
     */
    public function index()
    {   
        $this->locate(inlink('browse'));
    }   

    /**
     * Browse product.
     * 
     * @param string $mode
     * @param string $staus
     * @param string $line
     * @param string $orderBy     the order by
     * @param int    $recTotal 
     * @param int    $recPerPage 
     * @param int    $pageID 
     * @access public
     * @return void
     */
    public function browse($mode = 'browse', $status = 'all', $line = '', $orderBy = 'id_desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {   
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        $this->session->set('productList', $this->app->getURI(true));

        /* Build search form. */
        $this->loadModel('search', 'sys');
        $this->config->product->search['actionURL'] = $this->createLink('product', 'browse', 'mode=bysearch');
        $this->search->setSearchParams($this->config->product->search);
        
        $this->view->title    = $this->lang->product->browse;
        $this->view->products = $this->product->getList($mode, $status, $line, $orderBy, $pager);
        $this->view->mode     = $mode;
        $this->view->status   = $status;
        $this->view->line     = $line;
        $this->view->orderBy  = $orderBy;
        $this->view->pager    = $pager;
        $this->display();
    }   

    /**
     * Create a product.
     * 
     * @access public
     * @return void
     */
    public function create()
    {
        if($_POST)
        {
            $productID = $this->product->create();       
            if(dao::isError())  $this->send(array('result' => 'fail', 'message' => dao::getError()));

            $this->loadModel('action')->create('product', $productID, 'Created');
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('browse')));
        }

        $this->view->title = $this->lang->product->create;
        $this->display();
    }

    /**
     * Edit a product.
     * 
     * @param  int $productID 
     * @access public
     * @return void
     */
    public function edit($productID)
    {
        if($_POST)
        {
            $changes = $this->product->update($productID);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));

            $files = $this->loadModel('file', 'sys')->saveUpload('product', $productID);
            if($changes or $files)
            {
                $fileAction = $files ? $this->lang->addFiles . join(',', $files) : '';

                $actionID = $this->loadModel('action')->create('product', $productID, 'Edited', $fileAction);
                if($changes) $this->action->logHistory($actionID, $changes);
            }

            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('browse')));
        }

        $this->view->title   = $this->lang->product->edit;
        $this->view->product = $this->product->getByID($productID);
        $this->display();
    }

    /**
     * View a product.
     * 
     * @param  int    $productID 
     * @access public
     * @return void
     */
    public function view($productID)
    {
        $this->view->title   = $this->lang->product->view;
        $this->view->product = $this->product->getByID($productID);
        $this->view->users   = $this->loadModel('user')->getPairs();
        
        $this->display();
    }

    /**
     * Delete a product.
     * 
     * @param  int      $productID 
     * @access public
     * @return void
     */
    public function delete($productID)
    {
        $this->product->delete(TABLE_PRODUCT, $productID);
        if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
        $this->send(array('result' => 'success', 'locate' => inlink('browse')));
    }

    /**
     * Ajax get product by line.
     * 
     * @param  string $status 
     * @param  string $line 
     * @access public
     * @return void
     */
    public function ajaxGetByLine($status = '', $line = '')
    {
        $products = $this->product->getPairs($status, $line);

        echo html::select('product', array('') + $products, '', "class='form-control chosen'");
    }
}
