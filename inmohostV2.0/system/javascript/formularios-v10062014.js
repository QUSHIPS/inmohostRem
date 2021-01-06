// JavaScript Document

// Funciones de Validacion
function valida_propiedad(a,form)
{
    var aux = '';
    if(document.getElementById(form).id=='prp_edit_form'){
        
        select_tip_id = document.getElementById('select_tip_id').options[document.getElementById('select_tip_id').selectedIndex].value;
        select_con_id = document.getElementById('select_con_id').options[document.getElementById('select_con_id').selectedIndex].value;

        switch(select_tip_id){
            
            case '1': 
            case '5': 
            case '7': 
            case '12': 
            case '21': 
            case '26': 
            case '30': 
            case '31': 
            case '32':
                aux +=',valor8,2,Cant. Ba&ntilde;os,valor3,2,Dormitorios,valor4,2,Cochera,valor2,1,Sup. Total m2,valor7,1,Sup. cubierta m2,valor2,9,10,valor7,9,10';
                if(select_con_id == 1){
                    aux += ',prp_pre,10,Precio';
                }else if(select_con_id == 2){
                    aux += ',prp_pre,11,Precio';
                }
                
                if(document.prp_edit_form.valor24){ //si tiene expensas
                        aux+=',valor24,14,Valor de expensas,valor25,5,Valor expensas';
                }
                
            break;
            case '6': case '24': case '25':
                aux +=',valor14,2,Agua,valor12,2,Luz Electrica,valor18,2,Cloacas,valor15,2,Gas,valor2,1,Sup. Total m2,valor2,9,10,valor27,5,Precio pesos por m2,valor28,5,Precio dolares por m2';
                
                if(document.prp_edit_form.valor24){ //si tiene expensas
                        aux+=',valor24,14,Valor de expensas,valor25,5,Valor expensas';
                }
                
                 if(select_con_id == 1){
                    aux +=',prp_pre,12,Precio,prp_pre_dol,15,Precio Dolares';
                 }
            break;
            case '4': 
                if(document.prp_edit_form.valor24){ //si tiene expensas
                        aux+=',valor24,14,Valor de expensas,valor25,5,Valor expensas';
                }
            break;
            case '3': case '16': 
                   aux +=',valor2,1,Sup. Total m2,valor2,9,10,valor27,5,Precio pesos por m2,valor28,5,Precio dolares por m2';
            break;
        }
    }
       a = a + aux;
//        alert(a)
	if (verif(a,form))
	{
                document.prp_edit_form.prp_pre.value = document.prp_edit_form.prp_pre.value.replace(/[^0-9]/g, "");
                document.prp_edit_form.prp_pre_dol.value = document.prp_edit_form.prp_pre_dol.value.replace(/[^0-9]/g, "");
		document.prp_edit_form.edited.value=1;
		chequeaForm('prp_edit_form', 'destino', 'titulo', 'url');
	}
	else
	{
		return 0;
	}
}


function valida_formulario(a,form)
{
	var str="document."+form+".submit()";
	if (verif(a,form))
	{
		eval(str);
	}
	else
	{
		return 0;
	}
}

function verif(a,form)
{
	error='';
	formu=a.split(',');
	for (i=1;i<formu.length;i+=3)
	{
		switch (formu[i])
		{
			case '1' :
				error += no_vacio(formu[i-1],formu[i+1],form);
				break;
			case '2' :
				error += selec(formu[i-1],formu[i+1],form);
				break;
			case '3' :	
				error += mail(formu[i-1],formu[i+1],form);
				break;
			case '4' :	
				error += check(formu[i-1],formu[i+1],form);
				break;
			case '5' :	
				error += numer(formu[i-1],formu[i+1],form);
				break;		
			case '6' :	
				error += selecmul(formu[i-1],formu[i+1],form);
				break;
			case '7' :	
				error += selecdin(formu[i-1],formu[i+1],form);
				break;
			case '8' :	
				error += titulo_aviso(formu[i-1],formu[i+1],form);
				break;
			case '9' :	
				error += mayor_que(formu[i-1],formu[i+1],form);
				break;
			case '10' :	
				error += precio_venta_casas(formu[i-1],formu[i+1],form);
				break;
			case '11' :	
				error += precio_alquiler_casas(formu[i-1],formu[i+1],form);
				break;
			case '12' :	
				error += precio_venta_lotes(formu[i-1],formu[i+1],form);
				break;
                        case '13':
                                error += validar_youtube(formu[i-1],formu[i+1],form);
                                break;       
                        case '14':
                                error += validar_expensas(formu[i-1],formu[i+1],form);
                                break;   
                        case '15' :	
				error += precio_venta_lotes_dolares(formu[i-1],formu[i+1],form);
				break;        
	
		}
	}
	if (error!='')
	{
		if(parent.Dialog){
			parent.Dialog.alert(error, {windowParameters: {className:'alert', width:400, height:200}});		
		}else{
			parent.parent.Dialog.alert(error, {windowParameters: {className:'alert', width:400, height:200}});
		}
		
		error='';
		return 0;
	}
	else
	{
		return 1;
	}
}

