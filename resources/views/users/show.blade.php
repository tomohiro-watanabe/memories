@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
             @include('users.card', ['user' => $user])
        </aside>
        <div class="col-sm-8">
             @include('users.navtabs', ['user' => $user])
             @if (Auth::id() == $user->id)
                {!! Form::open(['route' => 'memories.store', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                            {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
                            <input id="file" type="file" name="image" />
                            {{ csrf_field() }}
                            {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
                        </div>
                        
                    {!! Form::close() !!}
            @endif
            @if (count($memories) > 0)
                @include('memories.memories', ['memories' => $memories])
            @endif
        </div>
    </div>
@endsection