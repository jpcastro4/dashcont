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
                            timeout : '1500',
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

            setTimeout(function() {
                $(".alert-fadeout").fadeOut();
            }, 3000);

            $('.dropdown').hover(function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(100);
            }, function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(100);
            });


<?php if(!empty($pg_account)):?>

        $('input[type=submit],button[type=submit],a.excluir').on('click', function(){

            $('.loading').fadeIn();
        })

        $(document).on('keyup',function(e){
           
            if(e.keyCode == 27){
                $('.loading').fadeOut();
            }
        });

        $('input[type=submit],button[type=submit]').on('click' ,function(event){
            event.preventDefault()

            var valid = true

            var form = $(this).parents('form')            

            form.find('[required]').each(function(index,e){
                if ( $(this).val() == '' ){

                    $(this).css('border-color','red')
                    valid = false
                    return
                 } 
            })

            if(valid == false){
                app.news('Campos vazios','error')
               //$('.loading').fadeOut()
                event.preventDefault()
                return
            }

            //form.submit()
        })

        if( window.sessionStorage.getItem('open-painel') ){
            var painel = $('[data-painel='+window.sessionStorage.getItem('open-painel')+']') 
            painel.fadeIn().addClass('ativo')
            $('html,body').animate({scrollTop: painel.offset().top},'slow')

           // window.sessionStorage.removeItem('open-painel')
        }

        $('[data-open-painel]').on('click', function(e){
            e.preventDefault()

            var $this = $(this).data('open-painel'),
                painel = $('[data-painel='+$this+']')

            if( painel.hasClass('ativo') ){
                painel.slideToggle().removeClass('ativo')
                window.sessionStorage.removeItem('open-painel')
            }else{
                window.sessionStorage.setItem('open-painel',$this)
                painel.slideToggle().addClass('ativo')
                $('html,body').animate({scrollTop: painel.offset().top},'slow')
            }
        })


 <?php endif; ?>


        // $('#btnsalvar').on('click' ,function(event){

        //     $('.preloader').fadeIn(400).show()
            
        //     var valid = true

        //     var form = $('form')            

        //     form.find('[required]').each(function(index,e){
        //         if ( $(this).val() == '' ){
                    
        //             console.log(e)

        //             $(this).css('border-color','red')
        //             valid = false
        //             return
        //          } 
        //     })


        //     if(valid == false){
        //         $('.preloader').fadeOut()
                
        //         app.news('Confira os campos','error')
                    
        //         event.preventDefault()
        //         return
        //     }

        //     form.submit()

        //     $('.preloader').fadeOut()

        // })


        // $('li.apto').on('click', function(){

        //     var $this = $(this),
        //         emp = $(this).data('emp'),
        //         andar = $(this).data('andar'),
        //         apto = $(this).data('apto')

                

        //     $.post(ajaxUrl+'statusApto', {emp:emp,andar:andar,apto:apto}, function(data){

        //         if(data.status == 'success'){

        //             if(data.novostatus == true ){
        //                 $this.addClass('apto-livre animated flipInX').removeClass('apto-reservado')
        //             }

        //             if(data.novostatus == false ){
        //                 $this.addClass('apto-reservado animated flipInX').removeClass('apto-livre')
        //             }

        //         }

        //         if(data.status == 'error'){

        //             alert('Erro')
        //         }
        //     },'json')
        //     .fail(function(data){
        //         alert('Erro total')
        //         console.log(data.responseText )
        //     }) 

        // })

        // $('input[type=submit],button[type=submit],a.excluir').on('click', function(){

        //     $('.loading').fadeIn();
        // })

        // $(document).on('keyup',function(e){
            
        //     if(e.keyCode == 27){
        //         $('.loading').fadeOut();
        //     }
        // });

        // $('input[name=mudaAndares]').on('change', function(){

        //     var sessaoAndares = $('.editar-andares')

        //     if( sessaoAndares.hasClass('ativo') ){

        //         sessaoAndares.fadeOut().removeClass('ativo')
            
        //     }else{

        //         sessaoAndares.fadeIn().addClass('ativo')
        //     }
        // })



        // if( $('input[name=empPrimeiroDif]').is(':checked') ){

        //     $('input[name=empPrimeiroPavi]').parents('.hidden').show().addClass('ativo')

        // }else{

        //     $('input[name=empPrimeiroPavi]').parents('.hidden').hide().removeClass('ativo')
        // }

        // $('input[name=empPrimeiroDif]').on('change', function(){

        //     var primPavi = $('input[name=empPrimeiroPavi]').parents('.hidden')

        //    console.log(primPavi)

        //    console.log( primPavi.hasClass('ativo') )

        //     if( primPavi.hasClass('ativo') ){

        //         primPavi.fadeOut().removeClass('ativo')
            
        //     }else{

        //         primPavi.fadeIn().addClass('ativo')
        //     }
        // })

        // $('.excluir').on('click', function(e){
        //     e.preventDefault();

        //     var $this = $(this)
        //     var r = confirm("Tem certeza que deseja excluir o arquivo?")
            
        //     if( r == true ){

        //         $.get(ajaxUrl+'excluir_arquivo/'+$(this).data('excluir'), function(data){
        //             $this.parents('.col-4').fadeOut().remove()
        //             $('.loading').fadeOut();
        //             app.news('Arquivo excluído','success')
        //         } )
        //         .fail(function(data){
        //             $('.loading').fadeOut();
        //             alert(data.responseText)
        //         })
        //     }
        
        // })

    });
    </script>

   <?php if(!empty($pg_map)) :?>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBvLVxUfEauc2SsXlqDaT3dBkqaVXqwBLk"></script>

    <script  type="text/javascript" >

        $(document).ready(function(){


            $('.card-car-name').on('click', function(){
                $(this).parents('.card-group').find('.card-menu').toggle()
            })


        })

    </script>

    <script type="text/javascript">

        //chamando o mapa com a localização do individuo
        function Trackdemand(deviceID){

            AWS.config.update({
                region: "sa-east-1",
                endpoint: 'http://dynamodb.sa-east-1.amazonaws.com',
                accessKeyId: "AKIAIP7H2WQJBTZEXBWQ",
                secretAccessKey: "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"
            }); 

            var params = {
                TableName : "tracker",
                // KeyConditionExpression: "deviceID = :deviceID and register >= :lasttime",
                KeyConditionExpression: "deviceID = :deviceID",
                Limit: 1,
                ScanIndexForward: false, //true ascendente e false descendente
                // ExpressionAttributeNames:{
                //     //"#yr": "deviceID"
                // },
                ExpressionAttributeValues: {
                    ":deviceID": deviceID,
                    //":lasttime": new Date().getTime() - 120
                }
            }

            var docClient = new AWS.DynamoDB.DocumentClient();            
            
            docClient.query(params, function(err, data) {                

                if (err) {

                    console.error( {'status':false,'message': 'Unable to query. Error: '+ '\n' + JSON.stringify(err, undefined, 2) } )
                    
                }else{
                     

                    if( data.Count != 0 ){

                        Localizar(data.Items[0])

                    }else{
                        
                        console.log( {'status':false,'message':'Não há localização para o veiculo','data':data} )
                         
                    }
                }
            })                                       
        }

        
        var options = {
          enableHighAccuracy: true,
          timeout: 5000,
          maximumAge: 0
        };

        navigator.geolocation.getCurrentPosition(

            function(location){

                sessionStorage.setItem('lat',location.coords.latitude)
                sessionStorage.setItem('lng',location.coords.longitude)

            },
            function(error){
                console.log(error)
            },
            options
        )  

        var map;
        var local;
        var geocoder;
        var mark;
        var lineCoords = [];

        var initialize = function() {

            window.lat = Number(sessionStorage.getItem('lat') );
            window.lng = Number(sessionStorage.getItem('lng') );
            
            map  = new google.maps.Map(document.getElementById('map-canvas'), {center:{lat:lat,lng:lng},zoom:16})
            local = new google.maps.Marker({position:{lat:window.lat, lng:window.lng}, map:map})
 
        };

        window.initialize = initialize;

        function Localizar(track){

            if(!track){
                alert('erro na track')
                return
            }
 
            console.log('entrando no trackeamento')
            var lat = Number(track.location.lat),
                lng = Number(track.location.lng),
                hr = track.timestamp

            mark = new google.maps.Marker({map:map,icon:'<?php echo base_url("assets/img/icon-car.png")?>'})


             
            //var geocoder = new google.maps.Geocoder();

            mark.setPosition({lat:lat, lng:lng, alt:0});
            map.setCenter({lat:lat, lng:lng, alt:0});
            
            var contentString = 
            '<div id="card-info-map animated fadeInUp" class="card-info-map p-1">'+
                '<div class="row m-1 align-items-center">'+
                    '<div class="col-7">'+
                        '<div class="row px-3 align-items-center">'+
                            '<div class="col-12 px-0 py-3 card-info-map-dispositivo"> <div class="card-info-map-device-name"> <div class="marcamodelo">Corolla - Toyota </div><div class="placa">NFQ1996</div> </div> <div class="card-info-map-device-ID" style="padding:8px 0">86863659785458</div></div>'+
                            '<div class="col-12 px-0 py-3 bd-top card-info-map-local">Rua Dona Gercina Borges Teixeira, B Ilda Aparecida de Goiânia</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-5 bd-left">'+
                        '<div class="row px-3 align-items-center text-center">'+
                            '<div class="col-12 px-0 card-info-map-veloc" style="padding:40px 0">60Km/h</div>'+
                            '<div class="col-12 px-0 py-3 bd-top card-info-status font-verde"><i class="flaticon-open-lock card-info-map-icon-status"></i><span card-info-map-status>Liberado</span></div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>';

            
            var infowindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth:300
            });

            mark.addListener('click', function() {
                infowindow.open(map, mark);
            })

            infowindow.addListener('domready', function() {
                var iwOuter = $('.gm-style-iw');
                var iwBackground = iwOuter.prev();
                iwBackground.children(':nth-child(2)').css({'display' : 'none'});
                iwBackground.children(':nth-child(4)').css({'display' : 'none'});
                var iwCloseBtn = iwOuter.next();
                iwCloseBtn.css({
                  opacity: '1', 
                  right: '62px',
                  top: '38px',
                });
                iwCloseBtn.mouseout(function(){
                  $(this).css({opacity: '1'});
                });
            });


            map.setCenter({lat:lat, lng:lng, alt:0});
            mark.setPosition({lat:lat, lng:lng, alt:0});
            lineCoords.push(new google.maps.LatLng(lat, lng));
            var lineCoordinatesPath = new google.maps.Polyline({
                path: lineCoords,
                geodesic: true,
                strokeColor: '#2E10FF'
            });
          
            lineCoordinatesPath.setMap(map);


        } 

       
        google.maps.event.addDomListener(window, 'load', initialize);

        function Realtime(deviceID){

            

        }

        setInterval(function() {
                Trackdemand('868683028310302')
            }, 10000);

        // 
        
        
        // var params = {
        //     TableName : "tracker",

        //     //ProjectionExpression: "#di = :imei, #reg = :reg",
        //     FilterExpression: "#di = :imei AND #reg > :reg" ,
        //     //FilterExpression: "#reg = :reg" ,
        //     //FilterExpression: "#di = :imei" ,
        //     ExpressionAttributeNames: {
        //         "#di": 'deviceID',
        //         "#reg": 'register'
        //     },
        //     ExpressionAttributeValues: {
        //         ":imei": "868683028310302",
        //         ":reg" : new Date().getTime() - 3600
        //     }
        // };

        // docClient.scan(params, function(err, data) {
        //     if (err) {
        //         console.error( "Unable to query. Error: " + "\n" + JSON.stringify(err, undefined, 2) )
        //     } else {
        //         console.log( data )
        //     }
        // });
        

        //vamos chamar a localização do carro       

        // var lineCoords = [];

        function redraw(payload) {

            console.log(payload)

            lat = payload.lat;
            lng = payload.lng;
            map.setCenter({lat:lat, lng:lng, alt:0});
            mark.setPosition({lat:lat, lng:lng, alt:0});
            lineCoords.push(new google.maps.LatLng(lat, lng));
            var lineCoordinatesPath = new google.maps.Polyline({
                path: lineCoords,
                geodesic: true,
                strokeColor: '#2E10FF'
            });
          
            lineCoordinatesPath.setMap(map);
        }

        

        // setInterval(function() {
            
        //     queryData()       

        // }, 2000);

        

        </script>
    <?php endif; ?>
    
    <!-- <script src="<?php echo base_url()?>assets/js/jquery.ajaxfileupload.js"></script> -->
    </body>
</html>