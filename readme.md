## インスタントLaravelトップページ

このリポは、インスタントLaravelのトップページです。

Laravel4.2とGumbyより作成されています。主なロジックはroutes.phpにあります。一部、ビューコンポーサー定義のみ、start/global.phpの最後に追加しています。

ユーザー登録とログインを実装しています。認証をCodiadから確認するためのAPIを一つ用意しています。

#### インストール

1. `git clone https://github.com/InstantLaravel/TopPage.git 対象ディレクトリー名`に続き、`composer install`を実行してください。

2. app/config/session.phpの'domain'に、使用する（サブドメインではなく）ドメイン名を指定します。認証をこのトップページで行わず、エディター(Codiad)の機能をそのまま利用する場合は、サブドメイン名を指定してもかまいません。

3. app/routes.phpの'http://***EDITOR-DOMAIN***'をエディター（Codiad）を起動するドメイン名に変更してください。

4. app/routes.php最初のメソッド名と、その中で最初にクエリー文字列と比較しているトークン値に、十分にランダムな値を設定してください。

5. パーミッション等は正しく設定しましょう。
