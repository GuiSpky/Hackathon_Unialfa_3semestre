<?php
$login = $_POST['login'] ?? NULL;
$senha = $_POST['senha'] ?? NULL;

$loginNaoVazio = !empty($login);
$senhaNaoVazio = !empty($senha);

// Verificar se tem informação no POST
if ($loginNaoVazio && $senhaNaoVazio) {
    $sql = "
            select id, nome, cpf, senha
                from idoso
                where
                cpf = :login 
        ";

    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":login", $login);
    $consulta->execute();


    $dadosDoBanco = $consulta->fetch(PDO::FETCH_OBJ);
    $idNaoExiste = !isset($dadosDoBanco->id);
    $senhaInvalida = !password_verify($senha, $dadosDoBanco->senha);
    if ($idNaoExiste) {
        mensagemErro("usuário nao encontrado");
    } elseif ($senhaInvalida) {
        mensagemErro("senha nao invalidad");
    }
    $_SESSION["usuario"] = [
        "id" => $dadosDoBanco->id,
        "nome" => $dadosDoBanco->nome,
        "cpf" => $dadosDoBanco->login
    ];
    // echo "<script>location.href='paginas/home.php'</script>";
    exit;
}

?>

<div class="login">
    <h1 class="text-align">Efetuar Login</h1>
    <form method="POST">
        <label for="Login">Login</label>
        <input type="text" name="login" id="login" class="form-control" required placeholder="Insira o cpf">
        <br>

        <label for="Senha">Senha</label>
        <input type="password" name="senha" id="senha" class="form-control" required placeholder="Digite sua senha">
        <br>
        <button type="submit" class="btn btn-success w-100">Efetuar Login</button>

    </form>
</div>