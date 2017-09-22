<?php 

  //check_adm_session();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>dashcont - <?php echo $titulo; ?></title>

        <meta name="msapplication-TileColor" content="#663fb5">
    <!--     <meta name="msapplication-TileImage" content="<?php echo base_url()?>assets/index/img/favicon/mstile-144x144.png"> -->
      <!--   <meta name="msapplication-config" content="<?php echo base_url()?>assets/index/img/favicon/browserconfig.xml"> -->
        <meta name="theme-color" content="#663fb5">
        <!-- Only needed Bootstrap bits + custom CSS in one file -->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,600,800" rel="stylesheet">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" ></script>
        <script src="<?php echo base_url()?>assets/lib/jquery.popSelect.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/7cbf6b3d85.js"></script>

        <script type="text/javascript">var ajaxUrl = '<?php echo base_url('ajax_functions/'); ?>'; </script>

        <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootbox/sweet-alert.min.css" /> -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/theme.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/font/flaticon.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/lib/animate.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/lib/all-animation.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/lib/jquery.popSelect.css">  
        <!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/rede.css"> -->


    </head>

    <body class="clearfix relative">
        <div class="loading ">
            <div class="sk-fading-circle">
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
   <!--  <div class="container-fluid hidden-md-up">
       <div class="row">
            <div class="col-12 col-sm-12 col-md-2 bg-black-md ">
              <div class="row head header-princ-menu pd-10 text-center">
                    <div class="title title-1 col-12 ">Dashboard</div>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#menuprincipal" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation"><span class="fa fa-bars font-branco"></span></button>
                </div>
            </div>
            <div class="col-4 bg-grey-md1">
                <div class="row head header-sec-menu pd-10">
                    <div class="title title-2 w-100 text-center mb-1"> <?php //echo $pg_icone ?>  <span class="pull-right"> <?php echo $titulo_1 ?>  </span></div>
                </div>
            </div>
            <div class="col-8 bg-grey-md1 ">
                <a href=""  data-toggle="collapse" data-target="#menu-secundario" >
                <div class="row head header-contain pd-10">
                    <div class="col-12">
                        <h1 class="title title-2 text-center"> Menu </h1>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div> -->

  <!-- INICIO TEMPLATE  -->
<div class="container-fluid head sticky-top bg-azul">
    <div class="row align-items-center">
        <div class="col-10 col-md-3" >
            <div class="row text-center ">
                <button class="navbar-toggler navbar-toggler-left hidden-sm-up align-items-center" type="button" data-toggle="collapse" data-target="#menuprincipal" aria-expanded="false" aria-controls="menuprincipal" aria-expanded="false" aria-label="Toggle navigation"><span class="fa fa-bars font-branco"></span></button>
                <div class="title title-1 font-branco align-items-center col-12">dashcont</div>
            </div>
        </div>


        <div class="col-12 col-md-6 hidden-sm-down">
            <div class="row">
                <div class="col-12">
                    <ul class="menu-head">
                        <li><a class="<?php if( !empty($pg_inicio) ){ echo 'ativo '; } ?>"  href="<?php echo base_url()?>administrativo"><i class="flaticon-home"></i>  </a></li>
                        <li><a class="<?php if( !empty($pg_administrativo) ){ echo 'ativo '; } ?>"  href="<?php echo base_url()?>administrativo/corretores"><i class="flaticon-settings"></i></a></li>
                        <li><a class="<?php if( !empty($pg_pesquisas) ){ echo 'ativo '; } ?>"  href="<?php echo base_url()?>administrativo/sair"><i class="flaticon-users"></i> </a></li>
                    </ul>
                </div>
                
            </div>
        </div>
        <?php //if(!$this->agent->is_mobile() ): ?>
        <div class="col-2 col-md-3">
            <div class="row text-center">
                <div class="col-12 ">
                    <div class="title title-2 col-12 font-branco "> <?php echo $titulo_1 ?> </div>
                </div>
            </div>
        </div>
        <?php //endif;?>
    </div>
</div>

 
