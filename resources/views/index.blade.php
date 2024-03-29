<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel 11 CRUD and Image Upload Example Tutorial - Tutsmake.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container mt-2">
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 11 CRUD and Image Upload Example Tutorial - Tutsmake.com</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ url('add-vacancy') }}"> Create Vacancy</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>S.No</th>
            <th>Title</th>
            <th>Image</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
       
        @foreach ($vacancies as $vc)
        <tr>
            <td>{{ $vc->id }}</td>
            <td>{{ $vc->title }}</td>
            <td><img src="{{ asset('storage/images/'.$vc->image) }}" alt="Your Image" width="100px" height="100px"></td>
            <td>{{ $vc->description }}</td>
            <td>
                <form action="{{ url('delete/'.$vc->id) }}" method="get">
    
                    <a class="btn btn-primary" href="{{ url('edit/'.$vc->id) }}">Edit</a>
   
                    @csrf
                    @method('get')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
  
    </table>
  
    {!! $vacancies->links() !!}
</body>
</html>