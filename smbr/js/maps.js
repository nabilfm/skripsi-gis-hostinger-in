<script>
    $(document).ready(function () {
    // Plugin initialization
        $('.slider').slider();
        var Mkeyp = $("input#fnMkey").val();
        var fiturIkon = [];
      //alert(fnMkey.value);
      $.ajax({
        url: 'http://localhost/kh/includes/api_dist.php',
        data: 'fnMkey='+Mkeyp,
        type: 'POST',
        dataType: 'json',
        success: function(rows)
        {
          for (var i in rows)
        	{

	            var row   = rows[i];

	            var name  = row[0];
	            var lat   = parseFloat(row[1]);
	            var lon   = parseFloat(row[2]);

	            var iconFeature = new ol.Feature({
	              
	              geometry: new ol.geom.Point(ol.proj.transform([lon, lat ], 'EPSG:4326', 'EPSG:3857')),
	              name: name,
	              population: 4000,
	              rainfall: 500,
	              longitude: lon,
	              latitude: lat
	            });

	            fiturIkon.push(iconFeature);
	             //alert(name+" "+lon+" "+lat);
	              var vectorSource = new ol.source.Vector({
	              features: fiturIkon
	            });
        	}

          

          var iconStyle = new ol.style.Style({
            image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
              anchor: [0.5, 46],
              anchorXUnits: 'fraction',
              anchorYUnits: 'pixels',
              opacity: 0.75,
              src: 'http://localhost/kh/img/icon.png'
            }))
          });

          var vectorLayer = new ol.layer.Vector({
            source: vectorSource,
            style: iconStyle
          });

          /*
            var rasterLayer = new ol.layer.Tile({
              source: new ol.source.TileJSON({
                url: 'http://api.tiles.mapbox.com/v3/mapbox.geography-class.json',
                crossOrigin: ''
              })
            });
          */

          var layerKite = new ol.layer.Tile({
                source: new ol.source.OSM()
              });

          var map = new ol.Map({
            layers: [layerKite, vectorLayer],
            target: document.getElementById('map'),
            view: new ol.View({
              center: ol.proj.transform([120.921737, -2.207274 ], 'EPSG:4326', 'EPSG:3857'),
              zoom: 4
            })
          });

          var element = document.getElementById('popup');

          var popup = new ol.Overlay({
            element: element,
            positioning: 'bottom-center',
            stopEvent: false
          });
          map.addOverlay(popup);

          // display popup on click
          map.on('click', function(evt) {
            var feature = map.forEachFeatureAtPixel(evt.pixel,
                function(feature) {
                  return feature;
                });
            if (feature) {
              var gName = feature.get('name');
              var gLat = feature.get('latitude');
              var gLon  = feature.get('longitude');
              var $toastContent = $('<h5>'+gName+'</h5>');
              var $toastContent2 = $('<h6>Longitude: '+gLon+'</h6>');
              var $toastContent3 = $('<h6>Latitude: '+gLat+'</h6>');
              Materialize.toast($toastContent, 2000);
              Materialize.toast($toastContent2, 2000);
              Materialize.toast($toastContent3, 2000);
              /*popup.setPosition(evt.coordinate);
              $(element).popover({
                'placement': 'top',
                'html': true,
                'content': '<p>'+feature.get('name')+'</p>'+'<p>Lon: '+feature.get('longitude')+'</p>'+"Lat: "+feature.get('latitude')
              });
              $(element).popover('show');*/
            } else {
              /*$(element).popover('destroy');*/
            }
          });

          // change mouse cursor when over marker
          map.on('pointermove', function(e) {
            if (e.dragging) {
              $(element).popover('destroy');
              return;
            }
            var pixel = map.getEventPixel(e.originalEvent);
            var hit = map.hasFeatureAtPixel(pixel);
            map.getTarget().style.cursor = hit ? 'pointer' : '';
          });
        }
      })
    });
    </script>