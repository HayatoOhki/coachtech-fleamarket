# Coachtech Flea Market 🛍️

[![Laravel](https://img.shields.io/badge/-Laravel%208-EA4335?logo=laravel&logoColor=white)](https://laravel.com/)
[![PHP](https://img.shields.io/badge/-PHP%208.1-8892BF?logo=php&logoColor=white)](https://www.php.net/)
[![Docker](https://img.shields.io/badge/-Docker-blue?logo=docker&logoColor=white)](https://www.docker.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)

---

## 📖 Table of Contents  
1. [Overview / 概要](#overview--概要)  
2. [Demo](#demo)  
3. [Features](#features)  
4. [Tech Stack](#tech-stack)  
5. [Getting Started](#getting-started)  
6. [Project Structure](#project-structure)  
7. [URLs & Demo Accounts](#urls--demo-accounts)  
8. [Database ER Diagram](#database-er-diagram)  
9. [Roadmap](#roadmap)  
10. [Author](#author)  
11. [License](#license)  

---

## Overview / 概要

**Coachtech Flea Market** は **COACHTECH** ブランド専用アイテムを売買できる **C2C フリマアプリ** です。  
“**シンプルな UI** × **充実した取引機能**” により、だれでも安心して売買を楽しめることを目指しています。

| 開発規模 | 期間 | 担当領域 |
| --- | --- | --- |
| 個人開発 (Solo) | 2025‑06 ~ 2025‑07 (約 6 週間) | 企画・設計・実装・テスト・CI/CD |

---

## Demo

| User App | Admin Dashboard |
| --- | --- |
| ![User Top](https://github.com/user-attachments/assets/7fc76049-67fc-49d9-84ea-5cbd01c921ac) | ![Admin](https://github.com/user-attachments/assets/7fc76049-67fc-49d9-84ea-5cbd01c921ac) |

<https://52.195.174.1>

> ⚠️ **初回アクセス時は自動スリープ解除のため 30 秒ほどお待ちください**

---

## Features

- **ユーザー登録 & プロフィール編集**  (Laravel Breeze + Tailwind)
- **商品 CRUD** ・複数画像アップロード (S3 互換 MinIO)
- **全文検索 / カテゴリ・タグフィルタ**  (MySQL FULLTEXT)
- **取引チャット & 状態管理**  (Enum, Eloquent Observer)
- **管理者ダッシュボード** – ユーザー・商品停止／物理削除
- **CI/CD** – GitHub Actions → DockerHub → Amazon ECS
- **自動テスト** – PHPUnit / Pest, Feature & Unit 45+ Cases
- **静的解析** – PHPStan, Larastan (level 9)

---

## Tech Stack

| Layer | Tech | Version |
| --- | --- | --- |
| Backend | **Laravel** | 8.83.8 |
| Language | **PHP** | 8.1.18 |
| DB | **MySQL** | 8.0.26 |
| Web server | **Nginx** | 1.21.1 |
| Infrastructure | **Docker / docker‑compose** | v2 |
| CI/CD | GitHub Actions, AWS ECS Fargate |
| Others | phpMyAdmin, PHPUnit, PHPStan |

---

## Getting Started

### Prerequisites
- Docker Desktop 4.0+
- Git

### Quick Start

```bash
# 1. Clone
git clone https://github.com/HayatoOhki/coachtech-fleamarket.git
cd coachtech-fleamarket

# 2. Build & up
docker compose up -d --build

# 3. Initialize Laravel
docker compose exec php bash -c "composer install \
  && cp env/.env.dev .env \
  && php artisan key:generate \
  && php artisan migrate:fresh --seed"

# 4. Access
open http://localhost
```
> **MySQL が起動しない場合** は OS に合わせて `docker-compose.yml` のポート／ボリューム設定を調整してください。

### Stop Containers
```bash
docker compose down
```

---

## Project Structure

```
├── app/           # Laravel application (Domain, Service, Repository layers)
├── database/
│   ├── migrations
│   └── seeders/
├── public/
├── resources/
├── tests/
└── docker/
    ├── nginx/
    └── php/
```

---

## URLs & Demo Accounts

| Environment | URL |
| --- | --- |
| **Dev** | <http://localhost> |
| **Admin (Dev)** | <http://localhost/admin/user> |
| **Prod** | <https://52.195.174.1> |
| **Admin (Prod)** | <https://52.195.174.1/admin/user> |
| phpMyAdmin | <http://localhost:8080> |

| Email | Password | Role |
| --- | --- | --- |
| admin001@example.com | adminpassword001 | Admin |
| user001@example.com | userpassword001 | User |
| user002@example.com | userpassword002 | User |
| user003@example.com | userpassword003 | User |
| user004@example.com | userpassword004 | User |
| user005@example.com | userpassword005 | User |

---

## Database ER Diagram

![ER diagram](https://github.com/user-attachments/assets/fd5cfe92-d605-44de-a458-45b1e8954f99)

---

## Roadmap

- [ ] 商品のお気に入り機能
- [ ] 決済 (Stripe)
- [ ] 通知 (Laravel Notification + Pusher)
- [ ] E2E テスト (Playwright)

---

## Author

|  |  |
| --- | --- |
| **Hayato Ohki** | Freelance Full‑Stack Engineer |
| Tech | PHP / Laravel / TypeScript / AWS |
| LinkedIn | <https://www.linkedin.com/in/> |
| X (Twitter) | [@hayato_ohki](https://twitter.com/hayato_ohki) |

---

## License

This project is licensed under the **MIT License** – see the [LICENSE](LICENSE) file for details.
