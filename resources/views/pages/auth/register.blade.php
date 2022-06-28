@extends('layouts.main')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-5">
        <main class="form-registration">
            <h1 class="h3 mb-3 fw-normal text-center mt-5">Registration Form</h1>
            <form action="" method="POST">
              <div class="form-floating">
                <input type="text" name="name" class="form-control" id="name" placeholder=Username">
                <label for="name">Username</label>
              </div>
              <div class="form-floating">
                <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                <label for="email">Email</label>
              </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                <label for="password">Password</label>
              </div>
          
              <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            </form>
            <small class="d-block text-center mt-3 mb-5">Not registered? <a href="/register">Register Now!</a></small>
          </main>
    </div>
</div>

@endsection