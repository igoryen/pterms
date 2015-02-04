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
    $id = (int) $this->params()->fromRoute('id', 0);
    if (!$id) {
      return $this
              ->redirect()
              ->toRoute('term', array(
                'action' => 'add'
      ));
    }

    // Get the Term with the specified id.  An exception is thrown
    // if it cannot be found, in which case go to the index page.
    try {
      $term = $this->getTermTable()->getTerm($id);
    } catch (\Exception $ex) {
      return $this->redirect()->toRoute('term', array(
                'action' => 'index'
      ));
    }

    $form = new TermForm();
    $form->bind($term);
    $form->get('submit')->setAttribute('value', 'Edit');

    $request = $this->getRequest();
    if ($request->isPost()) {
      $form->setInputFilter($term->getInputFilter());
      $form->setData($request->getPost());

      if ($form->isValid()) {
        $this->getTermTable()->saveTerm($term);

        // Redirect to list of terms
        return $this->redirect()->toRoute('term');
      }
    }

    return array(
      'id' => $id,
      'form' => $form,
    );
  }

  public function deleteAction() {
    $id = (int) $this->params()->fromRoute('id', 0);
    if (!$id) {
      return $this->redirect()->toRoute('term');
    }

    $request = $this->getRequest();
    if ($request->isPost()) {
      $del = $request->getPost('del', 'No');

      if ($del == 'Yes') {
        $id = (int) $request->getPost('id');
        $this->getTermTable()->deleteTerm($id);
      }

      // Redirect to list of terms
      return $this->redirect()->toRoute('term');
    }

    return array(
      'id' => $id,
      'term' => $this->getTermTable()->getTerm($id)
    );
  }

  public function getTermTable() {
    if (!$this->termTable) {
      $sm = $this->getServiceLocator();
      $this->termTable = $sm->get('Term\Model\TermTable');
    }
    return $this->termTable;
  }

}
