<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<title>Swipe between maps</title>
<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.min.js'></script>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.css' type='text/css' />
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-compare/v0.1.0/mapbox-gl-compare.js'></script>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-compare/v0.1.0/mapbox-gl-compare.css' type='text/css' />
<link rel="stylesheet" href="assets/css/main.css" />

<style>
    body { 
	margin: 0; 
     padding: 0;
	}
	


.map {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 100%;
}




</style>
</head>
<body>

<header id="header">

				<div class="inner">
					

					<div class="content">
						<h1>Elecciones Presidenciales 2019 </h1>
						<h2>Resultados Frente de Todos<br />
						PASO - Generales</h2>
						<a href="#" class="button big alt"><span>Comenzar</span></a>
					</div>
					<a href="#" class="button hidden"><span>Comenzar</span></a>
				
				</div>
			</header>


<div id='antes' class='map'></div>
<div id='despues' class='map'></div>



<style>
#menu {
    background: #fff;
    position: absolute;
	z-index: 1;
	top: 10px;
	left: 10px;
	border-radius: 3px;
	width: 150px;
	border: 1px solid rgba(0,0,0,0.4);
	font-family: 'Open Sans', sans-serif;
}
 
#menu a {
	font-size: 13px;
	color: #404040;
	display: block;
	margin: 0;
	padding: 0;
	padding: 10px;
	text-decoration: none;
	border-bottom: 1px solid rgba(0,0,0,0.25);
	text-align: center;
}
 
#menu a:last-child {
    border: none;
}
 
#menu a:hover {
	background-color: #f8f8f8;
	color: #404040;
}
 
#menu a.active {
	background-color: #3887be;
	color: #ffffff;
}
 
#menu a.active:hover {
    background: #3074a4;
}
</style>

<nav id="menu"></nav>
<div id="map"></div>


<div id= 'columna'>
		
	<div id= 'imagenorientacion'></div>
	<div id='state-legend' class='legend'>
		<h4>% de Votos</h4>
		<div><span style='background-color: #000000'></span>0% / Sin Datos</div>
		<div><span style='background-color: #FCFF2E'></span>10%</div>
		<div><span style='background-color: #A4F786'></span>20%</div>
		<div><span style='background-color: #40EBEC'></span>30%</div>
		<div><span style='background-color: #36B9E8'></span>40%</div>
		<div><span style='background-color: #297FC2'></span>50%</div>
		<div><span style='background-color: #1D3A7C'></span>60</div>
		<div><span style='background-color: #1E1560'></span>70</div>
		<div><span style='background-color: #220054'></span>80%</div>
		</div>
	<div id= 'aclaracion'>
		<p id='titulo'>Aclaración:</p><p> Para la realización del mapa se utilizaron los datos publicados por la 
		Dirección Nacional Electoral (DINE). Los mismos se realizan en base al escrutinio
		provisorio. Por tanto, algunos circuitos carecen de información.
		Por otro lado, los polígonos de los circuitos, publicados por la DINE, cuentan con algunos
		errores, inconsistencias o faltantes. Se publican únicamente los circuitos que no contienen inconvenientes.</p>
	</div>
</div>






<script>
mapboxgl.accessToken = 'pk.eyJ1IjoiY3JzaWx2YW1vcmVubyIsImEiOiJjaXM2MmFtbDUwY2hpMnlvMHl6bHhtMjdjIn0.-pqBOlEymp803EUcTdACjA';


limites = [
            [-98, -80], // Southwest coordinates
            [-25, -5]
            ];

var mappaso = new mapboxgl.Map({
    container: 'antes',
    style: 'mapbox://styles/crsilvamoreno/cjjurmve7121q2rpdr0plw7pj',
    center: [-58, -34],
	maxBounds : limites,  // Northeast coordinates
    minZoom: 3.53,
    zoom: 3.53
});

var mapgen = new mapboxgl.Map({
    container: 'despues',
    style: 'mapbox://styles/crsilvamoreno/cjjurmve7121q2rpdr0plw7pj',
    center: [-58, -34],
	maxBounds : limites, 
    minZoom: 3.53,
    zoom: 3.53
});

