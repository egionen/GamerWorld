<!DOCTYPE html>
<?php
include_once "./classe/conexao.php";
include_once './classe/cabecalho.php';
session_start();
$idlogado = $_SESSION["user"];
?>                   
<html>
    <head>
        <title>Lista</title>
    </head>
    <body>
        <?php
          if (!empty($_GET["plataforma_delete"])) {


        $tirar_viadagem = "SET FOREIGN_KEY_CHECKS = 0";
        $tirar = $mysqli->query($tirar_viadagem) or die($mysqli->error);

        $delete_plataforma = "DELETE FROM plataforma WHERE idplataforma = '" . $_GET["plataforma_delete"] . "';";
        $deletar_plataforma = $mysqli->query($delete_plataforma) or die($mysqli->error);
        
        echo '<script>
                swal({
                    title: "Plataforma Deletada!",
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
     if (!empty($_GET["desenvolvedora_delete"])) {


        $tirar_viadagem = "SET FOREIGN_KEY_CHECKS = 0";
        $tirar = $mysqli->query($tirar_viadagem) or die($mysqli->error);

        $delete_desenvolvedora = "DELETE FROM desenvolvedoras WHERE iddesenvolvedoras = '" . $_GET["desenvolvedora_delete"] . "';";
        $deletar_desenvolvedora = $mysqli->query($delete_desenvolvedora) or die($mysqli->error);
        
        echo '<script>
                swal({
                    title: "Desenvolvedora Deletada!",
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
        //SE RECEBER AMIGUINHO
        if (!empty($_GET["idamigo"])) {
            $idamigo = $_GET["idamigo"];
            //SELECIONA AMIGO CADASTRADO
            $select_amigos = "SELECT * FROM amigos WHERE id_usuario ='" . $idlogado . "' and id_amigo = '" . $idamigo . "'";
            $query_amigos = $mysqli->query($select_amigos) or die($mysqli->error);
            $array_amigos = $query_amigos->fetch_assoc();
            if ($idlogado == $_GET["idamigo"]) {
                //SE USUARIO TENTAR SE CADASTRAR
                echo "<script>
                            swal({
                                title: 'Opa!',
                                text: 'Temos um Forever Alone tentando se adicionar! LOL',
                                 imageUrl: 'imgs/forever_alone.jpeg',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
                               
                            },
         function (isConfirm) {
                if (isConfirm) {
                    window.location = 'listar.php';
                }
            });        
</script>";
            } else {
                if ($array_amigos["id_usuario"] == $idlogado and $array_amigos["id_amigo"] == $idamigo) {
                    //SE TENTAR CADASTRAR UM JA CADASTRADO
                    echo "<script>
                            swal({
                                title: 'Opa!',
                                text: 'Ainda não é possível clonar pessoas!',
                                 type: 'error',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
                              },
         function (isConfirm) {
                if (isConfirm) {
                    window.location = 'listar.php';
                }
            });        
            </script>";
                } else {
                    //INSERIR AMIGO
                    $insert_amigo = "INSERT INTO amigos (id_usuario,id_amigo) values ('" . $idlogado . "','" . $_GET["idamigo"] . "')";
                    $in_amigo = $mysqli->query($insert_amigo)or die("<script>
                            swal({
                                title: 'Opa!',
                                text: 'Ocorreu algum erro ao tentar adicionar amigo!',
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
                    title: "Amigo Adicionado!",
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
            }
        }
        ?>  
        <!--NAVBAR-->
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
        <!--Tab-->
        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s3"><a class="active  black-text" href="#desenvolvedoras">Desenvolvedoras</a></li>
                    <li class="tab col s3"><a class="black-text" href="#jogos">Jogos</a></li>
                    <li class="tab col s3"><a class="black-text" href="#usuarios">Usuarios</a></li>
                    <li class="tab col s3"><a class="black-text" href="#plataformas">Plataformas</a></li>
                </ul>
            </div>
            <div id="desenvolvedoras" class="col s12">
                <!--TABELA DESENVOLVEDORAS -->
                <a class="waves-effect waves-light btn black white-text modal-trigger" href="#modal_add_desenvolvedoras"><i class="material-icons">add</i></a>
                <table>
                    <thead>
                        <tr>
                            <th data-field="acoes">Acoes</th>
                            <th data-field="id">Id Densenvolvedora</th>
                            <th data-field="nome">Nome</th>
                            <th data-field="nascionalidade">Nascionalidade</th>
                            <th data-field="origem">Origem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $lista_des = "SELECT * FROM desenvolvedoras";
                        $con_des = $mysqli->query($lista_des) or die($mysqli->error);
                        $table_des = $con_des->fetch_assoc();
                        $totaldes = $con_des->num_rows;
                        if ($totaldes > 0) {
                            do {
                                ?><tr><td><a class="btn-floating btn-small waves-effect waves-light black" href="form.php?iddesenvolvedora=<?php echo $table_des["iddesenvolvedoras"] ?>"><i class="material-icons">edit</i></a>
                                    <a class="btn-floating btn-small waves-effect waves-light black" href="listar.php?desenvolvedora_delete=<?php echo $table_des["iddesenvolvedoras"] ?>"><i class="material-icons">delete</i></a></td>
                                    <td><?php echo $table_des["iddesenvolvedoras"] ?></td>
                                    <td><?php echo $table_des["nome"] ?></td>
                                    <td><?php echo $table_des["origem"] ?></td>
                                    <td><?php echo $table_des["nascimento"] ?></td></tr><?php
                            } while ($table_des = mysqli_fetch_assoc($con_des));
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="jogos" class="col s12">  
                <!--TABELA JOGOS -->
                <table>
                    <thead>
                        <tr>
                            <th data-field="acoes">Acoes</th>
                            <th data-field="idjogos">Id Jogos</th>
                            <th data-field="nome">Nome</th>

                            <th data-field="desenvolvedora">Desenvolvedora</th>
                            <th data-field="capa">Capa</th>

                            <th data-field="lanc">Laçamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $lista_jog = "SELECT * FROM jogos";
                        $con_jog = $mysqli->query($lista_jog) or die($mysqli->error);
                        $table_jog = $con_jog->fetch_assoc();
                        $totaljog = $con_jog->num_rows;
                        if ($totaljog > 0) {
                            do {
                                ?><tr><td><a class="btn-floating btn-small waves-effect waves-light black" href="configjogo.php?idjogo=<?php echo $table_jog["idjogos"] ?>"><i class="material-icons">settings</i></a>
                                        <a class="btn-floating btn-small waves-effect waves-light black" href="form.php?idjogo=<?php echo $table_jog["idjogos"] ?>"><i class="material-icons">edit</i></a>
                                        <a class="btn-floating btn-small waves-effect waves-light black" href="logado.php?idjogo=<?php echo $table_jog["idjogos"] ?>"><i class="material-icons">add</i></a></td>
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
                            } while ($table_jog = mysqli_fetch_assoc($con_jog));
                        }
                        ?>
                    </tbody>
                </table></div>
            <div id="usuarios" class="col s12">
                <!--TABELA USUARIOS-->
                <table>
                    <thead>
                        <tr>
                            <th data-field="acoes">Acoes</th>

                            <th data-field="nome">Nome</th>
                            <th data-field="dnasc">Data de Nascimento</th>
                            <th data-field="email">Email</th>
                            <th data-field="cidade">Cidade</th>
                            <th data-field="estado">Estado</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $lista_usu = "SELECT * FROM usuarios";
                        $con_usu = $mysqli->query($lista_usu) or die($mysqli->error);
                        $table_usu = $con_usu->fetch_assoc();
                        $totalusu = $con_usu->num_rows;
                        if ($totalusu > 0) {
                            do {
                                ?><tr>
                                    <td><a class="btn-floating btn-small waves-effect waves-light black" href="listar.php?idamigo=<?php echo $table_usu["id_login"]; ?>"><i class="material-icons">add</i></a>
                                    <td><?php echo $table_usu["nome"] ?></td>
                                    <td><?php echo $table_usu["dnasc"] ?></td>
                                    <td><?php echo $table_usu["email"] ?></td>
                                    <td><?php echo $table_usu["cidade"] ?></td>
                                    <td><?php
                                        $uf_usu = "SELECT nome FROM ufs WHERE iduf ='" . $table_usu["id_ufs"] . "'";
                                        $con_uf_usu = $mysqli->query($uf_usu);
                                        $lista_uf_usu = $con_uf_usu->fetch_assoc();
                                        echo $lista_uf_usu["nome"];
                                        ?></td>
                                </tr><?php
                            } while ($table_usu = mysqli_fetch_assoc($con_usu));
                        }
                        ?>
                    </tbody>
                </table></div>
            <div id="plataformas" class="col s12">
                <a class="waves-effect waves-light btn black white-text modal-trigger" href="#modal_add_plataforma"><i class="material-icons">add</i></a>
                <!--TABELA PLATAFORMA-->
                <table>
                    <thead>
                        <tr>
                            <th data-field="acoes">Acoes</th>
                            <th data-field="nome">Nome</th>
                            <th data-field="dnasc">Empresa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $lista_pla = "SELECT * FROM plataforma";
                        $con_pla = $mysqli->query($lista_pla) or die($mysqli->error);
                        $table_pla = $con_pla->fetch_assoc();
                        $totalpla = $con_pla->num_rows;
                        if ($totalpla > 0) {
                            do {
                                ?><tr>
                                    <td><a class="btn-floating btn-small waves-effect waves-light black" href="form.php?idplataforma=<?php echo $table_pla["idplataforma"] ?>"><i class="material-icons">edit</i></a>
                                        <a class="btn-floating btn-small waves-effect waves-light black" href="logado.php?idplataforma=<?php echo $table_pla["idplataforma"] ?>"><i class="material-icons">add</i></a>
                                    <a class="btn-floating btn-small waves-effect waves-light black" href="listar.php?plataforma_delete=<?php echo $table_pla["idplataforma"] ?>"><i class="material-icons">delete</i></a></td>
                                    <td><?php echo $table_pla["nome"] ?></td>
                                    <td><?php echo $table_pla["empresa"] ?></td>
                                </tr><?php
                            } while ($table_pla = mysqli_fetch_assoc($con_pla));
                        }
                        ?>
                    </tbody>
                </table></div>
        </div> 

        <!--MODAL-->
        <div id="modal_add_plataforma" class="modal">
            <div class="modal-content">
                <h4>Adicionar uma Plataforma</h4>
                <div class="container-fluid">
                    <form method="post" action="listar.php">
                        <div class="input-field col s8">
                            <label for="nome" class="black-text">Nome</label>
                            <input type="text" name="nome" id="nome" class="validate black-text" required>
                        </div>
                        <div class="input-field col s8">
                            <label for="empresa" class="black-text">Empresa</label>
                            <input type="text" name="empresa" id="empresa" class="validate black-text" required>
                        </div>
                        <div class = "input-field col s8" >
                            <button class = "btn waves-effect white black-text" type = "submit" name = "add_plataforma" id = "login" >Aplicar </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="modal_add_desenvolvedoras" class="modal">
            <div class="modal-content">
                <h4>Adicionar uma Desenvolvedora</h4>
                <div class="container-fluid">
                    <form method="post" action="listar.php">
                        <div class="input-field col s8">
                            <label for="nome" class="black-text">Nome</label>
                            <input type="text" name="nome" id="nome" class="validate black-text" required>
                        </div>
                        <div class="input-field col s8">
                            <label for="nascionalidade" class="black-text">Nascionalidade</label>
                            <input type="text" name="nascionalidade" id="nascionalidade" class="validate black-text" required>
                        </div>
                        <div class="input-field col s8">
                            <label for="data" class="black-text">Origem</label>
                            <input type="number" max="2015" min="1950" name="data" id="data" class="validate black-text" required>
                        </div>
                        <div class = "input-field col s8" >
                            <button class = "btn waves-effect white black-text" type = "submit" name = "add_desenvolvedora" id = "add_desenvolvedora" >Aplicar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        
    
        if (isset($_POST["add_plataforma"])) {
            $ver_pla = "SELECT * FROM plataforma";
            $con_ver = $mysqli->query($ver_pla);
            $lista_pla = $con_ver->fetch_assoc();
            $nome = $_POST["nome"];
            $empresa = $_POST["empresa"];
            if ($lista_pla["nome"] != $nome) {
                $inserir_plataforma = "INSERT INTO plataforma(nome,empresa) values ('" . $nome . "','" . $empresa . "')";
                $con_inserir = $mysqli->query($inserir_plataforma);
                echo "<script>
                            swal({
                                title: 'Cadastrado!',
                                text: 'Plataforma Cadastrada!',
                                type: 'success',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
                            },
         function (isConfirm) {
                if (isConfirm) {
                    window.location = 'listar.php';
                }
            });        
</script>";
            } else {
                echo "<script>
                            swal({
                                title: 'Opa!',
                                text: 'Plataforma já cadastrada!',
                                type: 'error',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
                            },
         function (isConfirm) {
                if (isConfirm) {
                    window.location = 'listar.php';
                }
            });        
</script>";
            }
        }
        if (isset($_POST["add_desenvolvedora"])) {
            $ver_des = "SELECT * FROM desenvolvedoras";
            $con_des = $mysqli->query($ver_des);
            $lista_des = $con_des->fetch_assoc();
            $array_desenvolvedoras = array($_POST["nome"], $_POST["nascionalidade"], $_POST["data"]);
            if ($lista_des["nome"] != $array_desenvolvedoras[0]) {
                $inserir_desenvolvedora = "INSERT INTO desenvolvedoras(nome,nascimento,origem) values ('" . $array_desenvolvedoras[0] . "','" . $array_desenvolvedoras[2] . "','" . $array_desenvolvedoras[1] . "')";
                $inserir = $mysqli->query($inserir_desenvolvedora)or die($mysqli->error);
                echo "<script>
                            swal({
                                title: 'Cadastrado!',
                                text: 'Desenvolvedora Cadastrada!',
                                type: 'success',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
                            },
         function (isConfirm) {
                if (isConfirm) {
                    window.location = 'listar.php';
                }
            });        
</script>";
            } else {
                echo "<script>
                            swal({
                                title: 'Opa!',
                                text: 'Desenvolvedora já cadastrada!',
                                type: 'error',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
                            },
         function (isConfirm) {
                if (isConfirm) {
                    window.location = 'listar.php';
                }
            });        
</script>";
            }
        }
        ?>
        <!--FOOTER-->
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

