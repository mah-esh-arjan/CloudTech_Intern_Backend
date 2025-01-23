<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<form method="POST" action="/role-login">
    @csrf

    <section class="vh-100" style="background-color: #2779e2;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-9">

                    <h1 class="text-white mb-4">Role Login</h1>

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
                            <hr class="mx-n3">

                            <div class="d-md-flex justify-content-start align-items-center mb-4 py-2 gap-5" style="column-gap: 150px;">

                                <h6 class="mb-0 me-4">Role: </h6>

                                <div class="form-check form-check-inline mb-0 me-4">
                                    <input class="form-check-input" type="radio" name="role" id="admin"
                                        value="admin" />
                                    <label class="form-check-label" for="admin">admin</label>
                                </div>

                                <div class="form-check form-check-inline mb-0 me-4">
                                    <input class="form-check-input" type="radio" name="role" id="client"
                                        value="client" />
                                    <label class="form-check-label" for="client">client</label>
                                </div>

                                <div class="form-check form-check-inline mb-0">
                                    <input class="form-check-input" type="radio" name="role" id="reader"
                                        value="reader" />
                                    <label class="form-check-label" for="reader">reader</label>
                                </div>

                            </div>

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