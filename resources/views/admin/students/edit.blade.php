<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit student Form1</title>
@vite(['resources/sass/app.scss', 'resources/js/app.js'])
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" > --}}
</head>
<body>
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
<h2>Edit student</h2>
</div>
<div class="pull-right">
<a class="btn btn-primary" href="{{ route('list_etu.index') }}" enctype="multipart/form-data"> Back</a>
</div>
</div>
</div>
@if(session('status'))
<div class="alert alert-success mb-1 mt-1">
{{ session('status') }}
</div>
@endif
<form action="{{ route('student_update',2) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PATCH')
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>student nom_ar:</strong>
<input type="text" name="nom_ar" value="{{ $student->nom_ar }}" class="form-control" placeholder="student nom_ar">
@error('nom_ar')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>student etat:</strong>
<input type="text" name="etat" class="form-control" placeholder="student etat" value="{{ $student->etat }}">
@error('etat')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>student motif:</strong>
<input type="text" name="motif" value="{{ $student->motif }}" class="form-control" placeholder="student motif">
@error('motif')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>
</div>
<button type="submit" class="btn btn-primary ml-2">Submit</button>
</div>
</form>
</div>
</body>
</html>