@extends('pages.layout.app',['title' => 'Login'])
@section('content')

<section class="mt-5">
    <div class="container">
        <h2>Login</h2>
            <div class="form-group mt-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
            </div>
            <div class="form-group mt-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Login</button>
            <a href="{{ route('register') }}" class="btn btn-link btn-block mt-3">Register</a>
            <a href="{{ route('forgotPassword') }}" class="btn btn-link btn-block mt-3">Forgot Password</a>
    </div>
</section>


@endSection
