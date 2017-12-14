var map, mapControls, tooltipCtrl, infoControls, control, vpoint, vector_layer;
if(!window.map) window.map = map;
var kabupatenLayer, grid;
vector_layer = new OpenLayers.Layer.Vector(' Json'); 
		function init(){ 
			var options = { 	
				displayProjection: new OpenLayers.Projection("EPSG:4326"),
				controls: [
				new OpenLayers.Control.Navigation(),
				  new OpenLayers.Control.ArgParser(),
				  new OpenLayers.Control.Attribution(),
				  new OpenLayers.Control.Scale('scale'),
				  new OpenLayers.Control.PanZoomBar(),
				  new OpenLayers.Control.LayerSwitcher({'ascending':true}),
				 // new OpenLayers.Control.Permalink(),
				  new OpenLayers.Control.MousePosition(),
				  new OpenLayers.Control.KeyboardDefaults()
				],
				numZoomLevels: 20	
			};
			map = new OpenLayers.Map('map', options);
			var	tooltip = new OpenLayers.Popup("ttdata", 
				null,
				new OpenLayers.Size(140, 60),
				"<div style='font-size:.8em;padding:5px;overflow:hidden;'>tooltips</div>",
				false
			);
			//map.addPopup(tooltip);
			if(!window.tooltip) window.tooltip = tooltip;
			
			var lon     = 116.97 ;
			var lat     = -2.56 ;
			var zoom    = 5;
			
			layer = new OpenLayers.Layer.OSM("Administrasi", "http://tile.openstreetmap.org/${z}/${x}/${y}.png", {numZoomLevels: 19});
			map.addLayer(layer); 
			jumpTo(lon, lat, zoom);				
			 
		}
		function jumpTo(lon, lat, zoom)	{
			var y = Lon2Merc(lon);
			var x = Lat2Merc(lat);
			map.setCenter(new OpenLayers.LonLat(y, x), zoom);
			return false;
		}	
		function deletepoint(vector_layer)	{
			
			vector_layer.destroy();
			vector_layer.destroyFeatures();
			alert(vector_layer);
			return false;
		}
		function feature_click(feature) {
			if(feature.popup) {
				if(!feature.popup.isinfoclick) {
					feature.popup.destroy();
					feature.popup = null;
					create_tooltip(feature);
				}
				//else return;
				else create_tooltip(feature);
			}
			else create_tooltip(feature);
		}
		function onFeatureSelect(feature) {
                
                popup = new OpenLayers.Popup.FramedCloud("featurePopup",
                                         feature.geometry.getBounds().getCenterLonLat(),
                                         new OpenLayers.Size(400,500),
                                         "<h2>"+feature.attributes.tipe + "</h2>" +
                                         feature.attributes.popup,
                                         null, true, null);
                feature.popup = popup;
                popup.feature = feature;
                map.addPopup(popup, true);
            }
			function onPopupClose(feature) {
                // 'this' is the popup.
             
                if (feature.layer) { // The feature is not destroyed
                    selectControl.unselect(feature);
                } else { // After "moveend" or "refresh" events on POIs layer all 
                         //     features have been destroyed by the Strategy.BBOX
                    this.destroy();
                }
            }
		function Lon2Merc(lon) {
			return 20037508.34 * lon / 180;
		}
	 
		function Lat2Merc(lat) {
			var PI = 3.14159265358979323846;
			lat = Math.log(Math.tan( (90 + lat) * PI / 360)) / (PI / 180);
			return 20037508.34 * lat / 180;
		}
		
		function create_tooltip(feature) {
			var size = new OpenLayers.Size(10,10);
			var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
			var popup = new OpenLayers.Popup.FramedCloud("popupdata", 
				feature.geometry.getBounds().getCenterLonLat(),
				new OpenLayers.Size(10, 10),
				"<div class='tipinside'>" + feature.attributes.popup + "</div>",
				{'size':size, 'offset':new OpenLayers.Pixel(offset.x/2,offset.y/2)},
				true,
				function(evt) { 
					this.destroy();
				}
			);
			feature.popup = popup;
			feature.popup.isinfoclick = true;
			popup.autoSize = true;
			map.addPopup(popup);
		}
 