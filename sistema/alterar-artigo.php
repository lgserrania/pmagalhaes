<?php require_once("conexao/conecta.php"); ?>


<?php
    session_start();
    include "include/controle_sessao.php";
    
    if(isset($_POST["alterar"])){
        $id = $_POST["idpost"];
        $titulo = utf8_decode($_POST["titulo"]);
        $fonte = $_POST["fonte"];
        $autor = $_POST["autor"];
        $data =  $_POST["data"];
        $conteudo = $_POST["conteudo"];
        $categoriaPost = $_POST["categoria"];
        $imgAnt = $_POST["imgAntiga"];
        if($_FILES["imagem"]["name"] != ""){
            $diretorio = "uploads/";
            $imagem = $_FILES["imagem"];
            $diretorio = 'uploads/';
            $imagem_nome = date("YmdHis") . $imagem["name"];
            $imagem_diretorio = $diretorio . $imagem_nome;

            $update = "UPDATE tb_post "; 
            $update .= "SET tituloPost = '$titulo', autorPost = '$autor', dataPost = '$data', fontePost = '$fonte', conteudoPost = '$conteudo', categoriaPost = $categoriaPost, imgPost = '$imagem_diretorio' ";
            $update .= "WHERE idPost = $id";

            $confirma = mysqli_query($conecta, $update);

            if(!$confirma){
                die("Falha na inclusão");
        
            }else{       
                move_uploaded_file($imagem["tmp_name"], $diretorio . $imagem_nome);
                unlink("$imgAnt");
                header("Location: listar-artigos.php");
            }
        }else{
            $update = "UPDATE tb_post "; 
            $update .= "SET tituloPost = '$titulo', autorPost = '$autor', dataPost = '$data', fontePost = '$fonte', conteudoPost = '$conteudo', categoriaPost = $categoriaPost ";
            $update .= "WHERE idPost = $id";

            $confirma = mysqli_query($conecta, $update);

            if(!$confirma){
                die("Falha na inclusão");
        
            }else{       
                header("Location: listar-artigos.php");
            }
        }
    }

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $query_post = "SELECT * FROM tb_post WHERE idPost = $id";
        $lista_postagem = mysqli_query($conecta, $query_post);
        if(!$lista_postagem){          
            header("Location: listar-artigos.php");
        }else{
            $postagem = mysqli_fetch_assoc($lista_postagem);
        }
    }else{
        header("Location: listar-artigos.php");
    }

    //consulta ao banco de dados - categoria
    $categoria = "SELECT * FROM tb_categoria";    
    $lista_categoria = mysqli_query($conecta,$categoria);
    if(!$lista_categoria){
        die("Falha na conexão com o banco!");
    }
  
	
