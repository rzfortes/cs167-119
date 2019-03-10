@extends('layouts.app')
@extends('layouts.extra')

@section('content')

<div class="list">
    <h1 class="header">To do.</h1>

    @if($assignments)

        <ul class="items">
            @foreach($assignments as $assignment)
                <li>
                    
                    @if($assignment->done == 0)
                        <span class="item">{{$assignment->content}}</span>
                        {!! Form::open(['action' => ['AssignmentsController@destroy', $assignment->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class' => 'del-button'])}}
                        {!! Form::close() !!}
                        {{-- <a href="" class="done-button float-right mr-2">Mark as done</a> --}}
                        {!! Form::open(['action' => ['AssignmentsController@update', $assignment->id], 'method' => 'POST', 'class' => 'float-right mr-2']) !!}
                            {{Form::hidden('_method', 'PUT')}}
                            {{Form::submit('Mark as done', ['class' => 'done-button'])}}
                        {!! Form::close() !!}
                    @else
                        <span class="item done">{{$assignment->content}}</span>
                        {!! Form::open(['action' => ['AssignmentsController@destroy', $assignment->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class' => 'del-button'])}}
                        {!! Form::close() !!}
                        {!! Form::open(['action' => ['AssignmentsController@update', $assignment->id], 'method' => 'POST', 'class' => 'float-right mr-2']) !!}
                            {{Form::hidden('_method', 'PUT')}}
                            {{Form::submit('Mark as not done', ['class' => 'done-button'])}}
                        {!! Form::close() !!}
                    @endif

                </li>
            @endforeach
        </ul>

    @else
        <p>You haven't added any assignments yet.</p>
    @endif

    {!! Form::open(['action' => 'AssignmentsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'item-add']) !!}

        {{Form::text('content', '', ['class' => 'input', 'placeholder' => 'Type a new assignment here.', 'required', 'autocomplete' => 'off'])}}
    
        {{Form::submit('Add', ['class' => 'submit'])}}
    
    {!! Form::close() !!}

</div>
    
@endsection