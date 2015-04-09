<?php

namespace Term\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class TermTable {

  protected $tableGateway;

  public function __construct(TableGateway $tableGateway) {
    $this->tableGateway = $tableGateway;
  }

  public function fetchAll($paginated = false) {
    if ($paginated) {
      // create a new Select object for the table term
      $select = new Select('term');
      // create a new result set based on the Term entity
      $resultSetPrototype = new ResultSet();
      $resultSetPrototype->setArrayObjectPrototype(new Term());
      // create a new pagination adapter object
      $paginatorAdapter = new DbSelect(
              // our configured select object
              $select->order('abbreviation'),
              // the adapter to run it against
              $this->tableGateway->getAdapter(),
              // the result set to hydrate
              $resultSetPrototype
      );
      $paginator = new Paginator($paginatorAdapter);
      return $paginator;
    } // if paginated
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
