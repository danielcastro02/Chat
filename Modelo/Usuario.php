<?php

class usuario {

    protected $id_usuario;
    protected $nome;
    protected $senha;
    protected $telefone;
    protected $foto;
    public function __construct() {
        if (func_num_args() != 0) {
            $atributos = func_get_args()[0];
            foreach ($atributos as $atributo => $valor) {
                if (isset($valor)) {
                    $this->$atributo = $valor;
                }
            }
        }
    }

    function atualizar($vetor) {
        foreach ($vetor as $atributo => $valor) {
            if (isset($valor)) {
                $this->$atributo = $valor;
            }
        }
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }
    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getNome() {
        return $this->nome;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    public function getSenha() {
        return $this->senha;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getTelefone() {
        if ($this->telefone != null) {
            $newCel = str_replace("-", "", $this->telefone);
            $newCel = str_replace("(", "", $newCel);
            $newCel = str_replace(")", "", $newCel);
            $newCel = str_replace(" ", "", $newCel);
            return $newCel;
        } else {
            return null;
        }
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }


    public function getFoto() {
        return $this->foto;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

}
