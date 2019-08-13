<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="row">
            <aside class="col-sm-4">
                 @include('users.card', ['user' => Auth::user()])
            </aside>
            <div class="col-sm-8">
                @if (Auth::id() == $user->id)
                    {!! Form::open(['route' => 'memories.store', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                            {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
                            <input id="file" type="file" name="image" />
                            {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
                        </div>
                        {{ csrf_field() }}
                    {!! Form::close() !!}
                @endif
                @if (count($memories) > 0)
                    @include('memories.memories', ['memories' => $memories])
                @endif
                
                
            </div>
        </div>
    @else
    <div class="center jumbotron">
        <div class="text-center">
            <h1>ようこそ　Memoriesへ</h1>
        </div>
    </div>
    <div class="text-center">
    <h3>Memoriesでは画像と合わせてコメントを投稿することができます。
    <br>
    日々の思い出を共有し、感動を分かち合いましょう。</h3>
    <br><br>
    <h5>Memoriesをはじめますか？</h5>
    {!! link_to_route('signup.get', 'アカウント作成', [], ['class' => 'btn btn-lg btn-primary']) !!}
    <h5>既にアカウントをお持ちの方は</h5>
    {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-lg btn-primary']) !!}<br>
    (※ログイン画面にテスト用アカウントを作成済です。）    <br>
    </div>
    @endif
@endsection