var map = new mapboxgl.Compare(mappaso, mapgen, {

});

mapgen.addControl(new MapboxGeocoder({
    accessToken: mapboxgl.accessToken,
	countries: 'ar',
	language: 'es',
	placeholder: "Buscar",
	
	flyTo: {
        bearing: 0,
        speed: 0.6,
        curve: 1, 
        easing: function (t) { return t; }
    },
			
    mapboxgl: mapboxgl
}));

mappaso.addControl(new MapboxGeocoder({
    accessToken: mapboxgl.accessToken,
	countries: 'ar',
	language: 'es',
	placeholder: "Buscar",
	
	flyTo: {
        bearing: 0,
        speed: 0.6,
        curve: 1, 
        easing: function (t) { return t; }
    },
			
    mapboxgl: mapboxgl
}));


mappaso.on('load', function() {

    mappaso.addSource('provincias', {
        'type': 'vector',
        'url': 'mapbox://crsilvamoreno.6z6ec44i' 
    });

    mappaso.addLayer({
        'id': 'provincias1',
        'source': 'provincias',
        'source-layer': 'provinciasvotosfdtjxc-3rfdhy',
        'maxzoom': 5,
        'type': 'fill',
        'paint': {
            'fill-color': [
                'interpolate',
                ['linear'],
                ['get', '%pasofdt'],
                	 

				2,'#FCFF2E',
				4,'#FCFF2E',
				6,'#FCFF2E',
				8,'#FCFF2E',
				10,'#FCFF2E',
				12,'#FCFF2E',
				14,'#E6FD44',
				16,'#D0FB5A',
				18,'#BAF970',
				20,'#A4F786',
				22,'#8EF59C',
				24,'#78F3B3',
				26,'#62F1CA',
				28,'#4CF0E1',
				29,'#41F0ED',
				30,'#40EBEC',
				32,'#3EE1EB',
				34,'#3CD7EA',
				36,'#3ACDE9',
				38,'#38C3E8',
				40,'#36B9E8',
				42,'#34AFE8',
				44,'#32A6E8',
				45,'#31A2E8',
				46,'#2F9BE0',
				48,'#2C8DD1',
				50,'#297FC2',
				52,'#2671B4',
				54,'#2363A6',
				56,'#215598',
				58,'#1F478A',
				60,'#1D3A7C',
				62,'#1B2D6E',
				64,'#1B276A',
				66,'#1C2166',
				68,'#1D1B63',
				70,'#1E1560',
				72,'#1F0F5D',
				74,'#200A5A',
				76,'#210557',
				78,'#220054',
				80,'#220054',
				82,'#220054',
				84,'#220054',
				86,'#220054',
				100,'#220054'





            ],
            'fill-opacity': 0.5
        }
    }, 'waterway-label');
	

	 
	 mappaso.addSource('departamentos', {
        'type': 'vector',
        'url': 'mapbox://crsilvamoreno.bn9seekd' 
    });

    mappaso.addLayer({
        'id': 'votos-departamentos',
        'source': 'departamentos',
        'source-layer': 'Departamentos_con_Votos-6w0s7w',
        'minzoom': 4,
		'maxzoom': 7,
        'type': 'fill',
        'paint': {
            'fill-color': [
                'interpolate',
                ['linear'],
                ['get', '%pasofdt'],

				2,'#FCFF2E',
				4,'#FCFF2E',
				6,'#FCFF2E',
				8,'#FCFF2E',
				10,'#FCFF2E',
				12,'#FCFF2E',
				14,'#E6FD44',
				16,'#D0FB5A',
				18,'#BAF970',
				20,'#A4F786',
				22,'#8EF59C',
				24,'#78F3B3',
				26,'#62F1CA',
				28,'#4CF0E1',
				29,'#41F0ED',
				30,'#40EBEC',
				32,'#3EE1EB',
				34,'#3CD7EA',
				36,'#3ACDE9',
				38,'#38C3E8',
				40,'#36B9E8',
				42,'#34AFE8',
				44,'#32A6E8',
				45,'#31A2E8',
				46,'#2F9BE0',
				48,'#2C8DD1',
				50,'#297FC2',
				52,'#2671B4',
				54,'#2363A6',
				56,'#215598',
				58,'#1F478A',
				60,'#1D3A7C',
				62,'#1B2D6E',
				64,'#1B276A',
				66,'#1C2166',
				68,'#1D1B63',
				70,'#1E1560',
				72,'#1F0F5D',
				74,'#200A5A',
				76,'#210557',
				78,'#220054',
				80,'#220054',
				82,'#220054',
				84,'#220054',
				86,'#220054',
				100,'#220054'


 

            ],
            'fill-opacity': 0.5
        }
    }, 'waterway-label');


 mappaso.addSource('circuitos', {
        'type': 'vector',
        'url': 'mapbox://crsilvamoreno.6efglwap' 
    });

    mappaso.addLayer({
        'id': 'circuitos-votos',
        'source': 'circuitos',
        'source-layer': 'CircuitosVotosFDTJXC-04t8n6',
        'minzoom': 7,
		'maxzoom': 12,
        'type': 'fill',
        'paint': {
            'fill-color': [
                'interpolate',
                ['linear'],
                ['get', '%pasofdt'],

				2,'#FCFF2E',
				4,'#FCFF2E',
				6,'#FCFF2E',
				8,'#FCFF2E',
				10,'#FCFF2E',
				12,'#FCFF2E',
				14,'#E6FD44',
				16,'#D0FB5A',
				18,'#BAF970',
				20,'#A4F786',
				22,'#8EF59C',
				24,'#78F3B3',
				26,'#62F1CA',
				28,'#4CF0E1',
				29,'#41F0ED',
				30,'#40EBEC',
				32,'#3EE1EB',
				34,'#3CD7EA',
				36,'#3ACDE9',
				38,'#38C3E8',
				40,'#36B9E8',
				42,'#34AFE8',
				44,'#32A6E8',
				45,'#31A2E8',
				46,'#2F9BE0',
				48,'#2C8DD1',
				50,'#297FC2',
				52,'#2671B4',
				54,'#2363A6',
				56,'#215598',
				58,'#1F478A',
				60,'#1D3A7C',
				62,'#1B2D6E',
				64,'#1B276A',
				66,'#1C2166',
				68,'#1D1B63',
				70,'#1E1560',
				72,'#1F0F5D',
				74,'#200A5A',
				76,'#210557',
				78,'#220054',
				80,'#220054',
				82,'#220054',
				84,'#220054',
				86,'#220054',
				100,'#220054'




            ],
            'fill-opacity': 0.35
        }
    }, 'waterway-label');
	
	 mappaso.addSource('centroide-provincias', {
        'type': 'vector',
        'url': 'mapbox://crsilvamoreno.7ftlnx5g' 
    });
	
	mappaso.addLayer({
        'id': 'porcentajes-provincias-paso',
        'source': 'centroide-provincias',
        'source-layer': 'provinciasvotosfdtjxccentroid-92jj6p',
        'maxzoom': 5,
        'type': 'symbol',
			"layout": {
               "text-field": "{%pasofdt}",
               "text-size": [
  						"interpolate",
  						["linear"],
  						["zoom"],
  						3,
  						10,
  						5,
  						12
							],
				
                "text-offset": [0,0],
               "icon-allow-overlap": false,
               "icon-ignore-placement": false,
               "text-font": [
 						 "DIN Offc Pro Italic",
  							"Arial Unicode MS Regular"
							]
			 }
                
        });
	

	mappaso.addSource('centroide-departamentos', {
        'type': 'vector',
        'url': 'mapbox://crsilvamoreno.dlofahte' 
    });
	
	mappaso.addLayer({
        'id': 'porcentajes-departamentos-paso',
        'source': 'centroide-departamentos',
        'source-layer': 'departamentosvotosfdtjxccentr-67reum',
        'minzoom': 5.5,
		'maxzoom': 7,
        'type': 'symbol',
			"layout": {
               "text-field": "{%pasofdt}",
               "text-size": [
  						"interpolate",
  						["linear"],
  						["zoom"],
  						5,
  						10,
  						7,
  						12
							],
                "text-offset": [0,0],
               "icon-allow-overlap": false,
               "icon-ignore-placement": false,
               "text-font": [
 						 "DIN Offc Pro Italic",
  							"Arial Unicode MS Regular"
							]
			 }
                
        });
	
	
	
	
	mappaso.addSource('centroide-circuitos', {
        'type': 'vector',
        'url': 'mapbox://crsilvamoreno.1mg17zko' 
    });
	
	mappaso.addLayer({
        'id': 'porcentajes-circuitos-paso',
        'source': 'centroide-circuitos',
        'source-layer': 'circuitosvotosfdtjxccentroide-7atg8l',
        'minzoom': 7,
		'maxzoom': 12,
        'type': 'symbol',
			"layout": {
               "text-field": "{%pasofdt}",
               "text-size": [
  						"interpolate",
  						["linear"],
  						["zoom"],
  						7,
  						8,
  						10,
  						10
							],
                "text-offset": [0,0],
               "icon-allow-overlap": false,
               "icon-ignore-placement": false,
               "text-font": [
 						 "DIN Offc Pro Italic",
  							"Arial Unicode MS Regular"
							]
			 }
                
        });
	


});






