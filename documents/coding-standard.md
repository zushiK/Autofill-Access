# コーディング規約 📝

## 全体の基本規約

- tools.mdに従い、プルリク作成前（またはコミット前）にlarastanとphpcsfixerの実行
- 引数や戻り値はPHPDocで記載
- 変数名、関数名はローワーキャメルケース
- 定数の配列定義時、定数は複数形にする
- ファサードはuseではなく\Authなど「\」をつけて使う
- \Authはファサードじゃなくてauth()ヘルパ使用（その他のファサードもヘルパ関数があればそっちを優先して使用）
- データベースアクセス時はEloquentを使用（原則SQLは書かない）
- 仕様が不明確なため、開発中盤まではテーブル変更時migrationファイル直上書きで更新（直書き換えじゃなくなるタイミングでアナウンスします）
- 類似処理や関連処理などがある場合はコメントアウトで「(場所ID:M5tmTDUV)」としてコード検索で探しやすいようにする
- 不要なコメントアウトの排除
- 必要なコメントアウトには必ず説明を書く


## JavaScriptに関して

- JSはVue.jsで記述
- 部分的にvueを使用する（bladeに組み込む）
- 複数インスタンス構成（使用するbladeでnewする）（例えばheader.bladeにheader用インスタンスがあったりする）
- コンポーネント作成は/resources/js/components/コンポーネント名.vueで作成（resources/js/app.jsに登録してビルドnpm run dev）
- v-modelを使う場合は各フォームパーツにv-modelを追加してください（textarea.blade.php参考）

### コントローラーについて

- viewへの変数受け渡しは連想配列

## ファットコントローラー回避のための策

- 一般的なMVC+Serviceで実装する
- controllerとmodelの間にserviceを作り、そこにビジネスロジックを実装
- serviceクラス作成規則はmodel名+Service.php（ディレクトリはapp\Services\）
- serviceクラスはモデルの数以上できることはない（最大モデルファイル数となる）
- モデル間共通処理はtraitへの実装もあり
- 汎用的な処理（またはその他共通処理）の置き場はLibraryフォルダにクラスを作る（helpers.phpへの実装もあり）

## Modelについて

- 類似モデルは親クラスをApp\AbstractModelsに実装し、継承して共通処理と固有処理を分ける（親クラスはIlluminate\Database\Eloquent\Modelを継承する
- fillableとguardedについて
  1. guardedに空の配列を定義
  1. $request->all()を使用した複数代入は使用禁止とし、FormRequestに定義したsubstitutableメソッド(onlyメソッドで複数代入する値を指定)を使用し複数代入する
- そのテーブルの仕様はModelクラスのファイルにコメントで記載（別途ドキュメント作成を省くため）
- アクセサは以下の規約通りのみ使用可能（カラムなのかアクセサなのか分かりづらいので、メソッドで実装すればよい）
  - カラムの情報を加工して表示したいときにdisp_プレフィックスをつけて実装（姓・名を結合するようなのはメソッドで）
- _atのdatetime型カラムはCarbonにキャストする（Modelの$datesプロパティに記載）
- 各定数は適切なモデルに記載
- 退会などによるレコード論理削除時されていてもリレーション取得の必要があるリレーションメソッドにはwithTrashed()をつけてよい

## FormRequestについて

- バリデーションはFormRequestクラス使用
- FormRequestクラス名の命名規則は、コントローラークラス名ディレクトリ配下にメソッド名＋Requestで作成
  - 例）App\Http\Requests\HogeController\StoreRequest.php
