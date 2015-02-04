<?php

namespace Term\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Term {

  public $id;
  public $abbreviation;
  public $standsfor;
  public $explanation;
  public $example;
  public $link;
  protected $inputFilter;  

  public function exchangeArray($data) {
    $this->id = (!empty($data['id'])) ? $data['id'] : null;
    $this->abbreviation = (!empty($data['abbreviation'])) ? $data['abbreviation'] : null;
    $this->standsfor = (!empty($data['standsfor'])) ? $data['standsfor'] : null;
    $this->explanation = (!empty($data['explanation'])) ? $data['explanation'] : null;
    $this->example = (!empty($data['example'])) ? $data['example'] : null;
    $this->link = (!empty($data['link'])) ? $data['link'] : null;
  }
  
  public function getArrayCopy() {
    return get_object_vars($this);
  }

  public function setInputFilter(InputFilterInterface $inputFilter) {
    throw new \Exception("Not used");
  }
  
  public function getInputFilter() {
    if (!$this->inputFilter) {
      $inputFilter = new InputFilter();

      // "id"
      $inputFilter->add(array(
        'name' => 'id',
        'required' => true,
        'filters' => array(
          array('name' => 'Int'),
        ),
      ));

      // "abbreviation"
      $inputFilter->add(array(
        'name' => 'abbreviation',
        'required' => true,
        'filters' => array(
          array('name' => 'StripTags'),
          array('name' => 'StringTrim'),
        ),
        'validators' => array(
          array(
            'name' => 'StringLength',
            'options' => array(
              'encoding' => 'UTF-8',
              'min' => 1,
              'max' => 100,
            ),
          ),
        ),
      ));

      // "stands for"
      $inputFilter->add(array(
        'name' => 'standsfor',
        'required' => true,
        'filters' => array(
          array('name' => 'StripTags'),
          array('name' => 'StringTrim'),
        ),
        'validators' => array(
          array(
            'name' => 'StringLength',
            'options' => array(
              'encoding' => 'UTF-8',
              'min' => 1,
              'max' => 200,
            ),
          ),
        ),
      ));
      
      // "explanation"
      $inputFilter->add(array(
        'name' => 'explanation',
        'required' => false,
        'filters' => array(
          array('name' => 'StripTags'),
          array('name' => 'StringTrim'),
        ),
        'validators' => array(
          array(
            'name' => 'StringLength',
            'options' => array(
              'encoding' => 'UTF-8',
              'min' => 1,
              'max' => 1000,
            ),
          ),
        ),
      ));
      
      // "example"
      $inputFilter->add(array(
        'name' => 'example',
        'required' => false,
        'filters' => array(
          array('name' => 'StripTags'),
          array('name' => 'StringTrim'),
        ),
        'validators' => array(
          array(
            'name' => 'StringLength',
            'options' => array(
              'encoding' => 'UTF-8',
              'min' => 1,
              'max' => 1000,
            ),
          ),
        ),
      ));
      
      // "link"
      $inputFilter->add(array(
        'name' => 'link',
        'required' => false,
        'filters' => array(
          array('name' => 'StripTags'),
          array('name' => 'StringTrim'),
        ),
        'validators' => array(
          array(
            'name' => 'StringLength',
            'options' => array(
              'encoding' => 'UTF-8',
              'min' => 1,
              'max' => 500,
            ),
          ),
        ),
      ));

      $this->inputFilter = $inputFilter;
    }

    return $this->inputFilter;
  }

}
