<?xml version="1.0" encoding="iso-8859-1"?><!-- DWXMLSource="http://localhost/inmohostV2.0/system/datos/control_bar_priv.xml.php?bar_id=1&mod_tip=edit" -->
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
    <xsl:param name="mod_tip" />
    <xsl:param name="nomVentana" />
    <xsl:param name="bar_id" />
    <xsl:param name="fileEdit" />
    <xsl:param name="rutaSystem" />
    <xsl:param name="rutaAbsoluta" />
    <xsl:template match="/">
        <table width="100%" height="100%" border="0" cellpadding="1" cellspacing="1" class="tableOscura">
            <tr class="tableClara">
                <td width="150%" colspan="2">
                    <h1 align="left">Detalle Barrio Privado</h1>
                </td>
            </tr>
            <table width="100%" border="0" cellpadding="1" cellspacing="1" class="tableOscura" id="tablaEditUsuarios">
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_comp_priv_div">Tipo:</div>
                    </td>
                    <td>
                        <div align="center">
                            <xsl:value-of select="bar_priv/bar_comp_priv_desc"/>
                        </div>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="pro_id_div">Provincia:</div>
                    </td>
                    <td>
                        <div align="center">
                            <xsl:value-of select="bar_priv/pro_desc"/>
                        </div>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td width="20%" >
                        <div align="right" id="loc_id_div">Localidad:</div>
                    </td>
                    <td width="30%">
                        <div align="center">
                            <xsl:value-of select="bar_priv/loc_desc"/>
                        </div>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_zona_div">Zona:</div>
                    </td>
                    <td>
                        <div align="center">
                            <xsl:value-of select="bar_priv/bar_zona"/>
                        </div>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_dir_div">Domicilio:</div>
                    </td>
                    <td>
                        <div align="center">
                            <xsl:value-of select="bar_priv/bar_dir"/>
                        </div>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_denom_div">Denominación:</div>
                    </td>
                    <td>
                        <div align="center">
                            <xsl:value-of select="bar_priv/bar_denom"/>
                        </div>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_cont_div">Contacto:</div>
                    </td>
                    <td>
                        <div align="center">
                            <xsl:value-of select="bar_priv/bar_cont"/>
                        </div>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_tel_div">Teléfono:</div>
                    </td>
                    <td>
                        <div align="center">
                            <xsl:value-of select="bar_priv/bar_tel"/>
                        </div>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_mail_div">Mail:</div>
                    </td>
                    <td>
                        <div align="center">
                            <xsl:value-of select="bar_priv/bar_mail"/>
                        </div>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_desc_div">Descripción:</div>
                    </td>
                    <td>
                        <div align="center">
                            <xsl:value-of select="bar_priv/bar_desc"/>
                        </div>
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
                                        <div id="{serv_name}_div" style='width:150px;float:left;text-align:right;'>
                                            <xsl:value-of select="serv_desc"/>
                                        </div>
                                        <xsl:choose>
                                            <xsl:when test="serv_type='text'">:&nbsp;
                                                <xsl:value-of select="bar_priv/bar_desc"/>	           
                                            </xsl:when>
                                            <xsl:when test="serv_type='select'">:&nbsp;
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
                                        <div id="{serv_name}_div" style="float:left"><xsl:value-of select="serv_desc"/>:</div>&nbsp;
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
                        <div align="center">
                            <xsl:value-of select="bar_priv/bar_url"/>
                        </div>
                    </td>
                </tr>
                <tr class="tableClara">
                    <td>
                        <div align="right" id="bar_logo_div">Logo:</div>
                    </td>
                    <td>
                        <div align="center">
                            <img src="extra/logos/{bar_priv/bar_logo}" alt="Logo" width="90px"/>
                        </div>
                    </td>
                </tr>
            </table>
            <tr class="tableClara" height="32">
                <td colspan="2" >
                    <div align="center">
                        <input name="Submit" type="button" class="botonForm" value="Cerrar" onclick="parent.Windows.close('bar_priv')" tabindex="27" />
                        <!--input name="Submit" type="button" class="botonForm" value="Modificar" onclick="location.href='../{$fileEdit}?mod_tip={$mod_tip}&amp;nomVentana={$nomVentana}&amp;bar_id={$bar_id}'" tabindex="27" /-->
                    </div>
                </td>
            </tr>
        </table>
    </xsl:template>
</xsl:stylesheet> 