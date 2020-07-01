
#!/bin/bash

composer install
npm install
npm run dev
cp .env.Dev .env
php artisan key:generate
echo "Configure .env with database credentials then run 'php artisan migrate'"
