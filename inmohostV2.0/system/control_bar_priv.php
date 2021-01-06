<?php
include ("php/config.php");
include ("php/sec_head.php");

//libreria de dreamwaeaver XLST para inclusion de archivos de XML con XSLT
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

        <script language="javascript"> 
            function edicionBarPriv(){
                var verificaciones = [
                    ['pro_id',2,'Provincia'],
                    ['loc_id',2,'Localidad'],
                    ['bar_denom',1,'Denominacion'],
                    ['bar_dir',1,'Domicilio'],
                    ['bar_tel',1,'Telefono'],
                    ['bar_mail',3,'E-mail'],
                    ['bar_mail',1,'E-mail'],
                    ['servicios[ser_1]',5,'Superficie lote mas chico'],
                    ['servicios[ser_2]',5,'Superficie lote mas grande'],
                    ['servicios[ser_3]',5,'Cantidad de lotes'],
                    ['servicios[ser_4]',5,'Cantidad de lotes disponibles'],
                    ['servicios[ser_13]',5,'Superficie unidad más chico'],
                    ['servicios[ser_14]',5,'Superficie unidad más grande'],
                    ['servicios[ser_19]',5,'Expensas'],
                    ['bar_video',13,'Video']
                ];

                var ok = verif(verificaciones.join(','),"controlBarPriv");
                
                if(ok){
                    muestra_progreso();
                    document.controlBarPriv.submit();
                }
            }
        </script>

        <?php if($mod_tip == 'add'){ ?>
            <script language="javascript">
                Event.observe(window, 'load', function() { 
                    document.getElementById('bar_desc').value='';
                    document.getElementById('bar_reglamento').value='';
                });
            </script>
        <?php } ?>
        
        <script language="javascript" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_TOOLTIP; ?>"></script>

        <link rel="stylesheet" href="../interfaz/inmohost/css/jquery-ui.css" id="theme"/>
        <link rel="stylesheet" href="../interfaz/inmohost/css/jquery.fileupload-ui.css"/>
    </head>
    <body>
        <form id="controlBarPriv" enctype="multipart/form-data" name="controlBarPriv" method="post" id="bar_priv_edit_form" action="<?php echo _FILE_PHP_ABM_MENS_BAR_PRIV ?>">
            <input type="hidden" name="fileABM" value="<?php echo _FILE_PHP_ABM_BAR_PRIV ?>" />
            <input type="hidden" name="nomVentana" value="<?php echo $nomVentana ?>" />
            <input type="hidden" id="mod_tip" name="mod_tip" value="<?php echo $mod_tip ?>" />
            <input type="hidden" id="usr_id" name="usr_id" value="<?php echo $usr_id ?>" />
            <input type="hidden" id="bar_id" name="bar_id" value="<?php echo $bar_id ?>" />
            <input type="hidden" name="fileXSL" value="<?php echo $fileXSL ?>" />
            <input type="hidden" name="fileXML" value="<?php echo $fileXML ?>" />
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr >
                    <td colspan="2"><h1>&nbsp;</h1></td>
                </tr>
                <tr >
                    <td colspan="2">
                        <?php
                        if($mod_tip == "edit"){
                            $fileXML = _FILE_XML_BAR_PRIV;
                            $fileXSL = _FILE_XSL_BAR_PRIV;
                        }
                        
                        if(isset($fileXML) && isset($fileXSL)){
                            $new_xsl = new MM_XSLTransform();
                            $new_xsl->setXML($fileXML."?mod_tip=$mod_tip&bar_id=$bar_id&usr_id=$usr_id&bar_comp_priv=".(isset($bar_comp_priv) ? $bar_comp_priv : ($mod_tip == 'add' ? 1 : '')).($mod_tip == 'add' ? '&'.$_SERVER['QUERY_STRING'] : ''));
                            $new_xsl->setXSL($fileXSL);
                            $new_xsl->addParameter('bar_comp_priv', isset($bar_comp_priv) ? $bar_comp_priv : 1);
                            $new_xsl->addParameter("mod_tip", $mod_tip);
                            $new_xsl->addParameter("win_prp", $nomVentana);
                            echo $new_xsl->Transform();
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </form>
        <table width="100%" style="float:left">
            <tr>
                <td colspan='4'>
                    <table width="100%" border="0" cellpadding="1" cellspacing="1">
                        <tr>
                            <td>
                                <div id="fileupload">
                                    <form action="fileupload_bar_priv.php" method="POST" enctype="multipart/form-data">
                                        <div class="fileupload-buttonbar">
                                            <label class="fileinput-button">
                                                <span>Agregar Fotos...</span>
                                                <input type="file" name="files[]" multiple="multiple"/>
                                            </label>
                                            <!--button type="submit" class="start">Comenzar Subida</button-->
                                            <button type="reset" class="cancel">Cancelar Subida</button>
                                            <button type="button" class="delete">Borrar Fotos</button>
                                        </div>
                                        <input type="hidden" name="cantidad_fotos"  id="cantidad_fotos" value="0"/>
                                        <input type="hidden" name="cadena_hash"  id="cadena_hash"/>
                                    </form>
                                    <div class="fileupload-content">
                                        <div class="fileupload-progressbar"></div>
                                        <table class="files"></table>
                                    </div>
                                </div>

                                <script languague="Javascript" type="text/javascript">
                                    function eliminar_input(id,descontar_cantidad){     
                                        var cadena_hash; var valor_hash;

                                        if(descontar_cantidad) $('#cantidad_fotos').val($('#cantidad_fotos').val()-1);

                                        elemento = document.getElementById('descripcion_'+id);
                                        elemento.parentNode.removeChild(elemento);

                                        elemento = document.getElementById('hash_'+id);
                                        valor_hash = elemento.value; 
                                        elemento.parentNode.removeChild(elemento);

                                        elemento = document.getElementById(id);
                                        elemento.parentNode.removeChild(elemento);

                                        var re = new RegExp(valor_hash,"g");
                                        cadena_hash = $('#cadena_hash').val();
                                        cadena_hash = cadena_hash.replace(re,'');
                                        $('#cadena_hash').val(cadena_hash);
                                    }

                                    function actualizar_descripcion(id,valor){
                                        document.getElementById('descripcion_'+id).value=valor;
                                    }
                                    
                                    function es_orden_valido(valor){
                                        var valido = false;
                                        //var re = new RegExp("^[0-"+$('#cantidad_fotos').val()+"]$");
                                        var re = /[0-9]+/;
                                        if(valor.match(re)){
                                            valido = true;
                                        }
                                                                    
                                        return valido;
                                    }
                                    
                                    function actualizar_orden(id,valor){
                                        if(es_orden_valido(valor)){
                                            var valor_ultimo = document.getElementById(id+'_ord_ultimo').value;
                                            var id_ultimo;

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
                                            <button data-type="${delete_type}" data-url="${delete_url}" id="${name}" onclick="eliminar_input('${name}',false)">Delete</button>
                                        </td>
                                        {{else}}
                                        <td class="preview">
                                            <a href="#" target="_blank" onClick="parent.ver_foto('fotos/${name}');return false;"><img src="${url}" width="80px"/></a>
                                        </td>
                                        <td class="name" colspan="3"> Descripci&oacute;n:
                                            <input type="text" name="${name}_desc"  size="30" value="{{if descripcion}} ${descripcion} {{/if}}"  id="${name}_desc" onKeyUp="actualizar_descripcion('${name}',this.value)"/>
                                        </td>
                                        <td class="name"> Orden:
                                            <input type="text" name="${name}_orden"  size="2" id="${name}_orden" onBlur="actualizar_orden('${name}',this.value)" onFocus="this.select();"/>
                                            <input type="hidden" readonly name="${name}_ord_ultimo" id="${name}_ord_ultimo"/>
                                        </td>
                                        <td class="delete">
                                            <button data-type="${delete_type}" data-url="${delete_url}" id="${name}" onclick="eliminar_input('${name}',true)">Delete</button>
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
        <br />
        <br />
        <!--TOOLTIP-->
        <div id="toolTipBox">
            <iframe id="iframeToolTip" name="iframeToolTip" src="about:blank" scrolling="no" frameborder="0" style="margin:0px; padding:0px; border:none;" ></iframe>
        </div>
        <!--FIN TOOLTIP-->

        <div align="center">
            <?php /**
             * Cambiar esta parte por botones comunes con javascript .... agregar validacion y submit post-validacion 
             * * */ ?>
            <input type="button" class="botonForm" value="Cerrar" onclick="parent.Windows.close('bar_priv')"  />
            &nbsp;&nbsp;
            <img id="img_precarga" style="display:none;" src='https://www.inmohost.com.ar/online/inmohostV2.0/interfaz/inmohost/images/precarga_comun.gif'></img>
            <span id="input_aceptar">
                <input name="agregar" type="button" class="botonForm" id="agregar" onclick="edicionBarPriv()" value="Guardar" />
            </span>
        </div>

        <script language="JavaScript1.2" type="text/javascript" src="./javascript/jquery/jquery-1.6.2.min.js"></script>
        <script languague="Javascript" type="text/javascript">
            $(document).ready(function(jQuery) {
                $('#limpiar_latitudes').click(function(){
                    document.getElementById('lat').value='';
                    document.getElementById('lng').value='';                                          
                });
            });
            
            function cambiar_tipo(s_tipo){
                var tipo = s_tipo.options[s_tipo.selectedIndex].value;
                window.location.href='control_bar_priv.php?mod_tip=<?php echo $mod_tip ?>&nomVentana=bar_priv&bar_comp_priv='+tipo+'&<?php if(isset($bar_id)): echo 'bar_id=' . $bar_id; else: echo 'fileXML=' . $_GET['fileXML'] . '&fileXSL=' . $_GET['fileXSL'] . '&usr_id=' . $usr_id; endif ?>'<?php echo $mod_tip == 'add' ? "+$('#controlBarPriv').serialize()" : '' ?>;
            }    
        </script>

        <script language="Javascript" type="text/javascript" src="./javascript/jquery/jqueryui-1.8.13.min.js"></script>
        <script language="Javascript" type="text/javascript" src="./javascript/jquery/jquery.tmpl.min.js"></script>
        <script language="Javascript" type="text/javascript" src="./javascript/jquery/jquery.iframe-transport.js"></script>
        <script language="Javascript" type="text/javascript" src="./javascript/jquery/jquery.fileupload.js"></script>
        <script language="Javascript" type="text/javascript" src="./javascript/jquery/jquery.fileupload-ui.js"></script>
        <script language="Javascript" type="text/javascript" src="./javascript/jquery/application_bar_priv.js"></script>
    </body>
</html>