function no_vacio(a,b,form)
{
	cad ='document.'+form+'.'+a+'.value';
	lon =cad+'.length';
	if ((eval(lon))<1)
	{
		document.getElementById(a+'_div').className='destacado2';
		str='Ingrese algun valor en el campo ' + b +'<br>';
		return str;
	}
	else
	{
		if (document.getElementById(a+'_div').className=='destacado2')
		{
			document.getElementById(a+'_div').className='';
		}
		return '';		
	}
}	
function titulo_aviso(a,b,form)
{
	cad ='document.'+form+'.'+a+'.value';
        
        palabras=eval(cad+'.split(" ")');
        
        
        if(palabras.length>8){
            document.getElementById(a+'_div').className='destacado2';
		str='El titulo del aviso no puede tener mas de 8 palabras <br>';
		return str;
        }else{
            if (document.getElementById(a+'_div').className=='destacado2')
            {
		document.getElementById(a+'_div').className='';
            }
                return '';
        }
	
}	
function mayor_que(a,b,form)
{
	cad ='document.'+form+'.'+a+'.value';
        
                
        resultado=eval(cad+' < '+b);
        
        if(resultado){
            document.getElementById(a+'_div').className='destacado2';
		str='Ingrese un valor de superficie valido <br>';
		return str;
        }else{
            if (document.getElementById(a+'_div').className=='destacado2')
            {
		document.getElementById(a+'_div').className='';
            }
                return '';
        }
	
}	

function selec(a,b,form){
	cad ='document.'+form+'.'+a+'.selectedIndex'
	if ((eval(cad))==0)
	{
		document.getElementById(a+'_div').className='destacado2';
		return 'Debe seleccionar una opcion en el campo ' + b+'<br>';  	
	}
	else
	{
		if (document.getElementById(a+'_div').className=='destacado2')
		{
			document.getElementById(a+'_div').className='';
		}
		return '';		
	}
}

function selecmul(a,b,form){
	var i;
	var existe_seleccion=0;
	
	total=eval('document.'+form+'.'+a+'.options.length');
	
	for (i=0;i<total;i++){

			if (eval("document."+form+"."+a+".options["+i+"].selected")){
				existe_seleccion=1;
			}

	}
	if (!existe_seleccion)
	{
		document.getElementById(a+'_div').className='destacado2';
		return 'Debe seleccionar una opcion en el campo ' + b+'<br>';  	
	}
	else
	{
		if (document.getElementById(a+'_div').className=='destacado2')
		{
			document.getElementById(a+'_div').className='';
		}
		return '';		
	}
}

function selecdin(a,b,form){
	var i;
	var existe_seleccion=0;
	
	total=eval('document.'+form+'.'+a+'.options.length');

	for (i=0;i<total;i++){

			if (eval("document."+form+"."+a+".options["+i+"].text")){
				(eval("document."+form+"."+a+".options["+i+"].selected = 'TRUE'"));
				existe_seleccion=1;
			}

	}
	if (!existe_seleccion)
	{
		document.getElementById(a+'_div').className='destacado2';
		return 'Debe seleccionar una opcion en el campo ' + b+'<br>';  	
	}
	else
	{
		if (document.getElementById(a+'_div').className=='destacado2')
		{
			document.getElementById(a+'_div').className='';
		}
		return '';		
	}
}


function validarEmail(valor) {
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(valor)){
   alert("La dirección de email " + valor + " es correcta.");
  } else {
   alert("La dirección de email es incorrecta.");
  }
}

