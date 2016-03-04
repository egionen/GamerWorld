<html>
    <head>
        <link rel="icon"
              type="image/png"
              href="imgs/sonome.png" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--temas-->
        <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/custom.css"/>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <!--jquery-->
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
                $('select').material_select();
            });</script>
        <script>
            $(document).ready(function () {
                $('.slider').slider({full_width: true});
            });
        </script>
        <!--trigger modal-->
        <script>
            $(document).ready(function () {
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $('.modal-trigger').leanModal();
            });
        </script>
        <style type="text/css">
            .dropdown-content li > a, .dropdown-content li > span{
                color: #000;
            }    
        </style>   
    </head>

    <body>
        <script type="text/javascript">
            $(document).ready(function ()
            {
                $("#dtBox").DateTimePicker({
                    dateFormat: "yyyy-mm-dd",
                    shortDayNames: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
                    shortMonthNames: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
                    fullMonthNames: ["Janeiro", "Fevereiro", "Marco", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                    titleContentDate: "",
                    setButtonContent: "Aplicar",
                    clearButtonContent: "Limpar",
                })
            });</script></body>
</html>