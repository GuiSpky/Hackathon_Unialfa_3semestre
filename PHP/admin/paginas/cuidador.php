<?php
// Função para exibir mensagem de erro
function mensagemErro($mensagem)
{
    echo "<div class='alert alert-danger' role='alert'>$mensagem</div>";
}

// Função para fazer requisições GET para a API Node.js
function getCuidadores()
{
    $url = 'http://localhost:3003/api/cuidador';

    $response = file_get_contents($url);

    if ($response === false) {
        mensagemErro("Erro ao acessar a API Node.js");
    } else {
        $cuidadores = json_decode($response, true);
        // Processar e exibir os cuidadores, se necessário
        var_dump($cuidadores); // Exemplo de processamento
    }
}

// Função para fazer requisições POST para a API Node.js
function criarCuidador($nome, $idIdoso)
{
    $url = 'http://localhos:3003/api/cuidador';

    $data = array(
        'nome' => $nome,
        'idIdoso' => $idIdoso
    );

    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-type: application/json',
            'content' => json_encode($data)
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === false) {
        mensagemErro("Erro ao criar novo cuidador");
    } else {
        $response = json_decode($result, true);
        echo $response['mensagem']; // Exibe a mensagem de retorno da API Node.js
    }
}

// Função para fazer requisições PUT para a API Node.js
function editarCuidador($id, $nome, $idIdoso)
{
    $url = 'http://localhost:3003/api/cuidador/' . $id;

    $data = array(
        'nome' => $nome,
        'idIdoso' => $idIdoso
    );

    $options = array(
        'http' => array(
            'method' => 'PUT',
            'header' => 'Content-type: application/json',
            'content' => json_encode($data)
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === false) {
        mensagemErro("Erro ao atualizar cuidador");
    } else {
        $response = json_decode($result, true);
        echo $response['message']; // Exibe a mensagem de retorno da API Node.js
    }
}

// Função para fazer requisições DELETE para a API Node.js
function deletarCuidador($id)
{
    $url = 'http://localhost:3003/api/cuidador/' . $id;

    $options = array(
        'http' => array(
            'method' => 'DELETE'
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === false) {
        mensagemErro("Erro ao excluir cuidador");
    } else {
        $response = json_decode($result, true);
        echo $response['message']; // Exibe a mensagem de retorno da API Node.js
    }
}

// Exemplo de uso das funções:
// getCuidadores(); // Exemplo de requisição GET
// criarCuidador("Nome do Cuidador", "ID do Idoso"); // Exemplo de requisição POST
// editarCuidador(1, "Novo Nome", "Novo ID do Idoso"); // Exemplo de requisição PUT
// deletarCuidador(1); // Exemplo de requisição DELETE
?>
<body>
    <div class="login">
        <h1>Cuidadores</h1>
        <!-- Exemplo de formulário para criar um novo cuidador -->
        <form method="POST">
            <label for="nome">Nome do Cuidador:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="idIdoso">ID do Idoso:</label>
            <input type="text" id="idIdoso" name="idIdoso" required>

            <button type="submit" class="btn btn-success">Criar Cuidador</button>
        </form>
        <!-- Adicione outros formulários, listagens, etc., conforme necessário -->
    </div>
</body>
</html>
