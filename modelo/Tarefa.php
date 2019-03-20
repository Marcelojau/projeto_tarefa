<?php
class Tarefa {
    private $cod_tarefa;
    private $titulo;
    private $descricao;
    private $status;

    function setCodTarefa($cod_tarefa){
        $this->cod_tarefa = $cod_tarefa;
    }

    function getCodTarefa(){
        return $this->cod_tarefa;
    }

    function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    function getTitulo(){
        return $this->titulo;
    }


    function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    function getDescricao(){
        return $this->descricao;
    }

    function setStatus($status){
        $this->status = $status;
    }

    function getStatus(){
        return $this->status;
    }
 }
?>