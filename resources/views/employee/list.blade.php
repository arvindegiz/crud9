<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LARAVEL 9 CRUD OPERATION </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<body>
    <div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-white">LARAVEL 9 CRUD OPERATION</div>
        </div>
    </div>
        <div class="container py-3">
            <div class="d-flex justify-content-between py-3">
                <div class="h4">Employees</div>
                <div>
                    <a href="{{ route('employee.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ session::get('success') }}
                </div>
            @endif

            <div class="crard border-0 shadow-lg">
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Adreess</th>
                            <th>Action</th>
                        </tr>
                        @if($employees->isNotEmpty())
                            @foreach($employees as $employee)
                            <tr valign="middle">
                                <td>{{ $employee->id }}</td>
                                <td>
                                    @if($employee->image != '' && file_exists(public_path().'/upload/employees/'.
                                    $employee->image))
                                    <img src="{{ url('upload/employees/'.$employee->image) }}" alt="img" width="50"
                                    height="50" class="rounded-circle">
                                    @else
                                    <img src="{{ url('asset/image/noimg.png') }}" alt="" width="50"
                                    height="50" class="rounded-circle">
                                    @endif
                        
                                </td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->address }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        @else
                        <tr>
                            <td colspan="6">Record Not Found</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>

            <div class="mt-3">
                {{ $employees->links() }}
            </div>

        </div> 



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>