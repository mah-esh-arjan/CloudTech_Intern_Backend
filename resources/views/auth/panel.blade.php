<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


<h1>This is a {{auth()->user()->name}} Panel </h1>

@can('isRole', 'admin')
    <p>Welcome, Admin! You have CURD access.</p>
    <button type="button" class="btn btn-info">Read</button>
    <button type="button" class="btn btn-primary">Create</button>
    <button type="button" class="btn btn-warning">Update</button>
    <button type="button" class="btn btn-danger">Delete</button>


@endcan

@can('isRole', 'client')
    <p>Welcome, Client! You can manage your forms.</p>
    <button type="button" class="btn btn-info">Read</button>
    <button type="button" class="btn btn-primary">Create</button>
    <button type="button" class="btn btn-danger">Delete</button>
@endcan

@can('isRole', 'reader')
    <p>Welcome, Reader! You have read-only access.</p>
    <button type="button" class="btn btn-info">Read</button>

@endcan


