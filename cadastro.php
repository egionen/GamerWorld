<!DOCTYPE html>
<?php
//INICIAR SESSAO
session_unset();
//INCLUIR CONEXAO
include_once './classe/conexao.php';
//INCLUIR CABEÇALHO
include_once './classe/cabecalho.php';
?>
<html>
    <head>
        <title>Cadastro</title>
    </head>
    <body>
        <!--NAVBAR FIXA-->
        <div class = "navbar-fixed" >
            <nav style = "height: 75px" >
                <div class = "nav-wrapper teal black" >
                    <a href = "login.php" class = "brand-logo left" > <img src = "imgs/logogwpeq.png" > </a>
                    <ul id = "nav-mobile" class = "right hide-on-med-and-down" >
                    </ul>
                </div>
            </nav>
        </div>
        <br> <br>
        <!--COMEÇO DO FORMULARIO-->
        <div class = "container black" >
            <form class = "col s8 " method = "post" action = "cadastro.php" >
                <div class = "row" >
                    <div class = "container-fluid" >
                        <h3 class = "white-text" > Cadastro </h3>
                    </div>
                    <div class = "input-field col s6" >
                        <input name = "nome" id = "nome" type = "text" class = "validate white-text" placeholder = "Digite seu nome completo" required>
                        <label for = "nome" class = "white-text" > Nome </label>
                    </div>
                    <div class = "input-field col s6" >
                        <label for = "data" class = "white-text" > Data de Nascimento </label>
                        <input type="text" data-field="date" name="data" id="data" class="white-text" readonly required>
                        <div id="dtBox"></div>
                    </div>
                    <div class="input-field col s8">
                        <label for="email" class="white-text">Email</label>
                        <input type="text" name="email" id="email" class="validate white-text" required>
                    </div>
                    <div class="input-field col s8 ">
                        <label for="cidade" class="white-text">Cidade</label>
                        <input type="text" name="cidade" id="cidade" class="validate white-text" required>
                    </div>
                    <div class="input-field col s6 ">
                        <select class="white-text" name="uf" required>
                            <option value="" disabled selected>Estado</option>
                            <?php
                            //LISTAR ESTADOS
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
                        <div class="col s2 right"><a class="waves-effect waves-light btn black white-text modal-trigger" href="#modal_add_uf"><i class="material-icons">add</i></a></div>
                    </div>
                    <div class="input-field col s8">
                        <label for="user" class="white-text">Usuario</label>
                        <input type="text" name="user" id="user" placeholder="Nome usado para login" class="validate white-text">
                    </div>
                    <div class="input-field col s8">
                        <label for="pass" class="white-text">Senha</label>
                        <input type="password" name="pass" id="pass"  class="validate white-text">
                    </div>
                    <div class="input-field col s8">
                        <label for="cpass" class="white-text">Confirme sua Senha</label>
                        <input type="password" name="cpass" id="cpass"  class="validate white-text">
                    </div>
                    <div class = "input-field col s8" >
                        <button class = "btn waves-effect white black-text" type = "submit" name = "cadastrar" id = "cadastrar" >Cadastrar</button>
                    </div>	
                </div>
            </form>
        </div>
        <!--MODAL ADD ESTADO-->
        <div id="modal_add_uf" class="modal">
            <div class="modal-content">
                <h4>Adicionar um Estado</h4>
                <div class="container-fluid">
                    <form method="post" action="cadastro.php">
                        <div class="input-field col s8">
                            <label for="nome" class="black-text">Nome</label>
                            <input type="text" name="nome" id="nome" class="validate black-text" required>
                        </div>
                        <div class="input-field col s8">
                            <label for="empresa" class="black-text">Abreviacao</label>
                            <input type="text" maxlength="2" name="abrev" id="abrev" class="validate black-text" required>
                        </div>
                        <div class = "input-field col s8" >
                            <button class = "btn waves-effect black white-text" type = "submit" name = "add_estado" id = "add_estado" >Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <?php
    //SE ADD ESTADO FOR PRESSIONADO
    if (isset($_POST["add_estado"])) {
        //SELECIONA TODAS OS ESTADOS
        $select_uf = "SELECT * FROM ufs";
        $query_uf = $mysqli->query($select_uf);
        $array_uf = $query_uf->fetch_assoc();
        //RECEBE DADOS DA MODAL ESTADO
        $nome = $_POST["nome"];
        $abrev = $_POST["abrev"];
        //INSERE ESTADO
        $inserir_ufs = "INSERT INTO ufs(nome,uf) values ('" . $nome . "','" . $abrev . "')";
        $query_insert_uf = $mysqli->query($inserir_ufs)or die("<script>
                            swal({
                                title: 'Opa!',
                                text: 'Estado já foi adicionado!',
                                type: 'error',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
                            },
         function (isConfirm) {
                if (isConfirm) {
                    window.location = 'cadastro.php';
                }
            });        
</script>");
        echo "<script>
                            swal({
                                title: 'Cadastrado!',
                                text: 'Estado Adicionado! =D',
                                type: 'success',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
            },
         function (isConfirm) {
                if (isConfirm) {
                    window.location = 'cadastro.php';
                }
            });           
</script>";
    }
//SE CADASTRAR FOR PRESSIONADO
    if (isset($_POST['cadastrar'])) {
        //pegando dados de login do form
        $formlogin = array($_POST["user"], $_POST["pass"], $_POST["cpass"]);
        //pegando dados de usuario do form
        $formusuario = array($_POST['nome'], $_POST['data'], $_POST['email'], $_POST['cidade'], $_POST['uf']);
        //pegando informaçoes do banco para verificação de dados iguais
        $consulta = "SELECT * FROM login where user = '" . $formlogin[0] . "'";
        $con = $mysqli->query($consulta);
        //colocando dados de login em uma array
        $dtbd = $con->fetch_assoc();
        //se senha for igual a confirmação de senha
        if ($formlogin[1] == $formlogin[2]) {
            //se existir um usuario com mesmo nome no banco
            if ($formlogin[0] != $dtbd["user"]) {
                //caso contrario executa query de inserção de dados
                //inserção na tabela login
                $inserirlog = "INSERT INTO login (user,pass) values ('" . $formlogin[0] . "','" . $formlogin[1] . "')";
                $insert = $mysqli->query($inserirlog) or die($mysqli->error);
                // pegando id de login para o usuario
                $consulta = "SELECT idlogin FROM login where user = '" . $formlogin[0] . "'";
                $con = $mysqli->query($consulta) or die($mysqli->error);
                $dtbd = $con->fetch_assoc();
                //inserção de dados no usuarios
                $inserirusu = "INSERT INTO usuarios (nome,dnasc,email,cidade,id_ufs,id_login) values ('" . $formusuario[0] . "','" . $formusuario[1] . "','" . $formusuario[2] . "','" . $formusuario[3] . "','" . $formusuario[4] . "','" . $dtbd['idlogin'] . "')";
                $insert = $mysqli->query($inserirusu) or die($mysqli->error);
                session_start();
                echo "<script>
                            swal({
                                title: 'Cadastrado!',
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
            } else {
                echo "<script>
                            swal({
                                title: 'Opa!',
                                text: 'Já existe um usuario com esse nome ¬¬',
                                type: 'error',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
            },
         function (isConfirm) {
                if (isConfirm) {
                    window.location = 'cadastro.php';
                }
            });           
</script>";
            }
        } else {
            echo "<script>
                            swal({
                                title: 'Opa!',
                                text: 'Senhas não correspondem',
                                type: 'error',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#000',
            },
         function (isConfirm) {
                if (isConfirm) {
                    window.location = 'cadastro.php';
                }
            });           
</script>";
        }
    }
    ?>
</html>