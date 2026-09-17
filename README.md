# laravel_13_vue
- run "docker compose up -d"
- add following line in hosts file
- 127.0.0.0 laravel_13_vue.local
- if docker is installed in a vm use its ip

- open docker container console and run the following command to install laravel installer
-- composer global require laravel/installer if it is not installed in dockerfile
-- export PATH="$HOME/.config/composer/vendor/bin:$HOME/.composer/vendor/bin:$PATH"
- create a folder code, 
- but need to install laravel into another folder, otherwise laravel installer will says folder is not empty
- you can move files from other folder to code folder after laravel installation
-- laravel new laravel_13_vue
- it will asks some questions
- Do you want to use a starter Kit?
-- yes
- which frontend stack should your starter kit use?
-- React
-- Svelte
-- Vue -> select
-- Livewire
- Which authentication provider do you prefer?
-- Laravel's built-in authentication -> select
-- WorkOS (Requires WorkOS account)
- Would you like to add teams support to your application?
-- yes
-- no -> select
- let it install the project
-- The command "'npm' 'install'" failed.
- now move files to code folder
- mv /var/www/html/laravel_13_vue/vendor/* /var/www/html/vendor/
- cd laravel_13_vue
- rm -rf vendor
- mv /var/www/html/laravel_13_vue/* /var/www/html/
- cd /var/www/html
- npm install --ignore-scripts
- npm run build
- open project in browser http://laravel_13_vue.local/
- now you can register and login

For hot reloading during development, open the container console and run:

- cd /var/www/html
- npm run dev
- open project in browser http://laravel_13_vue.local/
- without the Vite development server, execute `npm run build` after changes to
  update the production assets
- search icons here https://lucide.dev/icons/

--------------------------------------------------------------------------------------------------
- create model
- php artisan make:model Product -m
- update model and migration and then run migration
- php artisan migrate
- create controller
- php artisan make:controller ProductController
- check route list
- php artisan route:list
- install card component from shadcn
-- site link = https://ui.shadcn.com/docs/components
-- npx shadcn-vue@latest add card
- install textarea component
-- npx shadcn-vue@latest add textarea
- add form request
-- php artisan make:request FormProductRequest
- create resource
-- php artisan make:resource ProductResource
- install table component
-- npx shadcn@latest add table => got error
-- npx shadcn@4.20.0 add table => got error
-- npx shadcn-vue@latest add table
- add product seeder
-- php artisan make:factory ProductFactory --model=Product
-- php artisan make:seeder ProductSeeder
- To run only the Product Seeder
-- php artisan db:seed --class=ProductSeeder
- To refresh your database and run all seeders from scratch
-- php artisan migrate:fresh --seed
- for image https://spatie.be/docs/laravel-medialibrary/v11/introduction
-- composer require "spatie/laravel-medialibrary"
-- missing ext-exif
-- install extension ext-exif
-- docker-php-ext-install exif
-- check if exif installed
-- root@874264a29f30:/var/www/html# php -m | grep exif
-- exif
-- composer require "spatie/laravel-medialibrary"
-- Preparing the database
-- php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="medialibrary-migrations"
-- php artisan migrate
-- Publishing the config file
-- php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="medialibrary-config"














<!-- echo "127.0.0.1 laravel_13_vue.local" | sudo tee -a /etc/hosts -->
<!-- Error and their fixes  -->
- Error
-- Hot reloading
- Fix
Keep the Vite process running while using the application. Vite is configured
to poll the bind-mounted files and is available on port 5173.
-- Allow 5173 port in compose.yaml
-- Add following in server key in vite.config.ts
--  server: {
      // added for Vite HMR to work with Docker and Laravel
      host: '0.0.0.0',
      port: 5173,
      hmr: {
          host: 'laravel_13_vue.local',
          clientPort: 5173,
      },
      cors: true, // <--- Add this line to allow CORS
      strictPort: true,
      origin: 'http://laravel_13_vue.local:5173',

- Error
-- http://localhost:5173/node_modules/vue-sonner/lib/index.css is getting ns_error_connection_refused
- Fix
-- remove import 'vue-sonner/style.css'; from code\resources\js\components\ui\sonner\Sonner.vue
-- add @import 'vue-sonner/style.css'; in code\resources\css\app.css
-- add resolve in vite.config.ts
-- resolve: {
    alias: {
      '@': fileURLToPath(new URL('./resources/js', import.meta.url)),
    },
  },


- Error
-- failed to load config from /var/www/html/vite.config.ts
-- error when starting dev server:
-- ReferenceError: fileURLToPath is not defined
- Fix
-- Add import { fileURLToPath, URL } from 'node:url'; in code\vite.config.ts