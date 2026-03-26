# Test Payment Button - Service Unavailable Fix

## Problem
When clicking the "Test Payment — Confirm Booking Instantly (Demo)" button, the page redirects to `/payment/test` and shows "Service Unavailable" error.

## Root Cause
The issue is caused by the PHP built-in server (`php artisan serve`) not handling POST requests properly on Railway's infrastructure, especially under load or with session management.

## Solutions Applied

### 1. Improved Error Handling
- Added try-catch blocks to prevent server crashes
- Changed error responses from JSON to user-friendly redirects
- Added better logging for debugging

### 2. Updated Railway Configuration
Files modified:
- `railway.json` - Updated start command
- `nixpacks.toml` - Added proper build phases
- `Procfile` - Added for Heroku-style deployment

### 3. Added Health Check
- Added `/test-server` endpoint for health checks
- Added `/test-post` endpoint to test POST requests

## Testing Steps

### Step 1: Test Server Health
Visit: `https://your-domain.com/test-server`

Expected response:
```json
{
  "status": "Server is working",
  "timestamp": "2026-03-26...",
  "php_version": "8.2.x",
  "laravel_version": "11.x"
}
```

### Step 2: Test POST Requests
Use curl or Postman:
```bash
curl -X POST https://your-domain.com/test-post \
  -H "Content-Type: application/json"
```

Expected response:
```json
{
  "status": "POST is working",
  "timestamp": "2026-03-26...",
  "session_working": true
}
```

### Step 3: Test Payment Flow
1. Go through the booking process
2. Select seats and enter passenger details
3. Click the green "Test Payment" button
4. Should redirect to dashboard with success message

## If Still Not Working

### Option A: Clear All Caches
Visit: `https://your-domain.com/clear-all-cache`

### Option B: Check Logs
On Railway:
1. Go to your project
2. Click on "Deployments"
3. Click on the latest deployment
4. View logs for errors

### Option C: Redeploy
1. Push these changes to your repository
2. Railway will automatically redeploy
3. Wait for deployment to complete
4. Test again

### Option D: Use Alternative Server (Advanced)
If PHP built-in server continues to have issues, consider:
1. Using Apache with mod_php
2. Using Nginx with PHP-FPM
3. Using a different hosting platform (Vercel, Netlify, etc.)

## Environment Variables to Check
Make sure these are set in Railway:
- `APP_ENV=production`
- `APP_DEBUG=false` (or `true` for debugging)
- `APP_KEY=base64:...` (run `php artisan key:generate` if missing)
- `DB_CONNECTION=mysql`
- `DB_HOST=...`
- `DB_DATABASE=...`
- `DB_USERNAME=...`
- `DB_PASSWORD=...`
- `SESSION_DRIVER=database` (recommended for Railway)
- `CACHE_DRIVER=database` (recommended for Railway)

## Quick Fix Commands
Run these locally before deploying:
```bash
cd FastBuss-website
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
php artisan optimize
```

## Contact
If the issue persists after trying all solutions, check:
1. Railway deployment logs
2. Laravel logs at `storage/logs/laravel.log`
3. Browser console for JavaScript errors
4. Network tab in browser dev tools for failed requests
