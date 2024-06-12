<?php
class Creneau {

  public $debut;
  public $fin;

  public function __construct(int $start = 8, int $end = 19) {
    $this->debut = $start;
    $this->fin = $end;
  }

  public function in_creneau(int $hour) : bool {
    return $hour >= $this->debut && $hour <= $this->fin;
  }

  public function toHTML() : string {
    return "<strong>{$this->debut}h</strong> à <strong>{$this->fin}h</strong>";
  }
}