# アプリケーション名
「FashionablyLate」お問い合わせフォーム

# 環境構築
### 1. Dockerの構築
コマンドラインで「docker-compose.yml」がある階層に移動して、下記のコマンド実行します。

`docker-compose up -d --build`

### 2. PHPコンテナに入る
`docker-compose exec php bash`

### 3. コンポーザーをインストール
`composer install`

### 4. .envファイルを作成
`cp .env.example .env`

### 5. .envファイルを編集
「VS Code」などで「.envファイル」を開き、DBに関する設定を以下に変更します。

```env
DB_HOST=mysql
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

### 6. マイグレーションを実行
`php artisan migrate`

### 7. シーダーを実行
実行すると「categoriesテーブル」にカテゴリの初期値が、「contentsテーブル」にテストデータ35件が追加されます。

`php artisan db:seed`

### 8. アプリケーションの暗号化キーを生成
`php artisan key:generate`

### 9. アクセス
下記「URL」アクセスすると、お問い合わせフォーム（index）が開きます。

正常に表示されれば完了です。


# ER図
<img width="732" height="359" alt="Image" src="https://github.com/user-attachments/assets/bc8a21f3-9f82-409d-b552-1361c20f6fa1" />

# URL
開発（ローカル）環境：http://localhost

# アプリケーション名
「FashionablyLate」お問い合わせフォーム

# 環境構築
### 1. Dockerの構築
コマンドラインで「docker-compose.yml」がある階層に移動して、下記のコマンド実行します。

`docker-compose up -d --build`

### 2. PHPコンテナに入る
`docker-compose exec php bash`

### 3. コンポーザーをインストール
`composer install`

### 4. .envファイルを作成
`cp .env.example .env`

### 5. .envファイルを編集
「VS Code」などで「.envファイル」を開き、DBに関する設定を以下に変更します。

```env
DB_HOST=mysql
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

### 6. マイグレーションを実行
`php artisan migrate`

### 7. シーダーを実行
実行すると「categoriesテーブル」にカテゴリの初期値が、「contentsテーブル」にテストデータ35件が追加されます。

`php artisan db:seed`

### 8. アプリケーションの暗号化キーを生成
`php artisan key:generate`

### 9. アクセス
下記「URL」アクセスすると、お問い合わせフォーム（index）が開きます。

正常に表示されれば完了です。


# ER図
![ER図](./img/er.png)

# URL
開発（ローカル）環境：http://localhost

