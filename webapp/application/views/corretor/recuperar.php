<?php //check_manutencao() ?>
<!DOCTYPE html>
<html lang="en">
  	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">
	    <meta http-equiv="x-ua-compatible" content="ie=edge">
	    <!-- <meta name="robots" content="noindex">
	    <meta name="googlebot" content="noindex"> -->
	    <title>Área do Corretor - <?php if(!empty($titulo)) echo $titulo; ?> </title>
	    <meta name="author" content="João Paulo de Castro Pereira - Difference Publicidade" />

	    <meta name="msapplication-TileColor" content="#A80B0B">
	    <meta name="msapplication-TileImage" content="<?php echo base_url()?>assets/index/img/favicon/mstile-144x144.png">
	    <meta name="msapplication-config" content="<?php echo base_url()?>assets/index/img/favicon/browserconfig.xml">
	    <meta name="theme-color" content="#A80B0B">
	   
	    <!-- Only needed Bootstrap bits + custom CSS in one file -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
	    <script src="https://use.fontawesome.com/7cbf6b3d85.js"></script>

	    <script type="text/javascript">var ajaxUrl = '<?php echo base_url('ajax_functions/'); ?>'; </script>

	    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/bo/assets/css/bootbox/sweet-alert.min.css" /> -->
	    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/theme.css">
	    
  	</head>

  	<body class="bg-black-t">
	    <div class="container py-5" style="max-width:350px">
	      	<div class="row py-5">
	         
	        	<div class="col-12 logo my-5 text-center">
	        		<img width="130" src="http://www.construtorast.com.br/templates/santateresa/images/construtora-santa-teresa.png" >
	        	</div>

	        	<?php if( empty($emailInvalido) ): ?>

	        	<?php if( empty($tempo) ): ?>

	        	<form action="" method="post" class="row" >
	        		<div class="w-100 text-center my-2">
	        			<h1 class="title-1 ">Recuperar senha</h1>
	        		</div>
	          	 		          	 
			        <div class="form-group col-12 mb-4">
                        <div class="label">Sua nova senha</div>
                        <input type="password" name="corretorNovaSenha" class="form-control" required />
                    </div>

                    <div class="form-group col-12 mb-4">
                        <div class="label">Repita a nova senha</div>
                        <input type="password" name="corretorNovaSenhaRepete" class="form-control" required />
                    </div>
                    <input type="hidden" name="url" class="form-control" value="<?php echo $url ?>" required />
                    <input type="hidden" name="email" class="form-control" value="<?php echo $email ?>" required />
		            <div class="col-12">
	          			<button type="submit" value="submit" name="submit" id="salvar" class="btn btn-theme btn-block">Salvar nova senha</button>
	          		</div>
		          	<div class="col-12 text-center my-3"> 
		              	<a class="" href="<?php echo base_url()?>entrar"><small>Voltar</small></a>
		          	</div>
	        	</form>

	        	<?php else: ?>
	        		<p class="alert alert-danger text-center w-100"> Tempo de recuperação expirou. <br> <b><a href="<?php echo base_url()?>/esqueceu">Clique aqui e solicite novamente</a></b> </p>
	      		<?php endif;?>

	        	<?php else: ?>
	        		<p class="alert alert-danger text-center w-100"> Email inválido </p>
	      		<?php endif;?>

	        	<hr class="invisible">
	          	        
	      	</div>
	       
	    </div>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    

    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/lib/noty.css" />
    <script src="<?php echo base_url()?>assets/lib/noty.js"></script>

    <script type="text/javascript">

        var app = {

            news: function(message,typeNews){

                new Noty({                        
                            text: message,
                            layout: 'topRight',
                            type: typeNews,
                            timeout : '2000',
                            theme: 'metroui',
                            modal: true,
                            progressBar: false,
                        }).show();
            }
        }
      
 

        $(document).ready(function(){

            <?php if(isset($mensagem) ):  ?>
            	app.news('<?php echo $mensagem;?>','success')
            <?php endif;?>

            <?php if(isset($mensagem_erro)):  ?>
            	app.news('<?php echo $mensagem_erro;?>','error')
            <?php endif;?>


            $('#salvar').on('click', function(e){
            	
            	if( $('input[name=corretorNovaSenha]').val() != $('input[name=corretorNovaSenhaRepete]').val() ){

            		app.news('Senhas não conferem','error')

            		e.preventDefault();
            	}else{

            		$('form').submit()
            	}
            })
        })

    </script>
    </body>
</html>
