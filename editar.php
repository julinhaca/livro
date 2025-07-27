<?php
require_once 'includes/conexao.php';



if (!isset($_GET['id'])) {
    echo "ID do livro não fornecido.";
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM livros WHERE id = $id";
$resultado = $conexao->query($sql);

if ($resultado->num_rows !== 1) {
    echo "Livro não encontrado.";
    exit;
}

$livro = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>✏️ Editar Livro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-primary">✏️ Editar Livro</h2>
    <a href="area_funcionario.php" class="btn btn-outline-secondary">🔙 Voltar</a>
  </div>

  <form action="db/atualizar_livro.php" method="POST" class="card shadow p-4 bg-white">
    <input type="hidden" name="id" value="<?= $livro['id'] ?>">

    <div class="mb-3">
      <label class="form-label">Título:</label>
      <input type="text" name="titulo" class="form-control" value="<?= htmlspecialchars($livro['titulo']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Autor:</label>
      <input type="text" name="autor" class="form-control" value="<?= htmlspecialchars($livro['autor']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Gênero:</label>
      <input type="text" name="genero" class="form-control" value="<?= htmlspecialchars($livro['genero']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Ano de Publicação:</label>
      <input type="number" name="ano_publicacao" class="form-control" value="<?= $livro['ano_publicacao'] ?>" required>
    </div>

    <div class="mb-4">
  <label class="form-label">Status:</label>
  <select name="status" class="form-select" required>
    <option value="Disponível" <?= $livro['status'] === 'Disponível' ? 'selected' : '' ?>>Disponível</option>
    <option value="Emprestado" <?= $livro['status'] === 'Emprestado' ? 'selected' : '' ?>>Emprestado</option>
  </select>
</div>


      </select>
    </div>

    <button type="submit" class="btn btn-success">💾 Salvar Alterações</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

