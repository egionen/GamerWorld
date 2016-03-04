<!DOCTYPE html>
<?php
session_start();
include_once "./classe/conexao.php";
$idlogado = $_SESSION["user"];
//Consultar Login
$consulta_de_login = "SELECT * FROM login where idlogin = $idlogado";
$con_login = $mysqli->query($consulta_de_login);
$resultado_login = $con_login->fetch_assoc();
//Consulta dos amigos
$consulta_de_amigos = "SELECT * FROM amigos where id_usuario = $idlogado";
$con_amigos = $mysqli->query($consulta_de_amigos);
$resultado_amigos = $con_amigos->fetch_assoc();
$total_de_amigos = $con_amigos->num_rows;
//Jogos do logado
$consulta_de_jogos = "SELECT * FROM usuario_tem_jogo where id_usuario = $idlogado";
$query_consulta_jogos = $mysqli->query($consulta_de_jogos);
$array_jogos_usuario = $query_consulta_jogos->fetch_assoc();
$total_jogos = $query_consulta_jogos->num_rows;
//Plataformas do Logado
$consulta_de_plataformas = "SELECT * FROM usuario_tem_plataforma WHERE id_usuario = $idlogado";
$query_consulta_plataformas = $mysqli->query($consulta_de_plataformas);
$array_plataformas_usuario = $query_consulta_plataformas->fetch_assoc();
$total_pla = $query_consulta_plataformas->num_rows;
//Novas Mensagens do Logado
$consulta_mensagem = "SELECT * FROM mensagem WHERE iddestinatario = $idlogado and status = 0";
$query_mensagem = $mysqli->query($consulta_mensagem);
$array_mensagens = $query_mensagem->fetch_assoc();
$total_mensagens = $query_mensagem->num_rows;
//Consulta de Todas as Mensagens
$consulta_mensagem2 = "SELECT * FROM mensagem WHERE iddestinatario = $idlogado";
$query_mensagem2 = $mysqli->query($consulta_mensagem2);
$lista_mensagens = $query_mensagem2->fetch_assoc();
?>
<html>
    <head>
        <title>GW</title>
        <link rel="icon"
              type="image/png"
              href="imgs/sonome.png" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--TEMAS-->
        <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/custom.css"/>
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <!--JQuery-->
        <script src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!--DatePicker-->
        <link rel="stylesheet" type="text/css" href="flatpicker/src/DateTimePicker.css" />
        <script type="text/javascript" src="flatpicker/src/DateTimePicker.js"></script>
        <!--SweetAlert-->
        <link rel = "stylesheet" type = "text/css" href = "sweetalert/dist/sweetalert.css">
        <script src = "sweetalert/dist/sweetalert.min.js" ></script>
        <script>
            $(document).ready(function () {
                $('.slider').slider({full_width: true});
            });
        </script>
        <!--Gatilho Modal-->
        <script>
            $(document).ready(function () {
                $('.modal-trigger').leanModal();
            });
        </script>
    </head>
    <!--CORPO-->
    <body>
        <?php
        if (!empty($array_mensagens)) {
            ?><script>Materialize.toast('Voce tem Mensagens Novas!', 4000)</script>
            <?php
        }
        //SE RECEBIDO DESTINATARIO
        if (!empty($_GET["destinatario"])) {
            $destinatario = $_GET["destinatario"];
            ?><script>$(document).ready(function () {
                        $('#modal_mensagem').openModal();
                    });
            </script>
            <!--ENVIAR MENSAGEM-->
            <div id="modal_mensagem" class="modal bottom-sheet">
                <div class="modal-content">
                    <h4>Escreva uma Mensagem para seu amiguinho!</h4>
                    <form method="POST" action="logado.php?iddestinatario=<?php echo $destinatario ?>">
                        <div class="input-field col s12">
                            <textarea name="mensagem" id="mensagem" class="materialize-textarea"></textarea>
                            <label for="mensage">Mensagem</label>
                        </div>
                        <button class="btn waves-effect black white-text" type="submit" name="enviar"><i class="material-icons">send</i></button>
                    </form>
                </div>
            </div>
            <?php
        }
