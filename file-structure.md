# File Structure – Gagespace Project

This document explains the folder and file layout of the Gagespace personal file server. It helps users and reviewers understand how the project is organized and what each part is responsible for.

---

## Root Directory

- `README.md` – Project overview and introduction
- `security-notes.md` – Explanation of authentication and security practices
- `cloudflare-tunnel.md` – Setup guide for securely exposing the server via Cloudflare Tunnel
- `file-structure.md` – This file

---

## /htdocs or /public

This is the public-facing directory served by Apache.

### Key Files:

- `index.html` – Main landing page for the Gagespace site
- `login.html` – Styled modal login page that opens the file server
- `filestorage.html` – Displays available files with download buttons
- `logout.php` – Destroys session and logs out the user

---

## Backend PHP Scripts

- `upload.php` – Handles secure file uploads to the server
- `list-files.php` – Lists uploaded files and folders dynamically
- `action_page.php` – Processes login form data and starts session
- `generic.php` – Displays file server

---

## Other

- `assets/` – Contains all CSS, JS, and image assets
- `uploads/` – (Private) Storage folder for uploaded files
- `.htaccess` – (Optional) Apache config to protect sensitive paths (not included here)

---

## Notes

- All sensitive logic is in `.php` files and hidden from the public
- Upload and download features are protected behind a session login
- Project is exposed via Cloudflare Tunnel, not via public IP

---

**Last updated:** April 2025