<?php

require_once('db.class.php');

$usuario = $_POST['usuario'];
$email = $_POST['email'];
$senha = md5($_POST['senha']);

$objDb = new db();
$link = $objDb->conecta_mysql();

$usuario_existe = false;
$email_existe = false;

//verificar se o usuário já existe

$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
if ($resultado_id = mysqli_query($link, $sql)) {

  $dados_usuario = mysqli_fetch_array($resultado_id);

  if (isset($dados_usuario['usuario'])) {

    $usuario_existe = true;
  }
} else {

  echo 'Erro ao tentar loalizar o registro do usuário.';
}

//verificar se o email já existe

$sql = "SELECT * FROM usuarios WHERE email = '$email'";
if ($resultado_id = mysqli_query($link, $sql)) {

  $dados_usuario = mysqli_fetch_array($resultado_id);

  if (isset($dados_usuario['email'])) {

    $email_existe = true;
  }
} else {

  echo 'Erro ao tentar loalizar o registro de email.';
}

if($usuario_existe || $email_existe){

  header('Location: inscrevase.php');

}

die();

$sql = "INSERT INTO usuarios(usuario, email, senha) VALUES ('$usuario', '$email', '$senha')";

//executar a query
if (mysqli_query($link, $sql)) {

  echo 'Usuário registrado com sucesso!';
} else {

  echo 'Erro ao registrar o usuário!';
}
