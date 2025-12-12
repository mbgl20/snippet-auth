<h1 align="center">snippet-auth</h1>
<p align="center">login • register • logout • settings</p>

---

## 📌 About

This is a snippet for authentication and login walls.

The first version will come out soon! Stay tuned!

---

## 📀 DEMO

# <a href="https://auth.demo.mabgl.com/" target="_blank">DEMO</a>

---

## 💻 Installation

** [ 1 ] ** Drag 'n' drop the archive into your webspace

** [ 2 ] ** Import `s.sql` into your db

** [ 3 ] ** Head to `/src/config.php` and replace the sample credentials with yours.

** [ 4 ] ** Check for function

** NOTICE **

Place for all pages that shoud be protected this part ❗ after ❗ the `'require_once ...'`:

### V1 - Commentless kick player from page to dedicated location.

```php
if (!isset($_SESSION['id'])) {
    header('Location: /login/');
    exit;
}
```

### V2 - Show player a notice (either with `die` or `include`)

```php
if (!isset($_SESSION['id'])) {
    die("You are not Logged-in!<br><a href="/login/">Login</a>");
    exit;
}
```

```php
// COMMING SOON!
if (!isset($_SESSION['id'])) {
    die(include('not-logged-in-page.php'));
    exit;
}
```

---

## 🔧 Planed work

 • Login

 • Register

 • Logout

 • Settings

 • E-Mail verfify

 • ...

---

## 📊 Progress

🟩🟩🟩🟩🟩 -> Finished 100%

⬛⬛⬛⬛⬛ -> Not even stared.



Database    🟩🟩🟩🟩🟩

Backend     🟩🟩🟩🟩⬛

Frontend    🟥🟥⬛⬛⬛

---


## 📫 Contact

If you want to contribute or just chat, feel free to reach out!  
> Always open for ideas, feedback, and new projects.
> Mail: mail@mabgl.com

---

<p align="center">✨ Thanks for visiting my project! Let's check it out and get in touch! ✨</p>
