# File Structure – Pooles Pools Project

This document explains the folder and file layout of the Pool Web application and Database implementation. It helps users and reviewers understand how the project is organized and what each part is responsible for.

---

## Root Directory

- `README.md` – Project overview and introduction
- `security-notes.md` – Explanation of authentication and security practices
- `cloudflare-tunnel.md` – Setup guide for securely exposing the server via Cloudflare Tunnel
- `file-structure.md` – This file

---
## /htdocs

This is the database where information is stored either provided by the customer, admin, or technician. 

## /htdocs

This is the public-facing directory served by Apache. I only provided specific code to showcase my skills. ****NOT ALL CODE PROVIDED IS ENOUGH TO RUN WEB SERVER**** This is just a showcase.

### Key Files:

- `index.php` – Main landing page for the site
- `login.php` – Styled modal login page to access certain areas of the website
- `signupmodal.php` – Contains the modal HTML/PHP for user sign-up.
- `db.php` – Crucial php file to gain access to database
- `logout.php` – Destroys session and logs out the user


---

## /ADMIN 

These files are part of the admin dashboard for Poole's Pools for technicians:

- `accounts.php` – Displays and manages technician/admin account information.
- `add-product.php` – Adds a new product to the store inventory.
- `adminindex.php` – Main dashboard page for admin users ("The Deep End").
- `appointments.php` – Displays and manages all scheduled appointments.
- `billing.php` – Displays billing information and payment records.
- `complete_service_job.php` – Processes completion of a service job and logs details.
- `customer.php` – Displays customer account details and provides management options.
- `delete_product.php` – Deletes a product from the inventory.
- `edit-product.php` – Edits existing product information in the inventory.
- `jobs.php` – Displays all technician job assignments (active or completed).
- `orders.php` – Shows all store orders placed by customers.
- `pool.php` – Manages customer pool information (address, size, etc.).
- `productcheckout.php` – Finalizes product checkout for service jobs.
- `products.php` – Displays current inventory and stock levels.
- `report_queries.php` – Handles backend SQL queries for generating admin reports.
- `service_inventory_table_update.php` – Updates service job inventory usage after checkout.

---

## Backend PHP Scripts

- `about.php` – Displays information about Poole's Pools.
- `account.php` – Displays and allows users to view their account information.
- `add_to_cart.php` – Adds a product to the user's shopping cart (session-based).
- `appointment_alter.php` – Updates an existing appointment (likely by a technician).
- `appointmentlogger.php` – Logs appointment actions or completions.
- `appointments.php` – Displays upcoming appointments for the logged-in user.
- `appointmentsmade.php` – Displays a list of past or completed appointments.
- `cart.php` – Shows items in the shopping cart and totals.
- `checkout.php` – Handles checkout processing, inserts order/payment into the database.
- `contact.php` – Displays a contact form or business contact information.
- `db.php` – Establishes a connection to the MySQL database.
- `hasher.php` – Hashes passwords to input manually for technician accounts.
- `login.php` – Processes login form data, starts sessions, and authenticates users.
- `logout.php` – Ends the current session and logs the user out.
- `orderhistory.php` – Displays past orders for the customer.
- `receipt.php` – Displays a receipt/confirmation of a successful order.
- `remove_from_cart.php` – Removes a selected item from the user's cart.
- `services.php` – Lists pool services offered, such as cleaning, repair, etc.
- `shop.php` – Displays products for sale and allows adding to cart.
- `signingup.php` – Processes signup form submissions and stores new user data.
- `update_account.php` – Processes updates to user account details.

---

## Other

- `assets/` – Contains all CSS, JS, and image assets
- `uploads/` – (Private) Storage folder for uploaded files
- `.htaccess` – (Optional) Apache config to protect sensitive paths (not included here)

---

## Notes

- All sensitive logic is in `.php` files and hidden from the public
- Project is exposed via Cloudflare Tunnel, not via public IP

---

**Last updated:** April 2025