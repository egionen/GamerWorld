<!DOCTYPE html>
<?php
//TELA DE INFORMAÇOES DO JOGO
//INICIAR SESSAO
session_start();
//DADO DE LOGADO
$idlogado = $_SESSION["user"];
//INCLUIR CONEXAO
include_once './classe/conexao.php';
//INCLUIR CABEÇALHO
include_once './classe/cabecalho.php';
//SE RETORNAR JOGO 
if (!empty("idjogo")) {
    $idjogo = $_GET["idjogo"];
}


//SELECIONANDO INFORMAÇOES DO LOGADO
$login = "SELECT * FROM login where idlogin = $idlogado ";
$con_log = $mysqli->query($login) or die($mysqli->error);
$inf_log = $con_log->fetch_assoc();
//SELECIONANDO JOGOS ONDE JOGO FOR IGUAL AO RETORNO
$jogos = "SELECT * FROM jogos where idjogos = $idjogo ";
$con_jog = $mysqli->query($jogos) or die($mysqli->error);
$lista_jog = $con_jog->fetch_assoc();
//SELECIONANDO DESENVOLVEDORAS
$des_jogo = "SELECT nome FROM desenvolvedoras WHERE iddesenvolvedoras ='" . $lista_jog["id_desenvolvedora"] . "'";
$con_des_jogo = $mysqli->query($des_jogo);
$lista_des_jogo = $con_des_jogo->fetch_assoc();
//SELECIONANDO TRAILERS DO JOGO
$trailer_jogo = "SELECT * FROM trailers WHERE id_jogos ='" . $idjogo . "'";
$con_trailer_jogo = $mysqli->query($trailer_jogo);
$lista_trailer_jogo = $con_trailer_jogo->fetch_assoc();
//SELECIONANDO CAPAS DO JOGO
$capas = "SELECT capa FROM capas WHERE idcapas = '" . $lista_jog["id_capa"] . "'";
$con_cap = $mysqli->query($capas) or die($mysqli->error);
$lista_capas = $con_cap->fetch_assoc();
//SELECIONANDO PLATAFORMAS DO JOGO
$jogo_plataforma = "SELECT * FROM jogo_tem_plataforma WHERE id_jogo = '" . $idjogo . "'";
$con_jogo_plataforma = $mysqli->query($jogo_plataforma) or die($mysqli->error);
$lista_jogo_plataforma = $con_jogo_plataforma->fetch_assoc();
?>
<html>

    <head>
        <title><?php echo $lista_jog["nome"]; ?></title>
    </head>
    <body>
        <?php
    
            
        
        //SE ADICIONAR FOR PRESSIONADO
        if (isset($_POST["adicionar"])) {
            $form_trailer = array($_POST["id"], $_POST["nome"], $_POST["trailer"], $_POST["data"]);
            $insert_amigo = "INSERT INTO trailers (jogo,link,data,id_jogos) values ('" . $form_trailer[1] . "','" . $form_trailer[2] . "','" . $form_trailer[3] . "','" . $form_trailer[0] . "')";
            $in_amigo = $mysqli->query($insert_amigo)or die("<script>
                            swal({
                                title: 'Opa!',
                                text: 'Trailer já foi adicionado!',
                                type: 'success',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
                            },
         function (isConfirm) {
                if (isConfirm) {
                    window.location = 'configjogo.php?idjogo=$idjogo';
                }
            });        
</script>");
            echo "<script>
                 swal({
                                title: 'Trailer Adicionado!',
                                
                                type: 'success',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
                            },
         function (isConfirm) {
                if (isConfirm) {
                    window.location = 'configjogo.php?idjogo=$idjogo';
                }
            });     
</script>";
        }

        //SE DELETE FOR PRESIONADO
        if (isset($_POST["delete"])) {


            $tirar_viadagem = "SET FOREIGN_KEY_CHECKS = 0";
            $tirar = $mysqli->query($tirar_viadagem) or die($mysqli->error);

            $delete_jogo = "DELETE FROM jogos WHERE idjogos = '" . $idjogo . "';";
            $deletar_jogo = $mysqli->query($delete_jogo) or die($mysqli->error);

            $delete_jogo_plataforma = "DELETE FROM jogo_tem_plataforma WHERE id_jogo = '" . $idjogo . "';";
            $deletar_jogo_plataforma = $mysqli->query($delete_jogo_plataforma) or die($mysqli->error);

            $delete_trailers = "DELETE FROM trailers WHERE id_jogos = '" . $idjogo . "';";
            $deletar_trailers = $mysqli->query($delete_trailers) or die($mysqli->error);

            $delete_usu_jogo = "DELETE FROM usuario_tem_jogo WHERE id_jogo = '" . $idjogo . "';";
            $deletar_usu_jogo = $mysqli->query($delete_usu_jogo) or die($mysqli->error);



            echo '<script>
                swal({
                    title: "Jogo Deletado com Sucesso",
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



        <!--NAVBAR FIXA-->
        <div class="navbar-fixed">
            <nav style="height: 75px">
                <div class="nav-wrapper teal black">
                    <a href="logado.php" class="brand-logo center"><img src="imgs/logogwpeq.png"></a>
                    <ul class="right hide-on-med-and-down"><!--BOTAO SAIR-->
                        <li><a href="logado.php?sair=1"><i class="material-icons">settings_power</i></a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <br>
        <!--COMEÇO DA LISTAGEM-->
        <div class="row">
            <div class="container">
                <div class=" col s2">
                    <img class="materialboxed" width="100" src="<?php echo $lista_capas["capa"] ?>">
                </div>
                <div class="col s8">
                    <h4><?php echo $lista_jog["nome"]; ?></h4>
                    <h6><?php echo $lista_des_jogo["nome"]; ?></h6>

                </div>
                <form class = "col s2 " method="post" action="configjogo.php?idjogo=<?php echo $idjogo ?>" ><!--FORM DELETE-->
                    <button class = "btn-floating btn-large waves-effect waves-light white" type = "submit" name = "delete" id = "delete" >
                        <i class = "material-icons right black-text" >delete</i>
                </form>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class=" col s12">
                    <ul class="tabs">

                        <li class="tab col s3"><a class="black-text" href="#trailers">Trailers</a></li>
                        <li class="tab col s3"><a class="black-text"  href="#reviews">Reviews</a></li>
                        <li class="tab col s3"><a  class="black-text"  href="#plataformas">Plataformas</a></li>
                    </ul>
                </div>

                <div id="trailers" class="container-fluid">
                    <h4>Trailers</h4>
                    <a class="waves-effect waves-light btn black white-text modal-trigger " href="#modal_add_trailer"><i class="material-icons">add</i></a>

                    <div class="divider black"></div>
                    <br>
                    <?php
                    do {
                        ?><iframe width = "560" height = "315" src = "<?php echo $lista_trailer_jogo["link"] ?>" frameborder = "0" allowfullscreen></iframe><?php
                    } while ($lista_trailer_jogo = mysqli_fetch_assoc($con_trailer_jogo));
                    ?>
                </div>
                <div id="reviews" class="container-fluid">
                    <h5>Reviews</h5><?php
                    //SELECIONAR REVIEWS DO LOGADO
                    $select_ava = "SELECT * FROM review WHERE id_login = '" . $idlogado . "' and id_jogo = '" . $idjogo . "'";
                    $query_select_ava = $mysqli->query($select_ava);
                    $array_ava = $query_select_ava->fetch_assoc();
                    //SE LOGADO JA TIVER EFETUADO UMA INSERÇAO DE REVIEW NESSE JOGO 
                    if ($array_ava["id_login"] != $idlogado) {
                        ?><a class="waves-effect waves-light btn black white-text modal-trigger " href="#modal_add_review"><i class="material-icons">add</i></a><?php
                    } else {
                        ?><h6>Atenção você já adicionou uma review para esse jogo ! =D</h6><?php
                    }
                    ?>
                    <br>
                    <div class="divider"></div>
                    <table>
                        <thead>
                            <tr>
                                <th data-field="review">Review</th>
                                <th data-field="autor">Autor</th>
                                <th data-field="autor">Historia</th>
                                <th data-field="autor">Jogabilidade</th>
                                <th data-field="autor">Trilha</th>
                                <th data-field="autor">Graficos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //LISTAR TODAS AS REVIEWS DO JOGO
                            $review_jogo = "SELECT * FROM review WHERE id_jogo = '" . $idjogo . "'";
                            $query_review_jogo = $mysqli->query($review_jogo) or die($mysqli->error);
                            $array_review = $query_review_jogo->fetch_assoc();

                            do {

                                $ava_jogo = "SELECT * FROM avaliacao WHERE id_review = '" . $array_review["idreview"] . "'";
                                $query_ava_jogo = $mysqli->query($ava_jogo) or die($mysqli->error);
                                $array_ava = $query_ava_jogo->fetch_assoc();

                                $select_autor = "SELECT * FROM login where idlogin = '" . $array_review["id_login"] . "'";
                                $query_login_review = $mysqli->query($select_autor) or die($mysqli->error);
                                $array_autor = $query_login_review->fetch_assoc();
                                ?>
                                <tr><td><?php echo $array_review["review"]; ?></td>
                                    <td><?php echo $array_autor["user"]; ?></td>
                                    <td><?php echo $array_ava["historia"]; ?></td>
                                    <td><?php echo $array_ava["jogabilidade"]; ?></td>
                                    <td><?php echo $array_ava["trilha"]; ?></td>
                                    <td><?php echo $array_ava["grafico"]; ?></td>
                                </tr>

                            <?php } while ($array_review = mysqli_fetch_assoc($query_review_jogo));
                            ?>
                        </tbody>
                    </table>
                </div>
                <div id="plataformas" class="container-fluid"><h5>Esse jogo está disponível nas seguintes plataformas:</h5>
                    <a href="#modal_add_plataforma" class="modal-trigger btn black waves-effect"><i class="material-icons">add</i></a>
                    <div class="divider black"></div>
                    <div class="container-fluid">
                        <?php
                        do {
                            //SELECIONAR PLATAFORMAS
                            $plataforma = "SELECT * FROM plataforma WHERE  idplataforma = '" . $lista_jogo_plataforma["id_plataforma"] . "'";
                            $con_plataforma = $mysqli->query($plataforma) or die($mysqli->error);
                            $lista_plataforma = $con_plataforma->fetch_assoc();
                            ?>
                            <h6><?php echo $lista_plataforma["nome"]; ?></h6>

                            <?php
                        } while ($lista_jogo_plataforma = mysqli_fetch_assoc($con_jogo_plataforma));
                        ?>
                    </div>
                </div>
            </div>
        </div>





        <!--MODAL-->
        <div id="modal_add_trailer" class="modal">
            <div class="modal-content">
                <h3><?php echo $lista_jog["nome"] ?></h3>
                <h5>Adicionar Trailer</h5>
                <div class="container-fluid">
                    <form method="post" action="configjogo.php?idjogo=<?php echo $idjogo; ?>">
                        <div class="input-field col s8">

                            <input type="hidden" value="<?php echo $idjogo; ?>"  name="id" id="id" class="validate black-text">
                            <input type="hidden" value="<?php echo $lista_jog["nome"]; ?>"  name="nome" id="nome" class="validate black-text">
                        </div>
                        <div class="input-field col s8">
                            <label for="trailer" class="black-text">Trailer</label>
                            <input type="text" name="trailer" id="trailer" class="validate black-text" required>
                        </div>
                        <div class = "input-field col s6" >
                            <!--DATE PICKER-->
                            <label for = "data" class = "black-text" > Data de Lançamento </label>
                            <input  type="text" data-field="date" name="data" id="data" class="black-text"readonly required>
                            <div id="dtBox">
                            </div>

                        </div>
                        <div class = "input-field col s8" >
                            <?php ?>
                            <button class = "btn waves-effect white black-text" type = "submit" name = "adicionar" id = "login" >Adicionar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--MODAL ADD PLATAFORMA-->
        <div id="modal_add_plataforma" class="modal">
            <div class="modal-content">
                <h4>Adicionar uma Plataforma para o Jogo</h4>
                <div class="container-fluid">
                    <form method="post" action="configjogo.php?idjogo=<?php echo $idjogo?>">
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
                    <br>
                        <button class = "btn waves-effect white black-text" type = "submit" name = "add_plataforma" id = "add_plataforma" >Aplicar</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!--MODAL ADD REVIEW-->
    <div id="modal_add_review" class="modal">
        <div class="modal-content">
            <h4>Adicionar um Review</h4>
            <div class="container-fluid">
                <form method="post" action="configjogo.php?idjogo=<?php echo $idjogo; ?>">
                    <div class="input-field col s8">
                        <input type="hidden" name="idjogo" id="idjogo" value="<?php echo $lista_jog["idjogos"]; ?>" class="validate black-text" required>
                        <input type="hidden" name="idlogin" id="idlogin" value="<?php echo $idlogado; ?>" class="validate black-text" required>
                    </div>
                    <div class="input-field col s8">
                        <label for="nome" class="black-text">Nome</label>
                        <input type="text" name="nome" id="nome" value="<?php echo $lista_jog["nome"]; ?>" readonly class="validate black-text" required>
                    </div>
                    <div class="row">
                        <div class="container left col s8">
                            <div class="input-field col s8">
                                <h6 class="black-text">Historia</h6>
                                <p class="range-field">
                                    <input  required type="range" name="historia" id="historia" min="0" max="10" />
                                </p>
                            </div>
                            <div class="input-field col s8">
                                <h6 class="black-text">Graficos</h6>
                                <p class="range-field">
                                    <input required type="range" name="graficos" id="graficos" min="0" max="10" />
                                </p>
                            </div>
                            <div class="input-field col s8">
                                <h6 class="black-text">Jogabilidade</h6>
                                <p class="range-field">
                                    <input required type="range" name="jogabilidade" id="jogabilidade" min="0" max="10" />
                                </p>
                            </div>
                            <div class="input-field col s8">
                                <h6 class="black-text">Trilha Sonora</h6>
                                <p class="range-field">
                                    <input required type="range" name="trilha" id="trilha" min="0" max="10" />
                                </p>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea required name="reviewtxt" id="reviewtxt" class="materialize-textarea"></textarea>
                                    <label for="reviewtxt">Review</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class = "input-field col s8" >
                        <button class = "btn waves-effect white black-text" type = "submit" name = "add_review" id = "add_review" > Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
<?php
    if(isset($_POST["add_plataforma"])){

             for ($i = 1; $i <= $totalpla; $i++) {
                 
                if (!empty($_POST[$i])) {//INSERIR JOGO TEM PLATAFORMA COM ID JOGO
               
                    $sql_plataforma_jogo = "INSERT INTO jogo_tem_plataforma (id_jogo,id_plataforma) values ('" . $idjogo . "','" . $i . "')";
                    $insert_plataforma_jogo = $mysqli->query($sql_plataforma_jogo) or die($mysqli->error);
                   echo '<script>swal({
            title: "Plataforma Adicionada",
            type: "success",
            confirmButtonColor: "#000",
            confirmButtonText: "Ok",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                window.location = "configjogo.php?idjogo=' . $idjogo . '";
            }
        });
    </script>';
                }}
    }
//SE ADD REVIEW FOR PRESIONADO
if (isset($_POST["add_review"])) {
//RECEBE FORMULARIO
    $form_review = array($_POST["idlogin"], $_POST["idjogo"], $_POST["nome"], $_POST["historia"], $_POST["graficos"], $_POST["jogabilidade"], $_POST["trilha"], $_POST["reviewtxt"]);
    //INSERIR REVIEW
    $inserir_review = "INSERT INTO review (review,id_jogo,id_login) values ('" . $form_review[7] . "','" . $idjogo . "','" . $idlogado . "')";
    $query_insert_review = $mysqli->query($inserir_review) or die($mysqli->error);
    //PEGAR REVIEW INSERIDA
    $select_ava = "SELECT * FROM review WHERE id_login = '" . $idlogado . "' and id_jogo = '" . $idjogo . "'";
    $query_select_ava = $mysqli->query($select_ava);
    $array_ava = $query_select_ava->fetch_assoc();
    //INSERIR AVALIACAO COM ID REVIEW
    $inserir_avaliacao = "INSERT INTO avaliacao (jogabilidade,grafico,trilha,historia,id_review) values ('" . $form_review[5] . "','" . $form_review[4] . "','" . $form_review[6] . "','" . $form_review[3] . "','" . $array_ava["idreview"] . "')";
    $query_insert = $mysqli->query($inserir_avaliacao) or die($mysqli->error);

    echo '<script>swal({
            title: "Review Adicionada",
            type: "success",
            confirmButtonColor: "#000",
            confirmButtonText: "Ok",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                window.location = "configjogo.php?idjogo=' . $idjogo . '";
            }
        });
    </script>';
}
?>
