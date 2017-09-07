<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>TrackSeg - <?php echo (!empty($pg_index))? 'Rastreamento barato. Você escolhe o que usa.': $pg_titulo; ?> </title>
    <meta name="description" content="A free HTML template and UI Kit built on Bootstrap" />
    <meta name="keywords" content="rasteramento veicular, rastreamento em tempo real, rastreamento satelite, roubo de carro" />
    <meta name="author" content="João Paulo TrackSeg Tecnologia" />
<!--    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url()?>assets/index/img/favicon/apple-touch-icon-57x57.png">
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
    <script src="https://use.fontawesome.com/7cbf6b3d85.js"></script>

    <script type="text/javascript">var ajaxUrl = '<?php echo base_url('ajax_functions/'); ?>'; </script>

 
    <link rel="stylesheet" href="<?php echo base_url()?>assets/index/css/theme.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/animate.css">  
    
</head>

<body class="bg-faded bg-grey-md1">

    <div class="container-fluid ">
        
        <div class="row ">

            <div class="container cart1">
            <form method="post" >
                <div class="row">
                    <div class="col-12 py-5 text-center">
                        <div class="container-title-cart pb-3">
                            <h2 class="title-cart">Na TreckSeg você escolhe o que quer usar</h2>
                            <p class="sub-title-cart"> Adquira seu rastreador em três passos </p>
                        </div>
                    </div>
                </div>
                <div class="row animated fadeInUp step0 cart-prod active">
                    <div class="col-12 col-md-6">
                        <div class="form-group-cart">
                            <div class="label-cart">Qual tipo do seu veículo?</div>
                            <select class="form-control" name="veiculoTipo" required >
                                <option value="" selected disabled >-Selecione um tipo-</option>
                                <option value="Carro">Carro</option>
                                <option value="Moto">Moto</option>
                            </select>
                            <div class="form-control-feedback">Por favor. Selecione o tipo do veículo</div>
                        </div>
                        <div class="form-group-cart">
                            <div class="label-cart">Qual cidade o veículo está?</div>
                            <select class="form-control" name="veiculoCidade" required >
                                <option value="" selected disabled >-Selecione a cidade-</option>
                                <option value="Rio de Janeiro">Rio de Janeiro</option>
                                <option value="Goiânia">Goiânia</option>
                            </select>
                            <div class="form-control-feedback">Precisamos saber sua cidade, por gentileza.</div>
                        </div>
                        <div class="form-group-cart"><small>* Ainda não atendemos todo o Brasil. Quer sugerir sua cidade? Clique aqui.</small></div>
                    </div>
                    <div class="col-12 col-md-6 ">
                        <div class="flag-price w-100 text-center" style="min-height:400px;background-image: url('<?php echo base_url('assets/index/img/')?>flag-price.png'); background-position: center; background-repeat: no-repeat; ">
                            <div class="price"><span class="price-">0</span><span class="price-cents">,00</span></div>
                        </div>
                    </div>
                    <div class="col-12 py-5 text-center">
                        <button class="btn btn-cart next-prod"> Continuar <i class="fa fa-next"></i></button>

                    </div>
                </div>
  
                <div class="row animated fadeInUp step1 cart-prod has-danger">
                    <div class="col-12 col-md-6">
                        <div class="title-desc-cart">Tipo de rastreamento?</div>
                        <div class="form-control-feedback feedback-option">Por favor. Selecione o tipo do veículo</div>

                        <div class="form-group-cart mt-4">
                            <label class="cart-option mb-4"><input type="radio" class="option-input radio" name="tipo_rasteramento" value="sob-demanda" data-price="29" data-price-cents="90" >Sob demanda - RS29,90</label>
                            <div class="cart-desc">Nessa opção seu veículo sendo rastreado  pelo nosso sistema. Basta você dar o comando para visualizar a localização mais recente captada.</div>
                        </div>
                        <div class="form-group-cart">
                            
                            <label class="cart-option mb-4"><input type="radio" class="option-input radio" name="tipo_rasteramento" value="tempo-real" data-price="39" data-price-cents="90" >Em tempo real - 39,90</label>
                            <div class="cart-desc">O rastreamento em tempo real mostra na tela do aplicativo ou do portal web o veículo se movimentando e as rotas que ele faz.</div>
                        </div>
                         
                    </div>
                    <div class="col-12 col-md-6 ">
                        <div class="flag-price w-100 text-center" style="min-height:400px;background-image: url('<?php echo base_url('assets/index/img/')?>flag-price.png'); background-position: center; background-repeat: no-repeat; ">
                            <div class="price"><span class="price-">0</span><span class="price-cents">,00</span></div>
                        </div>
                    </div>
                    <div class="col-12 py-5 text-center">
                        <button class="btn btn-cart  next-prod"> Continuar <i class="fa fa-next"></i></button>
                    </div>
                    <div class="col-12 text-center">
                        <a href="btn btn-link" class="prev-prod mt-2">Voltar</a>
                    </div>
                </div>
             
                <div class="row animated fadeInUp step2 cart-prod has-danger">

                    <div class="col-12 col-md-6">
                        <div class="title-desc-cart">Escolha como você quer acessar</div>
                        <div class="form-control-feedback feedback-option">Por favor. Selecione qual acesso você quer usar.</div>
                        <div class="form-group-cart mt-4">
                             
                            <label class="cart-option mb-4"><input type="radio" class="option-input radio" id="aplicativo" name="tipo_acesso" value="aplicativo" data-price="5" data-price-cents="90" >Somente pelo aplicativo - R$ 5,90</label>
                            <div class="cart-desc" for="aplicativo" >Essa opção de dá acesso somente pelo aplicativo Android ou iOS. Uma ótima opção se você não tem computador e usa somente o celular.</div>
                        </div>
                        <div class="form-group-cart">
                            
                            <label class="cart-option mb-4"><input type="radio" class="option-input radio" id="navegador" name="tipo_acesso" value="navegador" data-price="5" data-price-cents="90" >Somente pelo navegador do computador - R$ 5,90</label>
                            <div class="cart-desc" for="navegador">Se você não tem celular ou prefere acessar somente pelo computador, você escolher essa opção e ter acesso somente ao portal web.</div>
                        </div>

                        <div class="form-group-cart">
                            
                            <label class="cart-option mb-4"><input type="radio" class="option-input radio" id="todos" name="tipo_acesso" value="todos" data-price="10" data-price-cents="90" >De todos os lugares - R$ 10,90</label>
                            <div class="cart-desc" for="todos">Agora se você quer acesso de qualquer lugar, escolha esta opção. Você terá a liberdade de acessar tanto no portal quanto via aplicativo.</div>
                        </div>

                    </div>
                    <div class="col-12 col-md-6 ">
                        <div class="flag-price w-100 text-center" style="min-height:400px;background-image: url('<?php echo base_url('assets/index/img/')?>flag-price.png'); background-position: center; background-repeat: no-repeat; ">
                            <div class="price"><span class="price-">0</span><span class="price-cents">,00</span></div>
                        </div>
                    </div>
                    <div class="col-12 py-5 text-center">
                        <button class="btn btn-cart next-prod"> Continuar <i class="fa fa-next"></i></button>
                    </div>
                     <div class="col-12 text-center">
                        <a href="btn btn-link" class="prev-prod mt-2">Voltar</a>
                    </div>
                </div>
 
                <div class="row animated fadeInUp step3 cart-prod">
 
                    <div class="col-12 col-md-6">
                        <div class="title-desc-cart mb-4">Alertas</div>
                        <div class="form-group-cart">
                             
                            <label class="cart-option mb-4">
                            <input type="checkbox" class="option-input checkbox" id="panico" name="panico" value="true" data-price="10" data-price-cents="90" >Ativar botão de pânico - R$ 10,90
                            </label>
                            <div class="cart-desc" for="panico" >O botão de pânico avisa até 3 pessoas cadastradas no seu painel, que você está em risco.</div>
                        </div>
                        <div class="form-group-cart">
                            
                            <label class="cart-option mb-4">
                            <input type="checkbox" class="option-input checkbox" id="cerca" name="cerca" value="true" data-price="10" data-price-cents="90" >Cerca de proteção - R$ 10,90
                            </label>
                            <div class="cart-desc" for="cerca">A cerca de proteção te dá a opção de criar um perimetro onde o veículo pode andar. Você terá também a opção de escolher, caso o veículo saia do perímetro, se desliga o carro, mite um alerta de ajuda ou avisa a central.</div>
                        </div>

                        <div class="form-group-cart">
                            
                            <label class="cart-option mb-4">
                            <input type="checkbox" class="option-input checkbox" id="central" name="central" value="true" data-price="20" data-price-cents="90" >Suporte a Central 24h - R$ 20,90
                            </label>
                            <div class="cart-desc" for="central">Escolha essa opção se você deseja que a Central TecSeg 24h fique ao seu dispor caso aconteça algo, dando suporte como acionar a polícia indicando a localização do veículo.</div>
                        </div>

                    </div>
                    <div class="col-12 col-md-6 ">
                        <div class="flag-price w-100 text-center" style="min-height:400px;background-image: url('<?php echo base_url('assets/index/img/')?>flag-price.png'); background-position: center; background-repeat: no-repeat; ">
                            <div class="price"><span class="price-">0</span><span class="price-cents">,00</span></div>
                        </div>
                    </div>
                    <div class="col-12 py-5 text-center">
                        <button class="btn btn-cart pedido clearfix"> Continuar <i class="fa fa-next"></i></button>
                    </div>
                     <div class="col-12 text-center">
                        <a href="btn btn-link" class="prev-prod mt-2">Voltar</a>
                    </div>
                </div>

                </form>
            </div>
            <div class="container cart2" style="display: none" >
                <div class="row">
                    <div class="col-12 py-5 text-center">
                        <div class="container-title-cart pb-3">
                            <h2 class="title-cart">Área de finalização</h2>
                            <p class="sub-title-cart"> Resumo do seu pedido </p>
                        </div>
                    </div>
                </div>
                <div class="row animated fadeInUp">
 
                    <div class="col-12 col-md-6">
                        <h3 class="title-pedido p-3 mb-4"> Rastreador e Instalação </h3>
                        <div class="label-cart">Quantas parcelas?</div>
                        <small>Forma de pagamento padrão: cartão de crédito.</small>
                        <div class="row">
                            <div class="form-group-cart col-6">
                                <select class="form-control" name="parcelamento" >
                                    <option value="1" >1 parcela </option>
                                    <option value="2" >2 parcela </option>
                                    <option value="3" >3 parcela </option>
                                    <option value="4" >4 parcela </option>
                                    <option value="5" >5 parcela </option>
                                    <option value="6" selected >6 parcela </option>
                                </select>
                            </div>
                            <div class="label-cart col-6">x <span class="parcela">49,83</span></div>
                        </div>
                        <div class="row mx-0">
                             <div class="col-6 title-pedido p-2">Total</div>
                             <div class="col-6 title-pedido p-2 total-parcelamento">R$ 299,00</div>
                         </div>

                    </div>
                    <div class="col-12 col-md-6 ">
                        <h3 class="title-pedido p-3 mb-4"> Assinatura mensal </h3>
                        <div class="resumo-pedido w-100 text-center">
                             
                        </div>
                        <div class="row m-0">
                             <div class="col-6 title-pedido p-2">Mensal</div>
                             <div class="col-6 title-pedido p-2 total-parcelamento"><span class="price-">0</span><span class="price-cents">,00</span></div>
                         </div>
                    </div>
                    <div class="col-12 py-5 text-center">
                        <button class="btn btn-cart pagamento clearfix"> Continuar <i class="fa fa-next"></i></button>
                    </div>
                     <div class="col-12 text-center">
                        <a href="btn btn-link" class="prev-prod mt-2">Voltar</a>
                    </div>
                </div>
            </div>

            <div class="container cart3" style="display: none" >
                <div class="row">
                    <div class="col-12 py-5 text-center">
                        <div class="container-title-cart pb-3">
                            <h2 class="title-cart">Área de finalização</h2>
                            <p class="sub-title-cart"> Cadastro e pagamento </p>
                        </div>
                    </div>
                </div>
                <div class="row animated fadeInUp">
 
                    <div class="col-12 col-md-6 mx-auto">
                    <form method="post">    
                        <div class="form-group-cart">
                            <div class="label-cart">Nome</div>
                            <input class="form-control" type="text" name="clienteNome" required >
                            <div class="form-control-feedback">Seu nome por favor.</div>
                        </div>
                        <div class="form-group-cart">
                            <div class="label-cart">Email</div>
                            <input class="form-control" type="email" name="clienteEmail" required >
                            <div class="form-control-feedback">Informe um email válido.</div>
                        </div>
                        <div class="form-group-cart">
                            <div class="label-cart">Crie uma senha</div>
                            <input class="form-control" type="password" name="clienteSenha" required >
                            <div class="form-control-feedback">Por favor. Uma senha</div>
                        </div>
                        <div class="form-group-cart">
                            <div class="label-cart">Repita a senha</div>
                            <input class="form-control" type="password" name="clienteRepeteSenha" required >
                            <div class="form-control-feedback">Não esquece. Tem que ser igual a de cima.</div>
                        </div>
                        <div class="form-group-cart">
                            <div class="label-cart">DDD</div>
                            <input class="form-control" type="text" name="clienteDDD" maxlength="2" required >
                            <div class="form-control-feedback">Informe o DDD</div>
                        </div>
                        <div class="form-group-cart">
                            <div class="label-cart">Telefone</div>
                            <input class="form-control" type="text" name="clienteTelefone" required >
                            <div class="form-control-feedback">Não esqueça o telefone</div>
                        </div>
                    </form>
                    </div>
                    
                    <div class="col-12 py-5 text-center">
                        <button class="btn btn-cart cadastro clearfix"> Continuar <i class="fa fa-next"></i></button>
                    </div>
                     <div class="col-12 text-center">
                        <a href="btn btn-link" class="prev-prod mt-2">Voltar</a>
                    </div>
                </div>
            </div>


        </div>
        
    </div>
