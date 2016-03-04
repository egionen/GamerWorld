<!DOCTYPE html>
<?php
 session_start();
include_once './classe/conexao.php';
include_once './classe/cabecalho.php';
session_unset();

?>
<html>

    <head>
        <title>Login</title>
     


    <body>
 

        <div class="navbar-fixed">
            <nav style="height: 75px">
                <div class="nav-wrapper teal black">
                    <a href="inicio.php" class="brand-logo center"><img src="imgs/logogwpeq.png"></a>
                  
                </div>
            </nav>
        </div>
        <div class="container black">
            <br><br>
            <form class="col s8 " method="post" action="login.php">
                <div class="row">
                    <div class="container-fluid">
                        <h3 class="white-text">Login</h3>
                    </div>
                    <div class="input-field col s8" >
                        <input name="user" id="user" type="text" class="validate white-text" required style="border-bottom-color: #FFF;color: #FFF">
                        <label for="user" class="white-text">Usuario</label>
                    </div>
                    <div class="input-field col s8">
                        <input name="pass" id="pass" type="password" class="validate white-text" required style="border-bottom-color: #FFF">
                        <label for="pass" class="white-text">Senha</label>
                    </div>

                    <div class="input-field col s6">

                        <button class="btn waves-effect white black-text" type="submit" name="action" id="login">Submit
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
            </form>
        </div>
        <div class="divider col-lg-12"></div>
        <div class="container-fluid white-text" style="margin-bottom: 50px"> <br> <br><h5>Não tem Conta?</h5>
            <div class="input-field col s6">
                <a href="cadastro.php" class="btn waves-effect white black-text">Cadastro</a>
            </div>
        </div>
    </div>



</body>

<?php
include_once './classe/conexao.php';


if (isset($_POST['action'])) {
    $user = $_POST["user"];
    $pass = $_POST["pass"];

    $consulta = "SELECT * FROM login where user = '" . $user . "'AND pass ='" . $pass . "';";
    $con = $mysqli->query($consulta) or die($mysqli->error);
    $dado = $con->fetch_array();
    if ($dado['user'] == $user and $dado['pass'] == $pass) {
       
       
        $_SESSION["user"] = $dado["idlogin"];
        ?><script>swal({
                                    title: "Login Aceito",
                                    type: "success",
                                     confirmButtonColor: "#000",
                                    closeOnConfirm: false,
                                    closeOnCancel: false


                                },
                                function (isConfirm) {
                                    if (isConfirm) {

                                        window.location = "logado.php";

                                    }

                                });



                </script> 
                <?php
       
        
    } else {

        ?><script>
            swal({
                title: "Opa!",
                text: "Senha ou Usuario incorreto!",
                type: "error",
                confirmButtonText: "Ok",
                confirmButtonColor: "#000",
                
            })
        </script> <?php
    }
}
?>
</html>
