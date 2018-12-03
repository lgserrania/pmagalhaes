<?php
	require_once("../sistema/conexao/conecta.php");
	
	if(isset($_GET["id"])){
		$query = "SELECT * FROM tb_post WHERE idPost = " . $_GET["id"];
		$lista_posts = mysqli_query($conecta,$query);
		if(isset($lista_posts)){
			$post = mysqli_fetch_assoc($lista_posts);
			$query = "SELECT * FROM tb_galeria WHERE idPost = " . $_GET["id"];
			$lista_galeria = mysqli_query($conecta,$query);
		}else{
			header("Location:index.php");
		}
	}else{
		header("Location:index.php");
	}
?>


<!DOCTYPE html>
<html class="no-js" lag="pt-BR"> 
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>P Magalhães Consultoria | Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="P Magalhães Consultoria Financeira, Planejamento, Constura Seus Sonhos, Alcance Seus Objetivos. 
	Somos uma empresa prestadora de serviço financeiro. Tenha controle de gastos e alcance o sucesso"/>	<meta name="keywords" content=""/>

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="../images/favicon.ico">

	<!-- Google Webfonts -->
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="../css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="../css/icomoon.css">
	<!-- Simple Line Icons-->
	<link rel="stylesheet" href="../css/simple-line-icons.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="../css/magnific-popup.css">
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="../css/owl.carousel.min.css">
	<link rel="stylesheet" href="../css/owl.theme.default.min.css">
	<!-- Salvattore -->
	<link rel="stylesheet" href="../css/salvattore.css">
	<!-- Theme Style -->
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/responsive.css">
	<link rel="stylesheet" href="../css/set1.css">
	<link rel="stylesheet" href="../css/set2.css">
	<link rel="stylesheet" href="../css/swiper.min.css">


	<!-- Modernizr JS -->
	<script src="../js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	
	</head>
	<body>
		
		<section class="bg-header">
			<div id="fh5co-offcanvass">
				<ul>
					<li><a href="../index.php">Home</a></li>
					<li class="active"><a href="servicos/index.php">Serviços</a></li>
					<li><a href="clientes/index.php">Sobre</a></li>
					<li><a href="../sobre/index.php">Material Educativo</a></li>
					<li><a href="../contato/index.php">Contato</a></li>
					<li><a href="../artigos/index.php">Artigos</a></li>		
				</ul>
				<h3 class="fh5co-lead">Nossas Redes Sociais</h3>
				<p class="fh5co-social-icons">
					<a href="#"><i class="icon-twitter"></i></a>
					<a href="#"><i class="icon-facebook"></i></a>
					<a href="#"><i class="icon-instagram"></i></a>
					<a href="#"><i class="icon-youtube"></i></a>
				</p>
			</div>
			
			<div id="fh5co-menu" class="navbar">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse" data-target="#fh5co-navbar" aria-expanded="false" aria-controls="navbar"><span>Menu</span> <i></i></a>
							<a href="../index.php" class="navbar-brand"><img src="../images/logo-01.png" class="img-fluid logo"></a>
							<div id="logo-inside">
								<a href="../index.php" class="navbar-brand"><img src="../images/logo-01.png" class="img-fluid logo-inside"></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		

			<div id="fh5co-page" id="gotop">
				<div id="fh5co-wrap">
					<header id="fh5co-hero" data-section="home" role="banner" style="background: url(../images/bg2.png) top left; background-size: cover;">
						<div class="fh5co-overlay"></div>
						<div class="fh5co-intro" id="content-banner">
							<div class="container">
								<div class="row">								
									<div class="col-md-6 fh5co-text">
										<div class="marca-title"></div>
										<h2 class="to-animate intro-animate-1">Artigos</h2>
										<p class="to-animate intro-animate-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla deleniti magni eligendi commodi officiis obcaecati minus voluptatem itaque fuga</p>

									</div>
									<div class="col-md-6 text-right fh5co-intro-img to-animate intro-animate-4">
										<img src="../images/man2.png" alt="P Magalhães Consultoria" class="man-header">
									</div>

								</div>
							</div>						
						</div>
					</header>
					<!-- END .header -->
					
					<div id="fh5co-main">
                        <div class="container">
                            <div class="row box-artigo">
                                <div class="col-md-4">
                                    <img src="../sistema/<?php echo $post["imgPost"] ?>" class="img-responsive" alt="P Magalhaes">
                                </div>
                                <div class="col-md-8">
                                    <div class="marca-artigo"></div>
                                    <h2><?php echo $post["tituloPost"] ?></h2>
                                    <span class="data-detalhada"><?php echo $post["dataPost"] ?></span><br>
                                    <span class="autor-detalhada">Autor: <?php echo $post["autorPost"] ?></span>
                                    <div class="box-text">
										<?php echo $post["conteudoPost"] ?>
                                    </div>
                                </div>
							</div>
							<div class="row box-pagination" id="galeria">
								<div class="col-md-4 h2-galeria">
									<div class="marca-galeria"></div>
									<h2>Galeria</h2>
								</div>
                            	<div class="col-md-8">
									<div class="swiper-container">
   										 <div class="swiper-wrapper">
											<?php
											if(isset($lista_galeria)){
												foreach($lista_galeria as $imagem){
													echo "<div class='swiper-slide'>
														<img src='../sistema/{$imagem["imagem"]}' class='img-responsive' alt='P Magalhães'>
											  			</div>";
												}
											}
											?> 
										</div>
										<!-- Add Pagination -->
										<div class="swiper-pagination"></div>
										<!-- Add Arrows -->
										<div class="swiper-button-next">
											<img src="../images/next.png" class="img-responsive">
										</div>
										<div class="swiper-button-prev">
											<img src="../images/prev.png" class="img-responsive">
										</div>
 									 </div>
                            	</div>
                        	</div>                                                    
                        </div>		                     
                    </div>
                  

					
				</div>

				<footer id="fh5co-footer" style="">
					<div class="fh5co-overlay"></div>
					<div class="fh5co-footer-content">
						<div class="container">
							<div class="row">
								<div class="col-md-3 col-sm-4 col-md-push-3">
									<h3 class="fh5co-lead">Home</h3>
									<ul>
										<li><a href="#" id="session-1">O que podemos fazer</a></li>
										<li><a href="#" id="session-2">O Sucesso</a></li>
										<li><a href="#" id="session-3">Vantagens</a></li>
										<li><a href="#" id="session-4">Fale Conosco</a></li>
										<li><a href="#" id="session-5">Preguntas Frequentes</a></li>
									</ul>
								</div>
								<div class="col-md-3 col-sm-4 col-md-push-3">
									<h3 class="fh5co-lead">Nosso Site</h3>
									<ul>
										<li><a href="#">Home</a></li>
										<li><a href="#">Serviços</a></li>
										<li><a href="#">Clientes</a></li>
										<li><a href="#">Sobre</a></li>
										<li><a href="#">Contato</a></li>
										<li><a href="#">Artigos</a></li>
									</ul>
								</div>
								<div class="col-md-3 col-sm-4 col-md-push-3">
									<h3 class="fh5co-lead">Atendimento</h3>
									<ul>
										<li><i class="far fa-calendar-alt"></i> Seg à Sexta: 09:00 às 18:00</li>
										<li><i class="far fa-calendar-alt"></i> Sábado: 09:00 às 14:00</li>
										<li><i class="fas fa-phone-square"></i> 035 - 9 8701-2767</li>
										<li><i class="fab fa-skype"></i> wendel.paes</li>
										<li>contato@pmagalhaesconsultoria.com.br</li>
									</ul>
								</div>

								<div class="col-md-3 col-sm-12 col-md-pull-9">
									<div class="" style="border:none"><a href="../index.html"><img src="../images/logo2.png" class="logo-footer"></a></div>
									<p class="fh5co-copyright"><small>&copy; <?php echo date('Y') ?>. Todos os direitos reservados.</p>
									<p class="fh5co-social-icons">
										<a href="https://www.tihomeoffice.com/" target="_blank"><img src="../images/logoti.png" class="logoti" alt=""></a>
									</p>
								</div>
								
							</div>
						</div>
					</div>
				</footer>
			</div>
		


	<!-- jQuery -->
	<script src="../js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="../js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="../js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="../js/jquery.waypoints.min.js"></script>
	<!-- Magnific Popup -->
	<script src="../js/jquery.magnific-popup.min.js"></script>
	<!-- Owl Carousel -->
	<script src="../js/owl.carousel.min.js"></script>
	<!-- toCount -->
	<script src="../js/jquery.countTo.js"></script>
	<!-- Main JS -->
	<script src="../js/main.js"></script>
	<script src="../js/script.js"></script>
	<script src="../js/swiper.min.js"></script>	
	<script>
		var swiper = new Swiper('.swiper-container', {
		pagination: {
			el: '.swiper-pagination',
			type: 'progressbar',
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		});
 	 </script>
	
	</body>
</html>
