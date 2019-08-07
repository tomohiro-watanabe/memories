@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="row">
            <aside class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ Auth::user()->name }}</h3>
                    </div>
                    <div class="card-body">
                        <img class="rounded img-fluid" src="{{ Gravatar::src(Auth::user()->email, 500) }}" alt="">
                    </div>
                </div>
            </aside>
            <div class="col-sm-8">
                @if (Auth::id() == $user->id)
                    {!! Form::open(['route' => 'memories.store']) !!}
                        <div class="form-group">
                            {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
                            {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
                        </div>
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
    <h3>Memoriesでは画像と共にコメントを投稿することができます。
    日々の思い出を共有し、感動を分かち合いましょう。</h3>
    <h5>Memoriesをはじめますか？</h5>
    {!! link_to_route('signup.get', 'アカウント作成', [], ['class' => 'btn btn-lg btn-primary']) !!}
    <h5>既にアカウントをお持ちの方は</h5>
    {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-lg btn-primary']) !!}
    @endif
@endsection