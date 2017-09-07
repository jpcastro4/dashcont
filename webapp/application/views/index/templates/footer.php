    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/lib/noty.css" />
    <script src="<?php echo base_url()?>assets/lib/noty.js"></script>
    <script src="<?php echo base_url()?>assets/index/js/jquery.serializejson.js"></script>  

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

        setTimeout(function() {
            $(".alert-fadeout").fadeOut();
        }, 3000);


        $('input, select, textarea').on('change', function(){

            if( $(this).parent('.form-group-cart').hasClass('has-danger') && $(this).val() != '' ){
                $(this).parent('.form-group-cart').removeClass('has-danger')
                $(this).parent('.form-group-cart').find('.form-control-feedback').hide()
            }
        })

        $('.prev-prod').on('click', function(e){
            e.preventDefault();
            var currentPanel = $(this).parents('.cart-prod'),
                prev = currentPanel.prev()

            currentPanel.removeClass('active')
            prev.addClass('active')
        })

        $('.next-prod').on('click', function(e){
            e.preventDefault()

            var validate = false,
                currentPanel = $(this).parents('.cart-prod'),
                next = currentPanel.next(),
                numReqSelect =  currentPanel.find('select[required]').length,
                validSelect = 0
            
            currentPanel.find('select').each(function(e){
                
                var $select = $(this)           
 
                if( $select[0].required == true && $select[0].value == "" ){
                    $select.parent('.form-group-cart').addClass('has-danger')
                    $select.parent('.form-group-cart').find('.form-control-feedback').show()
                }else{
                    $select.parent('.form-group-cart').removeClass('has-danger')
                    $select.parent('.form-group-cart').find('.form-control-feedback').hide()
                    validSelect += numReqSelect
                }                
            })

            if(validSelect > numReqSelect ){
                validate = true
            }

            var validateRadio = 0

            currentPanel.find('input[type=radio]').each(function(){

                var $radio = $(this)

                if( $radio.prop('checked') ){
                    validateRadio = validateRadio+1
                }
            })

            if(validateRadio > 0 ){
                validate = true
            }else{
                currentPanel.find('.feedback-option').addClass('has-danger').show()
            }
 
            // AS CHECKBOX NÃO SÃO OBRIGATORIAS / PRODUTOS OPICIONAIS
            // currentPanel.find('input[type=checkbox]').each(function(){

            //     var $checkbox = $(this)

            //     if($checkbox.prop('checked')){

            //         validate = true
            //     } 
            // })

            if(validate){
                currentPanel.removeClass('active')
                next.addClass('active') 
            }

        })

        sessionStorage.clear()

        $('[data-price]').on('change',function(){           

            if($(this).prop('checked')){
                window.sessionStorage.setItem( $(this).attr('name'), $(this).data('price')+'.'+$(this).data('price-cents') )
            }else{
                window.sessionStorage.removeItem( $(this).attr('name'))
            }
            
            var somaTotal = 0
            $.each(window.sessionStorage,function(index,value){

                somaTotal += parseFloat(value) 
            })
            
            var result = somaTotal.toFixed(2).toString().split('.')

            $('.price-').html(result[0])
            $('.price-cents').html(', '+result[1])
        })

        $('.pedido').on('click', function(e){
            e.preventDefault()
            $('.resumo-pedido').html()
            $('form').find('input:checked').each(function(){
                $('.resumo-pedido').append( '<p>'+$(this).parent('label')[0].innerText+'</p>' )              
            })      

            window.localStorage.setItem('cart',  JSON.stringify( $('form').serializeJSON() ) )

            var currentPanel = $(this).parents('.cart-prod'),
                next = currentPanel.next()  

            $('.cart2').fadeIn()
            $('.cart1').fadeOut()           
        })

        $('select[name=parcelamento]').on('change', function(){
            var parcela = 299 / $(this).val()
            $('.parcela').html(  parcela.toFixed(2)  )
        })

        $('.pagamento').on('click', function(e){
            e.preventDefault()

            window.localStorage.setItem('parcelamento', $('select[name=parcelamento]').val() )
            
            $('.cart3').fadeIn()
            $('.cart2').fadeOut()
        })

        $('.cadastro').on('click', function(e){
            e.preventDefault()

            var form = $(this).parents('.cart3').find('form'),
                senha

            form.find('input[required]').each(function(){

                if($(this).val() == ''){
                    $(this).parent('.form-group-cart').addClass('has-danger')
                    $(this).parent('.form-group-cart').find('.form-control-feedback').show()
                }

                if( $(this)[0].name == 'clienteSenha' ){
                    senha = $(this).val()
                }

                if(  $(this)[0].name == 'clienteRepeteSenha' ){

                    if(  $(this).val() != senha ){
                        console.log('Repete '+$(this).val()+' '+senha)
                        $(this).parent('.form-group-cart').addClass('has-danger')
                        $(this).parent('.form-group-cart').find('.form-control-feedback').show()
                    }
                }
            })             
        })

        $('#btnsalvar').on('click' ,function(event){

            $('.preloader').fadeIn(400).show()
            
            var valid = true

            var form = $('form')            

            form.find('[required]').each(function(index,e){
                if ( $(this).val() == '' ){
                    
                    console.log(e)

                    $(this).css('border-color','red')
                    valid = false
                    return
                 } 
            })

            if(valid == false){
                $('.preloader').fadeOut()
                
                app.news('Confira os campos','error')
                    
                event.preventDefault()
                return
            }

            form.submit()

            $('.preloader').fadeOut()

        })

      });
    </script>

  </body>
</html>