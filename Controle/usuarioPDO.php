<?php

if (realpath('./index.php')) {
    include_once './Controle/conexao.php';
    include_once './Modelo/Usuario.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/conexao.php';
        include_once '../Modelo/Usuario.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/conexao.php';
            include_once '../../Modelo/Usuario.php';
        }
    }
}


class UsuarioPDO{
    
             /*inserir*/
    function inserirUsuario() {
        $usuario = new usuario($_POST);
        if($_POST['senha1'] == $_POST['senha2']){
            $senhamd5 = md5($_POST['senha1']);
            $con = new conexao();
            $pdo = $con->getConexao();
            $stmt = $pdo->prepare('insert into usuario values(default , :nome , :senha , :telefone , "");' );

            $stmt->bindValue(':nome', $usuario->getNome());    
        
            $stmt->bindValue(':senha', $senhamd5);    
        
            $stmt->bindValue(':telefone', $usuario->getTelefone());    
        
            if($stmt->execute()){ 
                header('location: ../index.php?msg=usuarioInserido');
            }else{
                header('location: ../index.php?msg=usuarioErroInsert');
            }
        } else{
            header('location: ../Tela/registroUsuario.php?msg=senhaerrada');      
        }
    }
    /*inserir*/
                
    

            

    public function selectUsuario(){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from usuario ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectUsuarioId_usuario($id_usuario){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from usuario where id_usuario = :id_usuario;');
        $stmt->bindValue(':id_usuario', $id_usuario);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectUsuarioNome($nome){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from usuario where nome = :nome;');
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectUsuarioSenha($senha){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from usuario where senha = :senha;');
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectUsuarioTelefone($telefone){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from usuario where telefone = :telefone;');
        $stmt->bindValue(':telefone', $telefone);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    
 
    public function updateUsuario(Usuario $usuario){        
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('update usuario set nome = :nome , senha = :senha , telefone = :telefone where id_usuario = :id_usuario;');
        $stmt->bindValue(':nome', $usuario->getNome());
        
        $stmt->bindValue(':senha', $usuario->getSenha());
        
        $stmt->bindValue(':telefone', $usuario->getTelefone());
        
        $stmt->bindValue(':id_usuario', $usuario->getId_usuario());
        $stmt->execute();
        return $stmt->rowCount();
    }            
    
    public function deleteUsuario($definir){
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('delete from usuario where id_usuario = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    public function deletar(){
        $this->deleteUsuario($_GET['id']);
        header('location: ../Tela/listarUsuario.php');
    }




            /*login*/
    public function login() {
        $con = new conexao();
        $pdo = $con->getConexao();
        $senha = md5($_POST['senha']);
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE telefone LIKE :telefone AND senha LIKE :senha");
        $stmt->bindValue(":telefone", $_POST['telefone']);
        $stmt->bindValue(":senha", $senha);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $linha = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['logado'] = serialize(new Usuario($linha));
            header("Location: ../index.php");
        } else {
            header("Location: ../Tela/login.php?msg=erro");
        }
    }
    
    function logout(){
        session_destroy();
        header('location: ../Tela/login.php');
    }
    
/*login*/

/*chave*/}
