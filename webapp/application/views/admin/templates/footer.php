 
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    

    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/lib/noty.css" />
    <script src="<?php echo base_url()?>assets/lib/noty.js"></script>

    <!-- <script src="<?php echo base_url()?>assets/js/jquery.ajaxfileupload.js"></script> -->
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


    </script>

    <script type="text/javascript">

    $('input#cpfcnpj').on('keyup', function(){

        var tamanho = $(this).val().length,
            cnpj = $(this).val()

        if(tamanho == 14 ){
            $('.loading').fadeIn();
            setTimeout( function(){         

                $.get('https://www.receitaws.com.br/v1/cnpj/'+cnpj, function(data){

                    if(data.status == 'ERROR'){
                        $('.loading').fadeOut()
                        app.news(data.message,'error')
                    }

                    if(data.status == 'OK'){
                        $('.loading').fadeOut()
                        $('input[name=clienteNomeRazao]').val(data.nome)
                    }
                },'jsonp')

            },2000)
        }
    })

    // var $area = $('.upload-area')

    // $area.on('drag dragstart dragend dragover dragenter dragleave drop', function(e){
    //     e.preventDefault();
    //     e.stopPropagation();
    // })
    // .on('dragover dragenter', function() {
    //     $area.addClass('is-dragover');
    // })
    // .on('dragleave dragend drop', function() {
    //     $area.removeClass('is-dragover');
    // })
    // .on('drop', function(e) {

    //     droppedFiles = e.originalEvent.dataTransfer;

    //     if( $('.modal').hasClass('show') != true ){
    //         $('.modal').modal('show')
    //     }
        
    //     var randomID = function(){

    //         var id = 0;
    //         return function () {
    //             return "_up" + id++;
    //         };
    //     }

    //     console.log(droppedFiles.items)

    //     if(droppedFiles.items){
    //         for(var i=0; i < droppedFiles.items.length; i++ ){

    //             var file = droppedFiles.items[i].getAsFile(),
    //                 fID = randomID()

    //             console.log(file)

    //             $('.modal .lista').append('<div class="lista-item-upload animated flipInX"><div class="row w-100 align-items-center"><div class="col-12 col-md-3"><input class="form-control" id="'+fID+'" name="" value="'+file.name+'" type="text"/></div> <div class="col-12 col-md-3"></div> <div class="col-12 col-md-3"><input class="form-control" name="" type="date"/></div> <div class="col-12 col-md-2"><label class="switch"><input type="checkbox" name="docRecalculo" value="1"> <div class="slider round"></div> </label></div> <div class="col-12 col-md-1"><i class="flaticon-error"></i></div>  </div> </div>')
    //         }

    //     }

        

    // });

    var imagsArray = []


    var processPreviewFiles = function(e){
        droppedFiles = e.originalEvent.dataTransfer;

        if( $('.modal').hasClass('show') != true ){
            $('.modal').modal('show')
        }
        
        var randomID = function(){

            return Math.floor((Math.random() * 10000) + 1);
        }


        if(droppedFiles.items){


            $.each( droppedFiles.files, function(i, file) {

                console.log(file)

                var fID = randomID()

                var reader = new FileReader();

                reader.onloadend = function(){

                    $('.modal .lista').append( 
                        '<div class="lista-item-upload animated flipInX">'+
                        '<div class="row w-100 align-items-center">'+
                        '<div class="col-12 col-md-6">'+file.name+'</div>'+
                        '<div class="col-12 col-md-5"><input class="form-control" name="arq'+fID+'[nome]" value="'+file.name+'" type="text"/></div>'+                    
                        '<div class="col-12 col-md-1"><i class="flaticon-error"></i></div>'+
                        '</div>'+
                        '<input class="form-control" name="arq'+fID+'[file]" value="'+reader.result+'" type="hidden"/> '+
                        '<input class="form-control" name="arq'+fID+'[filename]" value="'+file.name+'" type="hidden"/> '+
                        '</div>')


                }


                // reader.onload = $.proxy(function(file, $fileList, event) {

                //     var img = file.type.match('image.*') ? "<img src='" + event.target.result + "' /> " : "";
                //     $fileList.prepend( $("<li>").append( img + file.name ) )

                // }, this, file, $("#fileList"));

                reader.readAsDataURL(file);
            })

        }
    }

    var $area = $('.upload-area')

    $area.on('drag dragstart dragend dragover dragenter dragleave drop', function(e){
        e.preventDefault();
        e.stopPropagation();
    })
    .on('dragover dragenter', function() {
        $area.addClass('is-dragover');
    })
    .on('dragleave dragend drop', function() {
        $area.removeClass('is-dragover');
    })
    .on('drop', function(e) {

        processPreviewFiles(e)       

    });

    $('.files').on('change', function(e){
        console.log(e)
    })

    
    $('.modal').on('click', '.lista-item-upload .flaticon-error', function(e){
        e.preventDefault()
        
        if( confirm('Deseja excluir mesmo?') ){
            var $this = $(this)

            $this.parents('.lista-item-upload').addClass('animated flipOutX')

            setTimeout(function(){
                $this.parents('.lista-item-upload').remove()
            },500)
        }

        
    })

    $('.modal').on('click', 'form button[type=submit]', function(e){
                
    })

    
    </script>
 
    <script type="text/javascript">

        
      
 

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


        $('input[type=submit],button[type=submit],a.excluir').on('click', function(){

            $('.loading').fadeIn();
        })

        $(document).on('keyup',function(e){
           
            if(e.keyCode == 27){
                $('.loading').fadeOut();
            }
        });

        $('input[type=submit],button[type=submit]').on('click' ,function(event){
            
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
                $('.loading').fadeOut()
                event.preventDefault()
                return
            }

            form.submit()
        })

        if( window.sessionStorage.getItem('open-painel') ){
            var painel = $('[data-painel='+window.sessionStorage.getItem('open-painel')+']') 
            painel.fadeIn().addClass('ativo')
            $('html,body').animate({scrollTop: painel.offset().top},'slow')

            window.sessionStorage.removeItem('open-painel')
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



        $('#add-produto').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget)  
          var recipient = button.data('veiculo')  
 
          var modal = $(this)
 
          modal.find('input[name=veiculoID]').val(recipient)
        })

        $('li.apto').on('click', function(){

            var $this = $(this),
                emp = $(this).data('emp'),
                andar = $(this).data('andar'),
                apto = $(this).data('apto')

                

            $.post(ajaxUrl+'statusApto', {emp:emp,andar:andar,apto:apto}, function(data){

                if(data.status == 'success'){

                    if(data.novostatus == true ){
                        $this.addClass('apto-livre animated flipInX').removeClass('apto-reservado')
                    }

                    if(data.novostatus == false ){
                        $this.addClass('apto-reservado animated flipInX').removeClass('apto-livre')
                    }

                }

                if(data.status == 'error'){

                    alert('Erro')
                }
            },'json')
            .fail(function(data){
                alert('Erro total')
                console.log(data.responseText )
            }) 

        })

        
        $('input[name=mudaAndares]').on('change', function(){

            var sessaoAndares = $('.editar-andares')

            if( sessaoAndares.hasClass('ativo') ){

                sessaoAndares.fadeOut().removeClass('ativo')
            
            }else{

                sessaoAndares.fadeIn().addClass('ativo')
            }
        })



        if( $('input[name=empPrimeiroDif]').is(':checked') ){

            $('input[name=empPrimeiroPavi]').parents('.hidden').show().addClass('ativo')

        }else{

            $('input[name=empPrimeiroPavi]').parents('.hidden').hide().removeClass('ativo')
        }

        $('input[name=empPrimeiroDif]').on('change', function(){

            var primPavi = $('input[name=empPrimeiroPavi]').parents('.hidden')

           console.log(primPavi)

           console.log( primPavi.hasClass('ativo') )

            if( primPavi.hasClass('ativo') ){

                primPavi.fadeOut().removeClass('ativo')
            
            }else{

                primPavi.fadeIn().addClass('ativo')
            }
        })

        $('.excluir').on('click', function(e){
            e.preventDefault();

            var $this = $(this)
            var r = confirm("Tem certeza que deseja excluir o arquivo?")
            
            if( r == true ){

                $.get(ajaxUrl+'excluir_arquivo/'+$(this).data('excluir'), function(data){
                    $this.parents('.col-4').fadeOut().remove()
                    $('.loading').fadeOut();
                    app.news('Arquivo excluído','success')
                } )
                .fail(function(data){
                    $('.loading').fadeOut();
                    alert(data.responseText)
                })
            }
        
        })

    });
    </script>

  </body>
</html>