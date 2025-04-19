# Cloudflare Tunnel Setup – Gagespace

## What is Cloudflare Tunnel?

Cloudflare Tunnel (formerly Argo Tunnel) lets you expose your local web server (running on a Raspberry Pi) to the internet securely without opening any ports on your router.

---

## Why I Used It

Since Gagespace is self-hosted on my home network, I used Cloudflare Tunnel to:
- Avoid port forwarding
- Protect the server from direct IP exposure
- Securely connect `gagespace.com` to my Raspberry Pi

---

## How I Set It Up

1. **Installed cloudflared on Raspberry Pi**  
   ```bash
   sudo apt install cloudflared
   ```

2. **Authenticated to Cloudflare**  
   ```bash
   cloudflared tunnel login
   ```

3. **Created and configured a tunnel**  
   ```bash
   cloudflared tunnel create gagespace
   cloudflared tunnel route dns gagespace gagespace.com
   ```

4. **Ran the tunnel**  
   ```bash
   cloudflared tunnel run gagespace
   ```

5. **Created a systemd service** to auto-run at boot:  
   ```bash
   sudo nano /etc/systemd/system/cloudflared.service
   ```

---

## Outcome

- My local Apache server is securely available at `https://gagespace.com`
- No need for public IP or router access
- All traffic encrypted and proxied through Cloudflare

---

**Last updated:** April 2025