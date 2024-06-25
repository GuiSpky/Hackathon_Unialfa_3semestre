<?php
// Função para exibir mensagem de erro
function mensagemErro($mensagem)
{
    echo "<div class='alert alert-danger' role='alert'>$mensagem</div>";
}

// Função para fazer requisições GET para a API Node.js
function getIdosos()
{
    $url = 'http://localhost:3003/api/idoso';

    $response = file_get_contents($url);

    if ($response === false) {
        mensagemErro("Erro ao acessar a API Node.js");
    } else {
        $idosos = json_decode($response, true);
        // Processar e exibir os idosos, se necessário
        var_dump($idosos); // Exemplo de processamento
    }
}

// Função para fazer requisições POST para a API Node.js
function criarIdoso($nome, $cpf, $telefone, $endereco, $historicoMedico, $dataNascimento)
{
    $url = 'http://localhost:3003/api/idoso';

    $data = array(
        'nome' => $nome,
        'cpf' => $cpf,
        'telefone' => $telefone,
        'endereco' => $endereco,
        'historicoMedico' => $historicoMedico,
        'DataNascimento' => $dataNascimento
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
        mensagemErro("Erro ao criar novo idoso");
    } else {
        $response = json_decode($result, true);
        echo $response['mensagem']; // Exibe a mensagem de retorno da API Node.js
    }
}

// Função para fazer requisições PUT para a API Node.js
function editarIdoso($id, $nome, $cpf, $telefone, $endereco, $historicoMedico, $dataNascimento)
{
    $url = 'http://localhost:3003/api/idoso/' . $id;

    $data = array(
        'nome' => $nome,
        'cpf' => $cpf,
        'telefone' => $telefone,
        'endereco' => $endereco,
        'historicoMedico' => $historicoMedico,
        'DataNascimento' => $dataNascimento
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
        mensagemErro("Erro ao atualizar idoso");
    } else {
        $response = json_decode($result, true);
        echo $response['message']; // Exibe a mensagem de retorno da API Node.js
    }
}

// Função para fazer requisições DELETE para a API Node.js
function deletarIdoso($id)
{
    $url = 'http://localhost:3003/api/idoso/' . $id;

    $options = array(
        'http' => array(
            'method' => 'DELETE'
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === false) {
        mensagemErro("Erro ao excluir idoso");
    } else {
        $response = json_decode($result, true);
        echo $response['message']; // Exibe a mensagem de retorno da API Node.js
    }
}
// Exemplo de uso das funções:
// getIdosos(); // Exemplo de requisição GET
// criarIdoso("Nome do Idoso", "CPF do Idoso", "Telefone do Idoso", "Endereço do Idoso", "Histórico Médico do Idoso", "Data de Nascimento do Idoso"); // Exemplo de requisição POST
// editarIdoso(1, "Novo Nome", "Novo CPF", "Novo Telefone", "Novo Endereço", "Novo Histórico Médico", "Nova Data de Nascimento"); // Exemplo de requisição PUT
// deletarIdoso(1); // Exemplo de requisição DELETE

?>
<body>
    <div class="login">
        <h1>Idosos</h1>
        <!-- Exemplo de formulário para criar um novo idoso -->
        <form method="POST">
            <label for="nome">Nome do Idoso:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="cpf">CPF do Idoso:</label>
            <input type="text" id="cpf" name="cpf" required>

            <label for="telefone">Telefone do Idoso:</label>
            <input type="text" id="telefone" name="telefone" required>

            <label for="endereco">Endereço do Idoso:</label>
            <input type="text" id="endereco" name="endereco" required>

            <label for="historicoMedico">Histórico Médico:</label>
            <input type="text" id="historicoMedico" name="historicoMedico" required>

            <label for="dataNascimento">Data de Nascimento:</label>
            <input type="text" id="dataNascimento" name="dataNascimento" required>
            <br>
            <button type="submit" class="btn btn-success" style="margin-top:10px;" >Criar Idoso</button>
        </form>
        <!-- Adicione outros formulários, listagens, etc., conforme necessário -->
    </div>
</body>
</html>
