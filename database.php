<?php
    // Verificar se foi enviando dados via POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
        $name = (isset($_POST["name"]) && $_POST["name"] != null) ? $_POST["name"] : "";
        $email = (isset($_POST["email"]) && $_POST["email"] != null) ? $_POST["email"] : "";
        $age = (isset($_POST["age"]) && $_POST["age"] != null) ? $_POST["age"] : "";
    } else if (!isset($name)) {
        // Se não se não foi setado nenhum valor para variável $name
        $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
        $name = NULL;
        $email = NULL;
        $age = NULL;
    }

    try {
        $conection = new PDO("mysql:host=localhost; dbname=first_crud", "root", "123123");
        $conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conection->exec("set names utf8");
    } catch (PDOException $erro) {
        echo "Erro na conexão:" . $erro->getMessage();
    }

    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "add" && $name != "") {
        try {
            $sql = $conection->prepare("INSERT INTO users (name, email, age) VALUES ('$name', '$email', '$age')");
            $sql->bindParam(1, $name);
            $sql->bindParam(2, $email);
            $sql->bindParam(3, $age);
           
            if ($sql->execute()) {
                if ($sql->rowCount() > 0) {
                    $cadastrado = "Dados cadastrados com sucesso!";
                    $id = null;
                    $name = null;
                    $email = null;
                    $age = null;
                } else {
                    $erroExecusao = "Erro ao tentar efetivar cadastro";
                }
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
                   
            }
        } catch (PDOException $erro) {
            $erro = "Erro: " . $erro->getMessage();
        }
    }
    

?>