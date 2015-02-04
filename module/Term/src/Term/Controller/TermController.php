<?php

namespace Term\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Term\Model\Term;
use Term\Form\TermForm;

class TermController extends AbstractActionController {
  
  protected $termTable;

  public function indexAction() {
    return new ViewModel(array(
      'terms' => $this->getTermTable()->fetchAll(),
    ));
  }

  public function addAction() {
    $form = new TermForm();
    $form->get('submit')->setValue('Add');

    $request = $this->getRequest();
    if ($request->isPost()) {
      $term = new Term();
      $form->setInputFilter($term->getInputFilter());
      $form->setData($request->getPost());

      if ($form->isValid()) {
        $term->exchangeArray($form->getData());
        $this->getTermTable()->saveTerm($term);

        // Redirect to list of terms
        return $this->redirect()->toRoute('term');
      }
    }
    return array('form' => $form);
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