function validar_youtube(a,b,form){
    var url = document.getElementById(a).value;
    if(url){
        var patt_youtube = /youtube.com\/watch\?v=(.+)&?/;
        var matchs = patt_youtube.exec(url);
        if(matchs){
            var id = matchs[1];
            var invalid = 1;

            if(id){
                 $.ajax('http://gdata.youtube.com/feeds/api/videos/'+id,{
                    async: false,
                    complete: function(a){
                        if(a.status == 200){
                            invalid = 0;  
                        }
                    }
                });
                
                return invalid == 1 ? 'El video no es valido.' : '';
            }
        }else{
            return 'Direccion de video invalida.';
        }
    }else{
        return '';
    }
}


function validar_expensas(a,b,form){
    
    cad ='document.'+form+'.'+a+'.options['+ 'document.'+form+'.'+a + '.selectedIndex].value';
    
    var tiene_expensas = eval(cad);
    
    if(tiene_expensas == 'Si'){ //validar que ponga un valor
        return no_vacio('valor25',b,form);
    }else{
        cad ='document.'+form+'.valor25.value = ""';
        eval(cad);
        return '';
    }
    
}

function mail(a,b,form)
{
	cad ='document.'+form+'.'+a+'.value'
	//existe = cad+'.indexOf(".")'
        valor = eval(cad);
        filtro = /^[A-Za-z][A-Za-z0-9_.]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
        console.log(valor);
        if (!filtro.test(valor)){
		document.getElementById(a+'_div').className='destacado2';
		return 'Ingrese un e-Mail valido '+b+'<br>';	
	}
	else
	{
		if (document.getElementById(a+'_div').className=='destacado2')
		{
			document.getElementById(a+'_div').className='';
		}
		return '';		
	}
}	

function check(a,b,form)
{
	cad ='document.'+form+'.'+a+'.checked'
	if (!eval(cad))
	{
		document.getElementById(a+'_div').className='destacado2';
		return 'Debe seleccionar una opcion en el campo'+b+'<br>';
	}
	else
	{
		if (document.getElementById(a+'_div').className=='destacado2')
		{
			document.getElementById(a+'_div').className='';
		}
		return '';		
	}
}
function numer(a,b,form){	
	cad ='if(document.'+form+'["'+a+'"]) document.'+form+'["'+a+'"].value;';
	if (isNaN(eval(cad)))
	{
		if(document.getElementById(a+'_div')){
                    document.getElementById(a+'_div').className='destacado2';
                    return ' Debe Ingresar un valor numerico en el campo '+b;
                }else{
                    return '';
                }
	}
	else
	{
		if (document.getElementById(a+'_div').className=='destacado2')
		{
			document.getElementById(a+'_div').className='';
		}
		return '';
	}
}

function soloNumeros(evt){	
	// Backspace = 8, Enter = 13, '0' = 48, '9' = 57
	var nav4 = window.Event ? true : false;
	var key = nav4 ? evt.which : evt.keyCode;	
	if (key <= 13 || (key >= 48 && key <= 57)) return true;
	else return false;
}

function precio_venta_casas(a,b,form){
    
        var cad ='document.'+form+'.'+a+'.value';
        var valor =  eval(cad);
                
        if(valor != '' && valor!=0 && parseInt(valor) < parseInt(_PRECIO_VENTA_CASAS)){
            
                document.getElementById(a+'_div').className='destacado2';
		str='Ingrese un precio de venta valido <br/>';
		return str;
        }else{
            if (document.getElementById(a+'_div').className=='destacado2')
            {
		document.getElementById(a+'_div').className='';
            }
                return '';
        }
}
function precio_alquiler_casas(a,b,form){
    
        var cad ='document.'+form+'.'+a+'.value';
        var valor =  eval(cad);
                
        if(valor != '' && valor!=0 && parseInt(valor) < parseInt(_PRECIO_ALQUILER_CASAS)){
            
                document.getElementById(a+'_div').className='destacado2';
		str='Ingrese un precio de alquiler valido <br/>';
		return str;
        }else{
            if (document.getElementById(a+'_div').className=='destacado2')
            {
		document.getElementById(a+'_div').className='';
            }
                return '';
        }
}
function precio_venta_lotes(a,b,form){
    
        var cad ='document.'+form+'.'+a+'.value';
        var valor =  eval(cad);
                
        if(valor != '' && valor!=0 && parseInt(valor) < parseInt(5000)){
            
                document.getElementById(a+'_div').className='destacado2';
		str='Ingrese un precio de venta valido <br/>';
		return str;
        }else{
            if (document.getElementById(a+'_div').className=='destacado2')
            {
		document.getElementById(a+'_div').className='';
            }
                return '';
        }
}

