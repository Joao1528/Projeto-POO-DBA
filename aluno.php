<?php
    require_once('controllers./Conexao.php');
    require_once('controllers./Crud.php');
    require_once('controllers./config.php');
    $Crud = new Crud(HOST, USER, PASS, BD);
    $mysqli = $Crud->conectar();


if (isset($_POST['email']) || isset($_post['senha'])){

    if(strlen($_POST['email']) == 0){
        echo  "<script>alert('Preencha o E-mail!');</script>";
    
    }elseif(strlen($_POST['senha']) == 0){
        echo  "<script>alert('Preencha a senha!');</script>";
    } else{
        $email = $mysqli ->real_escape_string($_POST["email"]);
        $senha = $mysqli ->real_escape_string($_POST["senha"]);

        //começa
        $dados= array('email'=>$email, 'senha'=>$senha);
        $sql_query = $Crud->login('aluno',$dados);
        // termina
        $quantidade = $sql_query->num_rows;

        if($quantidade == 1){
            $usuario = $sql_query -> fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: painel.php");

        } else{
            echo  "<script>alert('Falha ao logar, E-mail ou senha inválido');</script>";
        }

    }

}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets./style.css">
    <title>STUDY</title>
</head>

<body>
    <div class="main-login">
        <div class="left-login">
            <h1>BEM-VINDOS ALUNOS</h1>
            <img src="./assets/audiobook-animate.svg" class="left-login-image" alt="">
        </div>

        <div class="right-login">
            <div class="card-login">
                <h1>LOGIN</h1>

                <form action="" method="post">

                    <div class="textfield">
                        <label for="usuario">Usuário</label>
                        <input type="text" name="email" placeholder="Usuário">
                        <label for="senha">senha</label>
                        <input type="password" name="senha" placeholder="Senha">
                        <button id="btn" type="submit">LOGIN</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>