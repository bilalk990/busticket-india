# Railway Deployment Guide

## CRITICAL: Build Environment Variables

Before deploying, you MUST set these build-time environment variables in Railway:

### In Railway Dashboard → Your Service → Variables → Add these:

```
NPM_CONFIG_PRODUCTION=false
NODE_ENV=development
```

These ensure that Tailwind CSS and other dev dependencies are installed during build.

## Prerequisites
- Railway account
- GitHub repository connected to Railway

## Environment Variables to Set in Railway

Add these environment variables in your Railway project settings:

```
# Build Variables (CRITICAL - Add these first!)
NPM_CONFIG_PRODUCTION=false
NODE_ENV=development

# App Variables
APP_NAME=BusTicketIndia
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-app.railway.app

# Database Variables (Auto-set when you add MySQL)
DB_CONNECTION=mysql
DB_HOST=${{MYSQLHOST}}
DB_PORT=${{MYSQLPORT}}
DB_DATABASE=${{MYSQLDATABASE}}
DB_USERNAME=${{MYSQLUSER}}
DB_PASSWORD=${{MYSQLPASSWORD}}

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=error
```

## Steps to Deploy

1. **Connect GitHub Repository**
   - Go to Railway dashboard
   - Click "New Project"
   - Select "Deploy from GitHub repo"
   - Choose `bilalk990/busticket-india`

2. **IMPORTANT: Set Build Variables FIRST**
   - Go to your service settings
   - Click "Variables"
   - Add `NPM_CONFIG_PRODUCTION=false`
   - Add `NODE_ENV=development`
   - These MUST be set before first deployment!

3. **Add MySQL Database**
   - In your Railway project, click "New"
   - Select "Database" → "Add MySQL"
   - Railway will automatically set MySQL environment variables

4. **Set Application Environment Variables**
   - Add all the environment variables listed above
   - Generate APP_KEY by running locally: `php artisan key:generate --show`

5. **Deploy**
   - Railway will automatically deploy when you push to GitHub
   - First deployment might take 5-10 minutes
   - Watch the build logs to ensure npm install includes dev dependencies

## Troubleshooting Build Errors

### If you still see "Cannot find module 'tailwindcss'" error:

1. Check Railway build logs - look for this line:
   ```
   npm install --include=dev
   ```

2. Verify environment variables are set:
   - Go to Variables tab
   - Ensure `NPM_CONFIG_PRODUCTION=false` is there
   - Ensure `NODE_ENV=development` is there

3. Trigger a new deployment:
   - Go to Deployments tab
   - Click "Redeploy" on the latest deployment

4. Alternative: Use Dockerfile builder
   - In railway.toml, we've set `builder = "DOCKERFILE"`
   - This uses our custom Dockerfile which explicitly installs dev dependencies

## Post-Deployment

After successful deployment, run these commands in Railway's terminal:

```bash
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Build Process Explanation

The build now works as follows:

1. **Install Phase**: `npm install --include=dev` - Installs ALL dependencies including Tailwind
2. **Build Phase**: `NODE_ENV=development npm run build` - Builds with dev environment
3. **Result**: Tailwind CSS and PostCSS plugins are available during build

## Troubleshooting

If build fails:
- Check Railway logs for specific errors
- Ensure all environment variables are set (especially NPM_CONFIG_PRODUCTION)
- Verify database connection
- Check that build.sh has execute permissions

If assets don't load:
- Check that `npm run build` completed successfully
- Verify APP_URL is set correctly
- Check public/build directory exists
