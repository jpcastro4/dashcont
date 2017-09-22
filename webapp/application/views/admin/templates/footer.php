    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/lib/noty.css" />
    <script src="<?php echo base_url()?>assets/lib/noty.js"></script>
    <script src="<?php echo base_url()?>assets/lib/jquery.serializejson.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/lib/datapicker/datepicker.min.css" />
    <script src="<?php echo base_url()?>assets/lib/datapicker/datepicker.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/lib/print.min.css" />
    <script src="<?php echo base_url()?>assets/lib/print.min.js"></script>

    <!-- <script src="<?php echo base_url()?>assets/js/jquery.ajaxfileupload.js"></script> -->
    <script type="text/javascript">


    var globalItems = {

        urlSite: '<?php echo base_url() ?>',
        clienteCpfCnpj:'<?php echo $clienteCpfCnpj; ?>',
        dom : 'html,body', 
    }

    var urls = {

        docsLoad: globalItems.urlSite+'ajax_functions/docsLoad/'+globalItems.clienteCpfCnpj,
        docsUpload: globalItems.urlSite+'form/uploadDocS3/'+globalItems.clienteCpfCnpj,
        docsRecUpload: globalItems.urlSite+'form/uploadRecDocS3/'+globalItems.clienteCpfCnpj,
        getTags: globalItems.urlSite+'ajax_functions/getTags'
    }

    var idtsNames = {

        ano: '#ano',
        mes: '#mes',
        filtro: '#filtro',

        painelDocs: '.painel-docs',

        listaDocs: '.lista-docs',
        listaItemDoc : '.lista-item-doc',

        uploadarea: '.upload-area',

        upload: '.upload',
        uploadarealist: '.upload-area-list',
        uploadprocess: '.upload-process',
        uploadItem: '.upload-item-doc',
        itemupload: '.lista-item-upload'

    }

    function template(item){

        return $(item)

    }


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
        loadDocs: function(panelID){

           $(idtsNames.painelDocs).load(urls.docsLoad, function(){



                $('[data-toggle="tooltip"]').tooltip()

                $('[data-toggle="popover"]').popover({
                    html: true, 
                    content: function() {
                        return $('#popover-content').html();
                    }
                })               

                if(panelID){

                    console.log(panelID)

                    $(idtsNames.painelDocs).find('[data-toggle="tooltip"]').each(function () {
                        $(this).popover('hide');
                    });

                    $(idtsNames.painelDocs).find('[data-open-panel='+panelID+'] i').removeClass('flaticon-arrows-1').addClass('flaticon-error')

                    var panel = $(idtsNames.painelDocs).find('[data-panel='+panelID+']')
                    panel.slideToggle().addClass('ativo')
                    $('html,body').animate({scrollTop: panel.parents('.lista-item-doc').offset().top-50},'slow')                    
                }
            })

        },

        timingRandom: function(){

            var rand =  Math.floor((Math.random() * 10000) + 1)

            return rand
        },

        loading: function($classe){

            $(globalItems.dom).find($classe).append('<div class="loading ativo"><div class="sk-fading-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div></div>')
        },

        tooltips: function(){

            $(function () {
                $(globalItems.dom).find('[data-toggle="tooltip"]').tooltip()
            })
        },

        panels: function(){

            $(idtsNames.painelDocs).on('click', '[data-open-panel]', function(e){
                e.preventDefault()

                var $this = $(this),
                    id = $this.data('open-panel'),
                    parents = $this.parents(),
                    painel = $('[data-panel='+id+']'),
                    icone = $(this).find('i'),
                    scrollTo = $this.parents('.lista-item-doc')

                $(globalItems.dom).find('[data-panel]').each(function(e){                   

                    if($(this).hasClass('ativo') && id != $(this).data('panel') ){                     

                        $(this).removeClass('ativo').slideToggle()
                        $(this).parents().find('[data-open-panel] i').removeClass('flaticon-error').addClass('flaticon-arrows-1')
                    }
                }) 
                    
                if( painel.hasClass('ativo') ){
                    painel.slideToggle().removeClass('ativo')
                    icone.removeClass('flaticon-error').addClass('flaticon-arrows-1')
                    // window.sessionStorage.removeItem('open-panel')
                }else{
                    // window.sessionStorage.setItem('open-panel',$this)
                    icone.removeClass('flaticon-arrows-1').addClass('flaticon-error')
                    painel.slideToggle().addClass('ativo')
                    //$(globalItems.dom).animate({scrollTop: scrollTo.offset().top-40},'slow')
                }
                
            })
        },

        //process upload new docs
        initTags: function($itemClass){

            $(function(){
                $('.upload-process').find('.tags'+$itemClass).popSelect({  
                    showTitle: false,
                    placeholderText: '<i class="flaticon-plus font-verde add-tag"></i> Add nova Tag',
                });
            });
        },

        getTags : function($itemClass){

            var $this = this

             $.get(urls.getTags, function(r){

                var insertTags = $.each(r, function(i,e){

                    $('.upload-process').find('.tags'+$itemClass).append('<option value="'+e.tagID+'" data-bg="'+e.tagCor+'">'+e.tagNome+'</option>')

                    $this.initTags($itemClass)

                })

            },'json')
            .fail(function(r){

                console.log('Erro na requisição de tags: '+r.responseText )
            })
            
        },

        processPreviewNewFiles:  function(e){

            var $this = this
            
            droppedFiles = e.originalEvent.dataTransfer;

            if(droppedFiles.items){

                var createItems = $.each( droppedFiles.files, function(i, file) {

                    var fID = $this.timingRandom()

                    var reader = new FileReader();

                    reader.onloadend = function(){

                        $('.upload-process .lista').append( 
                            '<div class="lista-item-upload animated flipInX doc'+fID+'"  >'+
                            '<div class="row w-100 align-items-center">'+
                                '<div class="col-12 col-md-4"><input class="form-control" name="doc'+fID+'[docNome]" value="'+file.name+'" type="text"/></div>'+ 
                                '<div class="col-12 col-md-3 text-center"><input class="form-control DPvencimento" placeholder="Vencimento" name="doc'+fID+'[docVenc]" type="text"/></div>'+
                                '<div class="col-12 col-md-3 text-center"><input class="form-control DPcompetencia" placeholder="Competência" name="doc'+fID+'[docComp]" type="text"/></div>'+
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

                        $this.getTags(fID)
                    }

                    // console.log( $('.upload-process').find("#tags") )

                    // reader.onload = $.proxy(function(file, $fileList, event) {

                    //     var img = file.type.match('image.*') ? "<img src='" + event.target.result + "' /> " : "";
                    //     $fileList.prepend( $("<li>").append( img + file.name ) )

                    // }, this, file, $("#fileList"));

                    reader.readAsDataURL(file);
                })
                

                if( $('.upload-process').hasClass('ativo') != true ){
                    $('.upload-process').addClass('ativo').fadeIn()
                }
            }

        },

        processUploadFiles: function($class,$data){

            var item = $('.'+$class),
                nome = item.find('input[name=docNome]'),
                status = item.find('.lista-item-status')

            var error = null

            status.removeClass('flaticon-error flaticon-warning font-vermelho').addClass('flaticon-cogwheel fa fa-spin')
            
            if(!$data.docTags){

                error = 1

                status.removeClass('fa fa-spin flaticon-cogwheel font-vermelho').addClass('flaticon-warning font-vermelho').attr('data-status','fail').popover({content:'Escolha pelo menos uma tag para o item',placement:'top'})

                status.popover('show')


                setTimeout(function(){
                    status.popover('hide')
                },5000)

                return
            }

            if(!$data.docNome){

                error = 1

                status.removeClass('fa fa-spin flaticon-cogwheel font-vermelho').addClass('flaticon-warning font-vermelho').attr('data-status','fail').popover({content:'Defina um nome para o arquivo',placement:'top'})

                status.popover('show')


                setTimeout(function(){
                    status.popover('hide')
                },5000)

                return
            }

            //item.css('background: linear-gradient(to right, #4ACC99 0%, #4ACC99 100%, #4ACC99 0%, #e5e5e5 0%, #e5e5e5 100%)')

            // console.log($data)
            // return

            $.ajax({
                url: urls.docsUpload,
                type: 'POST',
                data: $data,
                dataType: 'json',
                // xhr: function(){
                //     var xhr = new window.XMLHttpRequest();
                //      // Handle progress
                //      //Upload progress
                //     xhr.upload.addEventListener("progress", function(evt){

                //         console.log(evt)

                //        if (evt.lengthComputable) {
                //           var percentComplete = (evt.loaded / evt.total)*100 ;
                //           //Do something with upload progress
                //           console.log(percentComplete);
                //        }
                //     }, false);
                //     //Download progress
                //     xhr.addEventListener("progress", function(evt){
                //         if (evt.lengthComputable) {
                //           var percentComplete = evt.loaded / evt.total;
                //           //Do something with download progress
                //           console.log(percentComplete);
                //         }
                //     }, false);

                //    return xhr;
                // },
                // complete:function(){
                //     console.log("Request finished.");
                // }
            })
            .done(function(r){
 
                if(r.status == true ){
                    status.removeClass('fa fa-spin flaticon-cogwheel font-vermelho').addClass('animated bounceIn flaticon-success font-verde')

                        setTimeout( function(){
                            //
                            item.fadeOut().remove()

                        },1500)

                        app.loading( $('.painel-docs').parents('.painel') )

                        app.loadDocs()

                        setTimeout( function(){
                            
                            $('.painel-docs').parents('.painel').find('.loading').addClass('animated fadeOut').removeClass('ativo')
                        
                            if(app.countActiveItems() === 0 ){

                                $(idtsNames.uploadarealist).removeClass('ativo').fadeOut()

                                app.news('Todos os documentos foram inseridos', 'success')
                            }

                        },1700)


                        
                    

                }

                if(r.status == false ){

                    status.removeClass('fa fa-spin flaticon-cogwheel font-vermelho').addClass('flaticon-warning font-vermelho').attr('data-status','fail').popover({content:r.message,placement:'top'})
                    status.popover('show')
                }
            })
            .fail(function(r){
                console.log('erro')           
                console.log(r.responseText)
            })
        },

        processPreviewRecFiles:  function(e,doc){

            var $this = this,
                docID = doc.data('doc')
            
            droppedFiles = e.originalEvent.dataTransfer;

            if(droppedFiles.items){

                var createItems = $.each( droppedFiles.files, function(i, file) {

                    var fID = $this.timingRandom()

                    var reader = new FileReader();

                    reader.onloadend = function(){

                        $('.upload-process-rec .lista').append( 
                            '<div class="lista-item-upload animated flipInX doc'+fID+'"  >'+
                            '<div class="row w-100 align-items-center">'+ 
                                '<div class="col-12 col-md-3 text-center"><input class="form-control DPvencimento" placeholder="Escolha o vencimento" name="doc'+fID+'[docVenc]" type="text" /></div>'+
                                '<div class="col-12 col-md-1 text-right"><i class="lista-item-status flaticon-error font-vermelho"></i></div>'+
                            '</div>'+
                            '<input class="form-control" name="doc'+fID+'[docID]" value="'+docID+'" type="hidden"/>'+
                            '<input class="form-control" name="doc'+fID+'[file]" value="'+reader.result+'" type="hidden"/>'+
                            '<input class="form-control" name="doc'+fID+'[filename]" value="'+file.name+'" type="hidden"/>'+
                            '</div>')
                    }

                    // console.log( $('.upload-process').find("#tags") )

                    // reader.onload = $.proxy(function(file, $fileList, event) {

                    //     var img = file.type.match('image.*') ? "<img src='" + event.target.result + "' /> " : "";
                    //     $fileList.prepend( $("<li>").append( img + file.name ) )

                    // }, this, file, $("#fileList"));

                    reader.readAsDataURL(file);
                })
                

                if( $('.upload-process-rec').hasClass('ativo') != true ){
                    $('.upload-process-rec').addClass('ativo').fadeIn()

                    $('html,body').animate({scrollTop: $('.upload').offset().top-50},'slow')      
                }
            }

        },
        processUploadRecFiles: function($class,$data){

            var item = $('.'+$class),
                status = item.find('.lista-item-status')

            var error = null

            status.removeClass('flaticon-error flaticon-warning font-vermelho').addClass('flaticon-cogwheel fa fa-spin')
            
            if(!$data.docVenc){

                error = 1

                status.removeClass('fa fa-spin flaticon-cogwheel font-vermelho').addClass('flaticon-warning font-vermelho').attr('data-status','fail').popover({content:'Defina o vencimento',placement:'top'})

                status.popover('show')


                setTimeout(function(){
                    status.popover('hide')
                },5000)

                return
            }

            var panelID = $(idtsNames.painelDocs+' [data-doc='+$data.docID+']').find('[data-panel]').data('panel')
           
            $.ajax({
                url: urls.docsRecUpload,
                type: 'POST',
                data: $data,
                dataType: 'json',
            })
            .done(function(r){
 
                if(r.status == true ){
                    status.removeClass('fa fa-spin flaticon-cogwheel font-vermelho').addClass('animated bounceIn flaticon-success font-verde')

                        setTimeout( function(){
                            //
                            item.fadeOut().remove()

                        },1500)

                        app.loading( $('.painel-docs').parents('.painel') )

                        app.loadDocs(panelID)

                        setTimeout( function(){
                            
                            $('.painel-docs').parents('.painel').find('.loading').addClass('animated fadeOut').removeClass('ativo')

                            if(app.countActiveItems() === 0 ){

                                $(idtsNames.uploadarealist).removeClass('ativo').fadeOut()

                                app.news('Recálculo inserido', 'success')
                            }

                        },1700)
                }

                if(r.status == false ){

                    status.removeClass('fa fa-spin flaticon-cogwheel font-vermelho').addClass('flaticon-warning font-vermelho').attr('data-status','fail').popover({content:r.message,placement:'top'})
                    status.popover('show')
                }
            })
            .fail(function(r){
                console.log('erro')           
                console.log(r)
            })
        }, 

        countActiveItems: function(){
            console.log($(idtsNames.uploadarealist).find(idtsNames.itemupload))
            return $(idtsNames.uploadarealist).find(idtsNames.itemupload).length
        },

        init: function(){
            this.loadDocs()
            this.tooltips()
            this.panels()
        },
    }

    app.init()

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
        app.processPreviewNewFiles(e)        
    });

    $('.upload-process form button[type=submit]').on('click', function(e){
        e.preventDefault();        

        var $form = $(this).parents('form'),
            $url = $form.attr('action'),
            $data = $form.serializeJSON()

        var endProcess = $.each($data, function(i,f){    
            app.processUploadFiles(i,f)
        })
    })

    //RECALCULO
    var $recItem = $('.painel-docs')

    $recItem.on('drag dragstart dragend dragover dragenter dragleave drop', '.upload-doc-rec', function(e){
        e.preventDefault();
        e.stopPropagation();
    })
    .on('dragover dragenter', '.upload-doc-rec', function() {

        $(this).addClass('is-dragover');
    })
    .on('dragleave dragend drop', '.upload-doc-rec', function() {
        $(this).removeClass('is-dragover');
    })
    .on('drop', '.upload-doc-rec', function(e) {

        app.processPreviewRecFiles(e,$(this));
    });

    $('.upload-process-rec form button[type=submit]').on('click', function(e){
        e.preventDefault();        

        var $form = $(this).parents('form'),
            $data = $form.serializeJSON()

        var endProcess = $.each($data, function(i,f){    
            app.processUploadRecFiles(i,f)
        })
    })


    $(idtsNames.upload).on('click', '.lista-item-upload .flaticon-error', function(e){
        e.preventDefault()
        
        if( confirm('Deseja excluir mesmo?') ){
            var $this = $(this)

            if(app.countActiveItems() === 1 ){

                $(idtsNames.uploadarealist).addClass('fadeOut').removeClass('ativo').delay(5000).removeClass('fadeOut')
            }

            $this.parents(idtsNames.itemupload).addClass('animated flipOutX')

            setTimeout(function(){
                $this.parents(idtsNames.itemupload).remove()
            },800)
        }

        
    })

    $('body').on('click', '.popover button.modItem', function(){
                
        var $this = $(this),
        input = $this.parents('.popover').find('input[name*="doc"]'),
        destino = $this.data('destino'),
        row = $this.data('row'),
        id = $this.data('rowid'),
        panel = $this.data('open-panel'),
        name = input.attr('name'),
        value = input.val()

        if( value == '' ){
            app.news('Defina uma data para salvar', 'error')
            return
        }

        $.post(ajaxUrl+'updateItemRec', {name:name,value:value,destino:destino,row:row,id:id}, function(r){
 
            //$this.parents('.popover').popover('hide');

            if(r.status==true){

                app.loading( $('.painel-docs').parents('.painel') )

                app.loadDocs(panel)

                setTimeout( function(){
                    $('.painel-docs').parents('.painel').find('.loading').addClass('animated fadeOut').removeClass('ativo')
                },1000)

                app.news('Vencimento atualizado', 'success')
            
            }

            if(r.status==false){

                app.news('Erro.'+ r.message, 'error')
            }



        },'json')
        .fail(function(r){

            console.log(r)
        })
        .always(function(){ 

        })
    })

    

    </script>

    <script type="text/javascript">
    
    $(document).ready(function(){
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



        $('body').on('focus', 'input.DPvencimento', function() {
            $(this).datepicker({
                zIndex:1061,
                language: 'pt-BR',
                autoHide: true,
                format: 'YYYY-mm-dd'

                // inline:true,
                // container:'.popover-content'
            })
        });

        $('body').on('focus', 'input.DPcompetencia', function() {
            $(this).datepicker({
                zIndex:1061,
                language: 'pt-BR',
                autoHide: true,
                format: 'YYYY-mm'

                // inline:true,
                // container:'.popover-content'
            })
        });

        $('body').on('click', function (e) {
            $('[data-toggle="popover"]').each(function () {
                //the 'is' for buttons that trigger popups
                //the 'has' for icons within a button that triggers a popup
                if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                    $(this).popover('hide');
                }

                
            });
        });

        $('body #ano').on('click', '#yup', function(e){

            var old = $(this).parents().find('.ycurrent').text(),
                novo = Number(old)+1

            $(this).parents().find('.ycurrent').text(novo)
        })

        $('body #ano').on('click', '#ydown', function(e){
            var old = $(this).parents().find('.ycurrent').text(),
                novo = Number(old)-1

            $(this).parents().find('.ycurrent').text(novo)

        })

        $('body #mes').on('click', '#mup', function(e){

            var months = $(this).parents().find('.months'),
                current = $(this).parents().find('.months.mcurrent')
            
            if(current.text() == 'Dezembro' ){

                current.removeClass('mcurrent')
                months.first().addClass('mcurrent')

                var ycurrent = $('#ano .ycurrent').text()

                $('#ano .ycurrent').text(Number(ycurrent)+1)

            }else{

                current.removeClass('mcurrent')
                current.next().addClass('mcurrent')

            }

            
        })

        $('body #mes').on('click', '#mdown', function(e){
           var months = $(this).parents().find('.months'),
                current = $(this).parents().find('.months.mcurrent')
            
            if(current.text() == 'Janeiro' ){

                current.removeClass('mcurrent')
                months.last().addClass('mcurrent')

                var ycurrent = $('#ano .ycurrent').text()

                $('#ano .ycurrent').text(Number(ycurrent)-1)

            }else{

                current.removeClass('mcurrent')
                current.prev().addClass('mcurrent')

            }

        })
         
    })

        



    </script>