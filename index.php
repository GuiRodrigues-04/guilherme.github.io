<?php

$servername = "localhost"; // Ou o IP do servidor MySQL
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "nome_do_banco";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if (isset($_POST['create'])) {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $cidade = $_POST['cidade'];
    $pais = $_POST['pais'];

    $sql = "INSERT INTO tabela_registros (nome, sobrenome, email, cidade, pais) 
            VALUES ('$nome', '$sobrenome', '$email', '$cidade', '$pais')";

    if ($conn->query($sql) === TRUE) {
        echo '<p>Registro criado com sucesso!</p>';
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['update'])) {
    $registro_id_update = $_POST['registro_id_update'];
    $novo_nome_update = $_POST['novo_nome_update'];

    $sql = "UPDATE tabela_registros SET nome='$novo_nome_update' WHERE id=$registro_id_update";

    if ($conn->query($sql) === TRUE) {
        echo '<p>Registro atualizado com sucesso!</p>';
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}

if (isset($_POST['delete'])) {
    $registro_id_delete = $_POST['registro_id_delete'];

    $sql = "DELETE FROM tabela_registros WHERE id=$registro_id_delete";

    if ($conn->query($sql) === TRUE) {
        echo '<p>Registro excluído com sucesso!</p>';
    } else {
        echo "Erro ao excluir: " . $conn->error;
    }
}

function listRecords($conn) {
    $sql = "SELECT id, nome, sobrenome, email, cidade, pais FROM tabela_registros";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<h2>Lista de Registros (Read)</h2>';
        echo '<ul>';
        while($row = $result->fetch_assoc()) {
            echo "<li>ID: " . $row["id"]. " - Nome: " . $row["nome"]. " " . $row["sobrenome"].
                 ", Email: " . $row["email"]. ", Cidade: " . $row["cidade"]. ", País: " . $row["pais"]. "</li>";
        }
        echo '</ul>';
    } else {
        echo "Nenhum registro encontrado.";
    }
}

listRecords($conn);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Formulário</title>
</head>
<body>
<h1>PREENCHER O FORMULÁRIO</h1>
    <form class="row g-3" method="post">
        <div class="col-md-4">
            <label for="validationDefault01" class="form-label">Primeiro Nome</label>
            <input type="text" class="form-control" id="validationDefault01" name="nome" required>
        </div>
        <div class="col-md-4">
            <label for="validationDefault02" class="form-label">Ultimo nome</label>
            <input type="text" class="form-control" id="validationDefault02" name="sobrenome" required>
        </div>
        <div class="col-md-4">
            <label for="validationDefaultUsername" class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                <input type="text" class="form-control" id="validationDefaultUsername" name="email" aria-describedby="inputGroupPrepend2" required>
            </div>
        </div>
        <div class="col-md-6">
            <label for="validationDefault03" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="validationDefault03" name="cidade" required>
        </div>
        <div class="col-md-3">
            <label for="validationDefault05" class="form-label">País</label>
            <input type="text" class="form-control" id="validationDefault05" name="pais" required>
        </div>
        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                <label class="form-check-label" for="invalidCheck2">
                    Concordo com os termos e condições
                </label>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit" name="create">Criar Registro</button>
            <button class="btn btn-primary" type="submit" name="create">Excluir Registro</button>
        </div>
    </form>
</body>
</html>
