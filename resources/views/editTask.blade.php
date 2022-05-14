@extends('layouts.app')

@section('content')
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>To DO - Dashboard</title>

    <!-- Styles -->
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ URL::asset('css/dashboard.css') }}" />
</head>

<section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
            <div class="card-body py-4 px-4 px-md-5">
                @if(Session::has('success'))
                <div class="alert alert-success">
                            {{\Session::get('success')}}
                    </div>
                @endif
              <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
                <i class="fas fa-pencil"></i>
                <u>Edit Task</u>
              </p>

              @foreach ($todo as $todo)
              <form role="form" method='POST' action="update/{{ $todo->id }}">
              <div class="pb-2">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-row align-items-center">
                      <input type="text" class="form-control form-control-lg" id="exampleFormControlInput1" name="message" value="{{ $todo->message }}" required>
                      <input type="hidden" name="_Token" value="{{ csrf_token() }}">
                    </div>
                  </div>
                </div>
              </div>

              @endforeach

              <hr class="my-4">

              <div style="text-align: right">
              <a href="/home" class="btn btn-warning">Cancel</a>
              <input type="submit" value="Save" class="btn btn-primary">
               {{ csrf_field() }}
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
