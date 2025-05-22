<?php

class Filme {
    public $id;
    public $titulo;
    public $descricao;
    public $horario;
    public $capaUrl;

    public function __construct($id = null, $titulo = null, $horario = null, $descricao = null, $capaUrl = null) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->horario = $horario;
        $this->descricao = $descricao;
        $this->capaUrl = $capaUrl;
    }
}
