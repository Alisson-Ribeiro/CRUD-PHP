<?php

$erro = false;
if(count($_POST) > 0) {

    include('conexao.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $nascimento = $_POST['nascimento'];

    if(empty($nome)) {
        $erro = "preencha o nome";
    }
    if(empty($email)) {
        $erro = "preencha o email";
    }

    if(!empty($nascimento)) {
        $pedacos = explode('/', $nascimento);
        if(count($pedacos) == 3) {
            $nascimento = implode('-', array_reverse($pedacos));
        } else {
            $erro = "A data de nascimento deve seguir o padrão dia/mês/ano.";
        }
    }

    if($erro) {
        echo "<p><b>ERRO:$erro</b></p>";
    } else {
        $sql_code = "INSERT INTO clientes (nome, email, telefone, nascimento, data) VALUES ('$nome','$email',
        '$telefone','$nascimento', NOW())";

        $sucesso = $mysqli->query($sql_code) or die($mysqli->error);
        if($sucesso) {
            echo "<p><b>Cliente cadastrado com sucesso!</b></p>";
            unset($_POST);
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de clientes</title>
</head>
<body>
    <a href="clientes.php">Voltar para a lista</a>
    <form method="POST" action="">
        <p>
            <label for="">nome</label>
            <input value="<?php if(isset($_POST['nome'])) echo $_POST['nome']; ?>" type="text" name="nome" required autofocus>
        </p>
        <p>
            <label for="">email</label>
            <input value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" type="email" name="email" required>
        </p>
        <p>
            <label for="">telefone</label>
            <input value="<?php if(isset($_POST['telefone'])) echo $_POST['telefone']; ?>" placeholder="(11)98888-9999" type="text" name="telefone">
        </p>
        <p>
            <label for="">data de nascimento</label>
            <input value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento']; ?>" placeholder="01/01/1970" type="text" name="nascimento">
        </p>
        <p>
            <button type="submit">Salvar cliente</button>
        </p>
    </form>
</body>
</html>