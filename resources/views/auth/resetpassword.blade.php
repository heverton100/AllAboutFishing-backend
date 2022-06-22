@include('layouts.header')
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <h2>All About Fishing</h2>
              </div>

              <h4>Reset Password</h4>
              <form method="POST" class="pt-3" action="{{ route('changepassword', ['id'=> $user->id]) }}">
                @csrf
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" name="email" id="email" value="{{$user->email}}" placeholder="E-mail" autocomplete="email" autofocus required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" onkeyup="funcheck()" name="password" id="password" placeholder="Password" required>

                </div>

                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" onkeyup="funcheck()" name="repeatpassword" id="repeatpassword" placeholder="Repeat Password" required>
                </div>

                <div class="mt-3">
                  <input type="submit" id="submit" value="Submit" class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn"/>

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


<script>
	function funcheck(){
	    val1=document.getElementById("password").value;
	    val2=document.getElementById("repeatpassword").value;
	    if(val1!=val2){
	    	document.getElementById("password").style.borderColor="#f00";
	        document.getElementById("repeatpassword").style.borderColor="#f00";
			$("#submit").prop("disabled", true );
	    }else{
	    	document.getElementById("password").style.borderColor="#0f0";
	        document.getElementById("repeatpassword").style.borderColor="#0f0";
			$("#submit").prop("disabled", false );
	    }
	}
</script>