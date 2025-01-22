@extends('layout.bootstrap')

@section('boot')

<form method="POST" action="{{url('update_data',$data->student_id)}}">
    @csrf

    <h1> Edit Form</h1>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" value="{{$data->name}}" name="name" class="form-control" id="name" placeholder="Example input">
    </div>
    <div class="form-group">
        <label for="age">Age</label>
        <input type="text" value="{{$data->age}}" name="age" class="form-control" id="age" placeholder="Age">
    </div>
    <div class="px-5 py-4">
        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Submit Form</button>
    </div>
</form>

@endsection