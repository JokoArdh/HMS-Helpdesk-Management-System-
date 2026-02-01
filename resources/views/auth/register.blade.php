
@extends('layouts.auth')
@section('container')
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

          <div class="d-flex justify-content-center py-4">
            <h3>Pendaftaran Akun</h3>
          </div><!-- End Logo -->

          <div class="card mb-3">

            <div class="card-body">

              <form action="{{ route('registrasi.store') }}" method="POST" class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="col-12">
                    <label for="yourUsername" class="form-label">Name</label>
                    <div class="input-group has-validation">
                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="yourUsername">
                      @error('name')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                <div class="col-12">
                  <label for="yourEmail" class="form-label">Email</label>
                  <div class="input-group has-validation">
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="yourEmail">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="col-12">
                  <label for="yourPassword" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="yourPassword" required>
                  @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                 @enderror
                </div>
                <div class="col-12">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                </div>

                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Setuju</label>
                  </div>
                </div>
                <div class="col-12">
                  <button class="btn btn-primary w-100" type="submit">Create</button>
                </div>
                <div class="col-12">
                  <p class="small mb-0">Anda punya akun? <a href="{{ route('login') }}">Masuk</a></p>
                </div>
              </form>

            </div>
          </div>

          <!--footer-->
          <div class="credits">
            <p class="footer">IT Helpdesk Management System Version 1.0 <br>
             &copy; 2026 by <a href="#">IT Support</a> All rights reserved.
            </p>
            
          </div>

        </div>
      </div>
    </div>

  </section>
@endsection