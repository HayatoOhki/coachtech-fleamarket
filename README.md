<div id="top"></div>

## 使用技術一覧

<p style="display: inline">
  <!-- フロントエンドのフレームワーク一覧 -->
  
  <!-- フロントエンドの言語一覧 -->
  <img src="https://img.shields.io/badge/-Javascript-F7DF1E.svg?logo=javascript&style=for-the-badge">
  <!-- バックエンドのフレームワーク一覧 -->
  <img src="https://img.shields.io/badge/-Laravel-E74430.svg?logo=laravel&style=for-the-badge">
  <!-- バックエンドの言語一覧 -->
  <img src="https://img.shields.io/badge/-Php-777BB4.svg?logo=php&style=for-the-badge">
  <!-- ミドルウェア一覧 -->
  <img src="https://img.shields.io/badge/-Nginx-269539.svg?logo=nginx&style=for-the-badge">
  <img src="https://img.shields.io/badge/-Mysql-4479A1.svg?logo=mysql&style=for-the-badge">
  <!-- インフラ一覧 -->
  <img src="https://img.shields.io/badge/-Docker-1488C6.svg?logo=docker&style=for-the-badge">
  <img src="https://img.shields.io/badge/-Amazon%20aws-232F3E.svg?logo=amazon-aws&style=for-the-badge">
</p>

## 目次

1. [サービスについて](#サービスについて)
2. [環境](#環境)
3. [開発環境構築](#開発環境構築)
4. [URL](#URL)
5. [ログイン情報](#ログイン情報)
6. [ER図](#ER図)

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
2. cd coachtech-fleamarket
3. docker-compose up -d --build

※MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせて docker-compose.yml ファイルを編集してください。

### Laravel環境構築
1. docker-compose exec php bash
2. composer install
3. cp env/.env.dev .env
4. php artisan key:generate
5. php artisan migrate --seed
※上記のコマンドを実行しても「Nothing to migrate.」が返ってくる場合以下のコマンドを実行  
※既にテーブル内にデータが入っている場合は、それらが消えてしまうため注意
5. php artisan migrate:fresh --seed

### 動作確認
http://localhost にアクセスできるか確認  
アクセスできたら成功

### コンテナの停止
以下のコマンドでコンテナを停止することができます  
docker-compose down

## URL
### 開発環境
・phpMyAdmin：http://localhost:8080/  
・トップページ：http://localhost/  
・管理者ページ：http://localhost/admin/user

### 本番環境
・トップページ：http://52.195.174.1  
・管理者ページ：http://52.195.174.1/admin/user

## ログイン情報
| メールアドレス           | パスワード                         | 権限                                      |
| ---------------------- | ---------------------------------- | ---------------------------------------- |
| admin001@example.com   | adminpassword001                   | 管理者                                    |
| user001@example.com    | userpassword001                    | ユーザー                                  |
| user002@example.com    | userpassword002                    | ユーザー                                  |
| user003@example.com    | userpassword003                    | ユーザー                                  |
| user004@example.com    | userpassword004                    | ユーザー                                  |
| user005@example.com    | userpassword005                    | ユーザー                                  |

## ER図
![index](https://github.com/user-attachments/assets/fd5cfe92-d605-44de-a458-45b1e8954f99)
