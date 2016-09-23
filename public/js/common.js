var xhr;
var timeout;

$(function(){
	isTouchSupported = "ontouchend" in document;
});

/*jQuery(function($) {
	// /////
	// CLEARABLE INPUT
	function tog(v){ return v?'addClass':'removeClass'; }
	$(document).on('input', '.clearable', function(){
		$(this)[tog(this.value)]('x');
	}).on('mousemove', '.x', function( e ){
		$(this)[tog(this.offsetWidth-18 < e.clientX-this.getBoundingClientRect().left)]('onX');
	}).on('click', '.onX', function(){
		$(this).removeClass('x onX').val('').change(); $(this).blur(); search();
	});
});*/

/*$(function(){
    //$("#q").focus(); //Focus on search field
    $("#main-search").autocomplete({
        minLength: 0,
        delay:5,
        data: { 'type': "test" },
        source: function(event, ui) {
        	console.log(this.value);
			// var field_value = $(this).val();
			// var field_type = $(this).parent(".search-group").children(".search-field-btn").children(".btn-filter-option").attr('value');
			// var feed = specific_feed;

	        $.ajax({
	            type: "POST",
	            url: "/search/suggest",
	            data: { 'type': 'retailer', 'term': field_value, 'feed': specific_feed },
	            success: function(data) {
	                response($.map(data, function(obj) {
	                    return {
	                        label: obj,
	                        value: obj,
	                        id: obj // don't really need this unless you're using it elsewhere.
	                    };
	                }));
	            }
	        });
	    },
        focus: function(event, ui) {
            $(this).val( ui.item.value );
            return false;
        },
        select: function(event, ui) {
            $(this).val( ui.item.value );
            return false;
        }
    });
});*/
$(document).ready(function(){

  // -------- GEOLOCATION ----------
  if(geoplugin_city()){
    curr_location = geoplugin_city()+", "+geoplugin_countryName();
    $("#location").val(curr_location);
  }
  else{
    /*if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
    }*/
    if (navigator && navigator.geolocation) {
        options={enableHighAccuracy: true, maximumAge: 15000, timeout: 30000};
        //options={maximumAge:Infinity, timeout:0};
        navigator.geolocation.watchPosition(successFunction, errorFunction, options);
    }

    initialize();
  }
  // -----------------------------

  $('.btn-toggle').click(function() {
      $(this).find('.btn').toggleClass('active');

      if ($(this).find('.btn-primary').size()>0) {
        $(this).find('.btn').toggleClass('btn-primary');
      }
      if ($(this).find('.btn-danger').size()>0) {
        $(this).find('.btn').toggleClass('btn-danger');
      }
      if ($(this).find('.btn-success').size()>0) {
        $(this).find('.btn').toggleClass('btn-success');
      }
      if ($(this).find('.btn-info').size()>0) {
        $(this).find('.btn').toggleClass('btn-info');
      }

      $(this).find('.btn').toggleClass('btn-default');

      $(this).find('.active input').prop("checked", true);
  });

  $("#main_search").on("click", function(){
    validateSearchForm();
  });

  $("#q").focus();
  $("#search_form #q").autocomplete({
      minLength: 0,
      delay: 5,
      source: function(request, response) {
        var field_value = $("#search_form #q").val();
            if(xhr && xhr.readystate != 4){
              xhr.abort();
            }
            xhr = $.ajax({
                type: "POST",
                url: "search/suggest",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { 'type': 'search', 'term': field_value },
                success: function(data) {
                console.log(data);
                response( $.map( data, function( item ) {
                return {
                    label: item.title,
                    value: item.title
                }}));
                },
                error: function (xhr, status, errorThrown) {
                    console.log(xhr.status);
                    console.log(xhr.responseText);
                }
            });
     },
    open: function(e,ui) {
      // Highlights/Bolds text typed in result suggestions
      var acData = $(this).data('ui-autocomplete');

      acData
          .menu
          .element
          .find('li')
          .each(function() {
            var me = $(this);

            me_txt = me.text();
            search_terms = acData.term.split(" ");
            $.each(search_terms, function(k1, v1){
              searchPattern = new RegExp(v1, 'gi');
              res = me_txt.match(searchPattern);
              res = $.unique(res);
              $.each(res, function(k2, v2){
                if(v2 != "b"){
                  me_txt = me_txt.replace(v2, "<b>"+v2+"</b>")
                }
              });
            });

            me.html(me_txt);
          });
    },
    select: function(event, ui) {
      window.clearTimeout(timeout);
      timeout = window.setTimeout(function(){
        $("#search_form #cat").val(ui.item.id);
      },50);
    },
    selectFirst: true,
    minLength: 0,
    delay: 2
      /*focus: function(event, ui) {
          $(this).val( ui.item.value );
          return false;
      },
      select: function(event, ui) {
          $(this).val( ui.item.value );
          return false;
      }*///availableTags
  }).keyup(function (e) {
      if(e.which === 13) {
          $(".ui-autocomplete").hide();
      }
  });


  $(".limit-chars").keyup(function(){
    var max_chars = $(this).attr("maxlength");

    if($(this).val().length > max_chars){
      $(this).val($(this).val().substr(0, max_chars));
    }
    var remaining = $(this).val().length;


    $(".max-chars."+$(this).attr("max-chars")).text(remaining);
    if(remaining <= 10 && !$(".max-chars."+$(this).attr("max-chars")).hasClass("red")){
      $(".max-chars."+$(this).attr("max-chars")).addClass("red");
    }
    else if(remaining > 10){
      $(".max-chars."+$(this).attr("max-chars")).removeClass("red");
    }
  });


  $('input.uppercase').blur(function(){
    return $(this).val(this.value.toUpperCase());
  });

  $('input.upperfirst').blur(function(){
    return $(this).val(ucwords(this.value));
  });

});