mapgen.on('load', function() {

    mapgen.addSource('provincias', {
        'type': 'vector',
        'url': 'mapbox://crsilvamoreno.6z6ec44i' 
    });

    mapgen.addLayer({
        'id': 'provincias1',
        'source': 'provincias',
        'source-layer': 'provinciasvotosfdtjxc-3rfdhy',
        'maxzoom': 5,
        'type': 'fill',
        'paint': {
            'fill-color': [
                'interpolate',
                ['linear'],
                ['get', '%genfdt'],

				2,'#FCFF2E',
				4,'#FCFF2E',
				6,'#FCFF2E',
				8,'#FCFF2E',
				10,'#FCFF2E',
				12,'#FCFF2E',
				14,'#E6FD44',
				16,'#D0FB5A',
				18,'#BAF970',
				20,'#A4F786',
				22,'#8EF59C',
				24,'#78F3B3',
				26,'#62F1CA',
				28,'#4CF0E1',
				29,'#41F0ED',
				30,'#40EBEC',
				32,'#3EE1EB',
				34,'#3CD7EA',
				36,'#3ACDE9',
				38,'#38C3E8',
				40,'#36B9E8',
				42,'#34AFE8',
				44,'#32A6E8',
				45,'#31A2E8',
				46,'#2F9BE0',
				48,'#2C8DD1',
				50,'#297FC2',
				52,'#2671B4',
				54,'#2363A6',
				56,'#215598',
				58,'#1F478A',
				60,'#1D3A7C',
				62,'#1B2D6E',
				64,'#1B276A',
				66,'#1C2166',
				68,'#1D1B63',
				70,'#1E1560',
				72,'#1F0F5D',
				74,'#200A5A',
				76,'#210557',
				78,'#220054',
				80,'#220054',
				82,'#220054',
				84,'#220054',
				86,'#220054',
				100,'#220054'



            ],
            'fill-opacity': 0.5
        }
    }, 'waterway-label');
	
	 
	 mapgen.addSource('departamentos', {
        'type': 'vector',
        'url': 'mapbox://crsilvamoreno.bn9seekd' 
    });

    mapgen.addLayer({
        'id': 'votos-departamentos',
        'source': 'departamentos',
        'source-layer': 'Departamentos_con_Votos-6w0s7w',
        'minzoom': 4,
		'maxzoom': 7,
        'type': 'fill',
        'paint': {
            'fill-color': [
                'interpolate',
                ['linear'],
                ['get', '%genfdt'],

				2,'#FCFF2E',
				4,'#FCFF2E',
				6,'#FCFF2E',
				8,'#FCFF2E',
				10,'#FCFF2E',
				12,'#FCFF2E',
				14,'#E6FD44',
				16,'#D0FB5A',
				18,'#BAF970',
				20,'#A4F786',
				22,'#8EF59C',
				24,'#78F3B3',
				26,'#62F1CA',
				28,'#4CF0E1',
				29,'#41F0ED',
				30,'#40EBEC',
				32,'#3EE1EB',
				34,'#3CD7EA',
				36,'#3ACDE9',
				38,'#38C3E8',
				40,'#36B9E8',
				42,'#34AFE8',
				44,'#32A6E8',
				45,'#31A2E8',
				46,'#2F9BE0',
				48,'#2C8DD1',
				50,'#297FC2',
				52,'#2671B4',
				54,'#2363A6',
				56,'#215598',
				58,'#1F478A',
				60,'#1D3A7C',
				62,'#1B2D6E',
				64,'#1B276A',
				66,'#1C2166',
				68,'#1D1B63',
				70,'#1E1560',
				72,'#1F0F5D',
				74,'#200A5A',
				76,'#210557',
				78,'#220054',
				80,'#220054',
				82,'#220054',
				84,'#220054',
				86,'#220054',
				100,'#220054'



            ],
            'fill-opacity': 0.5
        }
    }, 'waterway-label');


 mapgen.addSource('circuitos', {
        'type': 'vector',
        'url': 'mapbox://crsilvamoreno.6efglwap' 
    });

    mapgen.addLayer({
        'id': 'circuitos-votos',
        'source': 'circuitos',
        'source-layer': 'CircuitosVotosFDTJXC-04t8n6',
        'minzoom': 7,
		'maxzoom': 12,
        'type': 'fill',
        'paint': {
            'fill-color': [
                'interpolate',
                ['linear'],
                ['get', '%genfdt'],

				2,'#FCFF2E',
				4,'#FCFF2E',
				6,'#FCFF2E',
				8,'#FCFF2E',
				10,'#FCFF2E',
				12,'#FCFF2E',
				14,'#E6FD44',
				16,'#D0FB5A',
				18,'#BAF970',
				20,'#A4F786',
				22,'#8EF59C',
				24,'#78F3B3',
				26,'#62F1CA',
				28,'#4CF0E1',
				29,'#41F0ED',
				30,'#40EBEC',
				32,'#3EE1EB',
				34,'#3CD7EA',
				36,'#3ACDE9',
				38,'#38C3E8',
				40,'#36B9E8',
				42,'#34AFE8',
				44,'#32A6E8',
				45,'#31A2E8',
				46,'#2F9BE0',
				48,'#2C8DD1',
				50,'#297FC2',
				52,'#2671B4',
				54,'#2363A6',
				56,'#215598',
				58,'#1F478A',
				60,'#1D3A7C',
				62,'#1B2D6E',
				64,'#1B276A',
				66,'#1C2166',
				68,'#1D1B63',
				70,'#1E1560',
				72,'#1F0F5D',
				74,'#200A5A',
				76,'#210557',
				78,'#220054',
				80,'#220054',
				82,'#220054',
				84,'#220054',
				86,'#220054',
				100,'#220054'



            ],
            'fill-opacity': 0.35
        }
    }, 'waterway-label');
	
	mapgen.addSource('centroide-provincias', {
        'type': 'vector',
        'url': 'mapbox://crsilvamoreno.7ftlnx5g' 
    });
	
	mapgen.addLayer({
        'id': 'porcentajes-provincias-gen',
        'source': 'centroide-provincias',
        'source-layer': 'provinciasvotosfdtjxccentroid-92jj6p',
        'maxzoom': 5,
        'type': 'symbol',
			"layout": {
               "text-field": "{%genfdt}",
               "text-size": [
  						"interpolate",
  						["linear"],
  						["zoom"],
  						3,
  						10,
  						5,
  						12
							],
                "text-offset": [0,0],
               "icon-allow-overlap": false,
               "icon-ignore-placement": false,
               "text-font": [
 						 "Open Sans SemiBold",
  							"Arial Unicode MS Regular"
							]
			 }
                
        });
	

	mapgen.addSource('centroide-departamentos', {
        'type': 'vector',
        'url': 'mapbox://crsilvamoreno.dlofahte' 
    });
	
	mapgen.addLayer({
        'id': 'porcentajes-departamentos-gen',
        'source': 'centroide-departamentos',
        'source-layer': 'departamentosvotosfdtjxccentr-67reum',
        'minzoom': 5.5,
		'maxzoom': 7,
        'type': 'symbol',
			"layout": {
               "text-field": "{%genfdt}",
               "text-size": [
  						"interpolate",
  						["linear"],
  						["zoom"],
  						5,
  						10,
  						7,
  						12
							],
                "text-offset": [0,0],
               "icon-allow-overlap": false,
               "icon-ignore-placement": false,
               "text-font": [
 						 "Open Sans SemiBold",
  							"Arial Unicode MS Regular"
							]
			 }
                
        });
	
	
	
	
	mapgen.addSource('centroide-circuitos', {
        'type': 'vector',
        'url': 'mapbox://crsilvamoreno.1mg17zko' 
    });
	
	mapgen.addLayer({
        'id': 'porcentajes-circuitos-gen',
        'source': 'centroide-circuitos',
        'source-layer': 'circuitosvotosfdtjxccentroide-7atg8l',
        'minzoom': 7,
		'maxzoom': 12,
        'type': 'symbol',
			"layout": {
               "text-field": "{%genfdt}",
               "text-size": [
  						"interpolate",
  						["linear"],
  						["zoom"],
  						7,
  						8,
  						10,
  						10
							],
                "text-offset": [0,0],
               "icon-allow-overlap": false,
               "icon-ignore-placement": false,
               "text-font": [
 						 "Open Sans SemiBold",
  							"Arial Unicode MS Regular"
							]
			 }
                
        });
	


});




