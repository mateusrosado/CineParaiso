<?php

class Reserva {
    public $id;
    public $nome;
    public $email;
    public $filme_id;
    public $cadeira_id;

    public function __construct($id = null, $nome = null, $email = null, $filme_id = null, $cadeira_id = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->filme_id = $filme_id;
        $this->cadeira_id = $cadeira_id;
    }
}
