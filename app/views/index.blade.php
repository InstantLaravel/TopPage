@extends ('gumby-layout')

@section('content')
<div class="row">
    <h1 class="lead">インスタントLaravel</h1>
</div>
<div class="row">
    <div class="centered ten colums">
        <h3>チュートリアル専用、使い捨てインスタントLaravel環境。</h3>
    </div>
</div>
<div class="row">
    <div class="five colums centered">
        <img src="{{ asset('/img/InstantLaravel.png') }}" alt="Instant Laravel">
    </div>
</div>
<div class="row">
    <div class="nine columns centered"
         <p>「都会から遠い。準備が面倒。移動に時間が…参加費も必要…、でもオンラインなら！」</p>
    </div>
</div>
<div class="row">
    <li class="info alert"><i class="icon-book-open"></i> 只今、ベータテスト開放中！ベータなので毎日数時間運転中、その都度作り替えています！</li>
    <li class="info alert"><i class="icon-heart"></i> セキュリティー的にはダダ漏れです。皆さんの愛が支えです。</li>
</div>
<hr>
<div class="row">
    <a name="logform">,</a>
    <h3>登録／ログイン（兼用）</h3>
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
            <li class="primary alert">{{ $errors->first( 'username' ) }}'</li>
        </div>
        @endif
        <div class="row">
            <div class="six columns">
                <p>区別のつけやすいアルファベットのユーザー名：</p>
            </div>
            <div class="six columns">
                <li class="field">
                    {{ Form::text('username', Input::old('username', '') ) }}
                </li>
            </div>
        </div>
    </div>
    <div class="centered nine columns">
        @if ($errors->has('password'))
        <div class="row">
            <li class="primary alert">{{ $errors->first( 'password' ) }}'</li>
        </div>
        @endif
        <div class="row">
            <div class="six columns">
                {{ Form::label('password', '覚えやすいパスワード：') }}
            </div>
            <div class="six columns">
                <li class="field">
                    {{ Form::password('password', [ 'class'=>'six colums'] ) }}
                </li>
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
        <li>オンラインチュートリアルにお手軽に参加して頂くためのシステムです。（秘密ですがLaravel以外も用意できます。;D）</li>
        <li>Laravelの準備を済ませ、ブラウザから使えるエディターを用意してあります。登録し、アクセスしてもらうだけで、すぐに参加できます。</li>
        <li>事前予約が必要か、チャットにどんなシステムを使用するかは、そのチュートリアル主催者により異なります。参加したいチュートリアルを見つけたら、事前にチェックしておきましょう。（デフォルトのチュートリアル構成では、チャットがエディターに組み込まれています。全く事前準備は必要ありません。）</li>
    </ul>
