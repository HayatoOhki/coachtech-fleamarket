<div id="top"></div>

## 使用技術一覧

<p style="display: inline">
  <!-- フロントエンドのフレームワーク一覧 -->
  
  <!-- フロントエンドの言語一覧 -->
  <img src="https://img.shields.io/badge/-Javascript-F7DF1E.svg?logo=javascript&style=plastic">
  <!-- バックエンドのフレームワーク一覧 -->
  <img src="https://img.shields.io/badge/-Laravel-E74430.svg?logo=laravel&style=plastic">
  <!-- バックエンドの言語一覧 -->
  <img src="https://img.shields.io/badge/-Php-777BB4.svg?logo=php&style=plastic">
  <!-- ミドルウェア一覧 -->
  <img src="https://img.shields.io/badge/-Nginx-269539.svg?logo=nginx&style=plastic">
  <img src="https://img.shields.io/badge/-Mysql-4479A1.svg?logo=mysql&style=plastic">
  <!-- インフラ一覧 -->
  <img src="https://img.shields.io/badge/-Docker-1488C6.svg?logo=docker&style=plastic">
</p>

## 目次

1. [サービスについて](#サービスについて)
2. [環境](#環境)
3. [開発環境構築](#開発環境構築)
4. [ER図](#ER図)

## サービスについて

<!-- プロジェクトの概要を記載 -->
### サービス名：coachtechフリマ
### 概要：

当サービスは、coachtechブランドのアイテムを売買できるフリマアプリです。

シンプルで使いやすいインターフェースと、豊富な機能を備えており、ユーザーが効率的に取引を行えるように設計されています。

### 主な機能：
1. ユーザー登録とプロフィール管理

    ユーザーはメールアドレスを使用して登録し、プロフィール情報を設定できます。

2. 商品の出品と検索

    ユーザーは商品の写真と詳細を追加して出品できます。キーワードを使用した検索機能で商品を探すことができます。

3. 取引機能

    ユーザー同士でのメッセージを通じて取引ができます。取引履歴を通じて信頼性のある取引が促進されます。

4. アカウントの削除(管理者のみ)

    管理者はユーザー一覧画面からユーザーの削除を行えます。

    削除後はそのユーザーのプロフィール情報、出品情報、取引履歴などはすべて完全に消去されます。


![スクリーンショット 2024-07-23 150552](https://github.com/user-attachments/assets/7fc76049-67fc-49d9-84ea-5cbd01c921ac)

## 環境

<!-- 言語、フレームワーク、ミドルウェア、インフラの一覧とバージョンを記載 -->

| 言語・フレームワーク    | バージョン  |
| --------------------- | ---------- |
| PHP                   | 8.1.18     |
| Laravel               | 8.83.8     |
| nginx                 | 1.21.1     |
| MySQL                 | 8.0.26     |

## 開発環境構築

<!-- コンテナの作成方法、パッケージのインストール方法など、開発環境構築に必要な情報を記載 -->

### Dockerビルド
1. git clone git@github.com:HayatoOhki/coachtech-fleamarket.git
2. docker-compose up -d --build

※MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせて docker-compose.yml ファイルを編集してください。


### Laravel環境構築
1. docker-compose exec php bash
2. composer install
3. .env.example ファイルから .env を作成し、以下の[環境変数の一覧](#環境変数の一覧)を元に環境変数を変更
4. php artisan key:generate
5. php artisan migrate
6. php artisan db:seed

### 動作確認
http://localhost にアクセスできるか確認

アクセスできたら成功

### コンテナの停止

以下のコマンドでコンテナを停止することができます

docker-compose down

### 環境変数の一覧

| 変数名                  | .env.example                       | 変更後                                   |
| ---------------------- | ---------------------------------- | ---------------------------------------- |
| DB_HOST                | 127.0.0.1                          | mysql                                    |
| DB_DATABASE            | laravel                            | laravel_db                               |
| DB_USERNAME            | root                               | laravel_user                             |
| DB_PASSWORD            |                                    | laravel_pass                             |

## ER図
![index](https://github.com/user-attachments/assets/fd5cfe92-d605-44de-a458-45b1e8954f99)
