@extends('layout.bootstrap')

@section('boot')
    <form method="POST" action="{{ url('update-student', $data->student_id) }}">
        @csrf

        <h1> Edit Form</h1>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" value="{{ old('name', $data->name) }}" name="name" class="form-control" id="name"
                placeholder="Example input">
        </div>

        <div class="form-group">
            <label for="age">Age</label>
            <input type="text" value="{{ old('age', $data->age) }}" name="age" class="form-control" id="age"
                placeholder="Age">
        </div>

        <div class="form-group">
            <legend class="col-form-label col-sm-2 pt-0">Gender: </legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="F" 
                    {{old('gender',$data->gender) == 'F' ? 'checked' : ''}}>
                    <label class="form-check-label" for="gridRadios1">
                        Female
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="M"
                    {{old('gender',$data->gender) == 'M' ? 'checked' : ''}}>
                    <label class="form-check-label" for="gridRadios2">
                        Male
                    </label>
                </div>
                <div class="form-check disabled">
                    <input class="form-check-input" type="radio" name="gender" id="gridRadios3" value="O"
                    {{old('gender',$data->gender) == 'O' ? 'checked' : ''}}>
                    <label class="form-check-label" for="gridRadios3">
                        Other
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Select Course</label>
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="course">
                <option value="Commerce" {{old('course',$data->course) == 'Commerce'? 'selected' : ''}}>Commerce</option>
                <option value="Science"  {{old('course',$data->course) == 'Science' ? 'selected' : ''}}>Science</option>
            </select>
        </div>



        <div class="px-5 py-4">
            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Submit
                Form</button>
        </div>
    </form>
@endsection
