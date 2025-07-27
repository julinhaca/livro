<?php
require_once '../includes/conexao.php';




if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM livros WHERE id = $id";

    if ($conexao->query($sql)) {
        header("Location: ../area_funcionario.php?mensagem=excluido");
        exit;
    } else {
        echo "Erro ao excluir: " . $conexao->error;
    }
} else {
    echo "ID não informado.";
}
