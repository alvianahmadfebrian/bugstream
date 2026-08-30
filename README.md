# BugStream - Bug Management System

BugStream is a real-time, responsive enterprise bug tracking and management console. It features multi-role authorization, scoped analytical dashboards, dynamic priority distributions, comments timeline, and administrative user management.

---

## 👥 Role Accounts & Logins

All accounts use the same password: **`pisangkeju`**

| Role | Username / Name | Email | Description / Access Level |
| :--- | :--- | :--- | :--- |
| **Super Admin** | `masteryoda` | `yoda@jedi.com` | Full system access: User CRUD management, global metrics dashboard, and reassigning bugs. |
| **Support Dev (QA)** | `obiwan` | `obiwan@jedi.com` | Reports bugs, views dashboard scoped to their reported bugs, and conducts bug verification/retests. |
| **Developer** | `anakin` | `anakin@jedi.com` | Access restricted to assigned bugs list; updates task progress (Start progress -> Mark as fixed). |

---

## 🚀 Installation Guide

Follow these steps to set up the project locally.

### 📋 Prerequisites
Ensure you have the following installed:
- **PHP 8.2+** (with SQLite extension enabled)
- **Composer**
- **Node.js & NPM**

### 💻 Setup Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/alvianahmadfebrian/bugstream.git
   cd bugstream
   ```

2. **Install PHP and Javascript Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment File**
   Copy the example environment configuration:
   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Initialize SQLite Database**
   Create an empty SQLite file:
   ```bash
   touch database/database.sqlite
   ```

6. **Run Migrations & Seed Default Accounts**
   Run the migration tool to build database schema and seed the `masteryoda`, `obiwan`, and `anakin` accounts:
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Compile Assets & Start Dev Server**
   Start the Laravel local server:
   ```bash
   php artisan serve
   ```
   Open your browser and navigate to: `http://127.0.0.1:8000`

---

## 🧪 Running Automated Tests

Run the complete integration and feature test suite (which includes role access control, profile updates, and CRUD tests):
```bash
php artisan test
```
