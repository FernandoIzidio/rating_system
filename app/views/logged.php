<?php 

if (empty($_SESSION) || !isset($_SESSION["logged_in"])){
    echo "SESSÃO INVALIDA";
    sleep(3);
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/home">Home</a></li>
                <li><a href="/home/profile">Perfil</a></li>
                <li><a href="/home/assessments">Avaliações</a></li>
                <li><a href="/home/requests">Requisições</a></li>
            </ul>
            
        </nav>
    </header>
</body>
</html>