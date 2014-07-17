<?php

/*
  |--------------------------------------------------------------------------
  | アプリケーションルート
  |--------------------------------------------------------------------------
  |
  | このファイルでアプリケーションの全ルートを定義します。
  | 方法は簡単です。対応するURIをLaravelに指定してください。
  | そしてそのURIに対応する実行コードをクロージャーで指定します。
  |
 */
Route::get( 'api-to-get-user-name/{token}', function($token)
{
    if($token == "")
    {
        return Response::make( '' );
    }

    if( Auth::check() )
    {
        return Response::make( Auth::user()->username );
    }

    return Response::make( '' );
} );


Route::get( '/', function()
{
    return View::make( 'index' );
} );

Route::post( '/',[ 'before' => 'csrf',
             function()
{
    $rule = [
        'username' => [ 'required', 'max:50', 'alpha' ],
        'password' => [ 'required', 'max:30' ],
    ];

    $inputs = Input::only( 'username', 'password' );

    $val = Validator::make( $inputs, $rule );

    if( $val->fails() )
    {
        return Redirect::to( '/#logform' )
                ->withInput()
                ->withErrors( $val );
    }

    // LaravelのalphaバリデーションはUTF8のアルファベットでも通過する
    // ASCIIへ変換
    $inputs['username'] = mb_convert_encoding( $inputs['username'], 'ASCII', 'UTF-8' );

    // 指定されたユーザー名が存在する場合
    if( count( User::whereUsername( $inputs['username'] )->first() ) > 0 )
    {
        if( Auth::attempt( $inputs ) )
        {
            return Redirect::to( 'http://editor.instant.com' );
//            return Redirect::to('http://***EDITOR-DOMAIN***');
        }

        return Redirect::to( '/#logform' )
                ->withInput()
                ->withMessage( 'ユーザ名とパスワードが一致しません。' );
    }

    // ユーザー名が存在しない場合
    $user = User::create( $inputs );

    // workspaceディレクトリー中のbaseを新規ユーザーのためにコピー
    $workspaceDir = '/home/codiad/workspace';
    umask(002);
    File::copyDirectory($workspaceDir.'/base', $workspaceDir.'/'.$inputs['username']);

    // Codiadユーザー追加
    $data = [
        'username' => $inputs['username'],
        'password' => sha1( md5( $inputs['password'] ) ),
        'project'  => '',
    ];
    addCodiadData( '/home/codiad/data/users.php', $data );

    // Codiadプロジェクト追加
    $records = getCodiadData( '/home/codiad/data/projects.php' );
    $baseProject = head( $records );
    $data = [
        'name' => str_replace( 'base', $inputs['username'], $baseProject['name'] ),
        'path' => $inputs['username'],
    ];
    $records[] = $data;
    putCodiadData( '/home/codiad/data/projects.php', $records );

    // ACL情報追加
    // このファイルを持っているユーザーがCodiadでは非管理者になる
    $data = [
        $inputs['username']
    ];
    putCodiadData( '/home/codiad/data/'.$inputs['username'].'_acl.php',
                   $data );
    // Codiadグループから読み込めるように、664モードを設定
    chmod('/home/codiad/data/'.$inputs['username'].'_acl.php', 0664);

    // ログイン
    Auth::login( $user );

//    return Redirect::to('http://***EDITOR-DOMAIN***');
    return Redirect::to( 'http://editor.instant.com' );
} ] );

// Codiadの設定ファイルを読み込む
function getCodiadData( $fileName )
{
    // Codiad側でget_content...を使用しているため
    // 排他制御は無駄になる

    $content = File::get( $fileName );

    preg_match( '/^<\?php\/\*\|(.+)\|\*\/\?>/', $content, $matches );

    return json_decode( $matches[1], true );
}

// Codiadの設定ファイルを書き出す
function putCodiadData( $fileName, $data )
{
    File::put( $fileName, '<?php/*|'.json_encode( $data ).'|*/?>' );
}

// Codiadの設定ファイルを更新する
function addCodiadData( $fileName, $data )
{
    $records = getCodiadData( $fileName );

    $records[] = $data;

    putCodiadData( $fileName, $records );
}