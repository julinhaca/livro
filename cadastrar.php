<?php
session_start();
require_once 'includes/conexao.php';

if (!isset($_SESSION['usuario_funcionario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastrar Livro 📘</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-primary">➕ Cadastrar novo livro</h2>
    <a href="area_funcionario.php" class="btn btn-outline-secondary">🔙 Voltar</a>
  </div>

  <?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == '1'): ?>
    <div class="alert alert-success">📚 Livro cadastrado com sucesso!</div>
  <?php endif; ?>

  <form action="db/inserir_livros.php" method="post" class="card shadow p-4 bg-white">
    <div class="mb-3">
      <label for="titulo" class="form-label">Título:</label>
      <input type="text" name="titulo" id="titulo" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="autor" class="form-label">Autor:</label>
      <input type="text" name="autor" id="autor" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="genero" class="form-label">Gênero:</label>
      <input type="text" name="genero" id="genero" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="ano_publicacao" class="form-label">Ano de Publicação:</label>
      <input type="number" name="ano_publicacao" id="ano_publicacao" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="status" class="form-label">Status:</label>
      <select name="status" id="status" class="form-select" required>
        <option value="Disponível" selected>Disponível</option>
        <option value="Emprestado">Emprestado</option>
      </select>
    </div>

    <button type="submit" class="btn btn-success">💾 Cadastrar</button>
  </form>
</div>

</body>
</html>

