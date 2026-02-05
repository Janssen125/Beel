# Laravel 12 + Tailwind CSS Learning Project

This project is a sandbox for learning how to use **Laravel 12** with **Tailwind CSS**, based on the TailAdmin Laravel starter template.

The goal is to explore:

-   Laravel 12 project structure and workflow
-   Tailwind CSS styling in a Laravel app
-   Blade components and layouts
-   Asset building with Vite

---

## 📦 Source Template

This project is based on the TailAdmin Laravel template:

https://tailadmin.com/laravel

---

## 🛠️ Requirements

Make sure you have the following installed:

-   PHP **8.2+**
-   Composer
-   Node.js **18+**
-   npm
-   MySQL

---

## 🚀 Installation

1.  **Clone the repository**
    ```
    git clone <your-repo-url>
    cd <project-folder>
    ```
2.  **Install PHP Dependencies**
    ```
    composer install
    ```
3.  **Install Frontend Dependencies**
    ```
    npm install
    ```
4.  **Configure Database**
    ```
    copy <code>.env.example</code> file and name it <code>.env</code><br>
    at <code>DB_DATABASE</code>, name it as same as your database<br>
    then run <code>php artisan migrate --seed</code>
    ```

## ▶️ Running The Project

1. **Start the Laravel**
    ```
    php artisan serve
    ```
2. **Start Vite**
    ```
    npm install && npm run dev
    ```
3. **Visit**
    ```
    http://127.0.0.1
    ```

## 🎨 Tailwind CSS Usage

-   Tailwind is configured via Vite
-   Config file:

```
tailwind.config.js
```

-   Main CSS entry:

```
resources/css/app.css
```

-   Example Tailwind usage in a Blade file:

```
<div class="p-6 bg-white rounded-lg shadow">
    <h1 class="text-xl font-bold text-gray-800">Hello Tailwind</h1>
</div>
```

## 🧪 Learning Goals / Notes

-   Understand Laravel 12 directory structure
-   Practice Tailwind utility-first styling
-   Learn Blade templating and components
-   Explore authentication, routing, and middleware
-   Experiment freely without worrying about production

## 📚 Useful Resources

-   Laravel Docs: https://laravel.com/docs
-   Tailwind Docs: https://tailwindcss.com/docs
-   TailAdmin Docs: https://tailadmin.com/docs
