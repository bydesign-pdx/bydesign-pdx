//global infoBox
var infoBox;
//global map
var map;
// global list properties
var gmarkers = [];
// global cureent properties index
var gmarker_index = 1;
// global map search box
var mapSearchBox;
// global MarkerClusterer
var mcluster;
function noo_number_format(number, decimals, dec_point, thousands_sep) {
  number = (number + '')
    .replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}
!function(e){"use strict";function a(e){var a,o=nooGmapL10n.currency_position;switch(o){case"left":a="%1$s%2$s";break;case"right":a="%2$s%1$s";break;case"left_space":a="%1$s&nbsp;%2$s";break;case"right_space":a="%2$s&nbsp;%1$s"}return e=noo_number_format(e,nooGmapL10n.num_decimals,nooGmapL10n.decimal_sep,nooGmapL10n.thousands_sep),a.replace("%1$s",nooGmapL10n.currency).replace("%2$s",e)}function o(){mapSearchBox=e(".noo-map");var a=mapSearchBox.find("#gmap"),o=nooGmapL10n.latitude,t=nooGmapL10n.longitude;if(mapSearchBox.length&&a.length){var n=new google.maps.LatLng(o,t),i={flat:!1,noClear:!1,zoom:parseInt(nooGmapL10n.zoom),scrollwheel:!1,streetViewControl:!1,disableDefaultUI:!0,draggable:!Modernizr.touch||nooGmapL10n.draggable,center:n,mapTypeId:google.maps.MapTypeId.ROADMAP};map=new google.maps.Map(a.get(0),i),google.maps.visualRefresh=!0,google.maps.event.addListener(map,"tilesloaded",function(){mapSearchBox.find(".gmap-loading").hide()});var r=document.getElementById("gmap_search_input");map.controls[google.maps.ControlPosition.TOP_LEFT].push(r);var p=new google.maps.places.SearchBox(r);google.maps.event.addListener(p,"places_changed",function(){var e=p.getPlaces();if(0!=e.length){for(var a,o=new google.maps.LatLngBounds,t=0;a=e[t];t++){{new google.maps.Marker({map:map,zoom:parseInt(nooGmapL10n.zoom),title:a.name,position:a.geometry.location})}o.extend(a.geometry.location)}map.fitBounds(o),map.setZoom(parseInt(nooGmapL10n.zoom))}});var g={content:document.createElement("div"),disableAutoPan:!0,maxWidth:500,boxClass:"myinfobox",zIndex:null,closeBoxMargin:"-13px 0px 0px 0px",closeBoxURL:"",infoBoxClearance:new google.maps.Size(1,1),isHidden:!1,pane:"floatPane",enableEventPropagation:!1};infoBox=new InfoBox(g);var m=function(e){var a='<div class="gmap-infobox"><a class="info-close" onclick="return infoBox.close();" href="javascript:void(0)">x</a>					 <div class="info-img">'+e.image+'</div> 						 <div class="info-summary"> 						 	<h5 class="info-title">'+e.title+'</h5> 						 	<div class="info-detail"> 					 			<div class="size"><span>'+e.area+'</span></div> 					 			<div class="bedrooms"><span>'+e.bedrooms+'</span></div> 					 			<div class="bathrooms"><span>'+e.bathrooms+'</span></div> 					 		</div> 					 		<div class="info-more"> 					 			<div class="info-price">'+e.price_html+'</div> 					 			<div class="info-action"><a href="'+e.url+'"><i class="fa fa-plus"></i></a></div> 					 		</div> 					 	</div> 				 	</div>';infoBox.setContent(a),infoBox.open(map,e),map.setCenter(e.position),map.panBy(50,-120)};if("IDX"==e(a).data("source")&&"object"==typeof dsidx&&dsidx.dataSets){var d=null,c=new google.maps.LatLngBounds;e.each(dsidx.dataSets,function(e){d=e});for(var u=0;u<dsidx.dataSets[d].length;u++){var f=dsidx.dataSets[d][u];if(void 0!==f.ShortDescription)var h=f.ShortDescription.split(","),v=h[0]+", "+h[1];else var v=f.Address+", "+f.City;var _=new google.maps.LatLng(f.Latitude,f.Longitude),x=new google.maps.Marker({position:_,map:map,area:f.ImprovedSqFt+" "+nooGmapL10n.area_unit,image:f.PhotoUriBase,title:v,bedrooms:f.BedsShortString,bathrooms:f.BathsShortString,price_html:f.Price,url:nooGmapL10n.home_url+"/idx/"+f.PrettyUriForUrl});x.setIcon(nooGmapL10n.theme_uri+"/assets/images/marker-icon.png"),gmarkers.push(x),c.extend(x.getPosition()),nooGmapL10n.fitbounds&&map.fitBounds(c),google.maps.event.addListener(x,"click",function(){var e='<div class="gmap-infobox"><a class="info-close" onclick="return infoBox.close();" href="javascript:void(0)">x</a>							 <div class="info-img"><img src="'+this.image+'1-full.jpg" style="width:190px;height:160px"/></div> 								 <div class="info-summary"> 								 	<h5 class="info-title">'+this.title+'</h5> 								 	<div class="info-detail"> 							 			<div class="size"><span>'+this.area+'</span></div> 							 			<div class="bedrooms"><span>'+parseInt(this.bedrooms)+'</span></div> 							 			<div class="bathrooms"><span>'+parseInt(this.bathrooms)+'</span></div> 							 		</div> 							 		<div class="info-more"> 							 			<div class="info-price">'+this.price_html+'</div> 							 			<div class="info-action"><a href="'+this.url+'"><i class="fa fa-plus"></i></a></div> 							 		</div> 							 	</div> 						 	</div>';infoBox.setContent(e),infoBox.open(map,this),map.setCenter(this.position),map.panBy(50,-120)})}}else{var b=e.parseJSON(nooGmapL10n.markers);if(b.length)for(var c=new google.maps.LatLngBounds,y=s(),u=0;u<b.length;u++){var f=b[u],_=new google.maps.LatLng(f.latitude,f.longitude),x=new google.maps.Marker({position:_,map:map,image:f.image,title:f.title,area:f.area,bedrooms:f.bedrooms,bathrooms:f.bathrooms,price:f.price,price_html:f.price_html,url:f.url,category:f.category,status:f.status,sub_location:f.sub_location,location:f.location});""!=f.icon&&x.setIcon(f.icon),gmarkers.push(x),l(x,y)&&(c.extend(x.getPosition()),nooGmapL10n.fitbounds&&map.fitBounds(c)),google.maps.event.addListener(x,"click",function(){m(this)})}}var k=[{textColor:"#ffffff",opt_textColor:"#ffffff",url:nooGmapL10n.theme_uri+"/assets/images/cloud.png",height:72,width:72,textSize:15}];mcluster=new MarkerClusterer(map,gmarkers,{gridSize:50,ignoreHidden:!0,styles:k}),mcluster.setIgnoreHidden(!0),mapSearchBox.find(".zoom-in").length&&google.maps.event.addDomListener(mapSearchBox.find(".zoom-in").get(0),"click",function(e){e.stopPropagation(),e.preventDefault();var a=parseInt(map.getZoom(),10);a++,a>20&&(a=20),map.setZoom(a)}),mapSearchBox.find(".zoom-out").length&&google.maps.event.addDomListener(mapSearchBox.find(".zoom-out").get(0),"click",function(e){e.stopPropagation(),e.preventDefault();var a=parseInt(map.getZoom(),10);a--,0>a&&(a=0),map.setZoom(a)})}}function t(e){var a={coord:[1,1,1,38,38,59,59,1],type:"poly"};15!=map.getZoom()&&map.setZoom(15);var o=new google.maps.LatLng(e.coords.latitude,e.coords.longitude);map.setCenter(o);{var t=(new google.maps.Marker({position:o,map:map,icon:nooGmapL10n.theme_uri+"/assets/images/my-marker.png",shape:a,zIndex:9999,infoWindowIndex:9999,radius:1e3}),{strokeColor:"#75b08a",strokeOpacity:.6,strokeWeight:1,fillColor:"#75b08a",fillOpacity:.2,map:map,center:o,radius:1e3});new google.maps.Circle(t)}}function n(){alert(nooGmapL10n.no_geolocation_pos)}function i(){var a,o=e(".property-map-box"),t=o.data("zoom"),n=o.data("latitude"),i=o.data("longitude"),r=o.data("marker");if(o.length){var s=new google.maps.LatLng(n,i),l=new google.maps.Map(o.get(0),{flat:!1,noClear:!1,zoom:t,scrollwheel:!1,draggable:!Modernizr.touch||nooGmapL10n.draggable,center:s,streetViewControl:!1,mapTypeId:google.maps.MapTypeId.ROADMAP});""==r&&(r=nooGmapL10n.theme_uri+"/assets/images/marker-icon.png");var r=new google.maps.Marker({icon:r,position:s,map:l}),p=document.getElementById("property_map_search_input");l.controls[google.maps.ControlPosition.TOP_LEFT].push(p);var g=new google.maps.places.SearchBox(p);google.maps.event.addListener(g,"places_changed",function(){null!=a&&a.setMap(null);{var e=new google.maps.Geocoder,o=function(a){e.geocode({latLng:a},function(e,a){return a==google.maps.GeocoderStatus.OK&&e[0]?e[0].formatted_address:void 0})};o(s)}e.geocode({address:p.value},function(e,o){if(o==google.maps.GeocoderStatus.OK){l.setCenter(e[0].geometry.location),a=new google.maps.Marker({position:e[0].geometry.location,map:l,draggable:!1,animation:google.maps.Animation.DROP});var t=p.value,n=s,i=new google.maps.DirectionsService,r=new google.maps.DirectionsRenderer;r.setMap(l);var g={origin:t,destination:n,travelMode:google.maps.TravelMode.DRIVING};i.route(g,function(e,a){a==google.maps.DirectionsStatus.OK&&r.setDirections(e)})}else alert("Geocode was not successful for the following reason: "+o)})})}}function r(){e(".noo_advanced_search_property").each(function(){var a=e(this);if(a.find("#gmap").length){var o=s();"undefined"!=typeof infoBox&&null!==infoBox&&infoBox.close();var t=new google.maps.LatLngBounds;if("undefined"!=typeof mcluster&&mcluster.setIgnoreHidden(!0),gmarkers.length){for(var n=0;n<gmarkers.length;n++){var i=gmarkers[n];l(i,o)&&t.extend(i.getPosition())}"undefined"!=typeof mcluster&&mcluster.repaint()}map.setZoom(10),t.isEmpty()||map.fitBounds(t)}})}function s(){var a={location:"",sub_location:"",status:"",category:"",bedrooms:0/0,bathrooms:0/0,min_price:0/0,max_price:0/0,min_area:0/0,max_area:0/0};if(!e("#gmap").length)return a;var o=e(".noo_advanced_search_property .gsearch");return o.length&&(a.location=o.find("input.glocation_input").length>0?o.find("input.glocation_input").val():"",a.sub_location=o.find("input.gsub_location_input").length>0?o.find("input.gsub_location_input").val():"",a.status=o.find("input.gstatus_input").length>0?o.find("input.gstatus_input").val():"",a.category=o.find("input.gcategory_input").length>0?o.find("input.gcategory_input").val():"",a.bedrooms=o.find("input.gbedroom_input").length>0?parseInt(o.find("input.gbedroom_input").val()):0/0,a.bathrooms=o.find("input.gbathroom_input").length>0?parseInt(o.find("input.gbathroom_input").val()):0/0,a.min_price=o.find("input.gprice_min").length>0?parseFloat(o.find("input.gprice_min").val()):0/0,a.max_price=o.find("input.gprice_max").length>0?parseFloat(o.find("input.gprice_max").val()):0/0,a.min_area=o.find("input.garea_min").length>0?parseInt(o.find("input.garea_min").val()):0/0,a.max_area=o.find("input.garea_max").length>0?parseInt(o.find("input.garea_max").val()):0/0),a}function l(e,a){return null==e||"undefined"==typeof e?!1:null==a||"undefined"==typeof a?!1:e.location!==a.location&&""!=a.location?(e.setVisible(!1),!1):e.sub_location!==a.sub_location&&""!=a.sub_location?(e.setVisible(!1),!1):e.status!==a.status&&""!=a.status?(e.setVisible(!1),!1):e.category!==a.category&&""!=a.category?(e.setVisible(!1),!1):(isNaN(a.bedrooms)||e.bedrooms===a.bedrooms)&&(isNaN(a.bathrooms)||e.bathrooms===a.bathrooms)?!isNaN(a.min_price)&&parseFloat(e.price)<a.min_price?(e.setVisible(!1),!1):!isNaN(a.max_price)&&parseFloat(e.price)>a.max_price?(e.setVisible(!1),!1):!isNaN(a.min_area)&&parseInt(e.area)<a.min_area?(e.setVisible(!1),!1):!isNaN(a.max_area)&&parseInt(e.area)>a.max_area?(e.setVisible(!1),!1):(e.setVisible(!0),!0):(e.setVisible(!1),!1)}e.fn.nooLoadmore=function(a,o){var t={agentID:0,contentSelector:null,contentWrapper:null,nextSelector:"div.navigation a:first",navSelector:"div.navigation",itemSelector:"div.post",dataType:"html",finishedMsg:"<em>Congratulations, you've reached the end of the internet.</em>",loading:{speed:"fast",start:void 0},state:{isDuringAjax:!1,isInvalidPage:!1,isDestroyed:!1,isDone:!1,isPaused:!1,isBeyondMaxPage:!1,currPage:1}},a=e.extend(t,a);return this.each(function(){var t=this,n=e(this),i=n.find(".loadmore-wrap"),r=n.find(".loadmore-action"),s=r.find(".btn-loadmore"),l=r.find(".loadmore-loading");a.contentWrapper=a.contentWrapper||i;var p=function(e){if(e.match(/^(.*?)\b2\b(.*?$)/))e=e.match(/^(.*?)\b2\b(.*?$)/).slice(1);else if(e.match(/^(.*?)2(.*?$)/)){if(e.match(/^(.*?page=)2(\/.*|$)/))return e=e.match(/^(.*?page=)2(\/.*|$)/).slice(1);e=e.match(/^(.*?)2(.*?$)/).slice(1)}else{if(e.match(/^(.*?page=)1(\/.*|$)/))return e=e.match(/^(.*?page=)1(\/.*|$)/).slice(1);a.state.isInvalidPage=!0}return e},g=e(a.nextSelector).attr("href");g=p(g),a.callback=function(t,n){o&&o.call(e(a.contentSelector)[0],t,a,n)},a.loading.start=a.loading.start||function(){s.hide(),e(a.navSelector).hide(),l.show(a.loading.speed,e.proxy(function(){m(a)},t))};var m=function(a){{var o;a.callback}return a.state.currPage++,void 0!==a.maxPage&&a.state.currPage>a.maxPage?void(a.state.isBeyondMaxPage=!0):(o=g.join(a.state.currPage),void e.post(nooGmapL10n.ajax_url,{action:"noo_agent_ajax_property",page:a.state.currPage,agent_id:a.agentID},function(o){return""==o.content||null==o.content||void 0==o.content?(s.hide(),void r.append('<div style="margin-top:5px;">'+a.finishedMsg+"</div>").animate({opacity:1},2e3,function(){r.fadeOut(a.loading.speed)})):(e(a.contentWrapper).append(o.content),l.hide(),s.show(a.loading.speed),void 0)},"json"))};s.on("click",function(o){o.stopPropagation(),o.preventDefault(),a.loading.start.call(e(a.contentWrapper)[0],a)})})},google.maps.event.addDomListener(window,"load",o),e(document).on("click",".gmap-mylocation",function(e){e.stopPropagation(),e.preventDefault(),navigator.geolocation?navigator.geolocation.getCurrentPosition(t,n,{timeout:1e4}):alert(nooGmapL10n.no_geolocation_msg)}),e(document).on("click",".gmap-full",function(a){a.stopPropagation(),a.preventDefault(),e(this).closest(".noo-map").hasClass("fullscreen")?(e(this).closest(".noo-map").removeClass("fullscreen"),e(this).empty().html('<i class="fa fa-expand"></i> '+nooGmapL10n.fullscreen_label)):(e(this).closest(".noo-map").addClass("fullscreen"),e(this).empty().html('<i class="fa fa-compress"></i> '+nooGmapL10n.default_label)),google.maps.event.trigger(map,"resize")}),e(document).on("click",".gmap-prev",function(e){for(e.stopPropagation(),e.preventDefault(),gmarker_index--,gmarker_index<1&&(gmarker_index=gmarkers.length);gmarkers[gmarker_index-1].visible===!1;)gmarker_index--,gmarker_index>gmarkers.length&&(gmarker_index=1);map.getZoom()<15&&map.setZoom(15),google.maps.event.trigger(gmarkers[gmarker_index-1],"click")}),e(document).on("click",".gmap-next",function(e){for(e.stopPropagation(),e.preventDefault(),gmarker_index++,gmarker_index>gmarkers.length&&(gmarker_index=1);gmarkers[gmarker_index-1].visible===!1;)gmarker_index++,gmarker_index>gmarkers.length&&(gmarker_index=1);map.getZoom()<15&&map.setZoom(15),google.maps.event.trigger(gmarkers[gmarker_index-1],"click")}),google.maps.event.addDomListener(window,"load",i),e(document).ready(function(){if(e(".gsearch").length&&(e(".gsearch").find(".dropdown-menu > li > a").on("click",function(a){a.stopPropagation(),a.preventDefault();var o=e(this).closest(".dropdown"),t=e(this).data("value");o.children("input").val(t),o.children("input").trigger("change"),o.children('[data-toggle="dropdown"]').text(e(this).text()),o.children('[data-toggle="dropdown"]').dropdown("toggle")}),e(".noo-map").length&&e(".noo-map").each(function(){e(this).hasClass("no-gmap")||e(this).find(".gsearch").find(".gsearch-field").find('input[type="hidden"]').on("change",function(){r()})})),e(".gprice").length){var o=e(".gprice"),t=o.find(".gprice_min").data("min"),n=o.find(".gprice_max").data("max"),i=o.find(".gprice_min").val(),s=o.find(".gprice_max").val();o.find(".gprice-slider-range").slider({range:!0,animate:!0,min:t,max:n,values:[i,s],create:function(){var o=e(this).find(".ui-slider-handle");e(o[0]).tooltip({title:a(i),placement:"bottom",container:"body",html:!0}),e(o[1]).tooltip({title:a(s),placement:"bottom",container:"body",html:!0})},slide:function(t,n){var i=e(this).find(".ui-slider-handle");n.value==n.values[0]&&(o.find("input.gprice_min").val(n.values[0]).trigger("change"),e(i[0]).attr("data-original-title",a(n.values[0])).tooltip("fixTitle").tooltip("show")),n.value==n.values[1]&&(o.find("input.gprice_max").val(n.values[1]).trigger("change"),e(i[1]).attr("data-original-title",a(n.values[1])).tooltip("fixTitle").tooltip("show"))}})}if(e(".garea").length){var l=e(".garea"),p=l.find(".garea_min").data("min"),g=l.find(".garea_max").data("max"),m=l.find(".garea_min").val(),d=l.find(".garea_max").val();l.find(".garea-slider-range").slider({range:!0,animate:!0,min:p,max:g,values:[m,d],create:function(){var a=e(this).find(".ui-slider-handle");e(a[0]).tooltip({title:m+" "+nooGmapL10n.area_unit,placement:"bottom",container:"body",trigger:"hover focus",html:!0}),e(a[1]).tooltip({title:d+" "+nooGmapL10n.area_unit,placement:"bottom",container:"body",trigger:"hover focus",html:!0})},slide:function(a,o){var t=e(this).find(".ui-slider-handle");o.value==o.values[0]&&(l.find("input.garea_min").val(o.values[0]).trigger("change"),e(t[0]).attr("data-original-title",o.values[0]+" "+nooGmapL10n.area_unit).tooltip("fixTitle").tooltip("show")),o.value==o.values[1]&&(l.find("input.garea_max").val(o.values[1]).trigger("change"),e(t[1]).attr("data-original-title",o.values[1]+" "+nooGmapL10n.area_unit).tooltip("fixTitle").tooltip("show"))}})}})}(jQuery);