# 📝 PHP Blog Project – Task 3

This project is a simple **Blog Application** developed using **PHP**, **MySQL**, and **Bootstrap**.  
It is created as **Task-3** to understand PHP CRUD operations, user authentication, and basic web application flow.

---

## ✨ Features

- 👤 User **Registration** and **Login**
- 📝 Create, Read, Update, and Delete (**CRUD**) blog posts
- 🔍 Search posts by title or content
- 📄 Pagination for posts
- 🔐 Session-based authentication
- 📢 Flash messages for actions (create, update, delete)
- 📱 Responsive UI using Bootstrap

---

## 📂 Project Files

- `config.php` – Database connection  
- `index.php` – Home page (posts, search, pagination)  
- `create_post.php` – Create new post  
- `edit_post.php` – Edit post  
- `delete_post.php` – Delete post  
- `login.php` – User login  
- `register.php` – User registration  
- `header.php` / `footer.php` – Layout files  
- `flash.php` – Flash messages  

---

## 🚀 How to Run Locally

> Note: Keep `config.php` private. Do not upload database credentials. 🔒

1. Install **XAMPP**
2. Start **Apache** and **MySQL**
3. Create a database named `blog`
4. Import the required tables (`users`, `posts`)
5. Update database details in `config.php`
6. Open browser and run:
