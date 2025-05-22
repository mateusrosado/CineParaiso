<?php

class Cadeira {
    public $id;
    public $codigo;

    public function __construct($id = null, $codigo = null) {
        $this->id = $id;
        $this->codigo = $codigo;
    }
}