function precio_venta_lotes_dolares(a,b,form){
    
        var cad ='document.'+form+'.'+a+'.value';
        var valor =  eval(cad);
                
        
        if(valor != '' && valor!=0 && parseInt(valor) < parseInt(1000)){
            
                document.getElementById(a+'_div').className='destacado2';
		str='Ingrese un precio de venta en dolares valido <br/>';
		return str;
        }else{
            if (document.getElementById(a+'_div').className=='destacado2')
            {
		document.getElementById(a+'_div').className='';
            }
                return '';
        }
}

function soloNumerosVar(Var){	
	// Backspace = 8, Enter = 13, '0' = 48, '9' = 57
	if (Number(Var)) return true;
	else return false;
}

function chequeaForm(form, destino, titulo, url, parametros){
//form Number=>formulario a chequear
//titulo String=>Titulo ventana de destino
//url String=>archivo de destino
//parametros String=>cadena con todos los valores del formulario

	var totalElementos = document.getElementById(form).elements.length;
	var tipo;
	var elemento;
	var query="";
	var pes_ent;
	var pes_y;
	var dol_ent;
	var dol_y;
	
	for(i=0; i<totalElementos; i++){

	
		elemento = document.getElementById(form).elements[i];
		tipo = elemento.type;
		
		if(tipo=="hidden" || tipo=="text"){
			query += "&"+elemento.name+"="+elemento.value;
		} else if(tipo=="select-one"){
			query += "&"+elemento.name+"="+elemento.options[elemento.selectedIndex].value;
		} else if(tipo=="select-multiple"){
			k=0;
			for(j=0;j<elemento.options.length;j++){
				if(elemento.options[j].selected){
					query += "&"+elemento.name+"["+k+"]"+"="+elemento.options[j].value;
					k++;
				}
			}
			
		} else if(tipo=="checkbox"){
			query += "&"+elemento.name+"="+elemento.checked;
		} else {
			//alert(tipo);
		}
		
		if(elemento.name=="pes_ent"){
			pes_ent=elemento.value;
		}
		
		if(elemento.name=="pes_y"){
			pes_y=elemento.value;
		}
		
		if(elemento.name=="dol_ent"){
			dol_ent=elemento.value;
		}
		
		if(elemento.name=="dol_y"){
			dol_y=elemento.value;
		}
	}
	switch(parametros) 
    {
    	case 'mod_edit':
    			query += "&mod_edit="+parametros;
    			ventana(destino, query, url, titulo);
				display('menuPrincipal');
		break;
		case 'mod_inf':
				parent.ventana(destino, query, url, titulo);
		break;
		case 'mod_del':
		case 'mod_search':
			//verifica que los campos "entre" y "y" sean correctos para pesos y dolares
			res_pes=verifEntreY(pes_ent,pes_y,"Precio ($)");
			res_dol=verifEntreY(dol_ent,dol_y,"Precio (U$S)");
			if(res_pes==""&&res_dol==""){

				query += "&mod_edit="+parametros;
				ventana(destino, query, url, titulo);
				if(form!="prpFormBuscarRapido"){
					display('menuPrincipal');
				}	
			}else if(res_pes){
					alert(res_pes);			
			}else
			{
					alert(res_dol);			
			}	
		break;
		// Por defecto el se submitea el formulario para que se recargue en la misma pagina
		case 'ventana':
    			ventana(destino, query, url, titulo);
				display('menuPrincipal');
		break;
		default:
			//alert(parametros);
			if(form=='prp_edit_form'){
				muestra_progreso();
			}
			
			document.getElementById(form).submit();
		break;
		return false;
    }//switch
}

/*##############################################################################
				EDICCION DE FORMULARIOS
 ##############################################################################*/

function editForm_campo(id){

	var id_objet = id;

		if (document.getElementById("edit_"+id_objet).style.display == "none"){
			document.getElementById("edit_"+id_objet).innerHTML = document.getElementById(id_objet).value;
			document.getElementById("edit_"+id_objet).style.display = "";
			document.getElementById(id_objet).style.display = "none";
		} else {
			document.getElementById("edit_"+id_objet).style.display = "none";
			document.getElementById(id_objet).style.display = "";
			document.getElementById(id_objet).focus();
		}
	
}
