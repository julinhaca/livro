<?php
require_once 'includes/conexao.php';

session_start();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios_leitores WHERE usuario = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $leitor = $resultado->fetch_assoc();
        if (password_verify($senha, $leitor['senha'])) {
            $_SESSION['usuario'] = [
                'id' => $leitor['id'],
                'nome' => $leitor['nome'],
                'tipo' => 'leitor'
            ];
            header("Location: area_leitor.php");
            exit;
        }
    }

    $erro = "Usuário ou senha inválidos.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>📚 Login - Leitor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2 class="mb-4">📚 Login - Leitor</h2>

  <?php if (isset($erro)): ?>
    <div class="alert alert-danger"><?= $erro ?></div>
  <?php endif; ?>
  <?php if (isset($_GET['sucesso'])): ?>
    <div class="alert alert-success">Conta criada com sucesso! Faça login abaixo.</div>
  <?php endif; ?>

  <form method="POST" class="card p-4 shadow">
    <div class="mb-3">
      <label>Email:</label>
      <input type="email" name="usuario" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Senha:</label>
      <input type="password" name="senha" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Entrar</button>
    <a href="criar_conta_leitor.php" class="btn btn-link">Criar Conta</a>
  </form>
</div>
</body>
</html>
