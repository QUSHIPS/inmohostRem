<?xml version="1.0" encoding="iso-8859-1"?><!-- DWXMLSource="http://atilio/inmohostV2.0/system/datos/send_mail.xml.php?&chequea=dom,1,prp_id,1&tipoForm=buscar&orden=1&usr_id=886&mod_tip=edit&mod_edit=1&usr_id=886&usr_id=908&tip_id=0&con_id=0&pes_ent=&pes_y=&dol_ent=&dol_y=&dom=&prp_inmoID=908&prp_id=1" -->
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
  <!ENTITY ntilde "&#208;">
  <!ENTITY Ntilde "&#209;">
]>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="iso-8859-1"/>

<xsl:param name="dem_id" />
<xsl:param name="mod_tip" />
<xsl:param name="fileABM" />
<xsl:param name="demandas_mensajes" />
<xsl:template match="/">

  <!-- ARMO EL FORMULARIO DE ENVÍO -->
  <form id="agendaDemandaAgregar" name="agendaDemandaAgregar" method="post" style="height:100%" action="{$demandas_mensajes}">
	<input type="hidden" name="mod_tip" value="{$mod_tip}"/>
	<input type="hidden" name="dem_id" value="{XMLTEXTO/datos/dem_id}"/>
	<input type="hidden" name="otro" value="22"/>
  <table width="100%" height="100%" border="0" cellpadding="1" cellspacing="1" class="tableOscura">
        <tr class="tableClara">
          <td width="150%" colspan="5">
            <h1 align="left">Pedidos</h1>
			<hr />			</td>
          </tr>
		<tr>
		  <td colspan="5">
		<table width="100%" border="0" cellpadding="1" cellspacing="1" class="tableClara" id="tablaListarDemandas" >
               <tr class="tableClara">
		          <td width="150%" colspan="5">
		            <h1 align="left">Datos del interesado</h1>
					
					</td>
                  </tr>
                  <tr class="tableClara">
	                <td><div id="dem_raz_div" align="right">Nombre:</div></td>
	                <td><input type="text" name="dem_raz" size="15" value="{XMLTEXTO/datos/dem_raz}" /></td>
              	</tr>
              	 <tr class="tableClara">
	                <td><div id="dem_tel_div" align="right">Telefono:</div></td>
	                <td><input type="text" name="dem_tel" size="15" value="{XMLTEXTO/datos/dem_tel}" /></td>
              	</tr>
              	<tr class="tableClara">
	                <td><div id="dem_mail_div" align="right">E-Mail:</div></td>
	                <td><input type="text" name="dem_mail" size="15" value="{XMLTEXTO/datos/dem_mail}" /></td>
              	</tr>
                <tr class="tableClara">
		          <td width="150%" colspan="5">
		            <h1 align="left">Datos del Pedido</h1>
					<hr/>
					</td>
                  </tr>


              <tr class="tableClara">
                <td><div align="right" id="pro_id_div">Provincia:</div></td>
                <td><span id="div_pro_id">
                    <select name="pro_id" class="inputForm" id="pro_id"  onchange="act_select('loc_id,loc_desc','localidades','pro_id='+this.value,'loc_id',' multiple size=3 ','php/funciones','loc_desc');" >
					<xsl:for-each select="XMLTEXTO/datos/provincias/option">
						<xsl:choose>
							<xsl:when test="../selected = @value">
							 <option value="{@value}" selected="selected"><xsl:value-of select="." disable-output-escaping="yes"/></option>
						  </xsl:when>
						  <xsl:otherwise>
							 <option value="{@value}"><xsl:value-of select="." disable-output-escaping="yes"/></option>
						  </xsl:otherwise>
						</xsl:choose>
		          </xsl:for-each>
                    </select>
                    </span></td>
              </tr>
              <tr class="tableClara">
                <td><div align="right" id="aux_loc_id_div">Localidad:</div></td>
                <td ><span id="div_loc_id">
                		<select size="3" name="loc_id[]" class="inputForm" id="loc_id"  multiple="true">
							<xsl:for-each select="XMLTEXTO/datos/localidades/option">
									 <option value="{@value}"><xsl:value-of select="." disable-output-escaping="yes"/></option>
					      	</xsl:for-each>
               			</select>
               		</span>	
                </td>
                <td>
                <input name="quitar" type="button" class="botonForm" id="quitar"  value=" &#60;&#60; Quitar  &#160;&#160; " onclick="quitar_item_select('aux_loc_id','agendaDemandaAgregar');" />&#160;
                <input name="agregar" type="button" class="botonForm" id="agregar"  value="Agregar &#62;&#62;" onclick="agregar_item_select('loc_id','aux_loc_id','agendaDemandaAgregar');" />
                </td>
                <td>
                		<select size="3" name="aux_loc_id[]" class="inputForm" id="aux_loc_id"  multiple="true">
							<xsl:for-each select="XMLTEXTO/datos/localidades/option">
								<xsl:choose>
									<xsl:when test="../selected = @value">
									 <option value="{@value}" selected="selected"><xsl:value-of select="." disable-output-escaping="yes"/></option>
								  </xsl:when>
							</xsl:choose>
					      </xsl:for-each>
               			</select>
                </td>
              </tr>
              
              
              <tr class="tableClara">
                <td><div align="right" id="aux_tip_id_div">Tipo de Cons.:</div></td>
                <td><span id="div_tip_id">
                	<select size="3" name="tip_id[]" class="inputForm" id="tip_id"  multiple="true">
						<xsl:for-each select="XMLTEXTO/datos/tipoCons/option">
							<option value="{@value}"><xsl:value-of select="." disable-output-escaping="yes"/></option>
						</xsl:for-each>							
                	</select></span></td>
                <td>
                <input name="quitar" type="button" class="botonForm" id="quitar"  value=" &#60;&#60; Quitar  &#160;&#160; " onclick="quitar_item_select('aux_tip_id','agendaDemandaAgregar');" />&#160;
                <input name="agregar" type="button" class="botonForm" id="agregar"  value="Agregar &#62;&#62;" onclick="agregar_item_select('tip_id','aux_tip_id','agendaDemandaAgregar');" />
                </td>
                <td>
                	<select  multiple="true" size="3" name="aux_tip_id[]" class="inputForm" id="aux_tip_id"  >
						<xsl:for-each select="XMLTEXTO/datos/tipoCons/option">
						<xsl:choose>
							  <xsl:when test="../selected = @value">
								 <option value="{@value}" selected="selected"><xsl:value-of select="." disable-output-escaping="yes"/></option>
							  </xsl:when>
						</xsl:choose> 
			          </xsl:for-each>                		
					</select>
				</td>

              </tr>
              
              <tr class="tableClara">
                <td><div align="right" id="aux_con_id_div">Condici&#243;n:</div></td>
                <td><span id="div_con_id">
                	<select  size="3" name="con_id[]" class="inputForm" id="con_id" >
						<xsl:for-each select="XMLTEXTO/datos/tipoCond/option">
							<option value="{@value}"><xsl:value-of select="." disable-output-escaping="yes"/></option>
			          	</xsl:for-each>
                	</select></span>
                </td>
              	<td>
                <input name="quitar" type="button" class="botonForm" id="quitar"  value=" &#60;&#60; Quitar  &#160;&#160; " onclick="quitar_item_select('aux_con_id','agendaDemandaAgregar');" />&#160;
                <input name="agregar" type="button" class="botonForm" id="agregar"  value="Agregar &#62;&#62;" onclick="agregar_item_select('con_id','aux_con_id','agendaDemandaAgregar');" />
              	</td>  
              	<td>
              		<select  multiple="true" size="3" name="aux_con_id[]" class="inputForm" id="aux_con_id" >
						<xsl:for-each select="XMLTEXTO/datos/tipoCond/option">
						 <xsl:choose>
								<xsl:when test="../selected = @value">
								 <option value="{@value}" selected="selected"><xsl:value-of select="." disable-output-escaping="yes"/></option>
							  </xsl:when>
						</xsl:choose>
			          </xsl:for-each>              		
					</select>
				</td>  
              </tr>
              
              <tr class="tableClara">
                <td><div align="right">Domicilio/Barrio:</div></td>
                <td><span id="div_dem_nom"><input name="dem_dom" type="text" class="inputForm" id="prp_id2"  style="width:80px" value="{XMLTEXTO/datos/dem_dom}" /></span></td>
              </tr>
              
              <!--tr class="tableClara">
                <td><div align="right">Barrio:</div></td>
                <td><span id="div_dem_barr"><input name="dem_barr" type="text" class="inputForm" id="prp_id3"  style="width:80px" value="{XMLTEXTO/datos/dem_barr}"/></span></td>
              </tr-->
               <tr class="tableClara">
                <td><div align="right">Rango de Precio ($):</div></td>
                <td>
                    <span id="dem_pre_min_div"> </span>
                    <span id="div_dem_pre_min"><input name="dem_pre_min" type="text" class="inputForm" id="prp_id4"  style="width:50px" value="{XMLTEXTO/datos/dem_pre_min}"/></span>
                  <span id="dem_pre_max_div"> y </span>
                    <span id="div_dem_pre_max"><input name="dem_pre_max" type="text" class="inputForm" id="prp_id5" style="width:50px" value="{XMLTEXTO/datos/dem_pre_max}"/></span></td>
              </tr>
               <tr class="tableClara">
                <td><div align="right">Rango de Precio (U$S):</div></td>
                <td>
                    <span id="dem_pre_min_dol_div"> </span>
                    <span id="div_dem_pre_min_dol"><input name="dem_pre_min_dol" type="text" class="inputForm" id="prp_id4"  style="width:50px" value="{XMLTEXTO/datos/dem_pre_min_dol}"/></span>
                  y
                  <span id="dem_pre_max_dol_div"> </span>
                    <span id="div_dem_pre_max_dol"><input name="dem_pre_max_dol" type="text" class="inputForm" id="prp_id5"  style="width:50px" value="{XMLTEXTO/datos/dem_pre_max_dol}"/></span></td>
              </tr>
              <tr class="tableClara">
                <td><div align="right">Descripcion alternativa:</div></td>

                <td><span id="div_dem_desc"> <textarea name="dem_desc" rows="4"  cols="30" class="inputForm"><xsl:value-of select="XMLTEXTO/datos/dem_desc" disable-output-escaping="yes"/>&#160;</textarea></span></td>
              </tr>
                <tr><td colspan="2"></td>  </tr>
               <tr class="tableClara"> <td><div align="right"> <b>Servicios:</b> </div></td> <td> </td>  </tr>
               <tr class="tableClara">
                <td><div align="right">Cant. Habitaciones:</div></td>
                <td> Entre
                    <span id="dem_habitaciones_min_div"> </span>
                    <span id="div_dem_habitaciones_min"><input name="dem_habitaciones_min" type="text" size="7"  class="inputForm" value="{XMLTEXTO/datos/dem_habitaciones_min}"/> </span> y
                    <span id="dem_habitaciones_max_div"> </span>
                    <span id="div_dem_habitaciones_max"> <input name="dem_habitaciones_max"  size="7" class="inputForm" value="{XMLTEXTO/datos/dem_habitaciones_max}"/></span> </td>
              </tr>
              <tr class="tableClara">
                <td><div align="right">Cant. Baños:</div></td>
                <td>Entre
                <span id="dem_banos_min_div"> </span>
                <span id="div_dem_banos_min"><input name="dem_banos_min" type="text"  size="7" class="inputForm" value="{XMLTEXTO/datos/dem_banos_min}"/> </span>

                y
                <span id="dem_banos_max_div"> </span>
                <span id="div_dem_banos_max"><input name="dem_banos_max"  size="7" class="inputForm" value="{XMLTEXTO/datos/dem_banos_max}"/></span> </td>
              </tr>
              <tr class="tableClara">
                <td><div align="right">Sup. Total:</div></td>
                <td>Entre
                    <span id="dem_sup_total_min_div"> </span>
                <span id="div_dem_sup_total_min">
                    <input name="dem_sup_total_min"  type="text" size="7" class="inputForm" value="{XMLTEXTO/datos/dem_sup_total_min}"/> </span>
                    y
                  <span id="dem_sup_total_max_div"> </span>
                <span id="div_dem_sup_total_max">  
                    <input name="dem_sup_total_max"  size="7" class="inputForm" value="{XMLTEXTO/datos/dem_sup_total_max}"/>
                    </span>
                    </td>
              </tr>
              <tr class="tableClara">
                <td><div align="right">Sup. Cubierta:</div></td>
                <td>Entre
                <span id="dem_sup_cubierta_min_div"> </span>
                <span id="div_dem_sup_cubierta_min">
                <input name="dem_sup_cubierta_min" size="7"  class="inputForm" value="{XMLTEXTO/datos/dem_sup_cubierta_min}"/>
                </span>
                y
                <span id="dem_sup_cubierta_max_div"> </span>
                <span id="div_dem_sup_cubierta_max">  
                <input name="dem_sup_cubierta_max"  size="7" class="inputForm" value="{XMLTEXTO/datos/dem_sup_cubierta_max}"/>
                </span>
                </td>
              </tr>
              <tr class="tableClara">
                <td><div align="right">Cochera:</div></td>
                <td>
                       <select class="inputForm"  id="dem_cochera" name="dem_cochera">

                              <xsl:for-each select="XMLTEXTO/datos/cocheras/option">
                                <xsl:choose>
                                        <xsl:when test="../selected = @value">
                                         <option value="{@value}" selected="selected"><xsl:value-of select="." disable-output-escaping="yes"/></option>
                                  </xsl:when>
                                  <xsl:otherwise>
                                         <option value="{@value}"><xsl:value-of select="." disable-output-escaping="yes"/></option>
                                  </xsl:otherwise>
                                </xsl:choose>
                              </xsl:for-each>

                                
                       </select>
                </td>
              </tr>

              <tr class="tableClara">
		          <td width="150%" colspan="5">
		            <h1 align="left">Cruzar pedidos con:</h1>
					<hr />
					</td>
                  </tr>
                  <tr class="tableClara">
	                <td><div align="right">Inmobiliaria:</div></td>
	                <td>
                          <xsl:choose>
                                <xsl:when test="XMLTEXTO/datos/dem_inmobiliaria = 1">
                                 <input type="checkbox" name="dem_inmobiliaria"   value="1" checked="checked"/>
                          </xsl:when>
                          <xsl:otherwise>
                                 <input type="checkbox" name="dem_inmobiliaria"   value="1"/>
                          </xsl:otherwise>
                        </xsl:choose>




                            </td>
              	</tr>
              	 <tr class="tableClara">
	                <td><div align="right">Red de inmobiliarias(inmoclick)</div></td>
	                <td>
                            <xsl:choose>
                                <xsl:when test="XMLTEXTO/datos/dem_red_inmoclick = 1">
                                    <input type="checkbox" name="dem_red_inmoclick"  value="1" checked="checked"/>
                          </xsl:when>
                          <xsl:otherwise>
                                 <input type="checkbox" name="dem_red_inmoclick"  value="1" />
                          </xsl:otherwise>
                        </xsl:choose>


                            </td>
              	</tr>

               
				
              <tr class="tableClara">
                <td colspan="5"><div align="center">
                  <input name="listar2" type="button" class="botonForm" id="listar2"  value="Cerrar" onclick="parent.Windows.close('alt_dem')" />
                  &#160;&#160;
                  <input type="button" class="botonForm"  value="Aceptar" onclick="valida_formulario('dem_raz,1,Razon Social,dem_tel,1,Telefono,dem_mail,3,E-Mail,aux_loc_id,7,Localidad,aux_tip_id,7,Tipo de Construccion,aux_con_id,7,Condicion,dem_pre_min,5,Pecio Minimo,dem_pre_max,5,Precio Maximo,dem_pre_min_dol,5,Precio Minimo Dolares,dem_pre_max_dol,5,Precio Maximo Dolares,dem_habitaciones_min,5,Minimo Habitaciones,dem_habitaciones_max,5,Maximo Habitaciones,dem_banos_min,5,Minimo Banos,dem_banos_max,5,Maximo Banos,dem_sup_total_min,5,Sup. Total Minimo,dem_sup_total_max,5,Sup. Total Maximo,dem_sup_cubierta_min,5,Minimi Sup. Cubierta,dem_sup_cubierta_max,5,Maximo Sup. Cubierta','agendaDemandaAgregar');"/>
                  
                  
                </div></td>
                </tr>
				
             
          </table>
		
		  </td>
		  </tr>
        
      </table>
</form>

</xsl:template>
</xsl:stylesheet> 