</div>
<hr>
<div class="row">
    <div class="twelve columns">
        <section class="vertical tabs">
            <ul class="tab-nav three columns">
                <li class="active"><a href="#tabs-top">スケジュール</a></li>
                <li><a href="#tabs-top">使い方</a></li>
                <li><a href="#tabs-top">主催方法</a></li>
            </ul>
            <a name="tabs-top"></a>
            <div class="tab-content nine columns active">
                <h4 class="lead">スケジュール</h4>
                <p>スケジュールのサンプルです。本物ではありません。</p>
                <table class="striped">
                    <thead>
                        <tr>
                            <th>開始日時</th>
                            <th>内容</th>
                            <th>主催</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2014/07/15 18:00 (2h)</td>
                            <td>インスタントLaravelの元になっているCodiadの使用方法を学んでください。<br>事前準備は必要ありません。<br>開始時間３０分前から、<a href="#">regi.instantlaravel.com</a>で登録してください。登録情報はチュートリアル終了時、即座に破棄されます。</td>
                            <td>HiroKws</td>
                        </tr>
                        <tr>
                            <td>2014/07/17 18:00 (5h)</td>
                            <td>テーマを決めず、ご質問にLaravel答えるマンがお答えします。<br>事前準備は必要ありません。<br>開始時間３０分前から、<a href="#">regi.instantlaravel.com</a>で登録してください。登録情報はチュートリアル終了時、即座に破棄されます。</td>
                            <td>Laravel答えるマン</td>
                        </tr>
                        <tr>
                            <td>2014/07/30 7:00 (24h)</td>
                            <td>ハッカソンです。堅牢な銀行オンラインシステムの構築を目指します。<br>hackathon.instantlaravel.comで事前登録してください。先着３０名様まで参加可能です。<br>開始直前に、登録者にはサーバーのIPアドレスとSSHの接続情報をお送りいたします。作業は各自のPCからお好きな環境で行ってください。<br>チャットはLarachat（架空）を使用します。事前に準備をお願いします。</td>
                            <td>Sanwa</td>                        </tr>
                        <tr>
                            <td>2014/08/01 9:00 (12h)</td>
                            <td>自習時間です。デフォルト環境を建てておきますので、お好きに使用してください。<br>ただし、セキュリティー漏れをつつかないようにお願いします。:D</td>
                            <td>HiroKws</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-content nine columns">
                <h4 class="lead">使い方</h4>
                <p>ここではデフォルト環境について説明します。主催者により用意する環境は異なります。</p>
                <li class="danger alert"><i class="icon-alert"></i> 只今エディターで、日本語の文字列を含んだファイルの保存が不安定です。</li>
            </div>
            <div class="tab-content nine columns">
                <h4 class="lead">主催方法</h4>
                <p>当サイトは、オンラインチュートリアルイベントのハブサイトです。Laravelに関するオンラインチュートリアルなどのイベントを告知します。予定をお持ちの方はご連絡ください。(hirokws@gmail.com)</p>
                <p>また、ご依頼いただけば、サブドメインを提供します。（指定していただいた時間に、指定のIPアドレスとサブドメインを登録します。当初は手動で設定します。DNSとしてCloudFlareを使用します。）</p>
                <h5>環境（サーバー）</h5>
                <p>チュートリアルの環境（サーバー）は、主催者が用意してください。短時間のチュートリアルには、時間単位で利用できるAWS、DigitalOcean、Linodeなどのサービスが便利に利用でき、料金もさほどかかりません。</p>
                <h5>デフォルト環境</h5>
                <p>デフォルト環境を準備するシェル（Ubuntu14.04サーバー向け）を用意します。もちろん、使用してもかまいませんし、使用せず独自の環境を提供してもかまいません。Web上のIDEサービスを利用してもかまいません。開催告知の中でその旨を参加希望者にお伝えください。</p>
                 <p>エディター機能には、オンラインエディターのCodiadを使用しています。操作に関わる部分は、ほとんど日本語化してあります。英語が苦手な方でも大丈夫です。</p>
               <p>デフォルト環境は、Codiadの機能を元に構築しているため、セキュリティー的には脆弱です。「チュートリアルは無料で数時間のものであるので、参加者が悪事を働いたり、外部から攻撃を受けた場合は、中止でかまわないだろう。」という考えです。もちろん、参加希望者には事前に了承してもらいましょう。</p>
                <p>よりセキュアにするために、事前の申し込み制にしたり、招待制にしたりと運用で工夫することもできるでしょう。もしくはデフォルト環境設定スクリプトを改良したり、自分で初めからよりセキュアに環境を構築することもできるでしょう。開催者の方の考え方次第です。（環境設定ツールの次期バーションは、よりセキュアにしようと思っています。）</p>
                <p>"base"ユーザーがCodiadの管理者権限を持っています。ログインし、「マーケットプレス」から必要な拡張機能をインストールしてください。（初回インストール時は処理が戻ってこないことが多いようです。しばらく待って戻ってこないようでしたら、一度ウィンドウを閉じ、再度開いてみるとインストールされていることが多いです。ただ、プラグインによっては、正しく動作していないものもあり、インストールできないものもあります。）
                <p>Codiadでは通常workspaceディレクトリーにプロジェクトごとのディレクトリーを作成します。他にプロジェクトディレクトリーの位置を絶対パスで指定することもできますが、この場合、編集結果をダウンロードできません。（仕様のようです。絶対パスプロジェクトを作成するとき、確認ダイアログが表示されますが、こうした制限があることは表示されないため、とても分かりづらい仕様です。）</p>
                <h5>余りセキュアではない環境を使用することについて</h5>
                <p>結局、「数時間の無料チュートリアルイベントにどの程度手間をかけるか？」、「どの程度、セキュアーにするか？」などを考慮し、トレードオフで結論を出しました。個人情報を保持せず、チュートリアルの間、数時間だけ動作させ、その後は破棄する環境ですから、完全にセキュアにする必要はないと思います。とは言え、現状はやや物足りません。ですから、多少時間のかかるチュートリアルイベントであれば、攻撃にさらされる可能性も上がりますので、事前登録制にし、チュートリアル中は80番ポートしか開かないようにするなど、運用でカバーするしかないでしょう。デフォルト環境の次期バージョンでは、登録者をOSにユーザーとして登録し、ファイルパーミッションの指定により、多少セキュアにしようと考えています。
                <h5>デフォルト環境の不具合</h5>
                <p>Codiadは、修正の保存時に、本文まるごとではなく、修正前の差分をサーバーへ送るようになっていますが、日本語を含んだテキストの場合、そのdiff結果の行数がずれてしまうようです。そのため、保存したメッセージが表示されているにもかかわらず、実際には保存されていなかったり、とんでもない場所が書き換わったりしています。作者の環境では問題が起きないようですので、Javascriptのブラウザによる動作の違いに関わる不具合かも知れません。（原因を突き止め、修正できる人がいるのなら、プルリクエストをお願いします。）</p>                <h5>デフォルト環境セットアップシェル</h5>
                <p>Unutu14.04環境ですので、PHPバージョン5.5です。WebサーバーはNginxです。</p>
                <p>スクリプトの前半部分が設定項目になっています。EC2、Linodo、Dropletなどを起動したら、adduserで希望のユーザーを作成し、そのユーザー名を"loginUser"へ、所属グループを"loginUserGroup"へ指定します。Vagrantで試してみることも可能です。その場合、64ビット環境のほうが支障なく動作するようです。Vagrantの場合はユーザー名、所属グループとも"vagrant"です。</p>
                <p>Codiadはユーザー登録ができません。管理者が追加作業を行います。そのため、外部で認証と追加処理を行い、Codiadはエディター部分を担当させています。そのためにドメインを分けるように指定しています。トップページ兼登録・認証用ドメインと、Codiadを起動するドメインです。スクリプトにはプレビュー用のドメインも指定していますが、これは無理に必要ではありません。Codiad用のドメインでURIに/workspace/ユーザー名/publicにアクセスすれば、Laravelの場合トップページが表示されます。プレビュードメインを別にする場合、URIは/ユーザー名/publicと多少短くなります。</p>
                <p>認証とCodiadのドメインは同じドメインを使用してください。認証状態をCodiadサイドから確認するブリッジPHPスクリプトから、認証サイトのセッションクッキーへアクセスする必要があるためです。</p>
                <p>ブリッジPHPスクリプトを指定する場合、登録／認証などはルートページで行うことになります。指定しない場合、Codiad側で認証しますが、ユーザ登録機能は管理者がログイン後に手動で追加するシステムなため、自動化できません。事前予約制の場合、それでもかまわないと思いますが、事前予約は多少ユーザーの心理的負担が増えるでしょうから、ルートページ側での認証をおすすめしておきます。このサイトの内容も公開していますので、参考にしてください。</p>
            </div>
        </section>
    </div>
    @stop
