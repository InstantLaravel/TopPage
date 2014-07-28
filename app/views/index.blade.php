@extends ('gumby-layout')

@section('content')
<h1 class="lead">インスタントLaravel</h1>
<div class="row">
    <p>Laravelに興味を持っていただいた方向けの、簡単な機能紹介ハンズオンです。</p>
</div>
<hr>
<div class="row">
    <a name="logform"></a>
    <h3>新規ユーザー登録</h3>
</div>
<div class="row">
    {{ Form::open() }}
    <div class="centered nine columns">
        @if ($message)
        <div class="row">
            <li class="danger alert"><i class="icon-alert"></i> {{ $message }}</li>
        </div>
        @endif
        @if ($errors->has('username'))
        <div class="row">
            <li class="primary alert">{{ $errors->first( 'username' ) }}</li>
        </div>
        @endif
        <div class="row">
            <div class="six columns">
                <p>区別のつけやすいアルファベットのユーザー名：</p>
            </div>
            <div class="six columns">

                    {{ Form::text('username', Input::old('username', '') ) }}

            </div>
        </div>
    </div>
    <div class="centered nine columns">
        @if ($errors->has('password'))
        <div class="row">
            <li class="primary alert">{{ $errors->first( 'password' ) }}</li>
        </div>
        @endif
        <div class="row">
            <div class="six columns">
                {{ Form::label('password', '覚えやすいパスワード：') }}
            </div>
            <div class="six columns">

                    {{ Form::password('password', [ 'class'=>'six colums'] ) }}

            </div>
        </div>
    </div>
    <div class="row">
        <div class="centered two columns">
            {{ Form::submit(' 参加する ') }}
        </div>
    </div>
    {{ Form::close() }}
</div>
<div class="row">
    <ul class="disc">
        <li>このイベントは、基本的なLaravelの特徴を把握して頂くハンズオンです。事前準備／前提知識は必要ありません。</li>
        <li>エディター付属のチャットシステムを利用して進めます。質問はこまめに時間を取りますので、その時にどうぞ。</li>
        <li>時間は本日１９時より２時間を予定しております。進行により終了時間は前後致します。お時間がない方は、遠慮無く途中でもログアウトしてください。</li>
    </ul>
</div>
@stop
