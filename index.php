<!DOCTYPE html>
<html>
<?php
    include ('database.php');
?>
<head>
    <meta charset="utf-8" />
    <title>Read</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    
</head>
<body>
   
<div class="container">
    <header class="nav">
        <ul>
            <li>Qualquer coisa</li>
            <li><a href="#" >Opcao1</a></li>
            <li><a href="#" >Opcao2</a></li>
            <li><a href="#" >Opcao3</a></li>
        </ul>
    </header>
    <div class="main">
        <div class="title">
            <span>Cadastro</span>
        </div>
        <div class="add-user">
            <div class="add-user2">
                <div class="top">
                    <b>Adicionar novo usuário</b>
                </div>
                <div class="content">
                    <form action="?act=add" method="post" name="form">
                        <input type="hidden" name="id"
                            <?php
                                if (isset($id) && $id != null || $id != ""){
                                    echo "value=\"{$id}\"";
                                } 
                            ?> />
                        <label>Nome </label>
                        <input type="text" name="name"
                            <?php
                                if (isset($name) && $name != null || $name != ""){
                                    echo "value=\"{$name}\"";
                                } 
                            ?> />
                        <label>Email </label>
                        <input type="email" name="email"
                            <?php
                                if (isset($email) && $email != null || $email != ""){
                                    echo "value=\"{$email}\"";
                                } 
                            ?> />
                        <label>Idade </label>
                        <input type="numeric" name="age"
                            <?php
                                if (isset($age) && $age != null || $age != ""){
                                    echo "value=\"{$age}\"";
                                }
                            ?> />
                        <button type="submit" value="add">Add</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="title">
            <span>Lista de Usuários</span>
        </div>
        <div class="msg-cadastro">
            <?php
                if(isset($cadastrado)) {
                    echo "<span>";
                        echo $cadastrado;
                    echo "</span>";
                    } elseif (isset($erroExecusao)) {
                        echo $erroExecusao;
                    } elseif (isset($erroSql)) {
                        echo $erroSql;
                    } elseif (isset($erro)) {
                        echo $erro;
                    }
                echo "</span>";
                ?>
        </div>
        <div class="table">
            <div class="table2">
                <div class="table-top">
                    <b>Lista</b>
                </div>    
                <table class="content">
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Email</th> 
                        <th>Idade</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        try {
                           $sql = $conection->prepare("SELECT * FROM users");
                                if ($sql->execute()) {
                                    while ($rs = $sql->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->id."</td><td>".$rs->name."</td><td>".$rs->email."</td><td>".$rs->age
                                                ."</td><td><center><a href=\"\">[Alterar]</a>"
                                                ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                                ."<a href=\"\">[Excluir]</a></center></td>";
                                        echo "</tr>";
                                        }
                                } else {
                                    echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                }
                        } catch (PDOException $erro) {
                            echo "Erro: ".$erro->getMessage();
                        }
                        ?>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