var link = document.createElement('a');
    link.href = '#';
    link.className = 'active';
    link.textContent = "Porcentajes";
	
	var layers = document.getElementById('menu');
    layers.appendChild(link);
	
var link2 = document.createElement('a');
    link2.href = '#';
    link2.className = 'active';
    link2.textContent = "Polígonos";
	
	var layers = document.getElementById('menu');
    layers.appendChild(link2);
	



function clickPasoProvincias() {
		var clickedLayer2 = 'porcentajes-provincias-paso';

		var visibility2 = mappaso.getLayoutProperty(clickedLayer2, 'visibility');

		if (visibility2 === 'visible') {
			mappaso.setLayoutProperty(clickedLayer2, 'visibility', 'none');
			this.className = '';
		} else {
			this.className = 'active';
			mappaso.setLayoutProperty(clickedLayer2, 'visibility', 'visible');
		}
	};

function clickPasoDepartamentos() {
		var clickedLayer2 = 'porcentajes-departamentos-paso';

		var visibility2 = mappaso.getLayoutProperty(clickedLayer2, 'visibility');

		if (visibility2 === 'visible') {
			mappaso.setLayoutProperty(clickedLayer2, 'visibility', 'none');
			this.className = '';
		} else {
			this.className = 'active';
			mappaso.setLayoutProperty(clickedLayer2, 'visibility', 'visible');
		}
	};
	
	function clickPasoCircuitos() {
		var clickedLayer2 = 'porcentajes-circuitos-paso';

		var visibility2 = mappaso.getLayoutProperty(clickedLayer2, 'visibility');

		if (visibility2 === 'visible') {
			mappaso.setLayoutProperty(clickedLayer2, 'visibility', 'none');
			this.className = '';
		} else {
			this.className = 'active';
			mappaso.setLayoutProperty(clickedLayer2, 'visibility', 'visible');
		}
	};


