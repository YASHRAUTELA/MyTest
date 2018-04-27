<!DOCTYPE html>
<html>
<head>
	<title>Geo Location Address</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   
</head>
<body>
	<header>

		<div class="container">
		@if (session('error'))
                        <div class="col-md-8 col-md-offset-2 alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="col-md-8 col-md-offset-2  alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
			<div class="col-md-12" style="text-align: center">
				<h1>Add Person Data</h1>				
			</div>
		</div>
	</header>
	<section>
		<div class="container" style="padding: 100px;">
			<form method="POST" action="{{route('addPerson')}}">
			{{csrf_field()}}
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-3">
							<label>Name</label>

						</div>
						<div class="col-md-9">
							<input type="text" name="name" class="form-control">
						</div>

					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<label>Address</label>

						</div>
						<div class="col-md-9">
							<input id="autocomplete" class="form-control" placeholder="Enter your address" onFocus="geolocate()" type="text">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-2">
							<label>Street</label>
						</div>
						<div class="col-md-4">
							<input class="form-control" name="street_number" id="street_number" disabled="true" >
						</div>
						<div class="col-md-2">
							<label>Route</label>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control "
	              			id="route" name="route" disabled="true">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-2">
							<label>Locality</label>
						</div>
						<div class="col-md-4">
							<input class="form-control" id="locality" name="locality" disabled="true" >
						</div>
						<div class="col-md-2">
							<label>State</label>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control "
	              			id="administrative_area_level_1" name="state" disabled="true">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-2">
							<label>Zip Code</label>
						</div>
						<div class="col-md-4">
							<input class="form-control" id="postal_code" disabled="true" name="postal_code" >
						</div>
						<div class="col-md-2">
							<label>Country</label>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control" id="country" name="country" disabled="true">
						</div>
					</div>

					<br>
					<div class="row">
						<div class="col-md-3 col-md-offset-9">
							<button class="btn btn-success" type="submit">Submit</button>
						</div>
					</div>
				</div>
			</form>
			
		</div>
	</section>


	<script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
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
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1bO8Ke_FQ6IQDZVTQ3cFjnslBEt7GXsI&libraries=places&callback=initAutocomplete"
        async defer></script>
</body>
</html>