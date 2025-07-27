<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>🔐 Login - Biblioteca Luni</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script>
    function alternarFormulario(tipo) {
      const form = document.getElementById('form-login');
      const sepf = document.getElementById('campo-sepf');
      const titulo = document.getElementById('titulo-form');

      if (tipo === 'funcionario') {
        form.action = 'login_funcionario.php';
        sepf.style.display = 'block';
        titulo.innerText = 'Login - Funcionário';
      } else {
        form.action = 'login_leitor.php';
        sepf.style.display = 'none';
        titulo.innerText = 'Login - Leitor';
      }
    }

    window.onload = () => alternarFormulario('leitor'); // padrão
  </script>
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 450px;">
  <h2 id="titulo-form" class="mb-4 text-center text-primary">Login - Leitor</h2>

  <div class="mb-3 text-center">
    <button onclick="alternarFormulario('leitor')" class="btn btn-outline-primary btn-sm">👤 Leitor</button>
    <button onclick="alternarFormulario('funcionario')" class="btn btn-outline-dark btn-sm">🧑‍💼 Funcionário</button>
  </div>

  <form id="form-login" method="POST" class="card p-4 shadow bg-white">
    <div class="mb-3">
      <label>Usuário:</label>
      <input type="text" name="usuario" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Senha:</label>
      <input type="password" name="senha" class="form-control" required>
    </div>

    <div id="campo-sepf" class="mb-3" style="display: none;">
      <label>SEPF (5 dígitos):</label>
      <input type="text" name="sepf" class="form-control" maxlength="5" pattern="\d{5}">
    </div>

    <button type="submit" class="btn btn-primary w-100">Entrar</button>

    <div class="mt-3 text-center">
      <a href="criar_conta_leitor.php" class="btn btn-link">📘 Criar Conta (Leitor)</a>
    </div>
  </form>
</div>

</body>
</html>
