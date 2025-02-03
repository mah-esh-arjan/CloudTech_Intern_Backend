<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>


<form method="POST" action="/student-register" enctype="multipart/form-data">
    @csrf
    <section class="vh-100" style="background-color: #2779e2;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-9">

                    <h1 class="text-white mb-4">Student Registration Form</h1>

                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body">

                            <div class="row align-items-center pt-4 pb-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">Name</h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <input type="text" name="name" placeholder="Name" class="form-control form-control-lg" />
                                </div>
                            </div>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <hr class="mx-n3">

                            <div class="row align-items-center pt-4 pb-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">Password</h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <input type="password" name="password" placeholder="Password" class="form-control form-control-lg" />
                                </div>
                            </div>
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <hr class="mx-n3">

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">Age</h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <input type="number" name="age" placeholder="Age" class="form-control form-control-lg" />
                                </div>
                            </div>

                            @error('age')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <hr class="mx-n3">

                            <div class="d-md-flex justify-content-start align-items-center mb-4 py-2 gap-5" style="column-gap: 150px;">

                                <h6 class="mb-0 me-4">Gender: </h6>

                                <div class="form-check form-check-inline mb-0 me-4">
                                    <input class="form-check-input" type="radio" name="gender" id="femaleGender"
                                        value="F" />
                                    <label class="form-check-label" for="femaleGender">Female</label>
                                </div>

                                <div class="form-check form-check-inline mb-0 me-4">
                                    <input class="form-check-input" type="radio" name="gender" id="maleGender"
                                        value="M" />
                                    <label class="form-check-label" for="maleGender">Male</label>
                                </div>

                                <div class="form-check form-check-inline mb-0">
                                    <input class="form-check-input" type="radio" name="gender" id="otherGender"
                                        value="O" />
                                    <label class="form-check-label" for="otherGender">Other</label>
                                </div>

                            </div>

                            <hr class="mx-n3">
                            <div class="row">
                                <div class="col-12" style="display: flex; flex-direction: column;">

                                    <label class="form-label select-label">Choose option</label>
                                    <select name="course" class="select form-control-lg">
                                        <option value="Commerce" selected>Commerce</option>
                                        <option value="Science">Science</option>
                                    </select>
                                </div>
                            </div>
                            <hr class="mx-n3">

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">Upload Image</h6>
                                </div>
                                <div class="col-md-9 pe-5">

                                    <input class="form-control form-control-lg" id="formFileLg" type="file" name="image" />
                                    <div class="small text-muted mt-2">Upload your CV/Resume or any other relevant file. Max file
                                        size 50 MB</div>

                                </div>
                            </div>
                            @error('image_path')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <hr class="mx-n3">

                            <div class="px-5 py-4">
                                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Submit Form</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</form>