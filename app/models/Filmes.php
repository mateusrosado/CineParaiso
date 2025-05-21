<?php

namespace app\models;

use mf\model\Model;

class Filmes extends Model
{
    public function getFilmes() {
        $query = 'select id, titulo,horario from filmes';
        return $this->db->query($query)->fetchAll();
    }
    public function getDetalhes($id) {
        $query = 'SELECT titulo, descricao, horario FROM filmes WHERE id ='.$id;
        return $this->db->query($query)->fetchAll();
    }

}
