/*
 * jQuery File Upload Plugin JS Example 5.0.2
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://creativecommons.org/licenses/MIT/
 */

/*jslint nomen: true */
/*global $ */

$(function () {
    'use strict';


    $('#fileupload').fileupload(
    {
        singleFileUpload: false,
        autoUpload: true
    }
    );
    // Initialize the jQuery File Upload widget:
    $('#fileupload').bind('fileuploaddone', function (e, data) {

        var cantidad = parseInt($('#cantidad_fotos').val());
        var i;
        var error = false;
        for(i=0;i<data.result.length;i++){
          //  alert(data.result[i].error.length);
            if(!data.result[i].error){
                $('<input type="hidden"  name="array_fotos[]" value="'+data.result[i].name +'" id="'+data.result[i].name +'"/>').appendTo('#prp_edit_form');
                $('<input type="hidden"  name="array_descripcion[]" value="" id="descripcion_'+data.result[i].name +'"/>').appendTo('#prp_edit_form');
                $('#cadena_hash').val($('#cadena_hash').val() + ',' + data.result[i].hash);
                $('<input type="hidden"  name="hash[]" value="'+ data.result[i].hash +'" id="hash_'+data.result[i].name +'"/>').appendTo('#prp_edit_form');
                $('<input type="hidden"  name="orden[]" id="orden_'+data.result[i].name +'"/>').appendTo('#prp_edit_form');
                setTimeout("reordenar()",1000);
            }else{
                error = true;
            }
                 
        }
        //alert(1)
        if(!error){
           
            $('#cantidad_fotos').val(parseInt(i) + parseInt(cantidad));
            cambiar_porcentaje_visibilidad();
        }

    });
    $('#fileupload').bind('fileuploadfail', function (e, data) {
        
        //$('#cantidad_fotos').val(parseInt($('#cantidad_fotos').val())-1);
        cambiar_porcentaje_visibilidad();
       
    });
    
    // $('#fileupload').bind('fileuploadstart', function (e) {alert(1)})
    
    // Load existing files:
    $.getJSON($('#fileupload form').prop('action') + '?prp_id='+$('#prp_id').val()+'&usr_id='+$('#usr_id').val()+'&duplicar='+$('#duplicar').val(), function (files) {
        var fu = $('#fileupload').data('fileupload');
        fu._adjustMaxNumberOfFiles(-files.length);
        fu._renderDownload(files)
        .appendTo($('#fileupload .files'))
        .fadeIn(function () {
            // Fix for IE7 and lower:
            $(this).show();
        });
    } 
    ).success(function(data, textStatus, jqXHR) {
            
        var cantidad = parseInt($('#cantidad_fotos').val());  
        var i;
        var error = false;
        for(i=0;i<data.length;i++){
            
             if(!data[i].error){
                $('<input type="hidden"  name="array_fotos[]" value="'+data[i].name +'" id="'+data[i].name +'"/>').appendTo('#prp_edit_form');
                $('<input type="hidden"  name="array_descripcion[]" value="'+data[i].descripcion +'" id="descripcion_'+data[i].name +'"/>').appendTo('#prp_edit_form');
                $('#cadena_hash').val($('#cadena_hash').val() + ',' + data[i].hash);
                $('<input type="hidden"  name="hash[]" value="'+ data[i].hash +'" id="hash_'+data[i].name +'"/>').appendTo('#prp_edit_form');
                $('<input type="hidden"  name="orden[]" value="'+data[i].orden +'" id="orden_'+data[i].name +'"/>').appendTo('#prp_edit_form');
                $('#cantidad_fotos').val(i+1);
                cambiar_porcentaje_visibilidad();
                setTimeout("reordenar()",1000);
                $('#aguarde').hide();
            }else{
                error = true;
            }
        }
            
     //   if(!error){
//            $('#cantidad_fotos').val(parseInt(i) + parseInt(cantidad));
//            cambiar_porcentaje_visibilidad();
      //  }  
       
       
    })
    ;

    // Open download dialogs via iframes,
    // to prevent aborting current uploads:
    $('#fileupload .files a:not([target^=_blank])').live('click', function (e) {
        e.preventDefault();
        $('<iframe style="display:none;"></iframe>')
        .prop('src', this.href)
        .appendTo('body');
    });

});