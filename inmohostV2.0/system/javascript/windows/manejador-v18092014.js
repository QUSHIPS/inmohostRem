// JavaScript Document

// declaracion de variables utiles

// pageSize.windowHeight . pageSize.windowWidth



// acceso al id de la ventana en foco alert(Windows.focusedWindow.getId());
// cerrr ventana en foco Windows.close(Windows.focusedWindow.getId());

var WinNews;
var WinPropiedad;
var WinPropiedadListado;
var WinPropiedadMedios;
var WinInformes;
var WinGraficos;
var WinRedInmo;
var WinEditor;
var WinListados;
var WinPanelControl;
var WinAgendaCitas;
var WinAgendaResumen;
var WinPrpPublicaciones;
var WinActualizador;
var WinAltaTasacion;
var WinEdicionSimple;
var WinVarios;
var WinUrlExterna;
var WinExportar;
var WinMail;
var WinDemandas;
var WinCoincidencia;
var WinFichaFoto;
var WinFichaImp;
var WinAltUsr;
var WinNovedades;
var WinBarPriv;
var WinPanelBackup;
var WinDestinatarios;
var Win1;
var Win2;
var Win3;
var Win4;
var Win5;
var Win6;
var Win7;
var Win8;
var Win9;
var Win10;
var WinMapa;
var WinAyuda;
var WinPuntaje



