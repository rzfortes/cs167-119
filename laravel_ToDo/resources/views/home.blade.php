@extends('layouts.app')
@extends('layouts.extra')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="list">
    <h1 class="header">My Courses.</h1>

    @if ($subjects)
        
        <ul class="items">

            @foreach ($subjects as $subject)
                <li>

                    <span>{{$subject->courseName}}</span>
                    {!! Form::open(['action' => ['SubjectsController@destroy', $subject->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete', ['class' => 'del-button'])}}
                    {!! Form::close() !!}
                    <a id="view{{$subject->id}}" href="assignments/{{$subject->id}}" class="done-button float-right mr-2">View Assignments</a>

                </li>            
            @endforeach
            
        </ul>

    @else
        <p>You haven't added any subjects yet.</p>
    @endif

    {!! Form::open(['action' => 'SubjectsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'item-add']) !!}

        {{Form::text('courseName', '', ['class' => 'input', 'placeholder' => 'Type a new subject here.', 'required', 'autocomplete' => 'off'])}}
    
        {{Form::submit('Add', ['class' => 'submit'])}}
    
    {!! Form::close() !!}

</div>
@endsection
