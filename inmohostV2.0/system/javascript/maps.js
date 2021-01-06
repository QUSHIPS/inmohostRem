
// JavaScript Document
var gmarkers = [];
var i = 0;
var map;
var geocoder=null;
var marker=null;

function initialize(address,lat,lng,win_prp) {                
    var opciones = {
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDoubleClickZoom : true,
        center: new google.maps.LatLng(lat, lng),
        zoom: 8
    };

    map = new google.maps.Map(document.getElementById("mapa_buscar"), opciones);

    geocoder = new google.maps.Geocoder();
    
    showAddress(address,lat,lng,win_prp);
}

function showAddress(address,lat,lng,win_prp) {
	
    address=address.replace("Indistinto,"," ");
    
    if (geocoder) {
        geocoder.geocode({
            address: address
        },function(results, status){
            if ((status == google.maps.GeocoderStatus.OK) || (lat!=""&&lng!=""&&lat!=0&&lng!=0)) {
                var latlng;
                var lat_actual;
                var lng_actual;
            
                if( (lat!=""&&lng!=""&&lat!=0&&lng!=0)){
                    lat_actual = lat;
                    lng_actual = lng;
                    latlng = new google.maps.LatLng(lat, lng);
                }else{
                    lat_actual = results[0].geometry.location.lat();
                    lng_actual = results[0].geometry.location.lng();
                    latlng = results[0].geometry.location;
                }

                map.setCenter(latlng);
                map.panTo(latlng);
                map.setZoom(16);

                actualizar_latitudes(lat_actual,lng_actual,win_prp);
                
                if(marker!=null){
                    placeMarker(latlng,map,marker,win_prp);
                }else{
                    marker = new google.maps.Marker({
                        map: map,
                        position: latlng,
                        draggable: true
                    });
                }
                
                
                google.maps.event.addListener(marker, 'dragend', function(e) {
                    placeMarker(e.latLng, map, marker,win_prp);
                }); 
                
                google.maps.event.addListener(map, 'dblclick', function(e) {
                    placeMarker(e.latLng, map, marker,win_prp);
                }); 
            } else {
                alert('No se pudo localizar la direccion: ' + status);
            }                     
        });
    } // fin de la función showAddress
}

function placeMarker(position, map, marker, win_prp) {
    marker.setPosition(position);
    map.panTo(position);
    actualizar_latitudes(position.lat(),position.lng(),win_prp);
} 

function actualizar_latitudes(lat,lng,win_prp){
    //busca la ventana de propiedad abierta
    for(i=0;i<parent.window.length;i++){
        if(parent.window[i].name=="propiedad_content"||parent.window[i].name==win_prp+"_content"){
            parent.window[i].document.getElementById('lat').value=lat;	
            parent.window[i].document.getElementById('lng').value=lng;

        }
    }
}