@extends('layouts.app')

@section('content')
    @if (Auth::check())
        {{ Auth::user()->name }}
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