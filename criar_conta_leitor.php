<?php
require_once 'includes/conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios_leitores (nome, usuario, senha) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sss", $nome, $usuario, $senha);

    if ($stmt->execute()) {
        header("Location: login_leitor.php?sucesso=1");
        exit;
    } else {
        $erro = "Erro ao criar conta. Nome de usuário pode já estar em uso.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>📘 Criar Conta - Leitor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2 class="mb-4">📘 Criar Conta - Leitor</h2>

  <?php if (isset($erro)): ?>
    <div class="alert alert-danger"><?= $erro ?></div>
  <?php endif; ?>

  <form method="POST" class="card p-4 shadow">
    <div class="mb-3">
      <label>Nome:</label>
      <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Usuário:</label>
      <input type="text" name="usuario" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Senha:</label>
      <input type="password" name="senha" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Criar Conta</button>
    <a href="login_leitor.php" class="btn btn-link">Já tem conta? Faça login</a>
  </form>
</div>
</body>
</html>
