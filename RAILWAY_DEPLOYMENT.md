# Railway Deployment Guide

## Prerequisites
- Railway account
- GitHub repository connected to Railway

## Environment Variables to Set in Railway

Add these environment variables in your Railway project settings:

```
APP_NAME=BusTicketIndia
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-app.railway.app

DB_CONNECTION=mysql
DB_HOST=${{MYSQLHOST}}
DB_PORT=${{MYSQLPORT}}
DB_DATABASE=${{MYSQLDATABASE}}
DB_USERNAME=${{MYSQLUSER}}
DB_PASSWORD=${{MYSQLPASSWORD}}

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

LOG_CHANNEL=stack
LOG_LEVEL=error
```

## Steps to Deploy

1. **Connect GitHub Repository**
   - Go to Railway dashboard
   - Click "New Project"
   - Select "Deploy from GitHub repo"
   - Choose `bilalk990/busticket-india`

2. **Add MySQL Database**
   - In your Railway project, click "New"
   - Select "Database" → "Add MySQL"
   - Railway will automatically set MySQL environment variables

3. **Set Environment Variables**
   - Go to your service settings
   - Click "Variables"
   - Add all the environment variables listed above
   - Generate APP_KEY by running: `php artisan key:generate --show`

4. **Deploy**
   - Railway will automatically deploy when you push to GitHub
   - First deployment might take 5-10 minutes

## Post-Deployment

After successful deployment, run these commands in Railway's terminal:

```bash
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Troubleshooting

If build fails:
- Check Railway logs for specific errors
- Ensure all environment variables are set
- Verify database connection

If assets don't load:
- Check that `npm run build` completed successfully
- Verify APP_URL is set correctly