?>
<!doctype html>
<html class="no-js" lang="pt-BR"> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>P Magalhães Consultoria | Área Administrativa</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="images/favicon.ico">
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="favicon" href="images/favicon.ico">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/estilo.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />


    <!--Summernote-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>
    <link href="http://hayageek.github.io/jQuery-Upload-File/4.0.11/uploadfile.css" rel="stylesheet">
    <script src="http://hayageek.github.io/jQuery-Upload-File/4.0.11/jquery.uploadfile.min.js"></script>
    <script>
        $(function() {
            $.mask.definitions['~'] = "[+-]";
            $("#date").mask("99/99/9999",{placeholder:"mm/dd/yyyy",completed:function(){alert("completed!");}});
            $(".phone").mask("(999) 999-9999");
            $("#phoneExt").mask("(999) 999-9999? x99999");
            $("#iphone").mask("+33 999 999 999");
            $("#tin").mask("99-9999999");
            $("#ssn").mask("999-99-9999");
            $("#product").mask("a*-999-a999", { placeholder: " " });
            $("#eyescript").mask("~9.99 ~9.99 999");
            $("#po").mask("PO: aaa-999-***");
            $("#pct").mask("99%");
            $("#phoneAutoclearFalse").mask("(999) 999-9999", { autoclear: false, completed:function(){alert("completed autoclear!");} });
            $("#phoneExtAutoclearFalse").mask("(999) 999-9999? x99999", { autoclear: false });

            $("input").blur(function() {
                $("#info").html("Unmasked value: " + $(this).mask());
            }).dblclick(function() {
                $(this).unmask();
            });
        });
    </script>
    <!--Dropzone-->
    <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
    <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
   <style>
    #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }
        .dropzone {
            min-height: 150px;
            border: 2px dashed rgba(0, 0, 0, 0.3);
            background: white;
            padding: 20px 20px;
        }

    </style>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav" id="aside-menu">
                    <li class="active">
                        <a href="index.html"><i class="menu-icon fa fa-laptop"></i>Painel</a>
                    </li>
                    <li class="menu-title">Publicações</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Categorias</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-puzzle-piece"></i><a href="cadastrar-categoria.html">Cadastrar</a></li>   

                            
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Artigos</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="cadastrar-artigo.php">Cadastrar Artigo</a></li>
                            <li><i class="fa fa-table"></i><a href="">Listar Artigos</a></li>
                        </ul>
                    </li>
                    
                    <li class="menu-title">Galeria</li><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Menu</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="cadastrar-galeria.php">Criar Galeria</a></li>
                            <li><i class="menu-icon ti-themify-logo"></i><a href="listar-galeria.php">Listar Galeria</a></li>
                        </ul>
                    </li>
                    
                 

                    <li class="menu-title">Usuários</li><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Menu</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="cadastrar-usuario.php">Cadastrar Usuário</a></li>
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="usuario.php">Listar Usuário</a></li>
                        </ul>
                    </li>
                   
                    
                 
                    <li class="menu-title">Extras</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Perfil</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="">Meu Perfil</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="logout.php">Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img src="images/logo.png" class="logo" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">                      

                        <div class="dropdown for-notification">
                        
                        </div>                       
                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/logo.png" alt="P Magalhães">
                        </a>

                        <div class="user-menu dropdown-menu">                  

                            <a class="nav-link" href="logout.php"><i class="fa fa-power -off"></i>Sair</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
           
                <!-- /Widgets -->
                <!--  Traffic  -->               
                <!--  /Traffic -->
                <div class="clearfix"></div>
                <!-- Orders -->
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card" id="box-top">
                                <div class="card-body">
                                    <h4 class="box-title">Editar artigo </h4>
                                </div>
                                
                               
                            </div> <!-- /.card -->
                        </div>  <!-- /.col-lg-8 -->

                       
                    </div>                   
                    <form action="alterar-artigo.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="idpost" value="<?php echo $postagem["idPost"] ?>">
                        <input type="hidden" name="imgAntiga" value="<?php echo $postagem["imgPost"] ?>">   
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="inputUser">Título do Post</label>
                                <input type="text" class="form-control" id="inputUser" aria-describedby="emailHelp" name="titulo" placeholder="Título" value="<?php echo $postagem["tituloPost"] ?>">                                                        
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="inputUser">Fonte</label>
                                <input type="text" class="form-control" id="inputUser" aria-describedby="emailHelp" name="fonte" placeholder="Fonte" value="<?php echo $postagem["fontePost"] ?>">                                                        
                            </div>                                     
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="inputUser">Autor</label>
                                <input type="text" class="form-control" id="inputUser" aria-describedby="emailHelp" name="autor" placeholder="Autor" value="<?php echo $postagem["autorPost"] ?>">                                                        
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="inputData">Data</label>
                                <input type="text" class="form-control" id="inputData" aria-describedby="emailHelp" name="data" placeholder="Data" value="<?php echo $postagem["dataPost"] ?>">                                                        
                            </div> 
                            <div class="col-md-2 form-group">
                                <label for="inputUser">Categoria</label>
                                <select class="custom-select mr-sm-2" name="categoria" id="inlineFormCustomSelect">
                                    <?php
                                        $minhacategoria = $info_categoria["idCategoria"];
                                        while ($linha = mysqli_fetch_assoc($lista_categoria)){
                                    ?>
                                    <option value="<?php echo utf8_encode($linha["idCategoria"]); ?>" name="categoria" <?php if($linha["idCategoria"] == $postagem["categoriaPost"]) echo "selected" ?>>
                                        <?php echo utf8_encode($linha["nomeCategoria"]); ?>
                                    </option>
                                                    
                                    <?php
                                        }
                                    ?>     										
                                </select>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <p>Upload da Imagem Destacada <span>Resolução Aceitável é 640 x 426</span></p>  
                            </div>                                
                            <div class="col-md-4">
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" id="imgUp" src="<?php echo $postagem["imgPost"] ?>" alt="Card image cap">
                                    <div class="card-body">                                        
                                        <input type="file" name="imagem" class="form-control-file" id="imgInp">
                                        <button class="btn btn-danger" id="btnRemove" type="button" id="btn-cancel">Cancelar</button>
                                    </div>
                                </div>                                
                            </div>
                        </div>                   
                           
                       
                        <div class="row">
                            <div class="col-md-8">
                                <textarea name="conteudo" id="summernote" cols="30" rows="10"><?php echo $postagem["conteudoPost"] ?></textarea>
                            </div>
                        </div>                                                              
                                        
                        <div class="row box-confirma">
                            <div class="col-md-2">
                                <input class="btn btn-primary" name="alterar" value="Alterar Post" type="submit">
                            </div>                         
                        </div>                      
                    </form>
                </div>
                <!-- /.orders -->
                <!-- To Do and Live Chat -->
               
                <!-- /To Do and Live Chat -->
                <!-- Calender Chart Weather  -->
                
                <!-- /Calender Chart Weather -->
                <!-- Modal - Calendar - Add New Event -->
               
                <!-- /#event-modal -->
                <!-- Modal - Calendar - Add Category -->
               
            <!-- /#add-category -->
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col">
                        Copyright &copy; <?php echo date('Y') ?> P Magalhães Consultoria
                    </div>
                    <div class="col text-right">
                        <a href="https://tihomeoffice.com">Ti Home Office</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>


    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="assets/js/init/fullcalendar-init.js"></script>
    <script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <script>
    
    $('#summernote').summernote({
        placeholder: 'Hello bootstrap 4',
        tabsize: 2,
        height: 100
    });
    
    $("#imgInp").change(function() {
        readURL(this);
        //$("#btnRemove").toggle();
    });

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imgUp').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }   

    $("#btnRemove").click(function(){
        $('#imgUp').attr('src', ""); 
        $("#imgInp").val(""); 
        //$("#btnRemove").toggle(); 
    });

    </script>
 

    <!--Local Stuff-->
    <script>
        jQuery(document).ready(function($) {
            "use strict";

            // Pie chart flotPie1
            var piedata = [
                { label: "Desktop visits", data: [[1,32]], color: '#5c6bc0'},
                { label: "Tab visits", data: [[1,33]], color: '#ef5350'},
                { label: "Mobile visits", data: [[1,35]], color: '#66bb6a'}
            ];

            $.plot('#flotPie1', piedata, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        innerRadius: 0.65,
                        label: {
                            show: true,
                            radius: 2/3,
                            threshold: 1
                        },
                        stroke: {
                            width: 0
                        }
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true
                }
            });
            // Pie chart flotPie1  End
            // cellPaiChart
            var cellPaiChart = [
                { label: "Direct Sell", data: [[1,65]], color: '#5b83de'},
                { label: "Channel Sell", data: [[1,35]], color: '#00bfa5'}
            ];
            $.plot('#cellPaiChart', cellPaiChart, {
                series: {
                    pie: {
                        show: true,
                        stroke: {
                            width: 0
                        }
                    }
                },
                legend: {
                    show: false
                },grid: {
                    hoverable: true,
                    clickable: true
                }

            });
            // cellPaiChart End
            // Line Chart  #flotLine5
            var newCust = [[0, 3], [1, 5], [2,4], [3, 7], [4, 9], [5, 3], [6, 6], [7, 4], [8, 10]];

            var plot = $.plot($('#flotLine5'),[{
                data: newCust,
                label: 'New Data Flow',
                color: '#fff'
            }],
            {
                series: {
                    lines: {
                        show: true,
                        lineColor: '#fff',
                        lineWidth: 2
                    },
                    points: {
                        show: true,
                        fill: true,
                        fillColor: "#ffffff",
                        symbol: "circle",
                        radius: 3
                    },
                    shadowSize: 0
                },
                points: {
                    show: true,
                },
                legend: {
                    show: false
                },
                grid: {
                    show: false
                }
            });
            // Line Chart  #flotLine5 End
            // Traffic Chart using chartist
            if ($('#traffic-chart').length) {
                var chart = new Chartist.Line('#traffic-chart', {
                  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                  series: [
                  [0, 18000, 35000,  25000,  22000,  0],
                  [0, 33000, 15000,  20000,  15000,  300],
                  [0, 15000, 28000,  15000,  30000,  5000]
                  ]
              }, {
                  low: 0,
                  showArea: true,
                  showLine: false,
                  showPoint: false,
                  fullWidth: true,
                  axisX: {
                    showGrid: true
                }
            });

                chart.on('draw', function(data) {
                    if(data.type === 'line' || data.type === 'area') {
                        data.element.animate({
                            d: {
                                begin: 2000 * data.index,
                                dur: 2000,
                                from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                                to: data.path.clone().stringify(),
                                easing: Chartist.Svg.Easing.easeOutQuint
                            }
                        });
                    }
                });
            }
            // Traffic Chart using chartist End
            //Traffic chart chart-js
            if ($('#TrafficChart').length) {
                var ctx = document.getElementById( "TrafficChart" );
                ctx.height = 150;
                var myChart = new Chart( ctx, {
                    type: 'line',
                    data: {
                        labels: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul" ],
                        datasets: [
                        {
                            label: "Visit",
                            borderColor: "rgba(4, 73, 203,.09)",
                            borderWidth: "1",
                            backgroundColor: "rgba(4, 73, 203,.5)",
                            data: [ 0, 2900, 5000, 3300, 6000, 3250, 0 ]
                        },
                        {
                            label: "Bounce",
                            borderColor: "rgba(245, 23, 66, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(245, 23, 66,.5)",
                            pointHighlightStroke: "rgba(245, 23, 66,.5)",
                            data: [ 0, 4200, 4500, 1600, 4200, 1500, 4000 ]
                        },
                        {
                            label: "Targeted",
                            borderColor: "rgba(40, 169, 46, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(40, 169, 46, .5)",
                            pointHighlightStroke: "rgba(40, 169, 46,.5)",
                            data: [1000, 5200, 3600, 2600, 4200, 5300, 0 ]
                        }
                        ]
                    },
                    options: {
                        responsive: true,
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        }

                    }
                } );
            }
            //Traffic chart chart-js  End
            // Bar Chart #flotBarChart
            $.plot("#flotBarChart", [{
                data: [[0, 18], [2, 8], [4, 5], [6, 13],[8,5], [10,7],[12,4], [14,6],[16,15], [18, 9],[20,17], [22,7],[24,4], [26,9],[28,11]],
                bars: {
                    show: true,
                    lineWidth: 0,
                    fillColor: '#ffffff8a'
                }
            }], {
                grid: {
                    show: false
                }
            });
            // Bar Chart #flotBarChart End
        });
    </script>
 
    




    
    
    
    
</body>
</html>
<?php
    // Fechar conexao
    mysqli_close($conecta);
?>
