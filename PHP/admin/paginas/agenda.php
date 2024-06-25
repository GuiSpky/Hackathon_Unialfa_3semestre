<?php
// Função para exibir mensagem de erro
function mensagemErro($mensagem)
{
    echo "<div class='alert alert-danger' role='alert'>$mensagem</div>";
}

// Função para exibir mensagem de sucesso
function mensagemSucesso($mensagem)
{
    echo "<div class='alert alert-success' role='alert'>$mensagem</div>";
}

// Função para realizar requisições GET para a API Node.js
function listarAgendamentos($url)
{
    $response = file_get_contents($url);

    if ($response === false) {
        mensagemErro("Erro ao acessar a API Node.js");
        return null;
    } else {
        return json_decode($response, true);
    }
}

// Verifica se houve envio de dados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url = 'http://localhost:3003/api/agenda'; // Substitua pela URL correta da sua API Node.js

    // Captura dos dados do formulário
    $idAgente = $_POST['idAgente']; // Substitua pelo valor correto do idAgente
    $idIdoso = $_POST['idIdoso']; // Substitua pelo valor correto do idIdoso
    $dataVisita = $_POST['dataVisita'];
    $horaVisita = $_POST['horaVisita'];
    $info = $_POST['info']; // Se houver campo 'info'
    $idVacina = $_POST['idVacina'];

    $data = array(
        'idAgente' => $idAgente,
        'idIdoso' => $idIdoso,
        'dataVisita' => $dataVisita,
        'horaVisita' => $horaVisita,
        'info' => $info,
        'idVacina' => $idVacina
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
        mensagemErro("Erro ao criar novo agendamento");
    } else {
        $response = json_decode($result, true);
        mensagemSucesso($response['mensagem']); // Exibe a mensagem de retorno da API Node.js
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Verifica se foi clicado no botão Listar Agendamentos
    if (isset($_GET['listar'])) {
        $url = 'http://localhost:3003/api/agenda'; // Substitua pela URL correta da sua API Node.js

        // Chama a função para listar os agendamentos
        $agenda = listarAgendamentos($url);

        if ($agenda !== null) {
            echo "<h2>Agendamentos Cadastrados</h2>";
            echo "<ul>";
            foreach ($agenda as $agendamento) {
                echo "<li>ID Agendamento: " . $agendamento['id'] . ", Data: " . $agendamento['dataVisita'] . ", Hora: " . $agendamento['horaVisita'] . "</li>";
            }
            echo "</ul>";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $id = 1; // ID do agendamento a ser atualizado
    $url = 'http://localhost:3003/api/agenda/' . $id; // Substitua pela URL correta da sua API Node.js

    // Captura dos dados do formulário para atualização
    $idAgente = $_POST['idAgente']; // Substitua pelo novo valor do idAgente
    $idIdoso = $_POST['idIdoso']; // Substitua pelo novo valor do idIdoso
    $dataVisita = $_POST['dataVisita'];
    $horaVisita = $_POST['horaVisita'];
    $info = $_POST['info']; // Se houver campo 'info'
    $idVacina = $_POST['idVacina'];
    $dataAplicacao = $_POST['dataAplicacao'];

    $data = array(
        'idAgente' => $idAgente,
        'idIdoso' => $idIdoso,
        'dataVisita' => $dataVisita,
        'horaVisita' => $horaVisita,
        'info' => $info,
        'idVacina' => $idVacina,
        'DataAplicacao' => $dataAplicacao
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
        mensagemErro("Erro ao atualizar agendamento");
    } else {
        $response = json_decode($result, true);
        mensagemSucesso($response['message']); // Exibe a mensagem de retorno da API Node.js
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $id = 1; // ID do agendamento a ser excluído
    $url = 'http://localhost:3003/api/agenda/' . $id; // Substitua pela URL correta da sua API Node.js

    $options = array(
        'http' => array(
            'method' => 'DELETE'
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === false) {
        mensagemErro("Erro ao excluir agendamento");
    } else {
        $response = json_decode($result, true);
        mensagemSucesso($response['message']); // Exibe a mensagem de retorno da API Node.js
    }
} else {
    // Método HTTP não suportado
    mensagemErro("Método HTTP não suportado");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Visitas</title>
    <!-- Adicione aqui os links para o Bootstrap ou qualquer outro framework CSS -->
</head>
<body>
    <div class="container">
        <div class="login">
            <h1>Agendamento de Visitas</h1>
            <form id="formAgendamento" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="idAgente">ID Agente:</label>
                <input type="text" id="idAgente" name="idAgente" required>
                <br>
                <label for="idIdoso">ID Idoso:</label>
                <input type="text" id="idIdoso" name="idIdoso" required>
                <br>
                <label for="dataVisita">Data da Visita:</label>
                <input type="date" id="dataVisita" name="dataVisita" required>
                <br>
                <label for="horaVisita">Horário da Visita:</label>
                <input type="time" id="horaVisita" name="horaVisita" required>
                <br>
                <label for="idVacina">ID da Vacina:</label>
                <input type="text" id="idVacina" name="idVacina">
                <br>
                <button type="submit" class="btn btn-success">Agendar</button>
            </form>
            
            <div class="listar-agendamentos">
            <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <a href="" class="btn btn-primary">Listar Agendamentos</a>
            </form>
            <?php
            // Exibir os agendamentos listados, caso existam
            if (isset($agenda) && !empty($agenda)) {
                echo "<h3>Agendamentos Cadastrados</h3>";
                echo "<ul>";
                foreach ($agenda as $agendamento) {
                    echo "<li>ID Agendamento: " . $agendamento['id'] . ", Data: " . $agendamento['dataVisita'] . ", Hora: " . $agendamento['horaVisita'] . "</li>";
                }
                echo "</ul>";
            }
            ?>
        </div>

        </div>
    </div>

    <!-- Adicione aqui scripts adicionais, como o axios ou outros frameworks JS -->
</body>
</html>
