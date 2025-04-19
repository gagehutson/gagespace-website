# Security Notes – Gagespace Personal File Server

This document outlines the security practices used to protect Gagespace, a self-hosted file sharing platform for personal use, family, and friends.

---

## Authentication & Sessions

- A custom PHP login system is used with `session_start()` to manage user sessions.
- Sessions track authenticated users and restrict access to file storage and upload pages.
- Sessions are cleared via `logout.php` using `session_destroy()` for secure sign-out.

---

## Password Protection

- User credentials are stored in a PHP array on the server (not in a database).
- Passwords are currently in plaintext for simplicity — intended for **trusted users only**.
- Future enhancement: migrate to hashed password storage using `password_hash()`.

---

## Input & Upload Security

- Uploads are limited to authenticated users only.
- `upload.php` verifies that files are uploaded via HTTP POST and checks for empty names.
- `basename()` and file sanitization are used to prevent directory traversal attacks.
- Future improvement: implement MIME-type checking and file extension whitelisting.

---

## File Listing Security

- `list-files.php` dynamically lists files from an internal directory.
- Paths are encoded and passed via `$_GET`, with logic to prevent unauthorized path access.
- Folder navigation is restricted and sandboxed to the upload directory.

---

## Cloudflare Tunnel & HTTPS

- The file server is self-hosted on a Raspberry Pi and exposed securely using **Cloudflare Tunnel**.
- All external access is routed through HTTPS using a Cloudflare-secured domain.
- Direct IP and port access are blocked outside the LAN.

---

## Access Control

- Only users with valid credentials can upload, view, or download files.
- File download links are generated server-side and are protected by session checks.
- No public file access or guest user features are enabled.

---

## Not Yet Implemented

- No CSRF protection on form submissions
- No brute-force protection or login rate limiting
- No backend logging of access attempts

---

**Last updated:** April 2025  
**Author:** Gage Hutson