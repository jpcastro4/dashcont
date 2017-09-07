<?php 
    check_session()
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Dashboard </title>
<!--     <meta name="description" content="A free HTML template and UI Kit built on Bootstrap" />
    <meta name="keywords" content="free html template, bootstrap, ui kit, sass" />
    <meta name="author" content="Peter Finlan and Taty Grassini Codrops" />
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url()?>assets/index/img/favicon/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url()?>assets/index/img/favicon/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url()?>assets/index/img/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url()?>assets/index/img/favicon/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url()?>assets/index/img/favicon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url()?>assets/index/img/favicon/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url()?>assets/index/img/favicon/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url()?>assets/index/img/favicon/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url()?>assets/index/img/favicon/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/index/img/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/index/img/favicon/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/index/img/favicon/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/index/img/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="<?php echo base_url()?>assets/index/img/favicon/manifest.json">
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/index/img/favicon/favicon.ico"> -->
    <meta name="msapplication-TileColor" content="#663fb5">
    <meta name="msapplication-TileImage" content="<?php echo base_url()?>assets/index/img/favicon/mstile-144x144.png">
    <meta name="msapplication-config" content="<?php echo base_url()?>assets/index/img/favicon/browserconfig.xml">
    <meta name="theme-color" content="#663fb5">
    <!-- Only needed Bootstrap bits + custom CSS in one file -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700,900" rel="stylesheet">
 
    <link rel="stylesheet" href="<?php echo base_url()?>assets/lib/animate.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dashboard/css/theme.css">
    <script src="https://use.fontawesome.com/7cbf6b3d85.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dashboard/font/flaticon.css">

    <script type="text/javascript">var ajaxUrl = '<?php echo base_url('ajax_functions/'); ?>'; </script>    
    <script src="https://sdk.amazonaws.com/js/aws-sdk-2.92.0.min.js"></script>

  </head>

  <body class="bg-faded bg-grey-md1">
    <div class="loading animated ">
        <div class="sk-fading-circle animated bounceIn">
            <div class="sk-circle1 sk-circle"></div>
            <div class="sk-circle2 sk-circle"></div>
            <div class="sk-circle3 sk-circle"></div>
            <div class="sk-circle4 sk-circle"></div>
            <div class="sk-circle5 sk-circle"></div>
            <div class="sk-circle6 sk-circle"></div>
            <div class="sk-circle7 sk-circle"></div>
            <div class="sk-circle8 sk-circle"></div>
            <div class="sk-circle9 sk-circle"></div>
            <div class="sk-circle10 sk-circle"></div>
            <div class="sk-circle11 sk-circle"></div>
            <div class="sk-circle12 sk-circle"></div>
        </div>
    </div>
    
    <!-- INICIO TEMPLATE  -->
    <div class="container-fluid bg-amarelo">
        <div class="row">

            <!-- MENU PRINCIPAL -->
            <div class="col-12 col-md-3 col-lg-2" >
                <div class="row head header-princ-menu p-3 ">
                    <!-- <button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#menuprincipal" aria-expanded="false" aria-controls="menuprincipal" aria-expanded="false" aria-label="Toggle navigation"><span class="fa fa-bars font-branco"></span></button> -->
                    <div class="title title-1 col-12"><img width="80" alt="TrackSeg Rasteramento Veicular" src="<?php echo base_url('assets/img/logo-branco.png') ?>" ></div>
                    
                </div>
            </div>
            <div class="col-12 col-md-7 bg-grey-md2 <?php if($this->agent->is_mobile() ): echo 'collapse'; endif;?>" id="menu-secundario">
                <div class="row align-items-center head text-right header-contain">
                    <div class="col-12 align-items-center">
                    <!-- <nav class="pull-left">
                        <ul class="menu-horiz text-center align-items-center mb-0 clearfix">
                            <li><a class="<?php if( !empty($pg_inicio) ){ echo 'ativo '; } ?>"  href="<?php echo base_url()?>dashboard/map">  Mapa </a></li>
                            <li><a class="<?php if( !empty($pg_administrativo) ){ echo 'ativo '; } ?>"  href="<?php echo base_url()?>dashboard/account">  Conta </a></li>
                            <li><a class="<?php if( !empty($pg_pesquisas) ){ echo 'ativo '; } ?>"  href="<?php echo base_url()?>dashboard/logout">  Sair </a></li>
                        </ul>
                    </nav> -->
                    <nav class="pull-right text-right dropdown dropdown-profile">
                        <i class="flaticon-circle-2 profile-icon" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                        <ul class="align-items-center mb-0 p-3 dropdown-menu dropdown-menu-right menu-profile animated bounceIn" aria-labelledby="dropdownMenuLink">
                            <li class=""><a href="<?php echo base_url('dashboard/account')?>"><i class="flaticon-circle-2 mx-2"></i> Conta</a></li>
                            <li class=""><a href="<?php echo base_url('dashboard/vehicles')?>"><i class="flaticon-car-1 mx-2"></i> Veículos</a></li>
                            <!-- <li class=""><a href="<?php echo base_url('dashboard/financial')?>"><i class="flaticon-dollar mx-2"></i> Financeiro</a></li> -->
                        </ul>
                         
                    </nav> 
                    </div>
                </div>
            </div>
            <?php // if(!$this->agent->is_mobile() ): ?>
            <div class="col-12 col-md-3 bg-amarelo font-amarelo2 ">
                <div class="row align-items-center head header-sec-menu p-3 hidden-sm-down">
                    <div class="title title-2 col-12 "><i class="<?php echo $head->icon ?> "></i> <span class="pull-right"> <?php echo $head->title ?>  </span></div>
                </div>
                
            </div>
            <?php // endif;?>
        </div>
    </div>


    <div class="container-fluid h100">
     
