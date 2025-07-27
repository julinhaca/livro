<?php
require_once 'includes/conexao.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $sepf  = $_POST['sepf'];

    $sql = "SELECT * FROM usuarios_funcionarios WHERE usuarios = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $funcionario = $resultado->fetch_assoc();

        // Verifica senha e SEPF (ambos com password_verify)
        if (password_verify($senha, $funcionario['senha']) && password_verify($sepf, $funcionario['sepf'])) {
            $_SESSION['usuario_funcionario'] = [
                'id' => $funcionario['id'],
                'nome' => $funcionario['nome']
            ];
            header("Location: area_funcionario.php");
            exit;
        }
    }

    $erro = "Dados inválidos. Verifique usuário, senha ou SEPF.";
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>🔐 Login - Funcionário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2 class="mb-4">🔐 Login - Funcionário</h2>

  <?php if (isset($erro)): ?>
    <div class="alert alert-danger"><?= $erro ?></div>
  <?php endif; ?>

  <form method="POST" class="card p-4 shadow">
    <div class="mb-3">
      <label>Usuário:</label>
      <input type="text" name="usuario" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Senha:</label>
      <input type="password" name="senha" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>SEPF (5 dígitos):</label>
      <input type="text" name="sepf" class="form-control" maxlength="5" pattern="\d{5}" required>
    </div>
    <button type="submit" class="btn btn-dark">Entrar</button>
  </form>
</div>
</body>
</html>