// ------- GEOLOCATION -------
var curr_location = "";
var geocoder;

//Get the latitude and the longitude;
function successFunction(position){
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    codeLatLng(lat, lng);
}

function errorFunction(){ alt_geoloc(); }

function initialize(){ geocoder = new google.maps.Geocoder(); }

function codeLatLng(lat, lng){
    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      //alert("1");
        if (status == google.maps.GeocoderStatus.OK) {
            if(results[1]) {
                //formatted address: alert(results[0].formatted_address)
                var curr_location = "";
                for (var i=0; i<results[0].address_components.length; i++) {
                    for (var b=0;b<results[0].address_components[i].types.length;b++) {
                        //console.log(results[0].address_components[i].types[b]);
                        if (results[0].address_components[i].types[b] == "postal_town") {
                            curr_location += results[0].address_components[i].long_name+", ";
                        }
                        if (results[0].address_components[i].types[b] == "administrative_area_level_2") {
                            curr_location += results[0].address_components[i].long_name+" ";
                        }
                        if (results[0].address_components[i].types[b] == "postal_code") {
                            curr_location += results[0].address_components[i].long_name;
                        }
                    }
                }

                if(curr_location && curr_location!="undefined"){ $("#location").val(curr_location); }
                else{ alt_geoloc(); }
            } else { alt_geoloc(); } //alert("No results found");
        } else { alt_geoloc(); } //alert("Geocoder failed due to: " + status);
    });
}

function alt_geoloc(){
    $.get("http://ipinfo.io", function(response) {
      if(response.city){
        curr_location = response.city+" "+response.postal;
        $("#location").val(curr_location);
      }
    }, "jsonp");
}


// ---------------------------

function validateSearchForm() {
    if($("#search_form #q").val() && $("#search_form #location").val()){
      $("#search_form").submit();
    }
    else{
      return false;
    }
}

function ucwords(str, force){
  str=force ? str.toLowerCase() : str;
    return str.replace(/(\b)([a-zA-Z])/g, function(firstLetter){
    return firstLetter.toUpperCase();
  });
}