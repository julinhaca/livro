<?php
session_start();
require_once 'includes/conexao.php';

// Verifica se o leitor está logado corretamente
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'leitor') {
    header("Location: login_leitor.php");
    exit();
}

// Dados do leitor logado
$leitor_nome = $_SESSION['usuario']['nome'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>📚 Área do Leitor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Bem-vindo(a), <?= htmlspecialchars($leitor_nome) ?> 👋</h2>
        <a href="logout.php" class="btn btn-danger">Sair</a>
    </div>

    <hr>

    <h4>📗 Livros Disponíveis</h4>
    <table class="table table-striped table-bordered">
        <thead class="table-success">
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Gênero</th>
                <th>Ano</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM livros WHERE status = 'Disponível'";
        $res = mysqli_query($conexao, $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($livro = mysqli_fetch_assoc($res)) {
                echo "<tr>
                        <td>{$livro['titulo']}</td>
                        <td>{$livro['autor']}</td>
                        <td>{$livro['genero']}</td>
                        <td>{$livro['ano_publicacao']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhum livro disponível no momento.</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <h4 class="mt-4">📕 Livros Emprestados</h4>
    <table class="table table-striped table-bordered">
        <thead class="table-warning">
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Gênero</th>
                <th>Ano</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM livros WHERE status = 'Emprestado'";
        $res = mysqli_query($conexao, $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($livro = mysqli_fetch_assoc($res)) {
                echo "<tr>
                        <td>{$livro['titulo']}</td>
                        <td>{$livro['autor']}</td>
                        <td>{$livro['genero']}</td>
                        <td>{$livro['ano_publicacao']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhum livro emprestado no momento.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>

