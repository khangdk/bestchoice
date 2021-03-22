<?php
class BackendController extends Controller
{
    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
        $this->_templateObj->setFolderTemplate('backend/main/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }

    public function changeStatusAction()
    {
        $this->_model->changeStatus($this->_arrParam, null);
        URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
    }

    public function deleteAction()
    {
        $this->_model->deleteItems($this->_arrParam);
        URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
    }

    public function activeAction()
    {
        $this->_model->multiChangeStatus($this->_arrParam);
        URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
    }

    public function inactiveAction()
    {
        $this->_model->multiChangeStatus($this->_arrParam);
        URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
    }

    public function ajaxOrderingAction()
    {
        $result = $this->_model->changeOrdering($this->_arrParam, ['task' => 'ajax']);
        echo json_encode($result);
    }
}
