<?php

namespace Term\Form;

use Zend\Form\Form;

class TermForm extends Form {

  public function __construct($name = null) {
    // we want to ignore the name passed
    parent::__construct('term');

    $this->add(array(
      'name' => 'id',
      'type' => 'Hidden',
    ));
    
    $this->add(array(
      'name' => 'abbreviation',
      'type' => 'Text',
      'options' => array(
        'label' => 'Abbreviation',
      ),
    ));
    
    $this->add(array(
      'name' => 'standsfor',
      'type' => 'Text',
      'options' => array(
        'label' => 'Stands For',
      ),
    ));
    
    $this->add(array(
      'name' => 'explanation',
      'type' => 'Text',
      'options' => array(
        'label' => 'Explanation',
      ),
    ));
    
    $this->add(array(
      'name' => 'example',
      'type' => 'Text',
      'options' => array(
        'label' => 'Example',
      ),
    ));
    
    $this->add(array(
      'name' => 'link',
      'type' => 'Text',
      'options' => array(
        'label' => 'Link',
      ),
    ));
    
    $this->add(array(
      'name' => 'submit',
      'type' => 'Submit',
      'attributes' => array(
        'value' => 'Go',
        'id' => 'submitbutton',
      ),
    ));
  }

}
