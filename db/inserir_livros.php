<?php
require_once '../includes/conexao.php';
session_start();

// ✅ Verifica se o usuário é um funcionário


// ✅ Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Coleta e sanitiza os dados
    $titulo  = trim($_POST['titulo'] ?? '');
    $autor   = trim($_POST['autor'] ?? '');
    $genero  = trim($_POST['genero'] ?? '');
    $ano     = intval($_POST['ano_publicacao'] ?? 0);
    $status  = trim($_POST['status'] ?? '');

    // ✅ Verifica se todos os campos foram preenchidos corretamente
    if ($titulo && $autor && $genero && $ano > 0 && in_array($status, ['Disponível', 'Emprestado'])) {

        // Prepara a inserção no banco de dados
        $sql = "INSERT INTO livros (titulo, autor, genero, ano_publicacao, status, data_cadastrada)
                VALUES (?, ?, ?, ?, ?, NOW())";

        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sssis", $titulo, $autor, $genero, $ano, $status);

        // Executa e redireciona
        if ($stmt->execute()) {
            header("Location: ../cadastrar.php?sucesso=1");
            exit();
        } else {
            echo "❌ Erro ao cadastrar livro: " . $stmt->error;
        }

    } else {
        echo "⚠️ Por favor, preencha todos os campos corretamente.";
    }

} else {
    echo "🚫 Acesso inválido.";
}
?>

