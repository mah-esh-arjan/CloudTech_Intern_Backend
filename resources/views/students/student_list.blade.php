<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    tr {
        border: 2px solid black;
    }

    td {
        border: 1px solid black;
        padding: 8px;
    }
</style>

<h1> List of Students</h1>
<table>

    <tr>
        <td>Student_id</td>
        <td>Name</td>
        <td>Image</td>
        <td>Age </td>
        <td>Gender</td>
        <td>Course</td>

    </tr>
    @foreach ($students as $stu)

    <tr>
        <td class="col-lg-2"> {{$stu->student_id}} </td>
        <td class="col-lg-2"> <img src="{{ asset('images/'. $stu->image_path)}}" alt="not found" class="mw-100 mh-100"> </td>
        <td class="col-lg-2"> {{$stu->name}} </td>
        <td class="col-lg-2"> {{$stu->age}} </td>
        <td class="col-lg-2"> {{$stu->gender}} </td>
        <td class="col-lg-2"> {{$stu->course}} </td>
        <td class="col-lg-2">
            <a href="edit-student/{{$stu->student_id}}"><button class=" btn btn-primary">Edit </button> </a>
        </td>
        <td class="col-lg-2">
            <a href="delete-student/{{$stu->student_id}}"><button class=" btn btn-danger">Delete</button> </a>
        </td>
    </tr>
    @endforeach

</table>