function clickGenProvincias() {
		var clickedLayer2 = 'porcentajes-provincias-gen';

		var visibility2 = mapgen.getLayoutProperty(clickedLayer2, 'visibility');

		if (visibility2 === 'visible') {
			mapgen.setLayoutProperty(clickedLayer2, 'visibility', 'none');
			this.className = '';
		} else {
			this.className = 'active';
			mapgen.setLayoutProperty(clickedLayer2, 'visibility', 'visible');
		}
	};

function clickGenDepartamentos() {
		var clickedLayer2 = 'porcentajes-departamentos-gen';

		var visibility2 = mapgen.getLayoutProperty(clickedLayer2, 'visibility');

		if (visibility2 === 'visible') {
			mapgen.setLayoutProperty(clickedLayer2, 'visibility', 'none');
			this.className = '';
		} else {
			this.className = 'active';
			mapgen.setLayoutProperty(clickedLayer2, 'visibility', 'visible');
		}
	};
	
	function clickGenCircuitos() {
		var clickedLayer2 = 'porcentajes-circuitos-gen';

		var visibility2 = mapgen.getLayoutProperty(clickedLayer2, 'visibility');

		if (visibility2 === 'visible') {
			mapgen.setLayoutProperty(clickedLayer2, 'visibility', 'none');
			this.className = '';
		} else {
			this.className = 'active';
			mapgen.setLayoutProperty(clickedLayer2, 'visibility', 'visible');
		}
	};



	
 link.addEventListener('click',clickPasoProvincias);
 link.addEventListener('click',clickPasoDepartamentos);
 link.addEventListener('click',clickPasoCircuitos);
 link.addEventListener('click',clickGenProvincias);
 link.addEventListener('click',clickGenDepartamentos);
 link.addEventListener('click',clickGenCircuitos);
  

