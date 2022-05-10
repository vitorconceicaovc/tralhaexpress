<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Log In</title>
</head>
<body>

    <?php
        //vereficar se foi clicado submit para cliente
        if(isset($_POST['cliente'])) {
            //ligaçãi à base de dados
            $mysqli = new mysqli("localhost","root","","pw1_bd_tralhaexpress");
            // Check connection
            if ($mysqli -> connect_errno) {
                echo "Falha a ligar à base de dados: " . $mysqli -> connect_error;
                exit(); // ou  die()
            }
            //receber dados do html
            $email=$_POST['email'];
            $senha=$_POST['senha'];
            //criar a instrução sql
            $sql="SELECT * FROM clientes WHERE email_cliente='$email' AND senha=md5('$senha')";
            $result=mysqli_query($mysqli,$sql);
            if (!$result) {
                die("Erro na instrução sql...");
            }
            //vereficar se login está correto
            $count=mysqli_num_rows($result);
            $linha=mysqli_fetch_array($result);
            $id_cliente=$linha['id_cliente'];
            if($count==1) {
                echo '<div class="popup" onClick="closePopup()"><p>Login efetuado com sucesso, aguarde...</p><i class="fa-solid fa-circle-xmark"></i></div>';
                header('refresh:3;url=cliente.php?id='.$id_cliente);
            }
            else {
                echo '<div class="popup" onClick="closePopup()"><p>Erro a efectuar o LogIn</p><i class="fa-solid fa-circle-xmark"></i></div>';
            }
        }

        //vereficar se foi clicado submit para funcionario
        if(isset($_POST['funcionario'])) {
            //ligaçãi à base de dados
            $mysqli = new mysqli("localhost","root","","pw1_bd_tralhaexpress");
            // Check connection
            if ($mysqli -> connect_errno) {
                echo "Falha a ligar à base de dados: " . $mysqli -> connect_error;
                exit(); // ou  die()
            }
            //receber dados do html
            $email=$_POST['email'];
            $senha=$_POST['senha'];
            //criar a instrução sql
            $sql="SELECT * FROM funcionarios WHERE email_funcionario='$email' AND senha=md5('$senha')";
            $result=mysqli_query($mysqli,$sql);
            if (!$result) {
                die("Erro na instrução sql...");
            }
            //vereficar se login está correto
            $count=mysqli_num_rows($result);
            $linha=mysqli_fetch_array($result);
            $id_funcionario=$linha['id_funcionario'];
            if($count==1) {
                echo '<div class="popup" onClick="closePopup()"><p>Login efetuado com sucesso, aguarde...</p><i class="fa-solid fa-circle-xmark"></i></div>';
                header('refresh:3;url=funcionario.php?id='.$id_funcionario);
            }
            else {
                echo '<div class="popup" onClick="closePopup()"><p>Erro a efectuar o LogIn</p><i class="fa-solid fa-circle-xmark"></i></div>';
            }
        }
    ?>

    <section class="login">
            <div class="tipo">
                <a onclick="cliente()" class="btn" >Cliente</a>
                <a onclick="funcionario()" class="btn-second" >Funcionario</a>
                <a onclick="gerente()" class="btn-second" >Gerente</a>
            </div>
        <form action="login.php" method="post">
            <h2>Login</h2>
            <input type="email" placeholder="Email" name="email" required>
            <input type="password" placeholder="Senha" name="senha" required>
            <small><a href="registar.php">Ainda não tem uma conta?</a></small>
            <button class="btn-form" type="submit" name="cliente" >LOG IN</button>
        </form>
        <a class="btn-second" href="index.php">Voltar</a>
    </section>

    <section class="login-funcionario">
            <div class="tipo">
                <a onclick="cliente()" class="btn-second" >Cliente</a>
                <a onclick="funcionario()" class="btn" >Funcionario</a>
                <a onclick="gerente()" class="btn-second" >Gerente</a>
            </div>
        <form action="login.php" method="post">
            <h2>Login</h2>
            <input type="email" placeholder="Email" name="email" required>
            <input type="password" placeholder="Senha" name="senha" required>
            <small><a href="registar.php">Ainda não tem uma conta?</a></small>
            <button class="btn-form" type="submit" name="funcionario">LOG IN</button>
        </form>
        <a class="btn-second" href="index.php">Voltar</a>
    </section>

    <section class="login-gerente">
            <div class="tipo">
                <a onclick="cliente()" class="btn-second" >Cliente</a>
                <a onclick="funcionario()" class="btn-second" >Funcionario</a>
                <a onclick="gerente()" class="btn" >Gerente</a>
            </div>
        <form action="login.php" method="post">
            <h2>Login</h2>
            <input type="email" placeholder="Email" name="email" required>
            <input type="password" placeholder="Senha" name="senha" required>
            <small><a href="registar.php">Ainda não tem uma conta?</a></small>
            <button class="btn-form" type="submit">LOG IN</button>
        </form>
        <a class="btn-second" href="index.php">Voltar</a>
    </section>

    <script src="js/closepopup.js"></script>
    <script src="js/type.js"></script>
</body>
</html>