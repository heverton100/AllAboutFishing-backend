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
      <h4 class="card-title">Edit Place {{$places->id}}</h4>
      <form class="form-sample" method="post" action="{{ route('update_place', ['id'=> $places->id]) }}">
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
                <input placeholder="Name" name="name" type="text" value="{{$places->name}}" class="form-control" />
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <div class="col-sm-12">
                <input type="text" class="form-control" name="phone" value="{{$places->phone}}" placeholder="Phone" />
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
                    <option value='{{ $state->id }}' {{ ($places->state_id == $state->id)? "selected" : "" }}>{{ $state->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <div class="col-sm-12">
                <select class="form-control" id="city" name="city_id">
                  <option value='{{$places->city_id}}'>{{$places->city_name}}</option>

                </select>
              </div>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <div class="col-sm-12">
                <select class="form-control js-fish-basic-multiple w-100" id="place_fishes" name="place_fishes[]" multiple="multiple">
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
                <select class="form-control js-service-basic-multiple w-100" id="services" name="services[]" multiple="multiple">
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
                <input placeholder="Latitude" id="latitude" name="latitude" value="{{$places->latitude}}" type="text" class="form-control" />
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <div class="col-sm-12">
                <input type="text" class="form-control" id="longitude" value="{{$places->longitude}}" name="longitude" placeholder="Longitude" />
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <div class="col-sm-12">
                <textarea style="height: auto;" name="description" rows="3" placeholder="Description" class="form-control">{{$places->description}}</textarea>
              </div>
            </div>
          </div>
         <div class="col-md-6">
            <div class="form-group row">
              <div class="col-sm-12">
                <select class="form-control" id="category" name="category">
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

                @if ($places->url_image)
                <a href="{{$places->url_image}}" data-lightbox="{{$places->url_image}}">
                  <i class="menu-icon mdi mdi-image" style="font-size: 30px;color: limegreen;"></i>
                </a>
                @endif

                <input type="file" style="height: auto;" id="input_img" onchange="fileChange()" class="form-control" placeholder="Upload Image" />
                <input type="hidden" class="form-control" id="image_place" name="url_image" value="" />
                <div id="teste" style="display: none;">OK</div>
              </div>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-7">
            <button type="submit" class="btn btn-success me-2">Submit</button>
          </div>
          <div class="col-md-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              Add Images
            </button>
          </div>
          <div class="col-md-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalGallery">
              Gallery
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-sample" method="post" enctype="multipart/form-data" action="{{route('new_image_gallery')}}">
      @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Add Image</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="form-group row">
            <div class="col-sm-12">
              <input style="height: auto;" type="file" name="url_photo" id="url_photo" class="form-control" placeholder="Upload Image" />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12">
              <input style="height: auto;" placeholder="Subtitle" name="subtitle" type="text" class="form-control" />
            </div>
          </div>
          <input type="hidden" class="form-control" name="place_id" value="{{$places->id}}" />
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Send</button>
        </div>
      </form>  
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modalGallery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Gallery</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        <table class="table table-striped">
          <thead>
            <tr>

              <th>
                Image
              </th>
              <th>
                Subtitle
              </th>
              <th>
                Options
              </th>

            </tr>
          </thead>
          <tbody>
            @foreach($galleries as $gallery)
              <tr>
                <td>

                  @if ($gallery->url_photo)
                  <a href="{{$gallery->url_photo}}" 
                     data-lightbox="{{$gallery->url_photo}}">
                      <i class="menu-icon mdi mdi-image" style="font-size: 30px;color: limegreen;"></i>
                  </a>
                  @endif

                </td>
                <td>{{$gallery->subtitle}}</td>

                <td>

                  <a onclick="deletegallery({{$gallery->id}})" style='margin-left: 10px;width: 30px;height: 30px;padding: 5px;' href='#' class='btn btn-danger btn-rounded btn-social-icon'><i class='menu-icon mdi mdi-delete'></i></a>

                </td>
              </tr>
            @endforeach

          </tbody>
        </table>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
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


function deletegallery($id) {
  let text = "Are you sure you want to delete this image with id " + $id + " ?";
  if (confirm(text) == true) {
    window.location = "../../gallery/delete/{{$places->id}}/"+$id;
  }
}


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

$("#category").val("{{$places->category}}").change();

var $select001 = $('#services');
$select001.val(null).trigger('change');

var servicestemp = "{{$places->services}}";
var temp001 = servicestemp.split(",");

temp001.forEach(function(element){
  var $option = $('<option selected>'+element+'</option>').val(element);
  $select001.append($option).trigger('change');
});


var $select002 = $('#place_fishes');
$select002.val(null).trigger('change');

var place_fishestemp = "{{$places->place_fishes}}";
var temp002 = place_fishestemp.split(",");

temp002.forEach(function(element){
  var $option2 = $('<option selected>'+element+'</option>').val(element);
  $select002.append($option2).trigger('change');
});


$.ajax({
    url: "{{url('places/fetch-cities')}}",
    type: "POST",
    data: {
        state_id: $('#state').val(),
        _token: '{{csrf_token()}}'
    },
    dataType: 'json',
    success: function (res) {
        $('#city').html('<option value="">Select City</option>');
        $.each(res.cities, function (key, value) {
          if (value.id == {{$places->city_id}}) {
            $("#city").append('<option selected value="' + value.id + '">' + value.name + '</option>');
          }else{
            $("#city").append('<option value="' + value.id + '">' + value.name + '</option>');
          }
        });
    }
});

function inicializar() {
  var coordenadas = {lat: {{$places->latitude}}, lng: {{$places->longitude}}};

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