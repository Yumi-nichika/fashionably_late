# アプリケーション名
coachtech お問い合わせフォーム

## 概要
ユーザーがお問い合わせを送信でき、管理画面から内容を確認・検索できるアプリケーションです。

# 環境構築

## Dockerビルド

### 1. Gitをクローン
```cmd
git clone git@github.com:Yumi-nichika/fashionably_late.git
```

### 2. Dockerを起動
```cmd
docker-compose up -d --build
```

## Laravel環境構築

### 1. PHPコンテナに入る
```cmd
docker-compose exec php bash
```

### 2. コンポーザーをインストール
```cmd
composer install
```

### 3. .envファイルを作成
```cmd
cp .env.example .env
```

### 4. .envファイルを編集
```env
DB_HOST=mysql
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

### 5. マイグレーションを実行
```cmd
php artisan migrate
```

### 6. シーダーを実行
実行すると「categoriesテーブル」にカテゴリの初期値が、「contentsテーブル」にテストデータ35件が追加されます。
```cmd
php artisan db:seed
```

### 7. アプリケーションの暗号化キーを生成
```cmd
php artisan key:generate
```

### 8. アクセス
下記「URL」にアクセスし、正常に表示されれば完了です。

# 使用技術（実行環境）
- PHP 8.1.34
- Laravel 8.83.29
- mysql 8.0.26
- nginx 1.21.1

# ER図
![ER図](./img/er.png)

# URL
お問い合わせフォーム：http://localhost

管理画面ログイン：http://localhost/admin

管理画面ユーザー新規登録：http://localhost/register

phpMyAdmin:http://localhost:8080