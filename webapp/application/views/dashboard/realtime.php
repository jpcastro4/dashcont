    <div class="row h-100 relative">
        <div class="col-md-9 h-100 bg-cinza-md2">
            <div class="map" id="map-canvas"></div>
        </div>

        <div class="col-md-3 h-100 py-4 bg-cinza-md1">
        <?php if(!empty($veiculos)): ?>

            <?php foreach ($veiculos as $veiculo) : //var_dump($veiculo);


            $produtos = $this->dashboard->produtos_veiculo($veiculo->veiculoID);  //var_dump($produtos) ?>
            <div class="card-group w-100" >
                <div class="card-car p-4 w-100">
                    <div class="row align-items-center" >
                        <div class="col-5 ">
                            <div class="card-car-name font-uppercase"><?php echo $veiculo->veiculoFabricante; ?> <?php echo $veiculo->veiculoModelo; ?> - <?php echo $veiculo->veiculoPlaca; ?> </div>
                        </div>
                        <div class="col-2">
                            <i class="flaticon-arrow-point-to-right"></i>
                        </div>
                        <div class="col-5">
                            <div class="row text-center">
                                <div class="col-6 font-amarelo"><a href="#" <?php  ?> onclick="Trackdemand('<?php echo $veiculo->veiculoDeviceID; ?>')"><i class="flaticon-circle card-icons"></i><span class="card-icons-title">Localizar</span></a></div>
                                <div class="col-6 font-verde"><a href=""><i class="flaticon-open-lock card-icons"></i><span class="card-icons-title">Ativo</span></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-car card-menu p-4 mt-2 w-100 animated animated-02s fadeInDown">
                    <div class="row align-items-center text-center font-cinza ">
                        <div class="col-4 bd-right">
                            <a href=""><i class="flaticon-car-1 card-icons"></i><span class="card-icons-title">Veículo</span></a>
                        </div>
                        <div class="col-4 bd-right">
                           <a href=""> <i class="flaticon-woofer card-icons"></i><span class="card-icons-title">Cerca</span></a>
                        </div>
                        <div class="col-4 ">
                           <a href=""> <i class="flaticon-bell card-icons"></i><span class="card-icons-title">Alerta</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
    </div>