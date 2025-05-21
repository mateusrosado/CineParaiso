<?php
namespace app\controllers;

use mf\controller\Action;
use mf\model\Container;

class HomeController extends Action
{
  public function index()
  {
    $filme = Container::getModel('Filmes');
    $filmes = $filme->getFilmes();
    @$this->view->dados = $filmes;
    $this->render('index','layout1');
  }
}