//RECEBER MENSAGEM E INSERIR NO BANCO
        if (!empty($_GET["iddestinatario"])) {
            $destinatario = $_GET["iddestinatario"];
            $mensagem = $_POST["mensagem"];
            $insert_mensagem = "INSERT INTO mensagem (idremetente,iddestinatario,mensagem) values ('" . $idlogado . "','" . $destinatario . "','" . $mensagem . "')";
            $query_enviar = $mysqli->query($insert_mensagem)or die(
                            "<script>
      swal({
      title: 'Ops',
      text: 'Aconteceu algum erro',
      type: 'error',
      confirmButtonText: 'Ok',
      confirmButtonColor: '#000',
      },
      function (isConfirm) {
      if (isConfirm) {
      window.location = 'logado.php';
      }
      });</script>");

            echo "<script>
                            swal({
                                title: 'Mensagem Enviada!',
                                
                                type:'success',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
                            },
         function (isConfirm) {
                if (isConfirm) {
                    window.location = 'logado.php';
                }
            });        
</script>";
        }
        //SE RECEBER JOGO
        if (!empty($_GET["idjogo"])) {
            $idjogo = $_GET["idjogo"];
            //VERIFICAR SE JA POSSUI O JOGO
            $consulta_de_jogos2 = "SELECT * FROM usuario_tem_jogo where id_jogo = $idjogo and id_usuario = $idlogado";
            $query_consulta_jogos2 = $mysqli->query($consulta_de_jogos2);
            $array_jogos_usuario2 = $query_consulta_jogos2->fetch_assoc();
            if ($array_jogos_usuario2["id_jogo"] == $idjogo) {

                echo "<script>
                            swal({
                                title: 'Opa!',
                                text: 'Você já tem esse jogo!',
                                type: 'error',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
                            },
         function (isConfirm) {
                if (isConfirm) {
                    window.location = 'logado.php';
                }
            });        
</script>";
            } else {//SE NAO INSIRA
                $inserir_jogo_usuario = "INSERT INTO usuario_tem_jogo (id_usuario,id_jogo) values ($idlogado,'" . $_GET["idjogo"] . "')";
                $query_insert = $mysqli->query($inserir_jogo_usuario);
                echo "<script>
                            swal({
                                title: 'Inserido!',
                                text: 'Você inseriu um jogo no seu perfil!',
                                type: 'success',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
                            },
         function (isConfirm) {
                if (isConfirm) {
                    window.location = 'logado.php';
                }
            });        
</script>";
            }
        }
//SE RECEBER PLATAFORMA
        if (!empty($_GET["idplataforma"])) {
            $idplataforma = $_GET["idplataforma"];
            //VERIFICAR SE JA POSSUI PLATAFORMA
            $consulta_de_plataformas2 = "SELECT * FROM usuario_tem_plataforma where id_plataforma = $idplataforma and id_usuario = $idlogado";
            $query_consulta_plataformas2 = $mysqli->query($consulta_de_plataformas2);
            $array_plataformas_usuario2 = $query_consulta_plataformas2->fetch_assoc();
            if ($array_plataformas_usuario2["id_plataforma"] == $idplataforma) {

                echo "<script>
                            swal({
                                title: 'Opa!',
                                text: 'Você já tem essa plataforma!',
                                type: 'error',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
                            },
         function (isConfirm) {
                if (isConfirm) {
                    window.location = 'logado.php';
                }
            });        
</script>";
            } else {//SE NAO INSIRA
                $inserir_plataforma = "INSERT INTO usuario_tem_plataforma (id_usuario,id_plataforma) values ($idlogado,'" . $idplataforma . "')";
                $query_inserir_plataforma_usuario = $mysqli->query($inserir_plataforma);
                echo "<script>
                            swal({
                                title: 'Inserido!',
                                text: 'Você inseriu uma plataforma no seu perfil!',
                                type: 'success',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
                            },
         function (isConfirm) {
                if (isConfirm) {
                    window.location = 'logado.php';
                }
            });        
</script>";
            }
        }
        //SE SAIR
        if (!empty($_GET["sair"])) {
            //CORTA SESSAO
            session_unset();
            echo '<script>swal({
  title: "Você está saindo do GW",
   type: "info",
  
  closeOnConfirm: false,
  showLoaderOnConfirm: true,
},
function(){
  setTimeout(function(){
  window.location = "login.php";
  }, 2000);
});</script>';
        }

        //SE RECEBER DELETE AMIGO
        if (!empty($_GET["iddelete_amigo"])) {
            $delete_amigo = "DELETE FROM amigos WHERE id_amigo ='" . $_GET["iddelete_amigo"] . "'and id_usuario = '" . $idlogado . "'";
            $del_amigo = $mysqli->query($delete_amigo)or die("<script>
                            swal({
                                title: 'Opa!',
                                text: 'Ocorreu um erro ao tentar a exclusão',
                                type: 'error',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
                            },
                            function (isConfirm) {
                if (isConfirm) {
                    window.location = 'listar.php';
                }
            });        
</script>");
            echo '<script>
                swal({
                    title: "Amigo Deletado!",
                    type: "success",
                    confirmButtonText: "Ok",
                    confirmButtonColor: "#000",
                },
            function (isConfirm) {
                if (isConfirm) {
                    window.location = "logado.php";
                }
            });        
</script>';
        }
        //SE RECEBER id DELETE PLATAFORMA
        if (!empty($_GET["iddelete_plataforma"])) {
            $delete_plataforma = "DELETE FROM usuario_tem_plataforma WHERE id_plataforma ='" . $_GET["iddelete_plataforma"] . "'and id_usuario = '" . $idlogado . "'";
            $query_delete = $mysqli->query($delete_plataforma)or die("<script>
                            swal({
                                title: 'Opa!',
                                text: 'Ocorreu um erro ao tentar a exclusão',
                                type: 'error',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
                            },
                            function (isConfirm) {
                if (isConfirm) {
                    window.location = 'listar.php';
                }
            });        
</script>");
            echo '<script>
                swal({
                    title: "Plataforma Deletada!",
                    type: "success",
                    confirmButtonText: "Ok",
                    confirmButtonColor: "#000",
                },
            function (isConfirm) {
                if (isConfirm) {
                    window.location = "logado.php";
                }
            });        
</script>';
        }
        //SE RECEBER id DELETE do JOGO
        if (!empty($_GET["iddelete_jogo"])) {
            $delete_jogo = "DELETE FROM usuario_tem_jogo WHERE id_jogo ='" . $_GET["iddelete_jogo"] . "'and id_usuario = '" . $idlogado . "'";
            $query_delete = $mysqli->query($delete_jogo)or die("<script>
                            swal({
                                title: 'Opa!',
                                text: 'Ocorreu um erro ao tentar a exclusão',
                                type: 'error',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
                            },
                            function (isConfirm) {
                if (isConfirm) {
                    window.location = 'listar.php';
                }
            });        
</script>");
            echo '<script>
                swal({
                    title: "Jogo Deletado!",
                    type: "success",
                    confirmButtonText: "Ok",
                    confirmButtonColor: "#000",
                },
            function (isConfirm) {
                if (isConfirm) {
                    window.location = "logado.php";
                }
            });        
</script>';
        }
        ?>  
        <!--NAVBAR-->
        <div class="navbar-fixed">
            <nav style="height: 75px">
                <div class="nav-wrapper teal black">
                    <a href="#" class="brand-logo center"><img src="imgs/logogwpeq.png"></a>
                    <ul class="right hide-on-med-and-down"><!--BOTAO SAIR-->
                        <li><a href="logado.php?sair=1"><i class="material-icons">settings_power</i></a></li>
                    </ul>
                    <ul class="left hide-on-med-and-down"><!--BOTAO PERFIL-->
                        <li><a href="perfil.php"><i class="material-icons">perm_identity</i></a>
                    </ul>
                </div>
            </nav>
        </div>
        <br>

        <!--SLIDER-->
        <div class="container">
            <div class="slider " > 
                <ul class="slides " style="color: black"  >
                    <li>
                        <img src="http://i.ytimg.com/vi/rx25T4LKbyA/maxresdefault.jpg">
                    </li>
                    <li>
                        <img src="imgs/MM2.jpg">
                    </li>
                    <li>
                        <img src="https://cdn3.vox-cdn.com/thumbor/Uf2EJGK3UkuzbgeOsazfaQ_bUhc=/cdn0.vox-cdn.com/uploads/chorus_asset/file/3817550/18225727733_fabdb5f194_o.0.jpg">
                    </li>
                </ul>
            </div>
        </div>
        <br>
        <!--CORPO-->
        <div class="row">
            <div class="wrapper">
                <nav><!--NAVBAR_PERFIL-->
                    <div class="nav-wrapper black">
                        <ul class="left hide-on-med-and-down">
                            <li><a href="perfil.php"><i class="material-icons">perm_identity</i></a><!--PERFIL-->
                        </ul>
                        <ul class="left hide-on-med-and-down">
                            <li>Logado como <?php echo $resultado_login['user']; ?></li>
                        </ul>
                        <ul class="right hide-on-med-and-down">
                            <li><a href="addjogo.php"><i class="material-icons">games</i></a></li><!--ADD JOGO-->
                        </ul>
                        <ul class="right hide-on-med-and-down">
                            <li><a href="listar.php"><i class="material-icons">list</i></a></li><!--LISTAGEM-->
                        </ul>
                        <ul class="right hide-on-med-and-down"><!--MENSAGENS-->
                            <?php echo $total_mensagens ?>
                            <li><a class="modal-trigger" href="#mensagens"><i class="material-icons">chat_bubble_outline</i></a></li><!--Adicionar Jogo-->
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--LISTAS DO PERFIL-->
        <div class="container">
            <div class="row">
                <div class=" col s12">
                    <ul class="tabs">
                        <li class="tab col s3"><a class="black-text" href="#jogos">Jogos</a></li>
                        <li class="tab col s3"><a class="black-text"  href="#plataformas">Plataformas</a></li>
                        <li class="tab col s3"><a  class="black-text"  href="#amigos">Amigos</a></li>
                    </ul>
                </div>
                <div id="jogos" class="container-fluid">
                    <!--TABELA JOGOS-->
                    <h4>Seus Jogos:</h4>
                    <table>
                        <thead>
                            <tr>
                                <th data-field="acoes">Acoes</th>
                                <th data-field="idjogos">Id Jogos</th>
                                <th data-field="nome">Nome</th>
                                <th data-field="desenvolvedora">Desenvolvedora</th>
                                <th data-field="capa">Capa</th>
                                <th data-field="lanc">Lançamento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($total_jogos > 0) {
                                do {
                                    $lista_jog = "SELECT * FROM jogos where idjogos = '" . $array_jogos_usuario["id_jogo"] . "'";
                                    $con_jog = $mysqli->query($lista_jog) or die($mysqli->error);
                                    $table_jog = $con_jog->fetch_assoc();
                                    ?><tr><td><a class="btn-floating btn-small waves-effect waves-light black" href="configjogo.php?idjogo=<?php echo $table_jog["idjogos"] ?>"><i class="material-icons">settings</i></a>

                                            <a class="btn-floating btn-small waves-effect waves-light black" href="logado.php?iddelete_jogo=<?php echo $table_jog["idjogos"] ?>"><i class="material-icons">delete</i></a></td>
                                        <td><?php echo $table_jog["idjogos"] ?></td>
                                        <td><?php echo $table_jog["nome"] ?></td>

                                        <td><?php
                                            $des_jogo = "SELECT nome FROM desenvolvedoras WHERE iddesenvolvedoras ='" . $table_jog["id_desenvolvedora"] . "'";
                                            $con_des_jogo = $mysqli->query($des_jogo);
                                            $lista_des_jogo = $con_des_jogo->fetch_assoc();
                                            echo $lista_des_jogo["nome"];
                                            ?></td>
                                        <td><img class="materialboxed" width="100" src="<?php
                                            $lista_cap = "SELECT capa FROM capas WHERE idcapas = '" . $table_jog["id_capa"] . "'";
                                            $con_cap = $mysqli->query($lista_cap) or die($mysqli->error);
                                            $capas = $con_cap->fetch_assoc();
                                            echo $capas["capa"]
                                            ?>"></td>

                                        <td><?php echo $table_jog["lanc"] ?></td></tr><?php
                                } while ($array_jogos_usuario = mysqli_fetch_assoc($query_consulta_jogos));
                            } else {

                                echo "você não tem jogos :(";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div id="plataformas" class="container-fluid">
                    <!--TABELA PLATAFORMAS-->
                    <h4>Suas Plataformas:</h4>
                    <table>
                        <thead>
                            <tr>
                                <th data-field="acoes">Acoes</th>
                                <th data-field="nome">Nome</th>
                                <th data-field="lanc">Empresa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($total_pla > 0) {
                                do {
                                    $lista_pla = "SELECT * FROM plataforma WHERE idplataforma = '" . $array_plataformas_usuario["id_plataforma"] . "'";
                                    $con_pla = $mysqli->query($lista_pla) or die($mysqli->error);
                                    $table_pla = $con_pla->fetch_assoc();
                                    ?><tr>

                                        <td><a class="btn-floating btn-small waves-effect waves-light black" href="logado.php?iddelete_plataforma=<?php echo $table_pla["idplataforma"] ?>"><i class="material-icons">delete</i></a></td>
                                        <td><?php echo $table_pla["nome"] ?></td>
                                        <td><?php echo $table_pla["empresa"] ?></td>
                                        <?php
                                    } while ($array_plataformas_usuario = mysqli_fetch_assoc($query_consulta_plataformas));
                                } else {

                                    echo "você não tem plataformas :(";
                                }
                                ?>
                        </tbody>
                    </table>
                </div>
                <div id="amigos" class="container-fluid">
                    <!--TABELA ABIGUINHOS-->
                    <h4>Seus Amiguinhos:</h4>
                    <table>
                        <thead>
                            <tr>
                                <th data-field="acoes">Acoes</th>
                                <th data-field="id">id</th>
                                <th data-field="user">User</th>
                            </tr>
                        </thead>
                        <tbody><?php
                            do {
                                ?><tr>
                                    <td>
                                        <a class = "btn-floating btn-large waves-effect waves-light white" href="logado.php?iddelete_amigo=<?php echo $resultado_amigos["id_amigo"] ?>" >
                                            <i class = "material-icons right black-text" >delete</i></a>
                                        <a class = "btn-floating btn-large waves-effect waves-light white" href="logado.php?destinatario=<?php echo $resultado_amigos["id_amigo"] ?>" >
                                            <i class = "material-icons right black-text" >message</i></a>
                                    </td>
                                    <td><?php echo $resultado_amigos["id_amigo"] ?></td>
                                    <td><?php
                                        //Busca nome para cada idamigo na tabela login
                                        $consulta_de_ids = "SELECT user FROM login where idlogin = '" . $resultado_amigos["id_amigo"] . "'";
                                        $con_id = $mysqli->query($consulta_de_ids);
                                        $amigo = $con_id->fetch_assoc();
                                        //retorna nome de usuario 
                                        echo $amigo["user"]
                                        ?></td>
                                <?php } while ($resultado_amigos = mysqli_fetch_assoc($con_amigos));
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--MODAL MENSAGEM-->
        <div id="mensagens" class="modal">
            <div class="modal-content">
                <h4>Mensagens</h4>
                <div class="container-fluid">
                    <table>
                        <thead>
                            <tr>
                                <th data-field="acoes">Acoes</th>
                                <th data-field="user">Usuario</th>
                                <th data-field="mensagens">Mesagem</th>
                            </tr>
                        </thead>
                        <tbody><?php
                            do {
                                $consulta_remetente = "SELECT * FROM login where idlogin = '" . $lista_mensagens["idremetente"] . "'";
                                $query_remetente = $mysqli->query($consulta_remetente);
                                $remetente = $query_remetente->fetch_assoc();
                                ?><tr>
                                    <td>

                                        <a class = "btn-floating btn-large waves-effect waves-light white" href="logado.php?destinatario=<?php echo $lista_mensagens["idremetente"] ?>" >
                                            <i class = "material-icons right black-text" >message</i></a>
                                    </td>
                                    <td><?php echo $remetente["user"]; ?></td>
                                    <td><?php echo $lista_mensagens["mensagem"] ?></td>
                                <?php } while ($lista_mensagens = mysqli_fetch_assoc($query_mensagem2));
                                ?>
                                <?php
                                $lida = "UPDATE mensagem SET status = 1 WHERE iddestinatario = $idlogado";
                                $query_lida = $mysqli->query($lida)or die($mysqli->error);
                                ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a href="logado.php" class=" modal-action modal-close black white-text waves-effect waves-black btn-flat">Ok</a>
                </div>
            </div>
        </div>

        <!--Footer-->
        <footer class="page-footer black">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">Gamer World</h5>
                        <p class="grey-text text-lighten-4">Seu site de games</p>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    2015 Gamer World
                </div>
            </div>
        </footer>
    </body>
</html>
