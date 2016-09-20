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

});

// ------- GEOLOCATION -------

var placeSearch, autocomplete;
var componentForm = {
  street_number: ['Business_address_1', 'short_name'],
  locality: ['Business_address_2', 'long_name'],
  postal_town: ['Business_town', 'long_name'],
  administrative_area_level_2: ['Business_county', 'short_name'],
  postal_code: ['Business_postcode', 'short_name']
};

console.log(componentForm['postal_code'][1]);

function initAutocomplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(document.getElementById('autocomplete_address')),
      {types: ['geocode']});

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(componentForm[component][0]).value = '';
    document.getElementById(componentForm[component][0]).disabled = false;
  }

  var allInArray = {};

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  console.log(place.address_components);
  for (var i = 0; i < place.address_components.length; i++) {
    allInArray[place.address_components[i].types[0]] = place.address_components[i];
  } // for loop

  // loop through the "allInArray"
  for (var addressType in allInArray) {
    if (componentForm[addressType]) {
      if(addressType == 'street_number'){
        var val = allInArray['street_number']['short_name'] + " " + allInArray['route']['long_name'];
      }
      else if(addressType == 'locality'){ // Make sure address line 2 isn't the same as the town/city
        if(allInArray['locality']['long_name'] != allInArray['postal_town']['long_name']){
          var val = allInArray['locality']['long_name'];
        }
        else{
          val = "";
        }
      }
      else{
        var val = allInArray[addressType][componentForm[addressType][1]];
      }
      document.getElementById(componentForm[addressType][0]).value = val;
    }
  }

  $(".business-form-address-fields").slideDown();
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}