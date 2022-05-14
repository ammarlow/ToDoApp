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
                <i class="fas fa-check-square me-1"></i>
                <u>My Todo</u>
              </p>

              <form role="form" method='POST' action=" {{url('save')}}" enctype="multipart/form-data">
              <div class="pb-2">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-row align-items-center">
                      <input type="text" class="form-control form-control-lg" id="exampleFormControlInput1" name="message" placeholder="Add new..." required>
                      <input type="hidden" name="_Token" value="{{ csrf_token() }}">
                      <input type="file"  required name="image">
                      <input type="hidden" name="_Token" value="{{ csrf_token() }}">
                      <div>
                        <input type="submit" class="btn btn-primary" value="Add">
                        {{ csrf_field() }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="image">

              </div>
              </form>

              <hr class="my-4">

              @foreach ($todo as $todo)
              <ul class="list-group list-group-horizontal rounded-0 bg-transparent">
                <li
                  class="list-group-item d-flex align-items-center ps-0 pe-3 py-1 rounded-0 border-0 bg-transparent">
                </li>
                <li
                  class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                  <p class="lead fw-normal mb-0">{{ $todo->message }}</p>
                </li>
                <li class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">

                  <li
                    class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                    <img src="{{ $todo->path }}" style="height: 100px; width: 150px;">
                  </li>
                  <li class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">

                @if($todo->is_complete =='0')
                <p class="lead fw-normal mb-0" style="color: red">{{ $complete = "Incomplete" }}</p>
                <form role="form" method='POST' action="updateCompletion/{{ $todo->todo_id }}">
                <input type="hidden" name="completion" value="1">
                <input type="hidden" name="_Token" value="{{ csrf_token() }}">
                <input type="submit" style="border: 0; color:blue" value="(Mark as Complete)">
                {{ csrf_field() }}
                </form>
                @else
                <p class="lead fw-normal mb-0" style="color:green">{{ $complete = "Completed" }}</p>
                <form role="form" method='POST' action="updateCompletion/{{ $todo->todo_id }}">
                <input type="hidden" name="completion" value="0">
                <input type="hidden" name="_Token" value="{{ csrf_token() }}">
                <input type="submit" style="border: 0; color:blue" value="(Mark as Incomplete)">
                {{ csrf_field() }}
                </form>
                @endif
                </li>
                <li class="list-group-item ps-3 pe-0 py-1 rounded-0 border-0 bg-transparent">
                  <div class="d-flex flex-row justify-content-end mb-1">
                    <a href="/editTask?id={{ $todo->todo_id }}" class="text-info" data-mdb-toggle="tooltip" title="Edit todo"><i
                        class="fas fa-pencil-alt me-3"></i></a>
                    <form action="delete/{{ $todo->todo_id }}" method="post">
                    <button type="submit" class="text-danger" onclick="return confirm('Are you sure you want to delete this item?');" data-mdb-toggle="tooltip" title="Delete todo"><i
                        class="fas fa-trash-alt"></i></button>
                        {{csrf_field()}}
                    </form>
                  </div>
                </li>
              </ul>
              @endforeach

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
