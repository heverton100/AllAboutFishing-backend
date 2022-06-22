@extends('layouts.site')

@section('content')


<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Reviews</h4>
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
                User
              </th>
              <th>
                Place
              </th>
              <th>
                Comment
              </th>
              <th>
                Rating
              </th>
              <th>
                Approved
              </th>
              <th>
                Options
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($reviews as $review)
              <tr>
                <td>{{$review->id}}</td>
                <td>{{$review->user_name}}</td>
                <td>{{$review->place_name}}</td>
                <td>{{$review->comment}}</td>
                <td>{{$review->rating}}</td>
                <td>{{$review->approved}}</td>
                <td>
                  @if ($review->approved == 0)
                  <a href='reviews/setapproved/{{$review->id}}' class="btn btn-success btn-rounded btn-social-icon" style="width: 30px;height: 30px;padding: 5px;"><i class='menu-icon mdi mdi-check'></i></a>
                  @endif

                  @if ($review->approved == 1)
                  <a href='reviews/setdisapproved/{{$review->id}}' class="btn btn-warning btn-rounded btn-social-icon" style="width: 30px;height: 30px;padding: 5px;"><i class='menu-icon mdi mdi-check'></i></a>
                  @endif
                </td>
              </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


@endsection