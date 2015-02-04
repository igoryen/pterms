<?php

namespace Term\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TermController extends AbstractActionController {
  
  protected $termTable;

  public function indexAction() {
    return new ViewModel(array(
      'terms' => $this->getTermTable()->fetchAll(),
    ));
  }

  public function addAction() {
    
  }

  public function editAction() {
    
  }

  public function deleteAction() {
    
  }

  public function getTermTable() {
    if (!$this->termTable) {
      $sm = $this->getServiceLocator();
      $this->termTable = $sm->get('Term\Model\TermTable');
    }
    return $this->termTable;
  }

}
