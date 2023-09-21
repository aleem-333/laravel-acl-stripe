# Getting Started
### Clone Project
```
git clone https://github.com/aleem-333/laravel-acl-stripe.git
```
### Move to project
```
cd laravel-acl-stripe
```

### Install all the dependencies using composer
```
composer install
```

### Copy the example env file and make the required configuration changes in the .env file
```
cp .env.example .env
```
### Stripe Setup
1. Go to [Stripe Dashboard](https://dashboard.stripe.com/test/dashboard)
2. Create your Stripe account.
3. Go to the developer menu.
4. Go to the API Key tab.
5. Copy the Publishable & Secret key in the standard key section.
6. Add Publishable & Secret key in the .env file.

```
STRIPE_KEY=<Publishable>
STRIPE_SECRET=<Secret>
```

### MailTrap Setup
1. Go to [Mailtrap](https://mailtrap.io/)
2. Create your Mailtrap account.
3. Open inbox and select the Laravel option in the PHP section within the integration dropdown.
4. Copy all mail attributes and replace them in the .env file.

```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=""
MAIL_PASSWORD=""
MAIL_ENCRYPTION=tls
```

### Generate a new application key
```
php artisan key:generate
```

### Run the database migrations (Set the database connection in .env before migrating)
```
php artisan migrate:fresh --seed
```

### Admin credentials
```
Email: admin@gmail.com
Password: password
```

### Install node packages
```
npm install
```
### build 
```
npm run dev
```
### Start the local development server
```
php artisan serve
```