function clickPasoProvinciasPol() {
		var clickedLayer2 = 'provincias1';

		var visibility2 = mappaso.getLayoutProperty(clickedLayer2, 'visibility');

		if (visibility2 === 'visible') {
			mappaso.setLayoutProperty(clickedLayer2, 'visibility', 'none');
			this.className = '';
		} else {
			this.className = 'active';
			mappaso.setLayoutProperty(clickedLayer2, 'visibility', 'visible');
		}
	};

function clickPasoDepartamentosPol() {
		var clickedLayer2 = 'votos-departamentos';

		var visibility2 = mappaso.getLayoutProperty(clickedLayer2, 'visibility');

		if (visibility2 === 'visible') {
			mappaso.setLayoutProperty(clickedLayer2, 'visibility', 'none');
			this.className = '';
		} else {
			this.className = 'active';
			mappaso.setLayoutProperty(clickedLayer2, 'visibility', 'visible');
		}
	};
	
	function clickPasoCircuitosPol() {
		var clickedLayer2 = 'circuitos-votos';

		var visibility2 = mappaso.getLayoutProperty(clickedLayer2, 'visibility');

		if (visibility2 === 'visible') {
			mappaso.setLayoutProperty(clickedLayer2, 'visibility', 'none');
			this.className = '';
		} else {
			this.className = 'active';
			mappaso.setLayoutProperty(clickedLayer2, 'visibility', 'visible');
		}
	};


