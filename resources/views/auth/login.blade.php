@extends('layouts.auth')
@section('container')
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

          <div class="d-flex justify-content-center py-4">
            <h5>IT Helpdesk Management System</h5>
          </div><!-- End Logo -->

          <div class="card mb-3">

            <div class="card-body">

              <div class="pt-2 pb-2 mb-2">
                <h5 class="card-text text-center pb-0 fs-4">Selamat Datang!</h5>
                <h6 class="card-subtitle text-center mb-2 pb-2 text-muted">Masukan email dan password</h6>
              </div>
              
            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ session('error') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

              <form action="{{ route('login.store') }}" method="POST" class="row g-3 needs-validation">
                @csrf
                <div class="col-12">
                  <label for="yourUsername" class="form-label">Email</label>
                  <div class="input-group has-validation">
                    <input type="text" name="email" class="form-control" required>
                  </div>
                </div>

                <div class="col-12">
                  <label for="yourPassword" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" required>
                </div>

                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                  </div>
                </div>
                <div class="col-12">
                  <button class="btn btn-primary w-100" type="submit">Login</button>
                </div>
                <div class="col-12">
                  <p class="small mb-0">Anda tidak punya akun? <a href="{{ route('registrasi') }}">Buat akun baru</a></p>
                </div>
              </form>

            </div>
          </div>

          <!--footer-->
          <div class="credits">
            <p class="footer">IT Helpdesk Management System Versioan 1.0 <br>
             &copy; 2026 by <a href="#">IT Support</a> All rights reserved.
            </p>
            
          </div>

        </div>
      </div>
    </div>

  </section>
@endsection