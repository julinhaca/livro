<?php
require_once '../includes/conexao.php';




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $titulo = mysqli_real_escape_string($conexao, $_POST['titulo']);
    $autor = mysqli_real_escape_string($conexao, $_POST['autor']);
    $genero = mysqli_real_escape_string($conexao, $_POST['genero']);
    $ano = intval($_POST['ano_publicacao']);
    $status = mysqli_real_escape_string($conexao, $_POST['status']);

    $sql = "UPDATE livros SET 
                titulo = '$titulo',
                autor = '$autor',
                genero = '$genero',
                ano_publicacao = $ano,
                status = '$status'
            WHERE id = $id";

    if ($conexao->query($sql)) {
        header("Location: ../area_funcionario.php?mensagem=editado");
        exit;
    } else {
        echo "Erro ao atualizar: " . $conexao->error;
    }
} else {
    echo "Acesso inválido.";
}
