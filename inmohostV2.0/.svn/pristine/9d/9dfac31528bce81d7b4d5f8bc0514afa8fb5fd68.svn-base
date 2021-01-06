<?php
include ("php/config.php");
include ("php/sec_head.php");

//libreria de dreamwaeaver XLST para inclucion de archivos de XML con XSLT
include(_FILE_XSL_CLASS);
// cambio la hoja de estylos por defecto
$otraCSS = "styleInterno.css";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>INMOHOST</title>

        <?php include("head.php"); ?>

        <script language="JavaScript1.2" type="text/javascript" src="./javascript/jquery/jquery-1.6.2.min.js"></script>

        <script language="JavaScript1.2" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_AJAX; ?>"></script>

        <!--MENUEXTRA-->
        <script language="JavaScript1.2" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_MENUEXTRA; ?>"></script>
        <?php echo "<style type=\"text/css\" media=\"screen\">
	@import url(\"" . _FILE_CSS_MENUEXTRA . "\");
</style>\n"; ?>
        <!--//MENUEXTRA-->
        <script language="javascript" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_TOOLTIP; ?>"></script>

        <link rel="stylesheet" href="../interfaz/inmohost/css/jquery-ui.css" id="theme"/>
        <link rel="stylesheet" href="../interfaz/inmohost/css/jquery.fileupload-ui.css"/>
    </head>
    <body>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">

            <tr>
                <td>

                    <?php
                    //
                    // Si hay que realizar alguna operacion y ya se ha editado la entidad
                    // se ejecuta el abm del modulo
                    if ($mod_tip && $edited) {

                        include(_FILE_PRP_MEN_ABM);
                        include(_FILE_PHP_ABM_PRP);
                    
                    }
                    if ($errors) {

                        for ($i = 0; $i < count($errors); $i++) {
                            echo "<tr><td class='destacado2'>" . $errors[$i] . "</td></tr>
					<tr> <td> Revise la o las siguientes propiedades: </td></tr>";
                            foreach ($error_ids as $error_id) {
                                echo "<tr><td class='destacado2'>ID: " . $error_id . "</td></tr>";
                            }
                            echo "<tr> <td> Si usted esta cargando otra propiedad, debe colocar un domicilio distinto al que tiene la propiedad antes listada: </td></tr>";
                        }
                    }
// Para que funcionen las modificaciones por ID -- Atilio 
                    if ($mod_edit == 'mod_edit') {
                        $mod_edit = 1;
                        $query_string = "&mod_edit=$mod_edit&mod_tip=$mod_tip&prp_id=$prp_id&usr_id=$usr_id";
                    } else if ($mod_tip == "add" && $duplicar == 1) {
                        $mod_edit = 0;
                        $query_string = "&mod_edit=$mod_edit&mod_tip=$mod_tip&duplicar=1&prp_id=$prp_id&usr_id=$usr_id";
                    } else if ($mod_tip == "edit" && $duplicar == 1) {
                        $mod_edit = 0;
                        $mod_tip = "add";
                        $query_string = "&mod_edit=$mod_edit&mod_tip=$mod_tip&duplicar=1&prp_id=$prp_id&usr_id=$usr_id";
                    } else {
                        $query_string = $_SERVER['QUERY_STRING'] . "&usr_id=" . $usr_id;
                    }
                    ?>	</td>
            </tr>
            <tr>
                <td>  </td>
                <td>
                    <?php
                    // Si no se ejecuto ninguna operacion ($msg_exitos no definido) o si se ejecuto la operacion pero con errores
                    // se muestran de nuevo los datos de la propiedad



                    if ($priv_id == 1) {
                        if (!$msg_exitos && !$errors) {

                            $duplicado = 0;
                            if ($duplicar == 1) {

                                if (isset($max_id)) {
                                    ?>
                                    <table>
                                        <tr class="tr3">
                                            <td><div align="left"> <b>La propiedad se ingreso exitosamente con el identificador: <?php echo $max_id ?></b></div></td>
                                        </tr>
                                    </table>
                                    <?php
                                } else {
                                    ?>

                                    <table>
                                        <tr class="tr3">
                                            <td><div align="left"> <b> Modifique el formulario a continuacion para duplicar el inmueble con ID: <?php echo $prp_id ?>. </b></div></td>
                                        </tr>
                                    </table>
                                    <?php
                                }
                            }

                            $Item_xsl = new MM_XSLTransform();
                            //print _FILE_XML_PRP_FICHA_EDIT."?".$query_string;
                            $Item_xsl->setXML(_FILE_XML_PRP_FICHA_EDIT . "?" . $query_string);
                            $Item_xsl->setXSL(_FILE_XSL_PRP_FICHA_EDIT);
                            $Item_xsl->addParameter("prp_fotosXML", _PROXY . "?tip=prp_foto"); //_FILE_XML_PRP_FOTOS."?prp_id=$prp_id&usr_id=$usr_id&mod_edit=$mod_edit");
                            $Item_xsl->addParameter("mod_edit", $mod_edit);
                            $Item_xsl->addParameter("prp_id", $prp_id);
                            $Item_xsl->addParameter("mod_tip", $mod_tip);
                            $Item_xsl->addParameter("usr_id", $usr_id);
                            $Item_xsl->addParameter("fileFicha", _FILE_PHP_PRP_FICHA);
                            $Item_xsl->addParameter("fileFichaEdit", _FILE_PHP_PRP_FICHA_EDIT);
                            $Item_xsl->addParameter("fileFichaEstado", _FILE_PHP_PRP_LISTADO);
                            $Item_xsl->addParameter("fileCita", _FILE_PHP_AGENDA_CITAS);
                            $Item_xsl->addParameter("fileExportar", _FILE_PHP_EXPORTACION);
                            $Item_xsl->addParameter("filePropietario", _FILE_PRP_PROPIETARIOS);
                            $Item_xsl->addParameter("fileMapa", _FILE_PHP_PRP_MAP);
                            $Item_xsl->addParameter("win_prp", $win_prp);
                            $Item_xsl->addParameter("carpetaFotos", $carpetaFotos);
                            $Item_xsl->addParameter("duplicar", $duplicar);

                            

                            echo $Item_xsl->Transform();
                            ?>
                    
                            <?php $result = mysql_query('select fotos from propiedades where usr_id = '.$usr_id.' and prp_id='.$prp_id);
                                  $fotos = mysql_result($result, 0,0);  
                                    ?>
                            <table width="100%">
                                <tr>
                                    <td colspan='4'>
                                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                                            <tr>
                                                <td>
                                                    <div id="fileupload">
                                                        <form action="fileupload.php" method="POST" enctype="multipart/form-data">
                                                            <div class="fileupload-buttonbar">
                                                                <label class="fileinput-button">
                                                                    <span>Agregar Fotos...</span>
                                                                    <input type="file" name="files[]" multiple="multiple"/>
                                                                </label>
                                                                <!--button type="submit" class="start">Comenzar Subida</button-->
                                                                <button type="reset" class="cancel">Cancelar Subida</button>
                                                                <button type="button" class="delete" onClick="setTimeout('cambiar_porcentaje_visibilidad()',3000);">Borrar Fotos</button>
                                                            </div>
                                                            <input type="hidden" name="cantidad_fotos"  id="cantidad_fotos" value="0"/>
                                                            <input type="hidden" name="cadena_hash"  id="cadena_hash"/>
                                                        </form>
                                                        <span id="aguarde"> <?php if(($mod_tip=='edit' || $duplicar==1)&&$fotos > 0){?> Por favor, aguarde mientras se cargan las fotos... <img src="https://www.inmohost.com.ar/online/inmohostV2.0/interfaz/inmohost/images/loader.gif"/><?php } ?> </span>
                                                        <div class="fileupload-content">
                                                            <div class="fileupload-progressbar"></div>
                                                            <table class="files"></table>

                                                        </div>
                                                    </div>

                                                    <script languague="Javascript" type="text/javascript">
                                                        $(document).ready(function(jQuery) {
                                                                    
        <?php if ($mod_tip != 'del'): ?>
                                                                        parent.ventana('ventana_puntaje', 'usr_id=<?php echo $usr_id ?>&win_prp=<?php echo $win_prp ?>', 'system/progreso_puntuacion.php', 'Visibilidad del inmueble');
        <?php endif ?>
                                                                                                                    
                                                                    $('#prp_ocultar_precio_si').click(function(){
                                                                        $('#leyenda_precio').append('<font color="red"><b>IMPORTANTE! </b>: Solo un bajo porcentaje (menos del 15%) de los usuarios de internet se interesa por un inmueble que no tenga precio publicado. </font>');
                                                                        cambiar_porcentaje_visibilidad();
                                                                    })
                                                                                                                    
                                                                    $('#prp_ocultar_precio_no').click(function(){
                                                                        $('#leyenda_precio').empty();
                                                                        cambiar_porcentaje_visibilidad();
                                                                    })
                                                                                                                    
                                                                      
                                                                      
                                                                    $('#select_tip_id').change(function(){
                                                                        <?php if(($mod_tip=="add"&&$duplicar) || $mod_tip=="edit"): ?>
                                                                                    traeURL('php/funciones/traerServicios.php?prp_id=<?php echo $prp_id?>&usr_id=<?php echo $usr_id?>&tip_id='+document.getElementById('select_tip_id').options[document.getElementById('select_tip_id').selectedIndex].value,'panel_servicios',null,null);
                                                                        <?php else:?>
                                                                                    traeURL('php/funciones/traerServicios.php?tip_id='+document.getElementById('select_tip_id').options[document.getElementById('select_tip_id').selectedIndex].value,'panel_servicios',null,null);
                                                                        <?php endif ?>
                                                                    });
                                                                              
                                                                    <?php if(($mod_tip=="add"&&$duplicar) || $mod_tip=="edit"): ?>
                                                                             traeURL('php/funciones/traerServicios.php?prp_id=<?php echo $prp_id?>&usr_id=<?php echo $usr_id?>&tip_id='+document.getElementById('select_tip_id').options[document.getElementById('select_tip_id').selectedIndex].value,'panel_servicios',null,null);
                                                                    <?php endif?>
                                                                    
                                                                    
                                                                    if($('#prp_ocultar_precio_si').attr('checked')){
                                                                        $('#leyenda_precio').append('<font color="red"><b>IMPORTANTE! </b>: Solo un bajo porcentaje (menos del 15%) de los usuarios de internet se interesa por un inmueble que no tenga precio publicado. </font>');
                                                                    }
                                                                                                               
                                                                    $('#agregar_en_mapa').click(function(){
                                                                        cambiar_porcentaje_visibilidad();
                                                                    });
                                                                    $('#limpiar_latitudes').click(function(){
                                                                        document.getElementById('lat').value='';
                                                                        document.getElementById('lng').value='';
                                                                        cambiar_porcentaje_visibilidad();
                                                                                                
                                                                    });
                                                                                            
                                                                    $('#lat').change(function(){
                                                                        cambiar_porcentaje_visibilidad(); 
                                                                    });
                                                                    $('#prp_pre').change(function(){
                                                                        cambiar_porcentaje_visibilidad(); 
                                                                    });
                                                                    $('#prp_pre_dol').change(function(){
                                                                        cambiar_porcentaje_visibilidad(); 
                                                                    });
                                                                    $('#prp_desc').change(function(){
                                                                        cambiar_porcentaje_visibilidad(); 
                                                                    });
                                                                                            
                                                                    $('#cantidad_fotos').change(function(){
                                                                        cambiar_porcentaje_visibilidad(); 
                                                                    });
                                                                                            
                                                                                            
                                                                    // setTimeout('cambiar_porcentaje_visibilidad',3000);
                                                                });
                                                                                        
                                                                                                                                        
                                                                function eliminar_input(id,eliminada){
                                                                   
                                                                    var cadena_hash;
                                                                    var valor_hash;
                                                                    
                                                                   
                                                                     if(eliminada!='1')
                                                                        $('#cantidad_fotos').val(parseInt($('#cantidad_fotos').val())-1);

                                                               
                                                                    elemento = document.getElementById('descripcion_'+id);
                                                                    if(elemento)
                                                                        elemento.parentNode.removeChild(elemento);
                                                                    
                                                                    elemento = document.getElementById('hash_'+id);
                                                                    if(elemento){
                                                                        valor_hash = elemento.value; 
                                                                        elemento.parentNode.removeChild(elemento);
                                                                    }
                                                                    
                                                               
                                                                    
                                                                    elemento = document.getElementById(id);
                                                                    elemento.parentNode.removeChild(elemento);
                                                                    
                                                                    var re = new RegExp(valor_hash,"g");
                                                                    cadena_hash = $('#cadena_hash').val();
                                                                    cadena_hash = cadena_hash.replace(re,'');
                                                                    $('#cadena_hash').val(cadena_hash);
                                                                    
                                                                    elemento = document.getElementById('orden_'+id);
                                                                    if(elemento)
                                                                        elemento.parentNode.removeChild(elemento);
                                                                    
                                                                    cambiar_porcentaje_visibilidad();
                                                                    setTimeout("reordenar()",1000);
                                                                }

                                                                function actualizar_descripcion(id,valor){
                                                                    document.getElementById('descripcion_'+id).value=valor;
                                                                }
                                                                   
                                                                
                                                                function es_orden_valido(valor){
                                                                    var valido = true;
                                                                    
                                                                    var intRegex = /^\d+$/;
                                                                    
                                                                    if(parseInt(valor) > parseInt($('#cantidad_fotos').val()) || valor <= 0){
                                                                        valido = false;
                                                                 //       console.log('entra 1');
                                                                    }
                                                                    if(isNaN(valor)){
                                                                        valido = false;
                                                                  //      console.log('entra 2');
                                                                    }
                                                                    
                                                                    if(!intRegex.test(valor)) {
                                                                        valido = false;
                                                                 //       console.log('entra 3');
                                                                    }
                                                                    
                                                                    return valido;
                                                                }
                                                                
                                                                function actualizar_orden(id,valor){
                                                                
                                                                  if(es_orden_valido(valor)){
                                                                        //document.getElementById
                                                                      var valor_ultimo = document.getElementById(id+'_ord_ultimo').value;
                                                                      
                                                                       $("[id*=_ord_ultimo]").each(function(index){
                                                                            if($(this).val()==valor){
                                                                                ultimo_orden = $(this).attr('id').split("_");
                                                                            }
                                                                        });
                                                                       
                                                                      
                                                                        
                                                                        document.getElementById(ultimo_orden[0]+'_orden').value=valor_ultimo;
                                                                        document.getElementById(ultimo_orden[0]+'_ord_ultimo').value=valor_ultimo;
                                                                        document.getElementById(id+'_ord_ultimo').value=valor;
                                                                        document.getElementById('orden_'+id).value=valor;
                                                                        document.getElementById('orden_'+ultimo_orden[0]).value=valor_ultimo;
                                                                        
                                                                  }else{
                                                                      document.getElementById(id+'_orden').value = document.getElementById(id+'_ord_ultimo').value;
                                                                  }
//                                                                   
                                                                }   
                                                                
                                                                function reordenar(){
                                                                    $("[id*=_orden]").each(function(index){
                                                                        $(this).val(index+1);
                                                                         id_orden = $(this).attr('id').split("_");
                                                                         document.getElementById('orden_'+id_orden[0]).value=index+1;  
                                                                    });
                                                                    
                                                                    $("[id*=_ord_ultimo]").each(function(index){
                                                                        $(this).val(index+1);
                                                                    });
                                                                }
                                                                   
                                                                                            
                                                                function calcular_porcentaje(){
                                                                    var total = 0;
                                                                                            
                                                                    if($('#lat').val()!=''){
                                                                        total+=_PORCENTAJE_MAPA;
                                                                    }

                                                                    if( ($('#prp_pre').val()!=''&& $('#prp_pre').val()>1) || ($('#prp_pre_dol').val()!=''&&$('#prp_pre_dol').val()>1) ){
                                                                                                        
                                                                        if($('#prp_ocultar_precio_si').attr('checked')){
                                                                            if($('#prp_pre').val() > _PRECIO_INMUEBLES_COTI || parseInt($('#prp_pre_dol').val()*_VALOR_DOLAR_OFICIAL) > _PRECIO_INMUEBLES_COTI ){
                                                                                total+=_PORCENTAJE_PRECIO;
                                                                            }
                                                                        }else{
                                                                            total+=_PORCENTAJE_PRECIO;
                                                                        }
                                                                                                        
                                                                                                        
                                                                                                       
                                                                    }

                                                                    if($('#prp_desc').val().length >= _LONGITUD_MINIMA_PRP_DESC){
                                                                        total+=_PORCENTAJE_DESCRIPCION;
                                                                    }

                                                                    if($('#cantidad_fotos').val() == 1){
                                                                        total+=_PORCENTAJE_UNA_FOTO;
                                                                    }

                                                                    //  console.log("cant fotos" + $('#cantidad_fotos').val());
                                                                                                    
                                                                    if($('#cantidad_fotos').val() >= 2 && $('#cantidad_fotos').val() <= 3){
                                                                        total+=_PORCENTAJE_TRES_FOTOS;
                                                                    }

                                                                    if($('#cantidad_fotos').val() >= 4 && $('#cantidad_fotos').val() <= 5){
                                                                        total+=_PORCENTAJE_CINCO_FOTOS;
                                                                    }

                                                                    if($('#cantidad_fotos').val() >= 6){
                                                                        total+=_PORCENTAJE_SEIS_FOTOS;
                                                                    }
                                                                                                    
                                                                    return total;
                                                                }    
                                                                             
                                                                                   
                                                                function cambiar_porcentaje_visibilidad(){
                                                                                            
                                                                    for(i=0;i<parent.window.length;i++){
                                                                        if(parent.window[i].name == "ventana_puntaje_content"){
                                                                            if(parent.window[i].$topLoader){
                                                                                var progreso = parent.window[i].$topLoader.getProgress().split('%');
                                                                                porcentaje = calcular_porcentaje();
                                                                                                   
                                                                                if(porcentaje != progreso[0]){
                                                                                    parent.window[i].actualizar_porcentaje(porcentaje);
                                                                                    $('#prp_visibilidad').val(porcentaje);
                                                                                }

                                                                            }
                                                                        }
                                                                    }
                                                                                            
                                                                }
                                                                
//                                                                function revisar_tipo_const(){
//                                                                    select_tip_id = document.getElementById('select_tip_id').options[document.getElementById('select_tip_id').selectedIndex].value;
//                                                                    
//                                                                    if(document.getElementById('check_fo360_id').checked){
//                                                                        if(select_tip_id  != 1 && select_tip_id  != 4 && select_tip_id  != 5 && select_tip_id  != 6 && select_tip_id  != 21 && select_tip_id  != 24){
//                                                                            document.getElementById('check_fo360_id').checked = false;
//                                                                            $('#leyenda_procrear').html('');
//                                                                            if(parent.Dialog){
//                                                                                    parent.Dialog.alert('El inmueble seleccionado no puede aplicarse para los creditos PRO.CRE.AR', {windowParameters: {className:'alert', width:400, height:200}});		
//                                                                            }else{
//                                                                                    parent.parent.Dialog.alert('El inmueble seleccionado no puede aplicarse para los creditos PRO.CRE.AR', {windowParameters: {className:'alert', width:400, height:200}});
//                    }
//                                                                        }else{
//                                                                            if(select_tip_id  == 1 || select_tip_id  == 4 || select_tip_id  == 5 || select_tip_id == 21){
//                                                                                
//                                                                                $('#leyenda_procrear').html('<font><b>REQUISITOS</b>: Vivienda a estrenar. <ul> <li> No puede superar los 150 m2 de superficie</li><li> Valor maximo: $850.000</li> </ul> </font>');
//                                                                            }else if(select_tip_id  == 6 || select_tip_id  == 24){
//                                                                                $('#leyenda_procrear').html('<font><b>REQUISITOS</b>: Lote para construccion. <ul> <li> Valor minimo $15.000 y maximo de $150.000</li><li> Debe poseer servicios de agua, luz y gas.</li> </ul> </font>');
//                                                                            }else{
//                                                                                $('#leyenda_procrear').html('');
//                                                                            }
//                                                                            
//                                                                        }
//                                                                    }else{
//                                                                        if(select_tip_id  == 1 || select_tip_id  == 4 || select_tip_id  == 5 || select_tip_id == 21){
//                                                                                $('#leyenda_procrear').html('<font><b>REQUISITOS</b>: Vivienda a estrenar. <ul> <li> No puede superar los 150 m2 de superficie</li><li> Valor maximo: $850.000</li> </ul> </font>');
//                                                                            }else if(select_tip_id  == 6 || select_tip_id  == 24){
//                                                                                $('#leyenda_procrear').html('<font><b>REQUISITOS</b>: Lote para construccion. <ul> <li> Valor minimo $15.000 y maximo de $150.000</li><li> Debe poseer servicios de agua, luz y gas.</li> </ul> </font>');
//                                                                            }else{
//                                                                                $('#leyenda_procrear').html('');
//                                                                            }
//                                                                    }
//                                                                }

                                                    </script>

                                                    <script id="template-upload" type="text/x-jquery-tmpl">


                                                        <tr class="template-upload{{if error}} ui-state-error{{/if}}">
                                                            <td class="preview"></td>
                                                            <td class="name" colspan="2">${name}</td>

                                                            {{if error}}
                                                            <td class="error" colspan="2">Error:
                                                                {{if error === 'maxFileSize'}}File is too big
                                                                {{else error === 'minFileSize'}}File is too small
                                                                {{else error === 'acceptFileTypes'}}Filetype not allowed
                                                                {{else error === 'maxNumberOfFiles'}}Max number of files exceeded
                                                                {{else}}${error}
                                                                {{/if}}
                                                            </td>
                                                            {{else}}
                                                            <td class="progress"><div></div></td>
                                                            <td class="start"><button>Start</button></td>
                                                            {{/if}}
                                                            <td class="cancel"><button>Cancel</button></td>
                                                        </tr>
                                                    </script>


                                                    <script id="template-download" type="text/x-jquery-tmpl">

                                                        <tr class="template-download{{if error}} ui-state-error{{/if}}">
                                                            {{if error}}
                                                            <td></td>
                                                            <td class="name">${name}</td>
                                                            <td class="size">${sizef}</td>
                                                            <td class="error" colspan="2">Error:
                                                                {{if error === 1}}File exceeds upload_max_filesize (php.ini directive)
                                                                {{else error === 2}}File exceeds MAX_FILE_SIZE (HTML form directive)
                                                                {{else error === 3}}File was only partially uploaded
                                                                {{else error === 4}}No File was uploaded
                                                                {{else error === 5}}Missing a temporary folder
                                                                {{else error === 6}}Failed to write file to disk
                                                                {{else error === 7}}File upload stopped by extension
                                                                {{else error === 'maxFileSize'}}File is too big
                                                                {{else error === 'minFileSize'}}File is too small
                                                                {{else error === 'acceptFileTypes'}}Filetype not allowed
                                                                {{else error === 'maxNumberOfFiles'}}Max number of files exceeded
                                                                {{else error === 'uploadedBytes'}}Uploaded bytes exceed file size
                                                                {{else error === 'emptyResult'}}Empty file upload result
                                                                {{else}}${error}
                                                                {{/if}}
                                                            </td>
                                                            <td class="delete">
                                                                <button data-type="${delete_type}" data-url="${delete_url}" id="${name}" onclick="eliminar_input('${name}','${eliminada}')">Delete</button>
                                                            </td>
                                                            {{else}}
                                                            <td class="preview">
                                                                <a href="#" target="_blank" onClick="parent.ver_foto('${url_ampliada}');return false;"><img src="${url}" width="80px"/></a>
                                                            </td>
                                                            <td class="name" colspan="3"> Descripci&oacute;n:
                                                                <input type="text" name="${name}_desc"  size="30" value="{{if descripcion}} ${descripcion} {{/if}}"  id="${name}_desc" onKeyUp="actualizar_descripcion('${name}',this.value)"/>
                                                            </td>
                                                            <td class="name"> Orden:
                                                                <input type="text" name="${name}_orden"  size="2" id="${name}_orden" onBlur="actualizar_orden('${name}',this.value)" onFocus="this.select();"/>
                                                                <input type="hidden" readonly name="${name}_ord_ultimo" id="${name}_ord_ultimo"/>
                                                            </td>
                                                            <td class="delete">
                                                                <button data-type="${delete_type}" data-url="${delete_url}" id="${name}" onclick="eliminar_input('${name}','${eliminada}')">Delete</button>
                                                            </td>
                                                            

                                                            {{/if}}

                                                        </tr>
                                                    </script>

                                                </td>

                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                            </table>

                            <table width="100%">

                                <tr class="tableClara">
                                    <td width="33%"><div align="center">
                                            <input name="cancelar" type="reset" class="botonForm" value="Cancelar" tabindex="58" onclick="parent.Windows.close('{$win_prp}');" />
                                        </div>
                                    </td>
                                    <td width="33%">
                                        <div align="center">
                                            <?php if (!$duplicar): ?>
                                                <?php if ($mod_tip == "add"): ?>

                                                    <img id="img_precarga" style="display:none;" src='https://www.inmohost.com.ar/online/inmohostV2.0/interfaz/inmohost/images/precarga_comun.gif'></img>
                                                    <span id="input_duplicar">



                                                        <input name="enviar" type="button" class="botonForm" value="GUARDAR Y DUPLICAR" tabindex="59" onclick="javascript:document.getElementById('duplicar').value=1;valida_propiedad('pai_id,2,Pais,pro_id,2,Provincias,prp_pre,5,Precio,prp_pre_dol,5,Precio Dolares,loc_id,2,Localidades,prp_dom,1,Domicilio,tip_id,2,Tipo_de_Construccion,con_id,2,Condicion,valor2,5,Sup. Total m2,valor7,5,Sup. cubierta m2,prp_pub,8,Titulo','prp_edit_form');"/>
                                                    </span>

                                                <?php else: ?>
                                                    <img id="img_precarga" style="display:none;" src='https://www.inmohost.com.ar/online/inmohostV2.0/interfaz/inmohost/images/precarga_comun.gif'></img>
                                                    <span id="input_duplicar">



                                                        <input name="enviar" type="button" class="botonForm" value="DUPLICAR" tabindex="59" onclick="javascript:document.getElementById('duplicar').value=1;valida_propiedad('pai_id,2,Pais,pro_id,2,Provincias,prp_pre,5,Precio,prp_pre_dol,5,Precio Dolares,loc_id,2,Localidades,prp_dom,1,Domicilio,tip_id,2,Tipo_de_Construccion,con_id,2,Condicion,valor2,5,Sup. Total m2,valor7,5,Sup. cubierta m2,prp_pub,8,Titulo','prp_edit_form');"/>
                                                    </span>

                                                <?php endif ?>



                                            <?php endif ?>        
                                        </div>
                                    </td>
                                    <td width="33%">
                                        <div align="center">

                                            <img id="img_precarga" style="display:none;" src='https://www.inmohost.com.ar/online/inmohostV2.0/interfaz/inmohost/images/precarga_comun.gif'></img>
                                            <span id="input_aceptar">
                                                <input name="enviar" type="button" class="botonForm" value="GUARDAR" tabindex="59" onclick="javascript:document.getElementById('duplicar').value=0;javascript:valida_propiedad('pai_id,2,Pais,pro_id,2,Provincias,prp_pre,5,Precio,prp_pre_dol,5,Precio Dolares,loc_id,2,Localidades,prp_dom,1,Domicilio,tip_id,2,Tipo_de_Construccion,con_id,2,Condicion,valor2,5,Sup. Total m2,valor7,5,Sup. cubierta m2,prp_pub,8,Titulo','prp_edit_form');"/>
                                            </span>
                                        </div>
                                    </td>
                                </tr>

                            </table>

                            <?php
                        }
                        else {
                            // Se realizo la operacion con exito, se muestran los mensajes correspondientes
                            if ($msg_exitos && !$errors) {
                                
                              
                                
                                
                                ?>
                                <tr>
                                    <script language="javascript">
                                        parent.ventana('agenda_resumen','', '<?php echo _FILE_PHP_RESUMEN_PRINCIPAL; ?>', 'Resumen de movimentos');
                                    </script>

                                    <?php if ($mod_tip == "add") { 
                                          //reviso cantidad_maxima
                                            include ("php/conexion_inmoclick.php");
                                            $cadena = "select servicio_x_usuario_valor from servicios_x_usuarios where servicio_usuario_id = 1 and usr_id = "._USR_ID;
                                            $result = mysql_query($cadena,$conn2);
                                            if(mysql_num_rows($result)){
                                                $cantidad_maxima_propiedades = mysql_result($result, 0,0);
                                                $cadena = "select count(prp_id) from propiedades where prp_mostrar = 1 and mos_por_1 = 1 and usr_id = "._USR_ID;
                                                $result = mysql_query($cadena,$conn2);
                                                $cantidad_propiedades = mysql_result($result, 0,0);
                                                $limite_propiedad_excedido = 0;
                                                if($cantidad_propiedades > $cantidad_maxima_propiedades){
                                                    $limite_propiedad_excedido = 1;
                                                }

                                            }
                                        
                                        ?>		
                                        <td class='destacado'><h1 align="center">
                                                
                                                
                                               <script language="javascript"> location.href = '<?php echo $rutaAbsoluta._FILE_PHP_PRP_FICHA.'?win_prp=win1&mod_edit=1&prp_id='.$max_id;?>&usr_inmohost=<?php echo _USR_ID?>&usr_id=<?php echo _USR_ID?>&mod_tip=1&mensaje=La propiedad se ha cargado con el identificador: <?php echo $max_id?>&limite_propiedad_excedido=<?php echo $limite_propiedad_excedido?>&cantidad_propiedades=<?php echo $cantidad_propiedades?>&cantidad_maxima_propiedades=<?php echo $cantidad_maxima_propiedades?>'</script></td>
                                    <?php } elseif ($mod_tip == "edit") { ?>
                                        <td class='destacado'><h1 align="center"><br/>
                                                <script language="javascript"> location.href = '<?php echo $rutaAbsoluta._FILE_PHP_PRP_FICHA.'?win_prp=win1&mod_edit=1&prp_id='.$prp_id;?>&usr_inmohost=<?php echo _USR_ID?>&usr_id=<?php echo _USR_ID?>&mod_tip=1&mensaje=La propiedad se ha modificado'</script>
                                                                                                                                               
                                                          
                                    <?php } else { ?>

                                        <?php if (is_array($msg_exitos)) { ?>
                                            <?php for ($i = 0; $i < count($msg_exitos); $i++) { ?>
                                                <td class='destacado'><h1 align="center"><br/><?php echo $msg_exitos[$i] ?></h1></td>
                                            <?php } ?>

                                        <?php } else { ?>
                                            <td class='destacado'><h1 align="center"><br/>LA PROPIEDAD HA SIDO ELIMINADA</h1></td>
                                        <?php } ?>


                                    <?php } ?>
                                </tr>
                                <?php
                                /* for ($i=0; $i<count($msg_exitos);$i++)
                                  { ?>
                                  <tr><td class='destacado' >&nbsp;</td></tr>
                                  <tr><td class='destacado' >&nbsp;&nbsp;&bull;&nbsp;<?php echo $msg_exitos[$i]; ?></td></tr>
                                  <?php
                                  } */
                            }
                            ?>

                            <tr><td class='destacado' >&nbsp;</td></tr>


                            <?php
                        }
                    } else {
                        ?>
                        <FONT class='destacado'><h1 align="center"><br/>		NO TIENE PRIVILEGIOS PARA ACCEDER A ESTA FUNCION.</h1></FONT>
                        <?php
                    }
                    ?>


                </td>
            </tr>
        </table>

        <!--TOOLTIP-->
        <div id="toolTipBox">
            <iframe id="iframeToolTip" name="iframeToolTip" src="about:blank" scrolling="no" frameborder="0" style="margin:0px; padding:0px; border:none;" ></iframe>
        </div>
        <!--FIN TOOLTIP-->

        <script language="Javascript" type="text/javascript" src="./javascript/jquery/jqueryui-1.8.13.min.js"></script>
        <script language="Javascript" type="text/javascript" src="./javascript/jquery/jquery.tmpl.min.js"></script>
        <script language="Javascript" type="text/javascript" src="./javascript/jquery/jquery.iframe-transport.js"></script>
        <script language="Javascript" type="text/javascript" src="./javascript/jquery/jquery.fileupload.js"></script>
        <script language="Javascript" type="text/javascript" src="./javascript/jquery/jquery.fileupload-ui.js"></script>
        <?php if(!$msg_exitos){?>
            <script language="Javascript" type="text/javascript" src="./javascript/jquery/application.js?cache=01-12-2014"></script>
        <?php }?>
    </body>
</html>
