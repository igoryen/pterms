<?php

namespace Term\Model;

use Zend\Db\TableGateway\TableGateway;

class TermTable {

  protected $tableGateway;

  public function __construct(TableGateway $tableGateway) {
    $this->tableGateway = $tableGateway;
  }

  public function fetchAll() {
    $resultSet = $this->tableGateway->select();
    return $resultSet;
  }

  public function getTerm($id) {
    $id = (int) $id;
    $rowset = $this->tableGateway->select(array('id' => $id));
    $row = $rowset->current();
    if (!$row) {
      throw new \Exception("Could not find row $id");
    }
    return $row;
  }

  public function saveTerm(Term $term) {
    $data = array(
      'abbreviation'  => $term->abbreviation,
      'standsfor'     => $term->standsfor,
      'explanation'   => $term->explanation,
      'example'       => $term->example,
      'link'          => $term->link,
    );

    $id = (int) $term->id;
    if ($id == 0) {
      $this->tableGateway->insert($data);
    }
    else {
      if ($this->getTerm($id)) {
        $this->tableGateway->update($data, array('id' => $id));
      }
      else {
        throw new \Exception('Term id does not exist');
      }
    }
  }

  public function deleteTerm($id) {
    $this->tableGateway->delete(array('id' => (int) $id));
  }

}
