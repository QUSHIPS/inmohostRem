<?xml version="1.0" encoding="iso-8859-1"?>
<!DOCTYPE xsl:stylesheet  [
  <!ENTITY nbsp   "&#160;">
  <!ENTITY copy   "&#169;">
  <!ENTITY reg    "&#174;">
  <!ENTITY trade  "&#8482;">
  <!ENTITY mdash  "&#8212;">
  <!ENTITY ldquo  "&#8220;">
  <!ENTITY rdquo  "&#8221;"> 
  <!ENTITY pound  "&#163;">
  <!ENTITY yen    "&#165;">
  <!ENTITY euro   "&#8364;">
  <!ENTITY aacute "&#225;">
  <!ENTITY Aacute "&#193;">
  <!ENTITY eacute "&#233;">
  <!ENTITY Eacute "&#201;">
  <!ENTITY iacute "&#237;">
  <!ENTITY Iacute "&#205;">
  <!ENTITY oacute "&#243;">
  <!ENTITY Oacute "&#211;">
  <!ENTITY uacute "&#250;">
  <!ENTITY Uacute "&#218;">
  <!ENTITY ntilde "&#242;">
  <!ENTITY Ntilde "&#209;">
]>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="iso-8859-1"/>
    <xsl:param name="bar_id" />
    <xsl:param name="mod_tip" />
    <xsl:param name="win_prp" />
    <xsl:param name="bar_comp_priv" />
    <xsl:template match="/">
        <!-- ARMO EL FORMULARIO DE ENVÍO -->
        <table width="100%" height="100%" border="0" cellpadding="1" cellspacing="1" class="tableOscura">
            <tr class="tableClara">
                <td width="150%" colspan="2">
                    <h1 align="left">
                        <xsl:choose>
                            <xsl:when test="$mod_tip='add'">
                                Alta Barrio Privado	
                            </xsl:when>
                            <xsl:otherwise>Edicion Barrio Privado</xsl:otherwise>
                        </xsl:choose>
                    </h1>
                </td>
            </tr>
            <table width="100%" border="0" cellpadding="1" cellspacing="1" class="tableOscura" id="tablaEditUsuarios">
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_comp_priv_div">Tipo:</div>
                    </td>
                    <td>
                        <select name="bar_comp_priv" class="inputForm" onchange="cambiar_tipo(this)">
                            <xsl:for-each select="bar_priv/bar_comp_priv/option">
                                <xsl:choose>
                                    <xsl:when test="../selected = @value">
                                        <option value="{@value}" selected="selected">
                                            <xsl:value-of select="." disable-output-escaping="yes"/>
                                        </option>
                                    </xsl:when>
                                    <xsl:when test="$bar_comp_priv = @value">
                                        <option value="{@value}" selected="selected">
                                            <xsl:value-of select="." disable-output-escaping="yes"/>
                                        </option>
                                    </xsl:when>
                                    <xsl:otherwise>
                                        <option value="{@value}">
                                            <xsl:value-of select="." disable-output-escaping="yes"/>
                                        </option>
                                    </xsl:otherwise>
                                </xsl:choose>
                            </xsl:for-each>
                			
                        </select>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="pro_id_div">
                            <strong>Provincias:*</strong>
                        </div>
                    </td>
                    <td>
                        <span id="div_pro_id">
                            <select name="pro_id" id="pro_id" onchange="act_select('loc_id,loc_desc','localidades','pro_id='+this.value,'loc_id','','php/funciones','loc_desc');" class="inputForm" >
                                <xsl:for-each select="bar_priv/provincias/option">
                                    <xsl:choose>
                                        <xsl:when test="../selected = @value">
                                            <option value="{@value}" selected="selected">
                                                <xsl:value-of select="." disable-output-escaping="yes"/>
                                            </option>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <option value="{@value}">
                                                <xsl:value-of select="." disable-output-escaping="yes"/>
                                            </option>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </xsl:for-each>
                            </select>
                        </span>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td width="20%" >
                        <div align="right" id="loc_id_div">
                            <strong>Localidades:*</strong>
                        </div>
                    </td>
                    <td width="30%" >
                        <span id="div_loc_id">
                            <select name="loc_id" id="loc_id" onchange="" class="inputForm" >
                                <xsl:for-each select="bar_priv/localidades/option">
                                    <xsl:choose>
                                        <xsl:when test="../selected = @value">
                                            <option value="{@value}" selected="selected">
                                                <xsl:value-of select="." disable-output-escaping="yes"/>
                                            </option>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <option value="{@value}">
                                                <xsl:value-of select="." disable-output-escaping="yes"/>
                                            </option>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </xsl:for-each>
                            </select>
                        </span>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_zona_div">Zona:</div>
                    </td>
                    <td>
                        <input name="bar_zona" type="text" class="inputForm"  value="{bar_priv/bar_zona}"/>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_dir_div">Domicilio:*</div>
                    </td>
                    <td>
                        <input name="bar_dir" id="prp_dom" type="text" class="inputForm"  value="{bar_priv/bar_dir}"/>
                    </td>
                </tr>
                 <tr class="tableClara">
                     <td valign="middle" align="right">
                         <a href="javascript:window.parent.window.ventana('prp_mapa', '&amp;pro_id='+document.getElementById('pro_id').options[document.getElementById('pro_id').selectedIndex].value+'&amp;loc_id='+document.getElementById('loc_id').options[document.getElementById('loc_id').selectedIndex].value+'&amp;prp_dom='+document.getElementById('prp_dom').value+'&amp;prp_lat='+document.getElementById('lat').value+'&amp;prp_lng='+document.getElementById('lng').value+'&amp;win_prp={$win_prp}', './system/map.php', 'Agregar a mapa')" class="aNulo" >
                             <img src="../interfaz/inmohost/images/iconos/32/mapa.png" width="32" height="32" />
                         </a> 
                     </td>
                     <td valign="middle">
                         <table width="100%">
                             <tr>
                                 <td><b><a id="agregar_en_mapa" href="javascript:window.parent.window.ventana('prp_mapa', '&amp;pro_id='+document.getElementById('pro_id').options[document.getElementById('pro_id').selectedIndex].value+'&amp;loc_id='+document.getElementById('loc_id').options[document.getElementById('loc_id').selectedIndex].value+'&amp;prp_dom='+document.getElementById('prp_dom').value+'&amp;prp_lat='+document.getElementById('lat').value+'&amp;prp_lng='+document.getElementById('lng').value+'&amp;win_prp={$win_prp}', './system/map.php', 'Agregar a mapa')" class="aNulo" >Agregar domicilio en mapa</a></b></td>
                                 <td>
                                     <table style="float: right">
                                         <tr><td>Latitud:</td><td><input type="text" id="lat" size="10" readonly="true" name="bar_lat" value="{bar_priv/bar_lat}" /></td></tr>
                                         <tr><td>Longitud:</td><td><input type="text" id="lng" size="10" readonly="true" name="bar_lng" value="{bar_priv/bar_lng}" /></td></tr>
                                         <tr><td><a href='#' id='limpiar_latitudes' title='limpiar' alt='limpiar'>[X]</a></td></tr>
                                     </table>
                                </td>
                             </tr>
                         </table>
                     </td>
                 </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_titulo_publicidad_div">Titulo Publicidad:</div>
                    </td>
                    <td>
                        <select name="bar_titulo_publicidad" onchange="" class="inputForm" >
                            <xsl:for-each select="bar_priv/bar_titulo_publicidad/option">
                                <xsl:choose>
                                    <xsl:when test="../selected = @value">
                                        <option value="{@value}" selected="selected">
                                            <xsl:value-of select="." disable-output-escaping="yes"/>
                                        </option>
                                    </xsl:when>
                                    <xsl:otherwise>
                                        <option value="{@value}">
                                            <xsl:value-of select="." disable-output-escaping="yes"/>
                                        </option>
                                    </xsl:otherwise>
                                </xsl:choose>
                            </xsl:for-each>
                        </select>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_denom_div">Denominación:*</div>
                    </td>
                    <td>
                        <input name="bar_denom" type="text" class="inputForm"  value="{bar_priv/bar_denom}"/>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_cont_div">Contacto:</div>
                    </td>
                    <td>
                        <input name="bar_cont" type="text" class="inputForm"  value="{bar_priv/bar_cont}"/>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_tel_div">Teléfono:*</div>
                    </td>
                    <td>
                        <input name="bar_tel" type="text" class="inputForm"  value="{bar_priv/bar_tel}"/>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_mail_div">Mail:*</div>
                    </td>
                    <td>
                        <input name="bar_mail" type="text" class="inputForm"  value="{bar_priv/bar_mail}"/>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_desc_div">Descripción:</div>
                    </td>
                    <td>
                        <textarea id="bar_desc" name="bar_desc" type="text" cols="50" rows="5" class="inputForm" >
                            <xsl:value-of select="bar_priv/bar_desc"  disable-output-escaping="yes"/>&#160; 
                        </textarea>
                    </td>
                </tr>
                <tr class="tr1">
                    <td colspan="2" >
                        <h1>&nbsp;&nbsp;&nbsp;&nbsp;Servicios:</h1>
                    </td>
                </tr>
                <xsl:if test="servicios != ''">
                    <tr class="tableClara">
                        <td colspan="2" >
                            <xsl:value-of select="servicios"/>
                        </td>
                    </tr>
                </xsl:if>
                <tr class="tableClara">
                    <td valign="top" style="width: 50%">
                        <div style="display:block">
                            <xsl:for-each select="bar_priv/servicios/serv">
                                <xsl:variable name="modulo" select="(position()-1) mod 2" />
                                <xsl:if test="$modulo = 0">
                                    <div style="height:25px; border-bottom:#CCCCCC 1px solid; padding-right:10px; padding-top:3px;" align="right" >
                                        <div id="servicios[{serv_name}]_div" style='width:150px;float:left;text-align:right;'>
                                            <xsl:value-of select="serv_desc"/>
                                        </div>
                                        <xsl:choose>
                                            <xsl:when test="serv_type='text'">:&nbsp;
                                                <input type='{serv_type}' name='servicios[{serv_name}]' value='{serv_valor}' style="width:75px;"  class="inputForm" tabindex="{position()+15}"/>	
                                                <input type="hidden" name="ser_id0" value="2" />              
                                            </xsl:when>
                                            <xsl:when test="serv_type='select'">:&nbsp;
                                                <select name='servicios[{serv_name}]' class="inputForm" tabindex="{position()+16}"/>
                                                <xsl:for-each select="serv_opciones/opcion">
                                                    <xsl:if test="@selected = '1'">
                                                        <option value='{.}' selected="selected">
                                                            <xsl:value-of select="."/>
                                                        </option>
                                                    </xsl:if>
                                                    <xsl:if test="@selected = '0'">
                                                        <option value='{.}'>
                                                            <xsl:value-of select="."/>
                                                        </option>
                                                    </xsl:if>
                                                </xsl:for-each>
                                                <input type="hidden" name="ser_id0" value="2" />   
                                                <span id='destacado2'></span>           
                                            </xsl:when>
							
                                            <xsl:when test="serv_type='checkbox'">:&nbsp;
                                                <input type='{serv_type}' name='servicios[{serv_name}]' value='{serv_valor}' style="width:100px;"  class="inputForm" tabindex="{position()+16}"/>	
                                                <input type="hidden" name="ser_id0" value="2" />              
                                            </xsl:when>
                                        </xsl:choose>
                                        <br/>
                                    </div>
                                </xsl:if>
                            </xsl:for-each>
                        </div>				
                    </td>	
                    <td valign="top" style="width: 50%">
                        <div style="display:block">
                            <xsl:for-each select="bar_priv/servicios/serv">
                                <xsl:variable name="modulo" select="(position()-1) mod 2" />
                                <xsl:if test="$modulo = 1">
                                    <div style="height:25px; border-bottom:#CCCCCC 1px solid; padding-left:10px; padding-top:3px;" align="left" >
                                        <div id="servicios[{serv_name}]_div" style="float:left"><xsl:value-of select="serv_desc"/>:</div>&nbsp;
                                        <xsl:choose>
                                            <xsl:when test="serv_type='text'">
                                                <input type='{serv_type}' name='servicios[{serv_name}]' value='{serv_valor}' style="width:75px;" class="inputForm" tabindex="{position()+16}" />	
                                                <input type="hidden" name="ser_id0" value="2" />              
                                            </xsl:when>
                                            <xsl:when test="serv_type='select'">
                                                <select name='servicios[{serv_name}]' class="inputForm" tabindex="{position()+16}"/>
                                                <xsl:for-each select="serv_opciones/opcion">
                                                    <xsl:if test="@selected = '1'">
                                                        <option value='{.}' selected="selected">
                                                            <xsl:value-of select="."/>
                                                        </option>
                                                    </xsl:if>
                                                    <xsl:if test="@selected = '0'">
                                                        <option value='{.}'>
                                                            <xsl:value-of select="."/>
                                                        </option>
                                                    </xsl:if>
                                                </xsl:for-each>
                                                <input type="hidden" name="ser_id0" value="2" />              
                                            </xsl:when>
                                            <xsl:when test="serv_type='checkbox'">
                                                <input type='{serv_type}' name='servicios[{serv_name}]' value='{serv_valor}' style="width:100px;" class="inputForm" tabindex="{position()+16}"/>	
                                                <input type="hidden" name="ser_id0" value="2" />              
                                            </xsl:when>
                                        </xsl:choose>
                                        <br/>
                                    </div>
                                </xsl:if>
                            </xsl:for-each>
                        </div>				
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_url_div">Pag. Web (URL):</div>
                    </td>
                    <td>
                        <input name="bar_url" type="text" class="inputForm" style="width:95%" value="{bar_priv/bar_url}"/>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_video_div">Url Video:</div>
                    </td>
                    <td>
                        <input id="bar_video" name="bar_video" type="text" class="inputForm" style="width:95%" value="{bar_priv/bar_video}" />
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_reglamento_div">Reglamento:</div>
                    </td>
                    <td>
                        <textarea  id="bar_reglamento" name="bar_reglamento" type="text" cols="50" rows="5" class="inputForm">
                            <xsl:value-of select="bar_priv/bar_reglamento"  disable-output-escaping="yes"/>&#160; 
                        </textarea>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_reglamento_archivo_div">Reglamento (Subir archivo):</div>
                    </td>
                    <td>
                        <input name="bar_reglamento_archivo" type="file" class="inputForm" />
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_logo_div">Logo:</div>
                    </td>
                    <td>
                        <input name="bar_logo" type="file" class="inputForm" />
                    </td>
                </tr>
                <!-- FOTOS -->
                <tr>
                    <td colspan='4'></td>
                </tr>
                <!-- FOTOS -->
                <input type="hidden" name="vect_fotos" value="x1x2x3x4x5x6x7x8x9x10x11x12x13x14x15" />
                <input type="hidden" name="cant_fotos" value="15" />
            </table>
            <tr class="tableClara" height="32">
                <td colspan="2" >
                    
                </td>
            </tr>
        </table>
    </xsl:template>
</xsl:stylesheet> 