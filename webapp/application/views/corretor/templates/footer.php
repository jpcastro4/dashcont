
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

        setTimeout(function() {
            $(".alert-fadeout").fadeOut();
        }, 3000);


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