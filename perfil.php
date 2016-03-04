<!DOCTYPE html>
<?php
//abrindo sessao
session_start();
//incluindo conexao
include_once "./classe/conexao.php";
include_once './classe/cabecalho.php';
//identificando login
$idlogado = $_SESSION["user"];

//fazendo consultas gerais de login e usuario
$consulta_de_login = "SELECT * FROM login where idlogin = $idlogado";
$consulta_de_usuario = "SELECT * FROM usuarios where id_login = $idlogado";
$con = $mysqli->query($consulta_de_login);
$resultado_login = $con->fetch_assoc();
$con = $mysqli->query($consulta_de_usuario);
$resultado_usu = $con->fetch_assoc();
?>


<html>
    <!--configuraçoes do site-->
    <head>
        <title>Perfil</title>

        <script>
            $(document).ready(function () {
                $('select').material_select();
            });</script>
    </head>

    <!--começo do site-->
    <body>
        <!--NAVBAR-->
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
        <br>
        <br> <br>
        <!--CONTAINER COM FORMULARIO DE PERFIL-->
        <div class = "container black" >
            <div class="continer right" style="padding-bottom: 20px">
                <form class = "col s8 " method = "post" action = "perfil.php" ><!--FORM DELETE-->
                    <button class = "btn-floating btn-large waves-effect waves-light white" type = "submit" name = "delete" id = "delete" >
                        <i class = "material-icons right black-text" >delete</i>
                </form>
            </div>
            <!--FORM UPDATE PERFIL-->
            <form class = "col s8 " method = "post" action = "perfil.php" >
                <div class = "row" >
                    <div class = "col s6" >
                        <h3 class = "white-text" > Editar Perfil </h3></div>
                </div> 
                <div class="container-fluid">
                    <div class="row">
                        <div class = "input-field col s6" >
                            <input value="<?php echo $resultado_usu["nome"]; ?>" name = "nome" id = "nome" type = "text" class = "validate white-text" placeholder = "Digite seu nome completo" required>
                            <label for = "nome" class = "white-text" > Nome </label>
                        </div>
                        <div class = "input-field col s6" >
                            <!--DATE PICKER-->
                            <label for = "data" class = "white-text" > Data de Nascimento </label>
                            <input value="<?php echo $resultado_usu["dnasc"]; ?>" type="text" data-field="date" name="data" id="data" class="white-text"readonly required>
                            <div id="dtBox">
                            </div>
                        </div>
                        <div class="input-field col s8">
                            <label for="email" class="white-text">Email</label>
                            <input value="<?php echo $resultado_usu["email"]; ?>" type="text" name="email" id="email" class="validate white-text" required>
                        </div>
                        <div class="input-field col s8 ">
                            <label for="cidade" class="white-text">Cidade</label>
                            <input value="<?php echo $resultado_usu["cidade"]; ?>" type="text" name="cidade" id="cidade" class="validate white-text" required>
                        </div>
                        <style type="text/css">
                            .dropdown-content li > a, .dropdown-content li > span{
                                color: #000;
                            }    
                        </style>                   
                        <div class="input-field col s6 ">
                            <select class="white-text" name="uf" required>
                                <option value="" disabled selected>Estado</option>
                                <?php
                                //SELECIONANDO ESTADOS DISPONIVEIS
                                $sql = "SELECT * FROM ufs";
                                $con = $mysqli->query($sql) or die($mysqli->error);
                                $dados = $con->fetch_assoc();
                                $total = $con->num_rows;
                                if ($total > 0) {
                                    do {
                                        ?> <option  value="<?php echo $dados['iduf'] ?>"><?php echo $dados['nome'] ?></option><?php
                                    } while ($dados = mysqli_fetch_assoc($con));
                                }
                                ?>
                            </select>                          
                            <label>Estado</label>
                            <div class="input-field col s8">
                                <label for="user" class="white-text">Usuario</label>
                                <input required value="<?php echo $resultado_login["user"]; ?>" type="text" name="user" id="user" placeholder="Nome usado para login" class="validate white-text">
                            </div>
                            <div class="input-field col s8">
                                <label for="pass" class="white-text">Senha</label>
                                <input required type="password" name="pass" id="pass"  class="validate white-text">
                            </div>
                            <div class="input-field col s8">
                                <label for="cpass" class="white-text">Confirme sua Senha</label>
                                <input required type="password" name="cpass" id="cpass"  class="validate white-text">
                            </div>
                            <div class = "input-field col s8" >
                                <button class = "btn waves-effect waves-dark white black-text" type = "submit" name = "action" id = "login" >Aplicar
                                    <i class = "material-icons right" > send </i>
                                </button>
                            </div>	
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php
        if (isset($_POST['delete'])) {

            //tirando viadagem de check de chaves estrangeiras
            $tirar_viadagem = "SET FOREIGN_KEY_CHECKS = 0";
            $tirar = $mysqli->query($tirar_viadagem) or die($mysqli->error);
            //deletando usuario
            $delete_usu = "DELETE FROM usuarios WHERE idusuarios = '" . $resultado_usu["idusuarios"] . "';";
            $deletar = $mysqli->query($delete_usu) or die($mysqli->error);
            //deletando login
            $delete_log = "DELETE FROM login WHERE idlogin = '" . $idlogado . "';";
            $deletar = $mysqli->query($delete_log)or die($mysqli->error);
            //deletando amigos
            $delete_amigos = "DELETE FROM amigos WHERE id_usuario = '" . $idlogado . "';";
            $deletar = $mysqli->query($delete_amigos)or die($mysqli->error);
            //fechando sessao
            session_unset();
            echo "<script>
                            swal({
                                title: 'Você foi deletado do GW!',
                              
                                type: 'success',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
            },
         function (isConfirm) {
                if (isConfirm) {
                    window.location = 'login.php';
                }
            });           
</script>";
        }
        if (isset($_POST['action'])) {
            //pegando dados de login do form
            $formlogin = array($_POST["user"], $_POST["pass"], $_POST["cpass"]);
            //pegando dados de usuario do form
            $formusuario = array($_POST['nome'], $_POST['data'], $_POST['email'], $_POST['cidade'], $_POST['uf']);
            //pegando informaçoes do banco para verificação de dados iguais
            $consulta_login = "SELECT * FROM login where user = '" . $formlogin[0] . "'";
            $con = $mysqli->query($consulta_login);
            //colocando dados de login em uma array
            $resultado_login_apos = $con->fetch_assoc();
            //se senha for igual a confirmação de senha
            if ($formlogin[1] == $formlogin[2]) {

                //alterando login
                $update_login = "UPDATE login SET user = '" . $formlogin[0] . "',pass = '" . $formlogin[1] . "'  WHERE idlogin = $idlogado";
                $update = $mysqli->query($update_login) or die("<script>
                            swal({
                                title: 'Opa!',
                                text: 'Ja existe um usuário com esse nome!',
                                type: 'error',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
                            })
        </script>");

                $update_user = "UPDATE usuarios SET nome = '" . $formusuario[0] . "',dnasc = '" . $formusuario[1] . "',email = '" . $formusuario[2] . "',cidade = '" . $formusuario[3] . "',id_ufs = '" . $formusuario[4] . "'  WHERE id_login = $idlogado";
                $update = $mysqli->query($update_user)or die($mysqli->error);
                echo "<script>
                            swal({
                                title: 'Editado!',
                                
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
            } else {
                echo "<script>
                            swal({
                                title: 'Opa!',
                                text: 'Senhas não Correspondem',
                                type: 'error',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
                 
            });           
</script>";
            }
        }
        ?>
    </body>

</html>