function ventana(tipo, query, url, titulo){
    pageSize = WindowUtilities.getPageSize();
	
    var className;
    var title;
    var windows;
    var width;
    var heidth;
    var top = 0;
    var left = 0;
    var resizable = true;
    var closable = true;
    var minimizable = true;
    var maximizable = true;
    var draggable = true;
    var url;
    var WinTemp;
    var multi = false;
    var zIndex;
    var hReusable=550;
    var wReusable=870;
    var classNameReusable="inmohost";
	
			
	
    switch(tipo){

        case "news":
            WinTemp = "WinNews";
            windows = "news";
            className = "neutra";
            title = "<img src='interfaz/inmohost/images/iconos/rss.png' border='0' align='left' width='15' height='15' hspace='5' alt='Canal informaci�n RSS'/>Noticias";
            width = 240;
            height = 300;
            top = 75;
            left = pageSize.windowWidth - 315;
            resizable = false;
            closable = true;
            minimizable = false;
            maximizable = false;
            //draggable = false;
            url = "system/rss.php?"+query;
            break;
        case "prp_agregar": 
        case "prp_modificar":
            WinTemp = "WinPropiedad";
            windows = "prp_modificar";
            className = "inmohost";
            title = titulo;
            width = 700;
            height = 480;
            left = 50;
            url = url+"?"+query;
            multi = true;
            break;
        case "prp_ficha":
            WinTemp = "WinPropiedad";
            windows = "propiedad";
            className = "inmohost";
            title = titulo;
            width = 850;
            height = 580;
            url = url+"?"+query;
            multi = true;
            break;
        case "prp_listado":
            WinTemp = "WinPropiedadListado";
            windows = "listadoPropiedades";
            className = "inmohost";
            title = titulo;
            width = 800;
            height = 450;
            url = url+"?"+query;
            multi = true;
            break;
        case "prp_medios":
            WinTemp = "WinPropiedadMedios";
            windows = "propiedadMedios";
            className = "inmohost";
            title = titulo;
            width = 750;
            height = 450;
            url = url+"?"+query;
            multi = true;
            break;
        case "inf_listado":
            WinTemp = "WinInformes";
            windows = "listadoInformes";
            className = "inmohost";
            title = titulo;
            width = 750;
            height = 400;
            url = url+"?"+query;
            multi = true;
            break;
        case "graficos":
            WinTemp = "WinGraficos";
            windows = "graficosInformes";
            className = "inmohost";
            title = titulo;
            width = 570;
            height = 420;
            resizable = false;
            minimizable = false;
            maximizable = false;
            url = url+"?"+query;
            multi = true;
            break;
        case "red_inmobiliarios":
            WinTemp = "WinRedInmo";
            windows = "red_inmobiliarios";
            className = "inmohost";
            title = titulo;
            width = 750;
            height = 475;
            resizable = false;
            minimizable = false;
            maximizable = false;
            url = url+"?"+query;
            break;
        case "editor":
            WinTemp = "WinEditor";
            windows = "editor";
            className = "inmohost";
            title = titulo;
            width = 650;
            height = 430;
            url = url+"?"+query;
			
            break;
        case "generico_listado":
            WinTemp = "WinListados";
            windows = "generico_listado";
            className = "inmohost";
            title = titulo;
            width = 880;
            height = 450;
            url = url+"?"+query;
            multi = true;
            break;
        case "panel_control":
            WinTemp = "WinPanelControl";
            windows = "panel_control";
            className = "inmohost";
            title = titulo;
            width = 700;
            height = 400;
            url = url+"?"+query;
            break;
        case "agenda_citas":
            WinTemp = "WinAgendaCitas";
            windows = "agenda_citas";
            className = "inmohost";
            title = titulo;
            width = 750;
            height = 420;
            url = url+"?"+query;
            break;
        case "agenda_resumen":
            WinTemp = "WinAgendaResumen";
            windows = "agenda_resumen";
            className = "neutra";
            title = titulo;
            width = 520;
            height = 230;
            top = 100;
            left = 5;
            resizable = false;
            minimizable = false;
            maximizable = false;
            url = url+"?"+query;
            zIndex=0;
            break;
        case "prp_publicaciones":
            WinTemp = "WinPrpPublicaciones";
            windows = "WinPrpPublicaciones";
            className = "inmohost";
            title = titulo;
            width = 600;
            height = 350;
            url = url+"?"+query;
            break;
        case "edicionSimple":
            WinTemp = "WinEdicionSimple";
            windows = "edicionSimple";
            className = "inmohost";
            title = titulo;
            width = 500;
            height = 400;
            url = url+"?"+query;
            break;
        case "alta_tasacion":
            WinTemp = "WinAltaTasacion";
            windows = "alta_tasacion";
            className = "inmohost";
            title = titulo;
            width = 450;
            height = 350;
            url = url+"?"+query;
            break;
        case "actualizador":
            WinTemp = "WinActualizador";
            windows = "win_actualizador";
            className = "neutra";
            title = titulo;
            width = 350;
            height = 65;
            top = 1;
            left = (pageSize.windowWidth-350)/2;
            minimizable = false;
            maximizable = false;
            closable = false;
            url = url+"?"+query;
            break;
        case "exportar":
            WinTemp = "WinExportar";
            windows = "WinExportar";
            className = "neutra";
            title = titulo;
            width = 400;
            height = 200;
            minimizable = false;
            maximizable = false;
            url = url+"?"+query;
            break;
        case "varios":
            WinTemp = "WinVarios";
            windows = "WinVarios";
            className = "inmohost";
            title = titulo;
            width = 600;
            height = 430;
            url = url+"?"+query;
            multi = true;
            break;
        case "env_mail":
            WinTemp = "WinMail";
            windows = "env_mail";
            className = "inmohost";
            title = titulo;
            width = 765;
            height = 690;
            url = url+"?"+query;
            multi = true;
            break;
        case "alt_dem":
            WinTemp = "WinDemandas";
            windows = "alt_dem";
            className = "inmohost";
            title = titulo;
            width = 650;
            height = 470;
            url = url+"?"+query;
            multi = true;
            break;
        case "dem_coin":
            WinTemp = "WinCoincidencia";
            windows = "dem_coin";
            className = "inmohost";
            title = titulo;
            width = 400;
            height = 250;
            url = url+"?"+query;
            multi = true;
            break;
        case "ficha_foto":
            WinTemp = "WinFichaFoto";
            windows = "ficha_foto";
            className = "inmohost";
            title = titulo;
            width = 400;
            height = 250;
            url = url+"?"+query;
            multi = true;
            break;
        case "ficha_imp":
            WinTemp = "WinFichaImp";
            windows = "ficha_imp";
            className = "inmohost";
            title = titulo;
            width = 450;
            height = 400;
            url = url+"?"+query;
            multi = true;
            break;
        case "imagen":
            WinTemp = "WinImagen";
            windows = "imagen";
            className = "alert";
            title = '';
            width = 850;
            height = 550;
            if(url.indexOf('.gif', 0) != -1 || url.indexOf('.jpg', 0) != -1 || url.indexOf('.png', 0) != -1){
                url = rutaAbsolutaFichaFoto+"system/imagen.php?img="+url+"&"+query;
            } else {
                url = url+"?"+query;
            }
            break;
        case "alt_nov":
            WinTemp = "WinNovedades";
            windows = "alt_nov";
            className = "inmohost";
            title = titulo;
            width = 350;
            height = 300;
            url = url+"?"+query+"&win="+windows;
            multi = true;
            break;
        case "alt_usr":
            WinTemp = "WinAltUsr";
            windows = "alt_usr";
            className = "inmohost";
            title = titulo;
            width = 400;
            height = 300;
            url = url+"?"+query;
            multi = true;
            break;
		
        case "bar_priv":
            WinTemp = "WinBarPriv";
            windows = "bar_priv";
            className = "inmohost";
            title = titulo;
            width = 600;
            height =450;
            url = url+"?"+query;
            break;
        case "panel_backup":
            WinTemp = "WinPanelBackup";
            windows = "panel_backup";
            className = "inmohost";
            title = titulo;
            width = 600;
            height = 200;
            url = url+"?"+query;
            break;
        case "mail_destinatarios":
            WinTemp = "WinDestinatarios";
            windows = "destinatarios";
            className = "inmohost";
            title = titulo;
            width = 250;
            height = 600;
            url = url+"?"+query;
            break;
		
        //*****************************************************
        //ventanas reusables **********************************
        //*****************************************************
		
		
		
        case "win1":
            WinTemp = "Win1";
            windows = "win1";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win2":
            WinTemp = "Win2";
            windows = "win2";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win3":
            WinTemp = "Win3";
            windows = "win3";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win4":
            WinTemp = "Win4";
            windows = "win4";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win5":
            WinTemp = "Win5";
            windows = "win5";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win6":
            WinTemp = "Win6";
            windows = "win6";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win7":
            WinTemp = "Win7";
            windows = "win7";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win8":
            WinTemp = "Win8";
            windows = "win8";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win9":
            WinTemp = "Win9";
            windows = "win9";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win10":
            WinTemp = "Win10";
            windows = "win10";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        //------------------------------------/
        case "win11":
            WinTemp = "Win11";
            windows = "win11";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win12":
            WinTemp = "Win12";
            windows = "win12";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win13":
            WinTemp = "Win13";
            windows = "win13";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win14":
            WinTemp = "Win14";
            windows = "win14";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win15":
            WinTemp = "Win15";
            windows = "win15";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win16":
            WinTemp = "Win16";
            windows = "win16";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win17":
            WinTemp = "Win17";
            windows = "win17";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win18":
            WinTemp = "Win18";
            windows = "win18";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win19":
            WinTemp = "Win19";
            windows = "win19";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win20":
            WinTemp = "Win20";
            windows = "win20";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        //------------------------------------/
		
        case "win101":
            WinTemp = "Win101";
            windows = "win101";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win102":
            WinTemp = "Win102";
            windows = "win102";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win103":
            WinTemp = "Win103";
            windows = "win103";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win104":
            WinTemp = "Win104";
            windows = "win104";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win105":
            WinTemp = "Win105";
            windows = "win105";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win106":
            WinTemp = "Win106";
            windows = "win106";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win107":
            WinTemp = "Win107";
            windows = "win107";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win108":
            WinTemp = "Win108";
            windows = "win108";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win109":
            WinTemp = "Win109";
            windows = "win109";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "win110":
            WinTemp = "Win110";
            windows = "win110";
            className = classNameReusable;
            title = titulo;
            width = wReusable;
            height = hReusable;
            url = url+"?"+query;
            multi = true;
            break;
        case "prp_mapa":
		
            WinTemp = "WinMapa";
            windows = "prp_mapa";
            className = "inmohost";
            title = titulo;
            width = 750;
            height = 450;
            url = url+"?"+query;
            multi = true;
            break;
        case "url_ayuda":
		
            WinTemp = "WinAyuda";
            windows = "url_ayuda";
            className = "inmohost";
            title = titulo;
            width = 750;
            height = 450;
            url = url+"?"+query;
            multi = true;
            break;
        case "ventana_puntaje":
		
            WinTemp = "WinPuntaje";
            windows = "ventana_puntaje";
            className = "inmohost";
            title = titulo;
            width = 280;
            left = 310;
            height = 360;
            url = url+"?"+query;
            resizable = false;
            minimizable = false;
            maximizable = false;
            closable = false;
            multi = true;
            break;
                
        default:
            //alert(tipo)
            WinTemp = "WinUrlExterna";
            windows = "urlExterna";
            className = "inmohost";
            title = titulo;
            width = 780;
            height = 450;
                       
            url = url+"?"+query;
            multi = true;
            break;
		
    }
			
    ///////////////////////////////////////////
    //				armador 				//
    ///////////////////////////////////////////

    if (this[WinTemp]) {
        //alert(this[WinTemp].getId());
        this[WinTemp].destroy();
    }
		
    if(!zIndex){
        zIndex=100;
    }
			
    this[WinTemp] = new Window(windows, {
        className: className, 
        title: title, 
        width:width, 
        height:height, 
        top:top,
        left:left,
        resizable:resizable, 
        closable:closable, 
        minimizable:minimizable, 
        maximizable:maximizable, 
        draggable:draggable, 
        url: url, 
        wiredDrag: true, 
        zIndex: zIndex
    });

   // this[WinTemp].setDestroyOnClose();
    //win.getContent().innerHTML="";
		
    if(this[WinTemp].getId() == 'prp_modificar' || this[WinTemp].getId() == 'win101' || this[WinTemp].getId() == 'win102' || this[WinTemp].getId() == 'win103' || this[WinTemp].getId() == 'win104' || this[WinTemp].getId() == 'win105' || this[WinTemp].getId() == 'win106' || this[WinTemp].getId() == 'win107' || this[WinTemp].getId() == 'win108' || this[WinTemp].getId() == 'win109' || this[WinTemp].getId() == 'win110'){
        this[WinTemp].showCenter();
                    
        //  console.log(this[WinTemp].getId());
        left_center = this[WinTemp].getLeft().split("px");
        top_center = this[WinTemp].getTop().split("px");
        this[WinTemp].setLocation(top_center[0],parseInt(left_center[0])-100);
                
		
    }else if(top == 0 && left == 0) {
        this[WinTemp].showCenter();
    }else if(this[WinTemp].getId() == 'ventana_puntaje'){
                    
        this[WinTemp].showCenter();
        left_center = this[WinTemp].getLeft().split("px");
        top_center = this[WinTemp].getTop().split("px");
        this[WinTemp].setLocation(top_center[0],parseInt(left_center[0])+450);
    //this[WinTemp].setLocation(20,20);
                    
    } else {
        this[WinTemp].show();
        if(this[WinTemp].getId()=="agenda_resumen"){
        //    console.log(typeof(this[WinTemp].updateZIndex));
//            if(typeof(this[WinTemp].updateZIndex)==typeof(Function)){
//                console.log(1);
                  //this[WinTemp].updateZIndex(50);
        //      }
        }	
    }
    this[WinTemp].toFront();

    if(WinTemp == "WinUrlExterna"){
        this[WinTemp].maximize();
    }
	

    // Set up a windows observer, check ou debug window to get messages 
    //onStartResize(), onEndResize(), onStartMove(), onEndMove(), onClose(), onDestroy(), onMinimize(), onMaximize(), onHide(), onShow(), onFocus()
		
    myObserver0 = { 
        onDestroy: function(eventName, win)
        { 
        //alert(win);
        } 
    }

    Windows.addObserver(myObserver0);
   
   bandera_win_prp = 1;
   
    myObserver1 = { // aca hay que ver el nombre de la ventana
        onClose: function(eventName, win)
        { 
            if(win.getId() == 'prp_modificar' || win.getId() == 'win101' || win.getId() == 'win102' || win.getId() == 'win103' || win.getId() == 'win104' || win.getId() == 'win105' || win.getId() == 'win106' || win.getId() == 'win107' || win.getId() == 'win108' || win.getId() == 'win109' || win.getId() == 'win110'){
                Windows.close('ventana_puntaje');
            }
              
              if(bandera_win_prp == 1){
     
                    bandera_win_prp = 0;
                    
                        if(win.getId() == 'prp_mapa'){

                          bandera_win_prp = 0;
                          var indice = 0;

                            for(i=0;i<parent.window.length;i++){


                                    if(parent.window[i].name == "prp_modificar_content" || parent.window[i].name == 'win101_content' || parent.window[i].name == 'win102_content' || parent.window[i].name == 'win103_content' || parent.window[i].name == 'win104_content' || parent.window[i].name == 'win105_content' || parent.window[i].name == 'win106_content' || parent.window[i].name == 'win107_content' || parent.window[i].name == 'win108_content' || parent.window[i].name == 'win109_content' || parent.window[i].name == 'win110_content'){

                                        if(typeof parent.window[i].cambiar_porcentaje_visibilidad == 'function' ){

                                            parent.window[i].cambiar_porcentaje_visibilidad();
                                            console.log(i); 
                                        }
                                    }

                            }
                           //console.log(indice);                


                        }
              } 
					
        }
        
    }
    Windows.addObserver(myObserver1); 

		
}

