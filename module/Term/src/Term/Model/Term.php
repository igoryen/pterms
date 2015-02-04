<?php

namespace Term\Model;

class Term {

  public $id;
  public $abbreviation;
  public $standsfor;
  public $explanation;
  public $example;
  public $link;

  public function exchangeArray($data) {
    $this->id = (!empty($data['id'])) ? $data['id'] : null;
    $this->abbreviation = (!empty($data['abbreviation'])) ? $data['abbreviation'] : null;
    $this->standsfor = (!empty($data['standsfor'])) ? $data['standsfor'] : null;
    $this->explanation = (!empty($data['explanation'])) ? $data['explanation'] : null;
    $this->example = (!empty($data['example'])) ? $data['example'] : null;
    $this->link = (!empty($data['link'])) ? $data['link'] : null;
  }

}
