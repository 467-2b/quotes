#!/usr/bin/bash
# Update project files
php artisan migrate:fresh --seed
npm install # pull down npm packages
npm run dev # compile assets
