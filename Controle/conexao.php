<?php

class conexao {

    private static $con;

    public static function getConexao(): PDO {
        try {
            if (is_null(self::$con)) {
            self::$con = new PDO('mysql:host=localhost;dbname=chat', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            }
            return self::$con;
        } catch (Exception $e) {
            header('location: '.(realpath('./index.php')?".":"..").'/Tela/erroInterno.php?msg=deuErroDeAcessoNegadoAoBanco');
        }
    }

    public static function getTransactConnetion(): PDO {
        try {
        return new PDO('mysql:host=localhost;dbname=chat', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch (Exception $e) {
            header('location: '.(realpath('./index.php')?".":"..").'/Tela/erroInterno.php?msg=deuErroDeAcessoNegadoAoBanco');
        }
    }

}
