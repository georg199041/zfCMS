<?php

class BugController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function submitAction()
    {
        $frmBugReport = new Application_Form_BugReport();
        		$frmBugReport->setAction($this->view->baseUrl() . '/bug/submit');
        		$frmBugReport->setMethod('post');
        		if ($this->getRequest()->isPost()) {
        			if ($frmBugReport->isValid($_POST)) {
        				$bugModel = new Application_Model_DbTable_Bugs();
        				// if the form is valid then create the new bug
        				$result = $bugModel->createBug(
        					  $frmBugReport->getValue('author')
        					, $frmBugReport->getValue('email')
        					, $frmBugReport->getValue('date')
        					, $frmBugReport->getValue('url')
        					, $frmBugReport->getValue('description')
        					, $frmBugReport->getValue('priority')
        					, $frmBugReport->getValue('status'));
        				// if the createBug method returns a result
        				// then the bug was successfully created
        				if ($result) {
        					$this->_forward('confirm');
        				}
        			}
        		}
        		$this->view->form = $frmBugReport;
    }

    public function confirmAction()
    {
        // action body
    }

    public function listAction()
    {
        //*-----List Search-----*
        		// get the filter form
        		$listToolsForm = new Application_Form_BugReportListTools();
        		$listToolsForm->setAction($this->view->baseUrl() . '/bug/list');
        		$listToolsForm->setMethod('post');
        		$this->view->listToolsForm = $listToolsForm;
        		
        		// set the sort and filter criteria. you need to update this to use the request,
        		// as these values can come in from the form post or a url parameter
        		$sort = $this->_request->getParam('sort', null);
        		$filterField = $this->_request->getParam('filter_field', null);
        		$filterValue = $this->_request->getParam('filter');
        		if (!empty($filterField)) {
        			$filter[$filterField] = $filterValue;
        		} else {
        			$filter = null;
        		}
        		
        		// now you need to manually set these controls values
        		$listToolsForm->getElement('sort')->setValue($sort);
        		$listToolsForm->getElement('filter_field')->setValue($filterField);
        		$listToolsForm->getElement('filter')->setValue($filterValue);
        		//*----------------*
        		
        		//*-----Set List and Paginator-----*
        		// fetch the bug paginator adapter
        		$bugModel = new Application_Model_DbTable_Bugs();
        		$adapter = $bugModel->readPaginatorAdapter($filter, $sort);
        		$paginator = new Zend_Paginator($adapter);
        		
        		// show 10 bugs per page
        		$paginator->setItemCountPerPage(2);
        		
        		// get the page number that is passed in the request.
        		//if none is set then default to page 1.
        		$page = $this->_request->getParam('page', 1);
        		$paginator->setCurrentPageNumber($page);
        		
        		// pass the paginator to the view to render
        		$params = Zend_Controller_Front::getInstance()->getRequest()->getParams();
        		$this->view->paginator = $paginator;
        		//*--------------------*
    }

    public function editAction()
    {
        $bugModel = new Application_Model_DbTable_Bugs();
        		$frmBugReport = new Application_Form_BugReport();
        		$frmBugReport->setAction($this->view->baseUrl() . '/bug/edit');
        		$frmBugReport->setMethod('post');
        		if ($this->getRequest()->isPost()) {
        			if ($frmBugReport->isValid($_POST)) {
        				$bugModel = new Application_Model_DbTable_Bugs();
        				// if the form is valid then update the bug
        				$result = $bugModel->updateBug($frmBugReport->getValue('id'), $frmBugReport->
        					getValue('author'), $frmBugReport->getValue('email'), $frmBugReport->getValue
        					('date'), $frmBugReport->getValue('url'), $frmBugReport->getValue('description'),
        					$frmBugReport->getValue('priority'), $frmBugReport->getValue('status'));
        				return $this->_forward('list');
        			}
        		} else {
        			$id = $this->_request->getParam('id');
        			$bug = $bugModel->find($id)->current();
        			$frmBugReport->populate($bug->toArray());
        			//format the date field
        			$frmBugReport->getElement('date')->setValue(date('m-d-Y', $bug->date));
        		}
        		$this->view->form = $frmBugReport;
    }

    public function deleteAction()
	{
		$bugModel = new Application_Model_DbTable_Bugs();
		$id = $this->_request->getParam('id');
		$bugModel->deleteBug($id);
		return $this->_forward('list');
	}


}











