<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Gerente</title>
</head>
<body>



    <?php
    
    if (!isset($_GET['id'])) { 
        header('Location: login.php');
    } 
    $cliente=$_GET['id'];

    //ligaçãi à base de dados
    $mysqli = new mysqli("localhost","root","","pw1_bd_tralhaexpress");
    // Check connection
    if ($mysqli -> connect_errno) {
        echo "Falha a ligar à base de dados: " . $mysqli -> connect_error;
        exit(); // ou  die()
    }


    function atualizar() {

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

        //instrução sql para atualizar dados 
        $sql="UPDATE gerentes SET 
        email_gerente='$email',contacto_gerente='$contacto'
        WHERE nome_gerente='$nome'";

        $result=mysqli_query($mysqli,$sql);
        if (!$result) {
            die("Erro na instrução sql...");
        }

        echo '<div class="popup" onClick="closePopup()"><p>Contacto atualizado com sucesso.</p><i class="fa-solid fa-circle-xmark"></i></div>';

    }

    function foto() {
        echo '<div class="popup" onClick="closePopup()"><p>Foto atualizada com sucesso.</p><i class="fa-solid fa-circle-xmark"></i></div>';
    }

    if (isset($_POST['foto'])) {
        foto();
    }

    if(isset($_POST['update'])) {
        atualizar();
    }

    
    

    
    $sql="SELECT * FROM gerentes WHERE id_gerente='$cliente'";
    
    $result=mysqli_query($mysqli,$sql);
    if (!$result) {
        die("Erro na instrução sql...");
    }
    //vereficar se login está correto
    $count=mysqli_num_rows($result);

    if ($count!=1) {
        echo "<h2>Erro ao aceder ao utilizador!</h2>";
    }   else {

        //lê o registo da base de dados
        $linha=mysqli_fetch_array($result);


        echo '
    
        <section id="perfil" class="cliente">
            <div class="navbar">
                <div class="logo">TRALHA.EXPRESS</div>
                <div class="links">
                    <a onclick="perfil()" class="active" href="#perfil">Perfil</a>
                    <a onclick="servicos()" href="agendamentos_gerente.php?id='.$cliente.'">Agendamentos</a>
                    <a class="btn-second" href="login.php">Sair</a>
                </div>
            </div>
            <div class="profile-area">
                
                
                <img src="'.$linha['foto_gerente'].'" alt="">
    
                <form action="gerente.php?id='.$cliente.'" method="post">
                    <p></p>
                    <div class="roud">
                        <input type="file" name="">
                        <i class="fas fa-upload"></i>
                    </div>
                    <input class="blocked" type="text" name="nome" placeholder="Nome" value="'.$linha['nome_gerente'].'" readonly>
                    <input type="text" name="contacto" placeholder="Contacto" value="'.$linha['contacto_gerente'].'" required>
                    <input type="text" name="email" placeholder="Email" value="'.$linha['email_gerente'].'" required>
                    <input type="password"name="senha" placeholder="Senha" required>
                    <input class="btn-form" type="submit" value="Atualizar" name="update" >
                </form>
                
            </div>
        </section>
        
        

            
            
            
        
        
        
        ';

        
        
        
        

    }

    

    ?>

    
    

    <script src="js/active.js"></script>
    <script src="js/closepopup.js"></script>
</body>
</html>