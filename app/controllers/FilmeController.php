<?php
namespace app\controllers;

use mf\controller\Action;
use mf\model\Container;

class FilmeController extends Action
{
  public function index()
  {
    $this->render('index','layout2');
  }

  public function store($params)
  {
    $filme = Container::getModel('Filmes');
    $filmes = $filme->getDetalhes($params->id);
    @$this->view->dados = $filmes;
    $this->render('index','layout1');
  }
}