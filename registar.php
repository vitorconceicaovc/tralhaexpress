<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Registar Conta</title>
</head>
<body>

    <?php
        //atualizar se uma caixa de texto
        if(isset($_POST['email'])) {

            //ligaçãi à base de dados
            $mysqli = new mysqli("localhost","root","","pw1_bd_tralhaexpress");
            // Check connection
            if ($mysqli -> connect_errno) {
                echo "Falha a ligar à base de dados: " . $mysqli -> connect_error;
                exit(); // ou  die()
            }
            //receber os dados do form
            
            $nome=$_POST['nome'];   
            $contacto=$_POST['contacto'];        
            $email=$_POST['email'];   
            $senha=md5($_POST['senha']);
            

            //criar a instrução para atualizar
            $sql="INSERT INTO clientes(nome_cliente,contacto_cliente,email_cliente,senha) 
            VALUES('$nome','$contacto','$email','$senha')";
                    
            $result=mysqli_query($mysqli,$sql);
            if (!$result) {
                die("Erro na instrução sql...");
            }

            echo '<div class="popup" onClick="closePopup()"><p>Conta registada com sucesso, aguarde...</p><i class="fa-solid fa-circle-xmark"></i></div>';
            header('refresh:3;url=login.php');

        }
    
    
    ?>

    <section class="login">
        <form action="registar.php" method="post">
            <h2>Registar</h2>
            <input type="text" placeholder="Nome" name="nome" required>
            <input type="text" placeholder="Contacto" name="contacto" required>
            <input type="text" placeholder="Email" name="email" required>
            <input type="password" placeholder="Senha" name="senha" required>
            <small><a href="login.php">Já tem uma conta?</a></small>
            <button class="btn-form" type="submit">Registar</button>
        </form>
        <a class="btn-second" href="index.php">Voltar</a>
    </section>

    <script src="js/closepopup.js"></script>
</body>
</html>