function clickGenProvinciasPol() {
		var clickedLayer2 = 'provincias1';

		var visibility2 = mapgen.getLayoutProperty(clickedLayer2, 'visibility');

		if (visibility2 === 'visible') {
			mapgen.setLayoutProperty(clickedLayer2, 'visibility', 'none');
			this.className = '';
		} else {
			this.className = 'active';
			mapgen.setLayoutProperty(clickedLayer2, 'visibility', 'visible');
		}
	};

function clickGenDepartamentosPol() {
		var clickedLayer2 = 'votos-departamentos';

		var visibility2 = mapgen.getLayoutProperty(clickedLayer2, 'visibility');

		if (visibility2 === 'visible') {
			mapgen.setLayoutProperty(clickedLayer2, 'visibility', 'none');
			this.className = '';
		} else {
			this.className = 'active';
			mapgen.setLayoutProperty(clickedLayer2, 'visibility', 'visible');
		}
	};
	
	function clickGenCircuitosPol() {
		var clickedLayer2 = 'circuitos-votos';

		var visibility2 = mapgen.getLayoutProperty(clickedLayer2, 'visibility');

		if (visibility2 === 'visible') {
			mapgen.setLayoutProperty(clickedLayer2, 'visibility', 'none');
			this.className = '';
		} else {
			this.className = 'active';
			mapgen.setLayoutProperty(clickedLayer2, 'visibility', 'visible');
		}
	};



	
 link2.addEventListener('click',clickPasoProvinciasPol);
 link2.addEventListener('click',clickPasoDepartamentosPol);
 link2.addEventListener('click',clickPasoCircuitosPol);
 link2.addEventListener('click',clickGenProvinciasPol);
 link2.addEventListener('click',clickGenDepartamentosPol);
 link2.addEventListener('click',clickGenCircuitosPol);


</script>
  
  	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/main.js"></script>
  
</body>

</html>