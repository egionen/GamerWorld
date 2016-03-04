<!DOCTYPE html>
<?php
//ABRIR SESSAO
session_start();
//INCLUIR CONEXAO
include_once './classe/conexao.php';
//INCLUIR CABEÇALHO
include_once './classe/cabecalho.php';
?>
<html>
    <head>
        <title>Adicionar Jogo</title>
    </head>

    <body>
        <!--NAVBAR FIXA-->
        <div class="navbar-fixed">
            <nav style="height: 75px">
                <div class="nav-wrapper teal black">
                    <a href="logado.php" class="brand-logo center"><img src="imgs/logogwpeq.png"></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="logado.php?sair=1"><i class="material-icons">settings_power</i></a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <br><br>
        <!--COMEÇO DO FORMULARIO-->
        <div class = "container black" >
            <form class = "col s8 " method = "post" action = "addjogo.php" >
                <div class = "row" >
                    <div class = "container-fluid" >
                        <h3 class = "white-text" > Adicionar Jogo </h3>
                    </div>
                    <div class="input-field col s8">
                        <label for="capa" class="white-text">Capa</label>
                        <input name="capa" id="capa" type="text" placeholder="Coloque a url da capa aqui" class="white-text">
                    </div>
                    <div class = "input-field col s8" >
                        <input name = "nome" id = "nome" type = "text" class = "validate white-text" placeholder = "Digite o nome do jogo" required>
                        <label for = "nome" class = "white-text" > Nome </label>
                    </div>
                    <div class = "input-field col s8" >
                        <label for = "data" class = "white-text" > Data de Lançamento </label>
                        <input type="text" data-field="date" name="data" id="data" class="white-text" readonly required>
                        <div id="dtBox"></div>
                    </div>          
                    <div class="input-field col s6 ">
                        <select class="white-text" name="desenvolvedora" required>
                            <option value="" disabled selected>Desenvolvedora</option>
                            <?php
                            echo "<p>"; //LISTAR DESENVOLVEDORAS NO OPTION
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
                    <div class="input-field col s6" style="margin-bottom: 20px">
                        <h6 class="white-text">Plataformas Disponíveis</h6>
                        <?php
                        //LISTAR PLATAFORMAS NO CHECKBOX
                        $consulta_plataformas = "SELECT * FROM plataforma";
                        $con_plataformas = $mysqli->query($consulta_plataformas);
                        $resultado_plataformas = $con_plataformas->fetch_assoc();
                        $totalpla = 0;
                        do {
                            ?><input type="checkbox" name="<?php echo $resultado_plataformas["idplataforma"] ?>" value="<?php echo $resultado_plataformas["idplataforma"] ?>" id=<?php echo $resultado_plataformas["idplataforma"] ?>/>
                            <label for=<?php echo $resultado_plataformas["idplataforma"] ?>/><?php echo $resultado_plataformas["nome"] ?></label><?php
                            $totalpla++;
                        } while ($resultado_plataformas = mysqli_fetch_assoc($con_plataformas));
                        ?>
                    </div>
                    <div class = "input-field col s8" >
                        <button class = "btn waves-effect white black-text" type = "submit" name = "cadastro" id = "login" > Cadastrar</button>
                    </div>	
                </div>
            </form>
        </div>
    </body>
    <?php
    //CADASTRO PRESSIONADO
    if (isset($_POST['cadastro'])) {
        //pegando dados do jogo do form
        $formjogo = array($_POST["capa"], $_POST["nome"], $_POST["data"], $_POST["desenvolvedora"]);
        //pegando informaçoes do banco para verificação de dados iguais
        $consulta = "SELECT * FROM jogos where nome like '%" . $formjogo[1] . "%'";
        $con = $mysqli->query($consulta);
        //colocando dados de login em uma array
        $dtbd = $con->fetch_assoc();
        //se existir um jogo com mesmo nome no banco
        if ($formjogo[1] != $dtbd["nome"]) {
            //caso contrario executa query de inserção de dados
            //inserção na tabela jogos e capas
            $inserircapa = "INSERT INTO capas (nome, capa) values ('" . $formjogo[1] . "','" . $formjogo[0] . "')";
            $insertcapa = $mysqli->query($inserircapa) or die($mysqli->error);
            //SELECIONAR CAPA INSERIDA
            $consulta = "SELECT idcapas FROM capas where nome ='" . $formjogo[1] . "'";
            $con = $mysqli->query($consulta) or die($mysqli->error);
            $capa = $con->fetch_assoc();
            //INSERIR JOGO COM ID CAPA
            $inserirjogo = "INSERT INTO jogos (nome,id_desenvolvedora,id_capa,lanc) values ('" . $formjogo[1] . "','" . $formjogo[3] . "','" . $capa["idcapas"] . "','" . $formjogo[2] . "')";
            $insertjogo = $mysqli->query($inserirjogo) or die($mysqli->error);
            //SELECIONAR JOGO
            $consulta_de_jogo = "SELECT * FROM jogos WHERE nome = '" . $formjogo[1] . "';";
            $con_jogo = $mysqli->query($consulta_de_jogo);
            $jogo = $con_jogo->fetch_assoc();
            for ($i = 1; $i <= $totalpla; $i++) {
                //INSERIR JOGO TEM PLATAFORMA COM ID JOGO
                if (!empty($_POST[$i])) {
                    $sql_plataforma_jogo = "INSERT INTO jogo_tem_plataforma (id_jogo,id_plataforma) values ('" . $jogo["idjogos"] . "','" . $i . "')";
                    $insert_plataforma_jogo = $mysqli->query($sql_plataforma_jogo) or die($mysqli->error);
                }
            }
            echo '<script>
                        swal({
                            title: "Cadastrado",
                            type: "success",
                            confirmButtonColor: "#000",
                            confirmButtonText: "Ok",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        },
                        function (isConfirm) {
                            if (isConfirm) {
                                window.location = "logado.php";
                            }
                        });
            </script>';
        } else {
            echo '<script>
                        swal({
                            title: "Opa!",
                            text: "Ja existe um jogo com esse nome!",
                            type: "error",
                            confirmButtonText: "Ok",
                            confirmButtonColor: "#000",
                        })
            </script>';
        }
    }
    ?>
</html>