@include('layouts.header')
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="../../images/logo2.png" alt="logo">
              </div>

              <h4>Sign in to continue.</h4>
              <form method="POST" class="pt-3" action="{{ route('login_auth') }}">
                @csrf
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" placeholder="E-mail" autocomplete="email" autofocus required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" autocomplete="current-password" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mt-3">
                  <input type="submit" value="SIGN IN" class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn"/>

                </div>

              </form>
          
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
@include('layouts.footer')




@php if(session()->get("USERNAME") != ''){ @endphp
  @php
    header("Location: " . URL::to('/dashboard'), true, 302);
    exit();
  @endphp
@php } @endphp















