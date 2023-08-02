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
                <a href="{{ route('employee.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="crard border-0 shadow-lg">
                <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="neme" placeholder="Enrer Name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name')}}">
                    @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email" placeholder="Enrer Email" 
                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email')}}">
                    @error('email')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror 
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" cols="30" rows="4" placeholder="Enter the Address" class="form-control" value="{{ old('address')}}"></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label"></label>
                    <input type="file" name="image" class="@error('image') is-invalid @enderror">
                    @error('image')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror 
                </div>

                </div>

            </div>
            <button class="btn btn-primary mt-3">Save Employee</button>
        </form> 

    </div>



    
    



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>