function contenidoMenu(archivo){

    document.getElementById("contenidoMenuActual").innerHTML = archivo;
	
}


function dialogos(tipo, query, url, titulo,usr_id){
  
    switch(tipo){
        case "cerrarSesion":
            Dialog.confirm($(url).innerHTML, {
                windowParameters: {
                    className:"alert", 
                    width:350, 
                    height:120
                }, 
                okLabel: "Cerrar Sesi&oacute;n",
                cancelLabel: "Cancelar", 
                cancel: function(win){
                    cambiarInterfaz('');
                },
                ok:function(win){
                    window.location.href=rutaAbsoluta+"login.php?usr_id="+usr_id;
                    return false;
                }
            });
            break;
        case "destruirSesion":
            Dialog.confirm($(url).innerHTML, {
                windowParameters: {
                    className:"alert", 
                    width:350, 
                    height:175
                }, 
                okLabel: "Cerrar Sesi&oacute;n",
                cancelLabel: "Ingresar", 					 
                ok: function(win){
                    window.location.href=rutaAbsoluta+"login.php"+"?usr_id="+document.getElementById('usuario_id').value;
                },
                cancel:function(win){
                    renovarSesion();
                }
            });
            break;
        default:
            Dialog.alert({
                url: url+"?"+query, 
                options: {
                    method: 'get'
                }
            }, {
                windowParameters: {
                    className: "alert", 
                    width:300, 
                    height:200
                }, 
                okLabel: "Cerrar"
            });
            break;
    }
	
}

/*
var timeout; 

function openInfoDialog() { 
	Dialog.info("Alert que se cierra a los  3s ...", 
				{windowParameters: {width:250, height:100}, 
				showProgress: true}); 
	timeout=3; setTimeout(infoTimeout, 1000) 
} 

function infoTimeout() { 
	timeout--; if (timeout >0) { 
		Dialog.setInfoMessage("Alert que se cierra a los  " + timeout + "s ...") 
		setTimeout(infoTimeout, 1000) 
		} else Dialog.closeInfo() 
}
*/