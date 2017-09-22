    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/lib/noty.css" />
    <script src="<?php echo base_url()?>assets/lib/noty.js"></script>
    <script src="<?php echo base_url()?>assets/lib/jquery.serializejson.js"></script>

    <!-- <script src="<?php echo base_url()?>assets/js/jquery.ajaxfileupload.js"></script> -->
    <script type="text/javascript">  

    

    var app = {

        
        news: function(message,typeNews){

        new Noty({                        
                            
            text: message,
                layout: 'bottomRight',
                type: typeNews,
                timeout : '1800',
                theme: 'metroui',
                // modal: true,
                progressBar: false,
            }).show();
        },
        init: function(){

            load.painel()

            $(function () {
                $('html,body').find('[data-toggle="tooltip"]').tooltip()
            })

        }
    }

    var elements = {      

        dom: function(){
            return $(globalItems.dom)
        },

        painelDocs: $(globalItems.dom).find(idtsNames.painelDocs),

        docItem: function($class){

            return elements.painelDocs.find(idtsNames.listaItemDoc+'.'+$class)           
        },

        countItensDoc: function(){

            return $(globalItems.dom).find('.lista-docs')
        },       

    } 

    var template = {

        loading: function(){

            return '<div class="loading ativo"><div class="sk-fading-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div></div>'
        }
    }


    var load = {

        timingRand: function(){

            var rand =  Math.floor((Math.random() * 10000) + 1)

            if(rand > 3000 ){
                return rand-1000
            }
        },

        loading: function($classe){

            elements.dom.find($classe).append(template.loading)
        },

         
    }


    app.init()

    <?php if(isset($mensagem) ):  ?>
        app.news('<?php echo $mensagem;?>','success')
    <?php endif;?>

    <?php if(isset($mensagem_erro)):  ?>
        app.news('<?php echo $mensagem_erro;?>','error')
    <?php endif;?>

    $(document).ready(function(){

        // if( window.sessionStorage.getItem('open-painel') ){
        //     var painel = $('[data-painel='+window.sessionStorage.getItem('open-painel')+']') 
        //     painel.fadeIn().addClass('ativo')
        //     $('html,body').animate({scrollTop: painel.offset().top},'slow')

        //     window.sessionStorage.removeItem('open-painel')
        // }
 
 
        

        // $('html').on('click', function(){
        //     $('[data-toggle="popover"]').popover('hide')
        // })

        $('.painel-docs').on('click', '[data-open-panel]', function(e){
            e.preventDefault()

            var $this = $(this),
                id = $this.data('open-panel'),
                painel = $('[data-panel='+id+']')//,
                icone = $(this).find('i')            

            if( painel.hasClass('ativo') ){
                painel.slideToggle().removeClass('ativo')
                icone.removeClass('flaticon-error').addClass('flaticon-arrows-1')
                // window.sessionStorage.removeItem('open-panel')
            }else{
                // window.sessionStorage.setItem('open-panel',$this)
                icone.removeClass('flaticon-arrows-1').addClass('flaticon-error')
                painel.slideToggle().addClass('ativo')
                $('html,body').animate({scrollTop: painel.offset().top-40},'slow')
            }
        })

        


        $('input[type=submit],button[type=submit],a.excluir').on('click', function(){

           // $('.loading').fadeIn();
        })

        $(document).on('keyup',function(e){
           
            if(e.keyCode == 27){
                $('.loading').fadeOut();
            }
        });

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

    });

    </script>

    <script type="text/javascript">
    <?php if(!empty($arquivo)): ?>

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

                var fID = randomID()

                var reader = new FileReader();

                reader.onloadend = function(){

                    $('.modal .lista').append( 
                        '<div class="lista-item-upload animated flipInX arq'+fID+'" >'+
                        '<div class="row w-100 align-items-center">'+
                        '<div class="col-12 col-md-6">'+file.name+'</div>'+
                        '<div class="col-12 col-md-5"><input class="form-control" name="arq'+fID+'[nome]" value="'+file.name+'" type="text"/></div>'+                    
                        '<div class="col-12 col-md-1">'+
                        
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

    var progressBar = function($class){

        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener("progress", function(evt) {
            if (evt.lengthComputable) {
                var percentComplete = (evt.loaded / evt.total)*100;
                console.log(percentComplete)
            }
       }, false);

       xhr.addEventListener("progress", function(evt) {
           if (evt.lengthComputable) {
               var percentComplete = evt.loaded / evt.total;
               console.log(percentComplete)
           }
       }, false);

       return xhr;
    }

 

    var processUploadFiles = function($url,$class,$data){

        $('.'+$class+' i').removeClass('flaticon-error font-vermelho').addClass('flaticon-cogwheel fa fa-spin')

        $('.'+$class).css('background: linear-gradient(to right, #4ACC99 0%, #4ACC99 100%, #4ACC99 0%, #e5e5e5 0%, #e5e5e5 100%)')

        $.ajax({
            url: $url,
            type: 'POST',
            data: $data,
            dataType: 'json',
            xhr: function(){
                var xhr = new window.XMLHttpRequest();
                 // Handle progress
                 //Upload progress
                xhr.upload.addEventListener("progress", function(evt){

                    console.log(evt)

                   if (evt.lengthComputable) {
                      var percentComplete = (evt.loaded / evt.total)*100 ;
                      //Do something with upload progress
                      console.log(percentComplete);
                   }
                }, false);
                //Download progress
                xhr.addEventListener("progress", function(evt){
                    if (evt.lengthComputable) {
                      var percentComplete = evt.loaded / evt.total;
                      //Do something with download progress
                      console.log(percentComplete);
                    }
                }, false);

               return xhr;
            },
            complete:function(){
                console.log("Request finished.");
            }
        })
        .done(function(r){
            console.log('success')

            if(r.status == true ){
                $('.'+$class+' i').removeClass('fa fa-spin flaticon-cogwheel font-vermelho').addClass('animated bounceIn flaticon-success font-verde')

                $('.'+$class+' input').attr('name','')

            }

            if(r.status == false ){
                 $('.'+$class+' i').removeClass('fa fa-spin flaticon-cogwheel font-vermelho').addClass('flaticon-warning font-vermelho')
            }
        })
        .fail(function(r){
             console.log('erro')

            
            console.log(r)
        })
    }

    $('#upload-arquivo button[type=submit]').on('click', function(e){
        e.preventDefault();

        var $form = $(this).parents('form'),
            $url = $form.attr('action'),
            $data = $form.find('input').not('[value=""]').serializeJSON()

        $.each($data, function(i,f){
                
            processUploadFiles($url,i,f)

        })
    })

    <?php endif; ?>

    <?php if(!empty($documents)): ?>

        //SCRIPT DOCUMENTS
        var processPreviewFiles = function(e){
        droppedFiles = e.originalEvent.dataTransfer;

        if( $('.upload-process').hasClass('ativo') != true ){
            $('.upload-process').addClass('ativo')
        }

        var initPopover = function(){

            $(function(){
                $('.upload-process').find('select.tags').popSelect({
                    showTitle: false,
                    placeholderText: '<i class="flaticon-plus font-verde add-tag"></i> Add nova Tag',
                });
            });
        }

        var getTags = function(fID){

            $.get(ajaxUrl+'getTags', function(r){

                var insertTags = $.each(r, function(i,e){

                    $(".tags"+fID).append('<option value="'+e.tagID+'" data-bg="'+e.tagCor+'">'+e.tagNome+'</option>')

                })

                $.when(insertTags ).then( initPopover() )

            },'json')
            .fail(function(r){

                console.log(r)
            })
        }
        
        var randomID = function(){

            return Math.floor((Math.random() * 10000) + 1);
        }

        if(droppedFiles.items){

            $.each( droppedFiles.files, function(i, file) {

                var fID = randomID()

                var reader = new FileReader();

                reader.onloadend = function(){

                    $('.upload-process .lista').append( 
                        '<div class="lista-item-upload animated flipInX doc'+fID+'"  >'+
                        '<div class="row w-100 align-items-center">'+
                            '<div class="col-12 col-md-4"><input class="form-control" name="doc'+fID+'[docNome]" value="'+file.name+'" type="text"/></div>'+ 
                            '<div class="col-12 col-md-3 text-center"><input class="form-control" name="doc'+fID+'[docVenc]" type="date"/></div>'+
                            '<div class="col-12 col-md-3 text-center"><input class="form-control" name="doc'+fID+'[docComp]" type="month"/></div>'+
                            '<div class="col-12 col-md-1 mt-3 pl-4"> <label class="switch"><input type="checkbox" name="doc'+fID+'[docRec]" value="1"><div class="slider round"></div></label></div>'+
                            '<div class="col-12 col-md-1 text-right"><i class="lista-item-status flaticon-error font-vermelho"></i></div>'+
                            '<div class="row w-100 my-1 mx-0 align-items-center">'+
                                '<div class="col-11">'+
                                '<select id="tags" class="tags tags'+fID+'" name="doc'+fID+'[docTags][]" multiple>'+
                                '</select>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<input class="form-control" name="doc'+fID+'[file]" value="'+reader.result+'" type="hidden"/>'+
                        '<input class="form-control" name="doc'+fID+'[filename]" value="'+file.name+'" type="hidden"/>'+
                        '</div>')

                    getTags(fID)

                }

                // console.log( $('.upload-process').find("#tags") )

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

        console.log('upload area')

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

    
    $('.upload-process').on('click', '.lista-item-upload .flaticon-error', function(e){
        e.preventDefault()
        
        if( confirm('Deseja excluir mesmo?') ){
            var $this = $(this)

            $this.parents('.lista-item-upload').addClass('animated flipOutX')

            setTimeout(function(){
                $this.parents('.lista-item-upload').remove()
            },800)
        }

        
    })

    var progressBar = function($class){

        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener("progress", function(evt) {
            if (evt.lengthComputable) {
                var percentComplete = (evt.loaded / evt.total)*100;
                console.log(percentComplete)
            }
       }, false);

       xhr.addEventListener("progress", function(evt) {
           if (evt.lengthComputable) {
               var percentComplete = evt.loaded / evt.total;
               console.log(percentComplete)
           }
       }, false);

       return xhr;
    }

 

    var processUploadFiles = function($url,$class,$data){

        $('.'+$class).find('.lista-item-status').removeClass('flaticon-error font-vermelho').addClass('flaticon-cogwheel fa fa-spin')

        //$('.'+$class).css('background: linear-gradient(to right, #4ACC99 0%, #4ACC99 100%, #4ACC99 0%, #e5e5e5 0%, #e5e5e5 100%)')

        $.ajax({
            url: $url,
            type: 'POST',
            data: $data,
            dataType: 'json',
            xhr: function(){
                var xhr = new window.XMLHttpRequest();
                 // Handle progress
                 //Upload progress
                xhr.upload.addEventListener("progress", function(evt){

                    console.log(evt)

                   if (evt.lengthComputable) {
                      var percentComplete = (evt.loaded / evt.total)*100 ;
                      //Do something with upload progress
                      console.log(percentComplete);
                   }
                }, false);
                //Download progress
                xhr.addEventListener("progress", function(evt){
                    if (evt.lengthComputable) {
                      var percentComplete = evt.loaded / evt.total;
                      //Do something with download progress
                      console.log(percentComplete);
                    }
                }, false);

               return xhr;
            },
            complete:function(){
                console.log("Request finished.");
            }
        })
        .done(function(r){
            console.log('success')
            if(r.status == true ){
                $('.'+$class).find('.lista-item-status').removeClass('fa fa-spin flaticon-cogwheel font-vermelho').addClass('animated bounceIn flaticon-success font-verde')

                    setTimeout( function(){
                        $('.upload-process').fadeOut()
                        $('.'+$class ).fadeOut().remove()

                    },2000)

                    load.loading( $('.painel-docs').parents('.painel') )

                    load.painel()

                    setTimeout( function(){
                        $('.painel-docs').parents('.painel').find('.loading').addClass('animated fadeOut').removeClass('ativo')
                    },1000)

                $('.upload-process').html()

            }

            if(r.status == false ){
                 $('.'+$class).find('.lista-item-status').removeClass('fa fa-spin flaticon-cogwheel font-vermelho').addClass('flaticon-warning font-vermelho')
            }
        })
        .fail(function(r){
            console.log('erro')           
            console.log(r.responseText)
        })
    }

    $('#upload-docs button[type=submit]').on('click', function(e){
        e.preventDefault();

        var $form = $(this).parents('form'),
            $url = $form.attr('action'),
            $data = $form.serializeJSON()

        $.each($data, function(i,f){
                
            processUploadFiles($url,i,f)

        })
    })

    $('html').on('click', '.popover button.modItemRec', function(){       

        var $this = $(this),
            input = $this.parents().find('input'),
            destino = input.data('destino'),
            row = input.data('row'),
            id = input.data('rowid'),
            name = input.attr('name'),
            value = input.val(),
            panel = $('.painel-docs').find('[data-panel='+input.data('open-panel')+']') 

            $.post(ajaxUrl+'updateItemRec', {name:name,value:value,destino:destino,row:row,id:id}, function(r){

                console.log(r)

                if(r.status==true){

                    load.loading( $('.painel-docs').parents('.painel') )

                    load.painel(panel)

                    setTimeout( function(){
                        $('.painel-docs').parents('.painel').find('.loading').addClass('animated fadeOut').removeClass('ativo')
                    },1000)
                
                }

                if(r.status==false){

                    app.news('Erro.'+ r.message, 'error')
                }


            },'json')
            .fail(function(r){

                console.log(r)
            })
            .always(function(){               

                app.news('Vencimento modificado', 'success')

            })
    })






    var processUploadRec = function($dom,docID,file,filename){

        $('.'+$class).find('.lista-item-status').removeClass('flaticon-error font-vermelho').addClass('flaticon-cogwheel fa fa-spin')

        var $data = {docID:docID,file:file,filename:filename}

        $.ajax({
            url: $url,
            type: 'POST',
            data: $data,
            dataType: 'json',
            xhr: function(){
                var xhr = new window.XMLHttpRequest();
                 // Handle progress
                 //Upload progress
                xhr.upload.addEventListener("progress", function(evt){

                    console.log(evt)

                   if (evt.lengthComputable) {
                      var percentComplete = (evt.loaded / evt.total)*100 ;
                      //Do something with upload progress
                      console.log(percentComplete);
                   }
                }, false);
                //Download progress
                xhr.addEventListener("progress", function(evt){
                    if (evt.lengthComputable) {
                      var percentComplete = evt.loaded / evt.total;
                      //Do something with download progress
                      console.log(percentComplete);
                    }
                }, false);

               return xhr;
            },
            complete:function(){
                console.log("Request finished.");
            }
        })
        .done(function(r){
            console.log('success')
            if(r.status == true ){
                $('.'+$class).find('.lista-item-status').removeClass('fa fa-spin flaticon-cogwheel font-vermelho').addClass('animated bounceIn flaticon-success font-verde')

                $('.'+$class+' input').attr('disabled','disabled')

            }

            if(r.status == false ){
                 $('.'+$class).find('.lista-item-status').removeClass('fa fa-spin flaticon-cogwheel font-vermelho').addClass('flaticon-warning font-vermelho')
            }
        })
        .fail(function(r){
            console.log('erro')           
            console.log(r.responseText)
        })
    }

    var $recItem = $('.painel-docs')

    $recItem.on('drag dragstart dragend dragover dragenter dragleave drop', '.lista-item-doc', function(e){
        e.preventDefault();
        e.stopPropagation();
    })
    .on('dragover dragenter', '.lista-item-doc', function() {

        $(this).addClass('is-dragover');
    })
    .on('dragleave dragend drop', '.lista-item-doc', function() {
        $(this).removeClass('is-dragover');
    })
    .on('drop', '.lista-item-doc', function(e) {

        var $this = $(this),
            docID = $this.data('doc')


        processUploadRec();
    });



    <?php endif; ?>

    </script>


  </body>
</html>