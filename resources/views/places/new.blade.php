@extends('layouts.site')

@section('content')

<style type="text/css">

.imgbb-button {
  display: none;
}


#mapa {
  height:250px;
  width:100%;
}
</style>

<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">New Place</h4>
      <form class="form-sample" method="post" action="{{route('new_place')}}">
      @csrf

        <div class="row">
          <div class="col-md-12">
            <div id="mapa"></div>
          </div>
        </div>
        <br>



        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <div class="col-sm-12">
                <input placeholder="Name" name="name" type="text" class="form-control" />
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <div class="col-sm-12">
                <input type="text" class="form-control" name="phone" placeholder="Phone" />
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <div class="col-sm-12">
                <select class="form-control" id="state" name="state_id">
                    <option value=''>State</option>
                  @foreach($states as $state)
                    <option value='{{ $state->id }}'>{{ $state->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <div class="col-sm-12">
                <select class="form-control" id="city" name="city_id">
                  <option value=''>City</option>
                </select>
              </div>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <div class="col-sm-12">
                <select class="form-control js-fish-basic-multiple w-100" name="place_fishes[]" multiple="multiple">
                  <option>Fishes</option>
                  <option>Bagre</option>
                  <option>Carpa</option>
                  <option>Catfish</option>
                  <option>Lambari</option>
                  <option>Pacu</option>
                  <option>Tilápia</option>
                  <option>Traíra</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <div class="col-sm-12">
                <select class="form-control js-service-basic-multiple w-100" name="services[]" multiple="multiple">
                  <option>Services</option>
                  <option>Buffet</option>
                  <option>Cachoeira</option>
                  <option>Chalés</option>
                  <option>Lanchonete</option>
                  <option>Pesque e Pague</option>
                  <option>Piscina</option>
                  <option>Quiosques</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <div class="col-sm-12">
                <input placeholder="Latitude" id="latitude" name="latitude" type="text" class="form-control" />
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <div class="col-sm-12">
                <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude" />
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <div class="col-sm-12">
                <textarea style="height: auto;" name="description" rows="3" placeholder="Description" class="form-control"></textarea>
              </div>
            </div>
          </div>
         <div class="col-md-6">
            <div class="form-group row">
              <div class="col-sm-12">
                <select class="form-control" name="category">
                  <option>Category</option>
                  <option>Recanto</option>
                  <option>Pesque e Pague</option>
                  <option>Cachoeira</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <div class="col-sm-12">
                <input type="file" style="height: auto;" id="input_img" onchange="fileChange()" class="form-control" placeholder="Upload Image" />
                <input type="hidden" class="form-control" id="image_place" name="url_image" value="" />
                <div id="teste" style="display: none;">OK</div>
              </div>
            </div>
          </div>



        </div>

        <div class="row">
          <div class="col-md-8">
            <button type="submit" class="btn btn-success me-2">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">

function fileChange(){
  var file = document.getElementById('input_img');
  var form = new FormData();
  form.append("image", file.files[0])

  var settings = {
    "url": "https://api.imgbb.com/1/upload?key=2695e11befcab2be06f3ab072ef46067",
    "method": "POST",
    "timeout": 0,
    "processData": false,
    "mimeType": "multipart/form-data",
    "contentType": false,
    "data": form
  };

  $.ajax(settings).done(function (response) {
    console.log(response);
    var jx = JSON.parse(response);
    console.log(jx.data.url);
    $( "#image_place" ).val(jx.data.url);
    $( "#teste" ).css("display","block");
  });
}

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

$('#state').on('change', function () {
    var idState = this.value;
    //$("#city").html('');
    $.ajax({
        url: "{{url('places/fetch-cities')}}",
        type: "POST",
        data: {
            state_id: idState,
            _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (res) {
            $('#city').html('<option value="">Select City</option>');
            $.each(res.cities, function (key, value) {
                $("#city").append('<option value="' + value
                    .id + '">' + value.name + '</option>');
            });
        }
    });
});




function inicializar() {
  var coordenadas = {lat: -25.844566, lng: -49.074498};

  var mapa = new google.maps.Map(document.getElementById('mapa'), {
    zoom: 10,
    center: coordenadas 
  });

  let infoWindow = new google.maps.InfoWindow({
    content: "Click the map to get Lat/Lng!",
    position: coordenadas,
  });

  infoWindow.open(mapa);

  mapa.addListener("click", (mapsMouseEvent) => {
    // Close the current InfoWindow.
    infoWindow.close();
    // Create a new InfoWindow.
    infoWindow = new google.maps.InfoWindow({
      position: mapsMouseEvent.latLng,
    });
    infoWindow.setContent(
      JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
    );
    infoWindow.open(mapa);

    var teste = mapsMouseEvent.latLng.toString().split(",");

    $('#latitude').val(teste[0].replace("(", ""));
    $('#longitude').val(teste[1].replace(")", "").trim());

    var marker = new google.maps.Marker({
      position: mapsMouseEvent.latLng,
      map: mapa,
      title: 'Meu marcador'
    });
  });
}

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvDpp1YR00qvAMjor6PdR3kpJEqR-9tTI&callback=inicializar"></script>
@endsection