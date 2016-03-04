<!DOCTYPE html>
<?php
//abrindo sessao
session_start();
//incluindo conexao
include_once "./classe/conexao.php";
include_once './classe/cabecalho.php';
//identificando login
$idlogado = $_SESSION["user"];
?>


<html>

    <head>
        <title>Edição</title>
    </head>
    <!--começo do site-->
    <body>
        <!--NAVBAR-->
        <div class="navbar-fixed">
            <nav style="height: 75px">
                <div class="nav-wrapper teal black">
                    <a href="listar.php" class="brand-logo center"><img src="imgs/logogwpeq.png"></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="logado.php?sair=1"
                               ><i class="material-icons">settings_power</i></a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <br>
        <br> <br>

        <div class="container black">
            <?php
            //SE RECEBER PLATAFORMA -> FORMULARIO PLATAFORMA
            if (!empty($_GET["idplataforma"])) {
                $idplataforma = $_GET["idplataforma"];
                //LISTAR PLATAFORMA
                $lista_pla = "SELECT * FROM plataforma WHERE idplataforma ='" . $idplataforma . "'";
                $con_pla = $mysqli->query($lista_pla) or die($mysqli->error);
                $table_pla = $con_pla->fetch_assoc();
                ?> 
                <div class="container-fluid white-text" style="margin-bottom: 15px">

                    <h4>Editar plataforma</h4>
                    <div class="divider"></div>
                    <form method="post" action="form.php">
                        <input type="hidden" value="<?php echo $idplataforma ?>" name="idplataforma">

                        <div class="input-field col s8">
                            <label class="active white-text" for="nome" >Nome</label>
                            <input type="text" value="<?php echo $table_pla["nome"]; ?>" name="nome_plataforma" id="nome" class="white-text" required>
                        </div>
                        <div class="input-field col s8">
                            <label class="active white-text"  for="empresa">Empresa</label>
                            <input type="text" value="<?php echo $table_pla["empresa"]; ?>" name="empresa" id="empresa" class="white-text" required>
                        </div>
                        <div class = "input-field col s8" >
                            <button class = "btn waves-effect white black-text" type = "submit" name = "editar_plataforma" id = "editar_plataforma" >Aplicar</button>
                        </div>
                    </form>
                </div><?php
            }
            //SE RECEBER DESENVOLVEDORA -> FORMULARIO DESENVOLVEDORA
            if (!empty($_GET["iddesenvolvedora"])) {
                $lista_des = "SELECT * FROM desenvolvedoras WHERE iddesenvolvedoras = '" . $_GET['iddesenvolvedora'] . "'";
                $con_des = $mysqli->query($lista_des) or die($mysqli->error);
                $table_des = $con_des->fetch_assoc();
                ?><div class="container-fluid white-text" style="margin-bottom: 15px">
                    <h4>Editar desenvolvedora</h4>
                    <div class="divider"></div>
                    <form method="post" action="form.php">
                        <input type="hidden" value="<?php echo $table_des["iddesenvolvedoras"] ?>" name="iddesenvolvedora">
                        <div class="input-field col s8">
                            <label class="active white-text" for="nome">Nome</label>
                            <input type="text" value="<?php echo $table_des["nome"]; ?>" name="nome" id="nome" class="white-text" required>
                        </div>
                        <div class="input-field col s8">
                            <label class="active white-text"  for="origem">Nascionalidade</label>
                            <input type="text" value="<?php echo $table_des["origem"]; ?>" name="origem" id="origem" class="white-text" required>
                        </div>
                        <div class = "input-field col s6" >
                            <label for = "data" class = "active white-text" >Criação</label>
                            <input type="text"  name="data" id="data" value="<?php echo $table_des["nascimento"]; ?>" class="white-text" required>
                        </div>
                        <div class = "input-field col s8" >
                            <button class = "btn waves-effect white black-text" type = "submit" name = "editar_desenvolvedora" id = "editar_desenvolvedora" >Aplicar</button>
                        </div>
                    </form>
                </div><?php
            }
            ?>
            <?php
            //SE RECEBER JOGO -> FORMULARIO JOGO
            if (!empty($_GET["idjogo"])) {
                $lista_jogo = "SELECT * FROM jogos WHERE idjogos = '" . $_GET['idjogo'] . "'";
                $con_jogo = $mysqli->query($lista_jogo) or die($mysqli->error);
                $array_jogo = $con_jogo->fetch_assoc();
                ?><div class="container-fluid white-text" style="margin-bottom: 15px">
                    <h4>Editar Jogo</h4>
                    <div class="divider"></div>
                    <form method="post" action="form.php">
                        <input type="hidden" value="<?php echo $array_jogo["idjogos"] ?>" name="idjogo">
                        <div class="input-field col s8">
                            <label class="active white-text" for="nome">Nome</label>
                            <input type="text" value="<?php echo $array_jogo["nome"]; ?>" name="nome" id="nome" class="white-text" required>
                        </div>
                        <div class="input-field col s8">
                            <label class="active white-text"  for="desenvolvedora">Desenvolvedora</label>
                            <div class="input-field col s6 ">
                                <select class="white-text" name="desenvolvedora" required>
                                    <option value="" disabled selected>Desenvolvedora</option>
                                    <?php
                                    $sql = "SELECT * FROM desenvolvedoras";
                                    $con = $mysqli->query($sql) or die($mysqli->error);
                                    $dados = $con->fetch_assoc();
                                    $total = mysqli_num_rows($con);
                                    if ($total > 0) {
                                        do {
                                            ?> <option  value="<?php echo $dados['iddesenvolvedoras'] ?>"><?php echo $dados['nome'] ?></option><?php
                                        } while ($dados = mysqli_fetch_assoc($con));
                                    }
                                    ?></select>      
                            </div>
                            <div class = "input-field col s8" >
                                <label for = "data" class = "white-text" >Data de Lançamento</label>
                                <input type="text" data-field="date" name="data" id="data" class="white-text" value="<?php echo $array_jogo["lanc"] ?>" readonly required>
                                <div id="dtBox"></div>
                            </div>
                        </div>
                        <div class = "input-field col s8" >
                            <button class = "btn waves-effect white black-text" type = "submit" name = "editar_jogo" id = "editar_desenvolvedora" >Aplicar</button>
                        </div>
                    </form>
                </div><?php
            }
            ?>
        </div>
        <!--????FOOTER???-->
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
    <?php
    //UPDATES DE BANCO DOS TRES FORMULARIOS

    if (isset($_POST['editar_plataforma'])) {
        $form_plataforma = array($_POST["idplataforma"], $_POST["nome_plataforma"], $_POST["empresa"]);
        $editar_plataforma = "UPDATE plataforma SET nome = '" . $form_plataforma[1] . "', empresa = '" . $form_plataforma[2] . "' WHERE idplataforma = '" . $form_plataforma[0] . "'";
        $editar = $mysqli->query($editar_plataforma) or die($mysqli->error);

        echo '<script>
                swal({
                    title: "Plataforma Editada!",
                    type: "success",
                    confirmButtonText: "Ok",
                    confirmButtonColor: "#000",
                },
            function (isConfirm) {
                if (isConfirm) {
                    window.location = "listar.php";
                }
            });        
</script>';
    }
    if (isset($_POST['editar_desenvolvedora'])) {
        $form_desenvolvedora = array($_POST["nome"], $_POST["origem"], $_POST["data"], $_POST["iddesenvolvedora"]);
        $editar_desenvolvedora = "UPDATE desenvolvedoras SET nome = '" . $form_desenvolvedora[0] . "', origem = '" . $form_desenvolvedora[1] . "', nascimento = '" . $form_desenvolvedora[2] . "' WHERE iddesenvolvedoras = '" . $form_desenvolvedora[3] . "'";
        $editar = $mysqli->query($editar_desenvolvedora) or die($mysqli->error);

        echo '<script>
                swal({
                    title: "Desenvolvedora Editada!",
                    type: "success",
                    confirmButtonText: "Ok",
                    confirmButtonColor: "#000",
                },
            function (isConfirm) {
                if (isConfirm) {
                    window.location = "listar.php";
                }
            });        
</script>';
    }
    if (isset($_POST['editar_jogo'])) {
        $form_jogos = array($_POST["nome"], $_POST["desenvolvedora"], $_POST["data"], $_POST["idjogo"]);
        $editar_jogo = "UPDATE jogos SET nome = '" . $form_jogos[0] . "', id_desenvolvedora = '" . $form_jogos[1] . "',lanc= '" . $form_jogos[2] . "' WHERE idjogos = '" . $form_jogos[3] . "'";
        $editar = $mysqli->query($editar_jogo) or die($mysqli->error);

        echo '<script>
                swal({
                    title: "Jogo Editado!",
                    type: "success",
                    confirmButtonText: "Ok",
                    confirmButtonColor: "#000",
                },
            function (isConfirm) {
                if (isConfirm) {
                    window.location = "listar.php";
                }
            });        
</script>';
    }
?>



</html>

