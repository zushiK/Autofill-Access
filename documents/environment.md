# 環境構築 🧑‍💻

## 手順 📕

composer の install

```
$ composer install
```

envファイルのコピー

```
$ cp .env.example .env
```

key の設定

```
$ php artisan key:generate
```

マイグレーションとシーダーを実行する
 
 ```
$ php artisan migrate --seed
```

ストレージにシンボリックリンクを設定する

```
$ php artisan storage:link
```

npm をインストール

```
$ npm install && npm run dev
```

## Tips 💡

- ローカル環境でのみログインページの「開発用ログイン」ボタン押下でログインが可能
- ローカル環境でのみ`/user_dev_login_id/{id}` でログイン可能

- PDFダウンロードローカル環境構築手順
  - mkdir storage/fonts
  - cd storage/fonts
  - curl -O https://moji.or.jp/wp-content/ipafont/IPAexfont/ipaexg00401.zip
  - unzip ipaexg00401.zip
  - mv ipaexg00401/ipaexg.ttf .
  - rm -r ipaexg00401
  - rm -r ipaexg00401.zip