- 「Modelについて」にも記載の通り、そのアクションで複数代入する値をsubstitutableメソッドにonlyで定義する
- バリデーションルールは「|」区切りではなく配列で記述
- バリデーションのカスタムメッセージや項目名の日本語化はlang/ja/validation.phpに記述（カラム名が被る場合はFormRequestクラスのメソッドに記載）
- laravelで用意されているルールでカバーできないバリデーションルールはRuleクラスに記述（極力作らない）
- 汎用性のあるRuleはRule\Commonに配置
- バリデーションの実装はrequired,nullable,string,integer,date,image,max:などの必須・型・MAXサイズのチェックを行う（＋各項目ごとに必要なバリデーションを実装）
- text型カラムのmaxは基本3000文字とする
- 画像は基本jpg,png指定（maxは20480kb）
```
// 入力例
return [
    'name'          => ['required', 'string', 'max:255'],
    'name_kana'     => ['required', 'string', 'max:255', new Katakana],
    'age_group'     => ['required'],
    'tel'           => ['required', 'numeric'],
    'post_code'     => ['required', 'string', 'max:255', 'regex:/^\d{7}$/'],
    'prefecture_id' => ['required', 'integer', 'exists:m_prefectures,id'],
    'address1'      => ['required', 'string', 'max:255'],
    'address2'      => ['required', 'string', 'max:255'],
    'building'      => ['nullable', 'string', 'max:255'],
];
```

## ルーティングについて

ルート記述方法はLaravel8で名前空間を使用する

```
use App\Http\Controllers\HomeController;
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::resource('hoges', HogeController::class);
```

同じ名前のコントローラーがある場合はエイリアス使用

```
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\User\PostController as UserPostController;

Route::get('admin/posts', [AdminPostController::class, 'index'])->name('admin.posts.index');
Route::get('user/posts', [UserPostController::class, 'index'])->name('user.posts.index');
```

- 基本的にはLaravelのリソースルートに合わせたURI形式とする

## 通知について

- 通知はlaravelのNotification機能を使用
- キューイングし非同期にする（送信に時間がかかるので）
- メール通知はNotificationクラスのtoMailメソッドにてmailableを返す
- notificationとmailableは同じクラス名
- 各チャンネルの送信判定はnotificationクラスのviaメソッドに記述

## Mailableクラスについて

- authのフォルダを作成する（userに送信するメールの場合app/Mail/User/クラス名となる）
- キューイングし非同期にする（送信に時間がかかるので）
- Notificationで使用する場合Notificationクラスと同じクラス名にする
- コンストラクタにて$this->bcc(config('mail.minna_bcc'));を設定する
- メール本文はテキストメールで作成
- メール本文は/resources/views/mail/text/{user or client or admin or　なし}に作成
- メール本文ファイル命名規則：mailableクラス名をスネークケースに変換した名前

## イベントについて
- notificationやmailのみであればeventは使わず、それ以外のイベントも発生する場合はイベントにまとめる

## 認可とミドルウェアについて

- 認可やミドルウェアはルートファイルに記述（リソースルートを使用する場合はコントローラーの__constructに記載OK）
- ミドルウェア命名規則
  - 通過できる条件をクラス名にする
  - ミドルウェア名登録はミドルウェアクラス名をドット区切りにしたもの
- 「認可」処理はPolicyかGateに記述

### bladeテンプレートについて

- bladeからのDBアクセスは禁止
- bladeファイル命名規則
  - URIに対応する形式にする
  - 基本的にフォルダ名は複数形で統一（複数単語はスネークケース）
- bladeには分岐や繰り返し処理以外のロジックは書かない
- bladeの行数が多く見通しが悪い時はパーツに切り出してincludeやcomponentを使用
- パーツはcomponents/partsフォルダに全部入れる（フォルダ分けは規則を作るのがめんどくさそうなため）
- includeとcomponentの使い分けはslotを使用するかどうか
- 同じレイアウトを使用するときは、bladeコンポーネント化する（例えば管理画面の一覧表示系など）
- モーダルはレイアウトで記述してあるmodal_areaにsectionで置く（bootstrapがbody直下に置けと言っている）
- 管理画面はデザインなし、bootstrapでコーディングします

### DB命名規則について

- マスタテーブルにはm_プレフィックスをつける（外部キーカラムも）(例m_prefectures)
- datetime型のカラム名のサフィックスには_at
- date型のカラム名のサフィックスには_on

### パンくずリストについて

- diglactic/laravel-breadcrumbsを使用
- パンくずリスト名とルート名は原則同じにする

### バッチ処理について

- signatureはcommand:クラス名とする
