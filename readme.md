## インスタントLaravelトップページ

このリポは、インスタントLaravelのトップページです。

Laravel4.2とGumbyより作成されています。

ユーザー登録とログインを実装しています。

#### インストール

1. `git clone https://github.com/InstantLaravel/TopPage.git 対象ディレクトリー名`に続き、`composer install`を実行してください。

2. app/config/session.phpの'domain'に、使用する（サブドメインではなく）ドメイン名を指定します。認証をこのトップページで行わず、エディター(Codiad)の機能をそのまま利用する場合は、サブドメイン名でもかまいません。

3. app/routes.phpの'http://***EDITOR-DOMAIN***'をエディター（Codiad）を起動するドメイン名に変更してください。

4. パーミッション等は正しく設定しましょう。
