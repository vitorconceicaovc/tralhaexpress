<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Home</title>
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
        $sql="UPDATE clientes SET 
        email_cliente='$email',contacto_cliente='$contacto'
        WHERE nome_cliente='$nome'";

        $result=mysqli_query($mysqli,$sql);
        if (!$result) {
            die("Erro na instrução sql...");
        }

        echo '<div class="popup" onClick="closePopup()"><p>Contacto atualizado com sucesso.</p><i class="fa-solid fa-circle-xmark"></i></div>';

    }

    function schedule() {

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

        //receber os dados do form
            
        $data=$_POST['data'];   
        $morada=$_POST['morada'];        
        $tipo=$_POST['tipo'];   
        $obs=$_POST['obs'];  

        //criar a instrução para inserir agendamento
        $sql_agenda="INSERT INTO agendamentos(data_agenda,morada_agenda,tipo_agenda,obs_agenda,id_cliente) 
        VALUES('$data','$morada','$tipo','$obs','$cliente')";
                
        $result_agenda=mysqli_query($mysqli,$sql_agenda);
        if (!$result_agenda) {
            die("Erro na instrução sql de agendamento...");
        }

        echo '<div class="popup" onClick="closePopup()"><p>Serviço agendado com sucesso, aguarde...</p><i class="fa-solid fa-circle-xmark"></i></div>';

    }

    if(isset($_POST['update'])) {
        atualizar();
    }

    if(isset($_POST['schedule'])) {
        schedule();
    }
    
    

    
    $sql="SELECT * FROM clientes WHERE id_cliente='$cliente'";
    
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
                    <a onclick="agendar()" href="#agendar">Agendar</a>
                    <a onclick="servicos()" href="agendamentos.php?id='.$cliente.'">Agendamentos</a>
                    <a class="btn-second" href="login.php">Sair</a>
                </div>
            </div>
            <div class="profile-area">
                
                <img src="img/profile_2.png" alt="">
    
                <form action="cliente.php?id='.$cliente.'" method="post">
                    <p></p>
                    <input type="text" name="nome" placeholder="Nome" value="'.$linha['nome_cliente'].'" readonly>
                    <input type="text" name="contacto" placeholder="Contacto" value="'.$linha['contacto_cliente'].'" required>
                    <input type="text" name="email" placeholder="Email" value="'.$linha['email_cliente'].'" required>
                    <input type="password"name="senha" placeholder="Senha" required>
                    <input class="btn-form" type="submit" value="Atualizar" name="update" >
                </form>
                
            </div>
        </section>
        <section id="agendar" class="agendar">
            <div class="navbar">
                <div class="logo">TRALHA.EXPRESS</div>
                <div class="links">
                    <a onclick="perfil()"  href="#perfil">Perfil</a>
                    <a onclick="agendar()" class="active" href="#agendar">Agendar</a>
                    <a onclick="servicos()" href="agendamentos.php">Agendamentos</a>
                    <a class="btn-second" href="login.php">Sair</a>
                </div>
            </div>
    
            <div class="agenda-area">
                <form action="cliente.php?id='.$cliente.'" method="post">
                    <p>Agende o seu serviço</p>
                    <input type="datetime-local" placeholder="Nome" name="data" required>
                    <input type="text" placeholder="Morada" name="morada" required>
                    <select name="tipo" id="">
                        <option>Mudanças</option>
                        <option>Transportes</option>
                        <option>Remodelação</option>
                        <option>Decoração</option>
                    </select>
                    <textarea name="obs" placeholder="Obs"></textarea>
                    <input class="btn-form" type="submit" value="Agendar" name="schedule" >
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