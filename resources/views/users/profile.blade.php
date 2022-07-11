@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-6 offset-3" id="user-profile-form">
                <div class="row text-center form-header">
                    <p>User Information</p>
                </div>
            <form action="/update_profile" method="POST">
                @csrf
                <div class="row form-row">
                    <div class="col-4 text-right">
                        <label for="name">Name:</label>
                    </div>
                    <div class="col-8">
                        <input name="name" class="form-input" value="{{ $user->name }}">
                    </div>
                </div>
                <div class="row text-center">
                    <button class="col-2 offset-5"type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection