<?php
require_once 'includes/conexao.php';

$sucesso = "";
$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $sepf = $_POST['sepf'];

    // Validação simples
    if (strlen($sepf) !== 5 || !ctype_digit($sepf)) {
        $erro = "SEPF deve conter exatamente 5 números.";
    } else {
        // Criptografando senha e SEPF
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $sepf_hash = password_hash($sepf, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios_funcionarios (nome, usuarios, senha, sepf) VALUES (?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $nome, $usuario, $senha_hash, $sepf_hash);
            if ($stmt->execute()) {
                $sucesso = "Funcionário cadastrado com sucesso!";
            } else {
                $erro = "Erro ao cadastrar funcionário: " . $stmt->error;
            }
        } else {
            $erro = "Erro na preparação da query: " . $conexao->error;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Funcionário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-primary">Cadastrar Funcionarios </h2>
    <a href="area_funcionario.php" class="btn btn-outline-secondary">🔙 Voltar</a>
  </div>

<div class="container mt-5" style="max-width: 600px;">
    <h2 class="mb-4">➕ Cadastro de Funcionário</h2>

    <?php if ($sucesso): ?>
        <div class="alert alert-success"><?= $sucesso ?></div>
    <?php elseif ($erro): ?>
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
        <div class="mb-3">
            <label>SEPF (5 dígitos):</label>
            <input type="text" name="sepf" class="form-control" maxlength="5" pattern="\d{5}" required>
        </div>
        <button type="submit" class="btn btn-dark">Cadastrar</button>
    </form>
</div>
</body>
</html>
