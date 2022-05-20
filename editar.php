<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Editar agenda | Cliente</title>
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
    
    

    //ver quantos registos tem na tabela
    //print_r($result_agendamentos);
    
    ?>

    

    <section id="perfil" class="cliente">
        <div class="navbar">
            <div class="logo">TRALHA.EXPRESS</div>

            <?php

                echo '
                <div class="links">
                    <a class="btn" href="cliente.php?id='.$cliente.'">voltar</a>
                    <a class="btn-second" href="login.php">Sair</a>
                </div>
                '
            ?>
    
        </div>

      
        <div class="editar-area">
            
            <?php

            //buscar agendas na base de dados
            $sql= "SELECT * FROM agendamentos WHERE id_agenda='$cliente'"; 
            $result=mysqli_query($mysqli,$sql);
            if (!$result) {
                die("Erro na instrução sql de agendamentos...");
            }

            //vereficar se login está correto
            $count=mysqli_num_rows($result);

            function atualizar() {

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
                $cliente=$_GET['id'];
                
        
                //instrução sql para atualizar dados 
                $sql="UPDATE agendamentos SET 
                data_agenda='$data',morada_agenda='$morada',tipo_agenda='$tipo',obs_agenda='$obs'
                WHERE id_agenda='$cliente'";
        
                $result=mysqli_query($mysqli,$sql);
                if (!$result) {
                    die("Erro na instrução sql...");
                }
        
                echo '<div class="popup" onClick="closePopup()"><p>Agenda atualizada com sucesso.</p><i class="fa-solid fa-circle-xmark"></i></div>';
        
            }

            if(isset($_POST['update'])) {
                atualizar();
            }

            if ($count!=1) {
                echo "<h2>Erro ao aceder ao utilizador!</h2>";
            } else {

                //lê o registo da base de dados
                $linha=mysqli_fetch_array($result);


                echo '
            
                <form action="editar.php?id='.$cliente.'" method="post">
                    
                    
                    <input class="blocked" type="text" name="id" placeholder="Nome" value="ID da agenda: '.$linha['id_agenda'].'" readonly>
                    <input type="text" name="data" value="'.$linha['data_agenda'].'" >
                    <input type="text" name="morada" value="'.$linha['morada_agenda'].'" >
                    <input type="text" name="tipo" value="'.$linha['tipo_agenda'].'" >
                    <textarea type="text" name="obs" placeholder="'.$linha['obs_agenda'].'" ></textarea>
                    <input class="btn-form" type="submit" value="Atualizar" name="update" >

                </form>
                
                
                ';
            }



           
            
            
            ?>
            
                    
            
            
        </div>
    </section>  



    <script src="js/preloader.js"></script>

</body>
</html>