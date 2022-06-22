@extends('layouts.site')

@section('content')


<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Places</h4>
      <p class="card-description">
        
      </p>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>

              <th>
                ID
              </th>
              <th>
                Name
              </th>
              <th>
                Category
              </th>
              <th>
                City
              </th>
              <th>
                State
              </th>
              <th>
                Phone
              </th>
              <th>
                Image
              </th>
              <th>
                Options
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($places as $place)
              <tr>
                <td>{{$place->id}}</td>
                <td>{{$place->name}}</td>
                <td>{{$place->category}}</td>
                <td>{{$place->city_name}}</td>
                <td>{{$place->state_name}}</td>
                <td>{{$place->phone}}</td>
                <td>

                  @if ($place->url_image)
                  <a href="{{$place->url_image}}" 
                     data-lightbox="{{$place->url_image}}">
                      <i class="menu-icon mdi mdi-image" style="font-size: 30px;color: limegreen;"></i>
                  </a>
                  @endif
                </td>
                <td>

                  <a href='places/edit/{{$place->id}}' class="btn btn-info btn-rounded btn-social-icon" style="width: 30px;height: 30px;padding: 5px;" data-toggle='modal' data-target='#modalEditUser'><i class='menu-icon mdi mdi-pencil'></i></a>

                  <a onclick="myFunction({{$place->id}})" style='margin-left: 10px;width: 30px;height: 30px;padding: 5px;' href='#' class='btn btn-danger btn-rounded btn-social-icon'  data-toggle='modal' data-target='#modalDeleteUser'><i class='menu-icon mdi mdi-delete'></i></a>

                </td>
              </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
  

.fab{
  position: fixed;
  bottom:10px;
  right:10px;
}

.fab button{
  padding-top: 7px;
  cursor: pointer;
  width: 48px;
  height: 48px;
  border-radius: 30px;
  background-color: #008040;
  border: none;
  box-shadow: 0 1px 5px rgba(0,0,0,.4);
  font-size: 40px;
  color: white;
    
  -webkit-transition: .2s ease-out;
  -moz-transition: .2s ease-out;
  transition: .2s ease-out;
}

.fab button.main{
  position: absolute;
  width: 60px;
  height: 60px;
  border-radius: 30px;
  background-color: #008040;
  right: 0;
  bottom: 0;
  z-index: 20;
}

</style>

<div class="fab">
  <button class="main">
  <a href="{{route('places.new')}}" style="color:white;" >
    <i class="mdi mdi-plus-circle-outline"></i>
  </a></button>
</div>


<script type="text/javascript">

function myFunction($id) {
  let text = "Are you sure you want to delete this place with id " + $id + " ?";
  if (confirm(text) == true) {
    window.location = "places/delete/"+$id;
  }
}

</script>

@endsection