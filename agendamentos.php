<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Agendamentos | Cliente</title>
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
    
    //buscar agendas na base de dados
    $sql_agendamentos = "SELECT * FROM agendamentos WHERE id_cliente='$cliente' ORDER BY data_agenda ASC "; 
    $result_agendamentos=mysqli_query($mysqli,$sql_agendamentos);
    if (!$result_agendamentos) {
        die("Erro na instrução sql de agendamentos...");
    }

    //ver quantos registos tem na tabela
    //print_r($result_agendamentos);
    
    ?>

    <div id="preloader">
        <img src="img/preloader.gif" alt="">

    </div>

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

        <div class="agendamentos-area">

            <div class="agendamentos-table">

                <table>

               

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Morada</th>
                        <th>Tipo</th>
                        <th>OBS</th>
                        <th>Funcionario</th>
                        <th>Gerente</th>
                        <th>Estado</th>
                        <th>Editar</th>
                    </tr>

                </thead>   
                <tbody>

                    <?php
                    
                        while($agenda_data = mysqli_fetch_assoc($result_agendamentos)) {

                            echo "<tr><br>";
                            echo "<td>".$agenda_data['id_agenda']."</td>";
                            echo "<td>".$agenda_data['data_agenda']."</td>";
                            echo "<td>".$agenda_data['morada_agenda']."</td>";
                            echo "<td>".$agenda_data['tipo_agenda']."</td>";
                            echo "<td>".$agenda_data['obs_agenda']."</td>";
                            echo "<td>".$agenda_data['id_funcionario']."</td>";
                            echo "<td>".$agenda_data['id_gerente']."</td>";
                            echo "<td>".$agenda_data['estado_agenda']."</td>";
                            echo "<td><a href='editar.php?id=$agenda_data[id_agenda]'><i class='fa-solid fa-marker'></i></a></td>";
                            echo "</tr>";

                        }
                    
                    ?>

                </tbody>

                </table>

            </div>
            
         

        </div>
    </section>  



    <script src="js/preloader.js"></script>

</body>
</html>