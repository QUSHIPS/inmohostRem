<?xml version="1.0" encoding="iso-8859-1"?>
<!DOCTYPE xsl:stylesheet  [
  <!ENTITY nbsp   "&#160;">
  <!ENTITY nl      "&#xa;">
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
<xsl:param name="prp_fotosXML" />
<xsl:param name="mod_edit" />
<xsl:param name="mod_tip" />
<xsl:param name="prp_id" />
<xsl:param name="usr_id" />
<xsl:param name="usr_id_prp" />
<xsl:param name="usr_id_propiedad" />
<xsl:param name="datos_propietario" />
<xsl:param name="imp_foto" />
<xsl:param name="fileFicha" />
<xsl:param name="fileFichaEdit" />
<xsl:param name="fileFichaEstado" />
<xsl:param name="fileCita" />
<xsl:param name="fileBarPrivXML" />
<xsl:param name="fileBarPrivXSL" />
<xsl:param name="fileBarPrivPHP" />
<xsl:param name="fileExportar" />
<xsl:param name="filePropietario" />
<xsl:param name="display" />
<xsl:param name="border" />
<xsl:param name="rutaFotos" />
<xsl:param name="enviarMail" />
<xsl:param name="url_fotos_inmoclick" />

<xsl:template match="/">
<xsl:choose>

	<!-- EN EL CASO QUE NO ESTE LA PROPIEDAD -->
	<xsl:when test="XMLTEXTO/propiedad = 0">
		<div id="nulo">
		<div align="center"><br/>
		    <br/>
		  NO EXISTE EL INMUEBLE SOLICITADO
		  </div>
		</div>
	</xsl:when>

<xsl:otherwise>
  <!-- EN EL CASO QUE SI EXISTA LA PROPIEDAD -->

<xsl:if test="$mod_tip!='add'">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr class="tr1">
      <td width="20%"><div align="center">
        <h2><xsl:value-of select="XMLTEXTO/propiedad/usr_raz"/></h2>
      </div></td>
      <td width="25%"><div align="center">
        <h3>Publicación: <xsl:value-of select="XMLTEXTO/propiedad/prp_alta"/></h3>
      </div></td>
      <td width="25%">
        <h3 align="center">Modificación: <xsl:value-of select="XMLTEXTO/propiedad/prp_mod"/></h3>      </td>
    </tr>
  </table>
	<xsl:if test="$display = 'none'">
		 <table width="100%" border="0" cellpadding="0" cellspacing="0">
		 	<tr>
		 		<td><img src="http://www.inmoclick.com.ar/inmohost/logos/logo_{$usr_id_propiedad}.gif" width="100px"/> </td>
		 		<td><xsl:value-of select="XMLTEXTO/propiedad/usr_raz"/> - <xsl:value-of select="XMLTEXTO/propiedad/usr_dom"/> - <xsl:value-of select="XMLTEXTO/propiedad/usr_tel"/> - <xsl:value-of select="XMLTEXTO/propiedad/usr_mail"/> - <xsl:value-of select="XMLTEXTO/propiedad/web"/> </td>
		 	</tr>
		 </table>
	</xsl:if>
<table width="100%" border="0" cellpadding="1" cellspacing="1" class="tableOscura" style="margin-bottom:2px;" id="tablaMenu">
    <tr class="tableClara">
<xsl:if test="XMLTEXTO/propiedad/editCitas = '1'">
	<td width="10%">
      	<div id="div_ver_citas" style="display:{$display}">
	    	<p align="center"><a href="javascript:parent.ventana('agenda_citas', '&amp;prp_id={$prp_id}&amp;usr_id={$usr_id_prp}&amp;mod_edit=0', '{$fileCita}', 'Ver Citas');"  class="aNulo"><img src="../interfaz/inmohost/images/iconos/32/citas.png" width="32" height="32" /><br />
	      	Ver citas</a> </p>
	      </div>

	   </td>
</xsl:if>

        <xsl:choose>
         <xsl:when test="XMLTEXTO/propiedad/editPro = '1'">

                      <td width="10%">
                          <div align="center" id="div_ver_prop" style="display:{$display}">

                                                <a href="javascript:;" onclick="position(event); toolTip('{$filePropietario}&amp;inmo_id={XMLTEXTO/propiedad/usr_id}',this);"  class="aNulo"><img src="../interfaz/inmohost/images/iconos/32/propietario.png" width="32" height="32" /><br />
                                                    &nbsp;Propietario</a>
                          </div>
                      </td>
          </xsl:when>
          <xsl:otherwise>


                      <td width="10%">
                          <div align="center" id="div_ver_prop" style="display:{$display}">

                                                <a href="javascript:;" onclick="position(event); toolTip('{$filePropietario}&amp;inmo_id={XMLTEXTO/propiedad/usr_id}',this);"  class="aNulo"><img src="../interfaz/inmohost/images/iconos/32/propietario.png" width="32" height="32" /><br />
                                                    &nbsp;Inmobiliaria</a>
                          </div>
                      </td>



          </xsl:otherwise>


        </xsl:choose>
        <xsl:if test="XMLTEXTO/propiedad/editEstado = '1'">
                                <xsl:if test="$url_recomendar_facebook != '0'">
                                    <td width="10%">
                                        <div align="center" id="div_pano" style="display:{$display}">
                                           <div class="fb-like" data-href="{$url_recomendar_facebook}" data-width="100" data-layout="box_count" data-action="recommend" data-show-faces="false" data-send="true">
                                           </div>

                                        </div>
                                    </td>
                                </xsl:if>
                            </xsl:if>
<xsl:if test="XMLTEXTO/propiedad/editImprimir = '1'">
      <td width="10%">
 		<div align="center" id="div_imp" style="display:{$display}">
 		<xsl:choose>
 			<xsl:when test="XMLTEXTO/propiedad/fo_enl != '0-0-0.jpg'">
				<a href="javascript:confirm('Imprimir la ficha con la Foto?')?parent.ventana('ficha_imp', '&amp;imprimir=1&amp;imp_foto=1&amp;mod_edit=1&amp;prp_id={$prp_id}&amp;usr_inmohost={$usr_id}&amp;usr_id={XMLTEXTO/propiedad/usr_id}', 'system/prp_ficha.php', 'Vista Previa Impresion'):parent.ventana('ficha_imp', '&amp;mod_edit=1&amp;prp_id={$prp_id}&amp;usr_id={XMLTEXTO/propiedad/usr_id}&amp;imprimir=1', 'system/prp_ficha.php', 'Vista Previa Impresion')" title="Imprimir" class="aNulo">
				<img src="../interfaz/inmohost/images/iconos/32/imprimir.png" width="32" height="32" />

					<br />
					Imprimir
				</a>
			</xsl:when>
			<xsl:otherwise>
				<a href="javascript:parent.ventana('ficha_imp', '&amp;imprimir=1&amp;mod_edit=1&amp;prp_id={$prp_id}&amp;usr_inmohost={$usr_id}&amp;usr_id={XMLTEXTO/propiedad/usr_id}', 'system/prp_ficha.php', 'Vista Previa Impresion');" title="Imprimir" class="aNulo"><img src="../interfaz/inmohost/images/iconos/32/imprimir.png" width="32" height="32" />
				<img src="../interfaz/inmohost/images/iconos/32/imprimir.png" width="32" height="32" />

					<br/>
					Imprimir
				</a>
			</xsl:otherwise>
		</xsl:choose>

		</div>
	   <!-- 	<div align="center"><a href="javascript:parent.dialogos('alerta', '&amp;prp_id={$prp_id}&amp;usr_id={$usr_id}&amp;mod_edit=1', '{$fileExportar}', 'Exportar');" title="Imprimir" class="aNulo"><img src="../interfaz/inmohost/images/iconos/32/imprimir.png" width="32" height="32" /><br />
  &nbsp;Imprimir</a> </div>
  		-->
  </td>
</xsl:if>

<xsl:if test="XMLTEXTO/propiedad/editFicha = '1'">
      <td width="10%">
                 <xsl:choose>
 			<xsl:when test="$enviarMail != '0'">
                                <div align="center" id="div_video" style="display:{$display}"><a href="javascript:parent.ventana('env_mail', '&amp;prp_id={$prp_id}&amp;usr_id={$usr_id}&amp;tipo=enviar_ficha', 'system/send_mail.php', 'Enviar Ficha por Mail');" title="Enviar por E-Mail" class="aNulo" ><img src="../interfaz/inmohost/images/iconos/32/mail.png" width="32" height="32" /><br />
                                  Enviar por Mail</a>
                                </div>
			</xsl:when>
			<xsl:otherwise>
				<div align="center" id="div_video" style="display:{$display}"><a href="javascript:alert('Debe configurar su cuenta de Correo en el sistema para poder enviar la Ficha por E-Mail')" title="Enviar por E-Mail" class="aNulo" ><img src="../interfaz/inmohost/images/iconos/32/mail.png" width="32" height="32" /><br />
                                  Enviar por Mail</a>
                                </div>
			</xsl:otherwise>
		</xsl:choose>


	    
      </td>
</xsl:if>

<xsl:if test="XMLTEXTO/propiedad/editBarPriv != '' ">
      <td width="10%">
	    <div align="center" id="div_pano" style="display:{$display}"><a href="javascript:parent.ventana('bar_priv','&amp;fileXML={$fileBarPrivXML}?mod_tip=edit&amp;bar_id={XMLTEXTO/propiedad/editBarPriv}&amp;fileXSL={$fileBarPrivXSL}','{$fileBarPrivPHP}','Barrio Privado');" title="Barrio Privado"  class="aNulo"><img src="../interfaz/inmohost/images/iconos/32/barrios.png" width="32" height="32" /><br />
  &nbsp;Barrio Privado</a> </div></td>
</xsl:if>
    </tr>
  </table>
</xsl:if>

  <table width="100%" border="0" align="left" cellpadding="3" cellspacing="1" class="tableOscura">

    <tr class="tableClara">

        

                    <xsl:choose>
 			<xsl:when test="XMLTEXTO/propiedad/tiene_fotos = '1'">
                                <td width="750" height="600" align="center" valign="top" bgcolor="#EEEEEE" style="display:{$display}">
                                   <div id="gallery" class="ad-gallery">
                                          <div class="ad-image-wrapper">
                                              &#160;
                                          </div>
                                          <div class="ad-controls">
                                              &#160;
                                          </div>
                                          <div class="ad-nav">
                                              <div class="ad-thumbs">
                                                  <ul class="ad-thumb-list">
                                                      <xsl:for-each select="XMLTEXTO/propiedad/fotos/foto">

                                                        <li>
                                                            <a href="{$url_fotos_inmoclick}/image.php?width=640&amp;height=480&amp;cropratio=640:480&amp;image={fo_enl}">
                                                                <img src="{$url_fotos_inmoclick}/image.php?width=100&amp;height=100&amp;cropratio=640:480&amp;image={fo_enl}" alt="{fo_desc}" class="image1"/>
                                                            </a>
                                                        </li>    


                                                      </xsl:for-each> 
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  
                        </td>
			</xsl:when>
			<xsl:otherwise>
                            
			</xsl:otherwise>
		</xsl:choose>
            

                        


      <td valign="top">

        <table width="100%" border="{$border}" cellspacing="1" cellpadding="3" class="tableOscura">
          <tr class="tableClara">
          	<xsl:if test="$imp_foto=1">
		      	<xsl:if test="$display = 'none'">
					<xsl:if test="XMLTEXTO/propiedad/fo_enl != '0-0-0.jpg'">
						<td rowspan="10" valign="top"> <img src="http://www.inmoclick.com.ar/ftp_inmohost/fotos/{XMLTEXTO/propiedad/fo_enl}" width="150"/>  </td>
					</xsl:if>
				</xsl:if>
          	 </xsl:if>
          	<td colspan="2"><b>Referente del inmueble</b></td>
          </tr>
          <tr class="tableClara">
          	<td align="center">
          		<xsl:choose>
	          		<xsl:when test="XMLTEXTO/propiedad/referente/fotos > 0">
	          			<img src="{$rutaFotos}fotos/{XMLTEXTO/propiedad/referente/foto}" width="70px"/>
	          		</xsl:when>
		          	<xsl:otherwise>
		          			Sin Foto
		          	</xsl:otherwise>
				</xsl:choose>
          	</td>
          	<td> Referente:<xsl:value-of select="XMLTEXTO/propiedad/referente/nombre"/><br/>
          		 Telefono:<xsl:value-of select="XMLTEXTO/propiedad/referente/telefono"/><br/>
          		 E-mail:<xsl:value-of select="XMLTEXTO/propiedad/referente/email"/>
            </td>
          </tr>
           <tr class="tableClara">
          	<td colspan="2"><b>Inmueble</b></td>
          </tr>
          <tr class="tableClara">
            <td><strong>ID: </strong> &nbsp;<xsl:value-of select="XMLTEXTO/propiedad/prp_id"/></td>
                  <td><strong>Precio: </strong>
                    <xsl:if test="XMLTEXTO/propiedad/prp_pre != 0">
                      $<xsl:value-of select="XMLTEXTO/propiedad/prp_pre"/>
                    </xsl:if>
                    <xsl:if test="XMLTEXTO/propiedad/prp_pre != 0 and XMLTEXTO/propiedad/prp_pre_dol != 0">
                      &nbsp;||&nbsp;
                    </xsl:if>
                    <xsl:if test="XMLTEXTO/propiedad/prp_pre_dol != 0">
                      u$s<xsl:value-of select="XMLTEXTO/propiedad/prp_pre_dol"/>
                    </xsl:if>
                 </td>


                </tr>
            <tr class="tableClara">
         		<td colspan="2"><strong>Precio Tasacion: </strong> &nbsp;<xsl:value-of select="XMLTEXTO/propiedad/pre_inmo" disable-output-escaping="yes"/></td>
             </tr>
          <tr class="tableClara">
            <td width="50%">
              <strong>Inmueble: </strong> &nbsp;<xsl:value-of select="XMLTEXTO/propiedad/tip_desc"/>		        </td>
                  <td width="50%"><strong>Cartel: </strong> &nbsp;<xsl:value-of select="XMLTEXTO/propiedad/prp_cartel"/></td>
                </tr>
          <tr class="tableClara">
            <td><strong>Condición: </strong> &nbsp;<xsl:value-of select="XMLTEXTO/propiedad/con_desc"/></td>
                  <td><strong>Llave: </strong> &nbsp;<xsl:value-of select="XMLTEXTO/propiedad/prp_llave"/></td>
                </tr>

          <tr class="tableClara">
            <td colspan="2"><strong>Domicilio: </strong> &nbsp;<xsl:value-of select="XMLTEXTO/propiedad/prp_dom"/> - <xsl:value-of select="XMLTEXTO/propiedad/prp_bar"/></td>
                </tr>
          <tr class="tableClara">
            <td><strong>Localidad: </strong> &nbsp;<xsl:value-of select="XMLTEXTO/propiedad/loc_desc"/></td>
                  <td><strong>Provincia: </strong> &nbsp;<xsl:value-of select="XMLTEXTO/propiedad/pro_desc"/></td>
                </tr>

          <xsl:if test="XMLTEXTO/propiedad/prp_servicios != ''">
            <tr class="tableClara">
              <td colspan="2"><strong>Servicios: </strong>&nbsp;<xsl:value-of select="XMLTEXTO/propiedad/prp_servicios" disable-output-escaping="yes"/>                </td>
                </tr>
            </xsl:if>

          <tr class="tableClara">
            <td valign="top">
              <xsl:for-each select="XMLTEXTO/propiedad/servicios/serv">
                <xsl:variable name="modulo" select="(position()-1) mod 2" />
                <xsl:if test="$modulo = 0">
                  <strong><xsl:value-of select="serv_desc"/>: </strong> &nbsp;<xsl:value-of select="serv_valor"/><br />
                  </xsl:if>
                </xsl:for-each>              </td>
                  <td valign="top">
                    <xsl:for-each select="XMLTEXTO/propiedad/servicios/serv">
                      <xsl:variable name="modulo" select="(position()-1) mod 2" />
                      <xsl:if test="$modulo = 1">
                        <strong><xsl:value-of select="serv_desc"/>: </strong> &nbsp;<xsl:value-of select="serv_valor"/><br />
                      </xsl:if>
                    </xsl:for-each>                  </td>
               </tr>

          <xsl:if test="XMLTEXTO/propiedad/prp_nota != ''">

            <tr class="tableClara">
              <td colspan="2">
              		<strong>Nota: </strong> &nbsp;<xsl:value-of select="XMLTEXTO/propiedad/prp_nota" disable-output-escaping="yes"/></td>
             </tr>

            </xsl:if>
          </table>
          <tr class="tableClara">
              <td colspan="2">
              		<strong>Descripcion: </strong> &nbsp;<xsl:value-of select="XMLTEXTO/propiedad/prp_desc" disable-output-escaping="yes" /></td>
             </tr>
        </td>
      </tr>
 </table>

<!-- FIN PROPIEDAD -->
    </xsl:otherwise>
</xsl:choose>

</xsl:template>
</xsl:stylesheet> 