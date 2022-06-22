@extends('layouts.site')

@section('content')


<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Endpoints</h4>
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
                URL
              </th>
              <th>
                Type
              </th>
              <th>
                Category
              </th>
              <th>
                Parameters
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($endpoints as $endpoint)
              <tr>
                <td>{{$endpoint->id}}</td>
                <td>{{$endpoint->url}}</td>
                <td>{{$endpoint->type}}</td>
                <td>{{$endpoint->category}}</td>
                <td>{{$endpoint->parameters}}</td>
              </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection