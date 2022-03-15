# Robin Assistent

Robin Assistent is an application where caregivers can set up daily activities for their clients. The clients can then carry out these activities via an easy step-by-step plan. These are tasks that are normal for us, such as brushing our teeth and taking a shower. But for the clients it is much more difficult. Robin Assistent makes this much easier for them!

#### First time Setup
```bash
# Clone the repository to your device.
git clone git@github.com:MeesPos/robin-assistent.git

# Install composer packages with
composer install

# Install the NPM packages with
npm install

# Build files with npm
npm run dev

# Copy the .env.example and change the copied file name to .env
cp .env.example .env

# Generate an app key (dont use on production or staging)
php artisan key:generate

# ! When you are done with setting up the .env file proceed

# Migrate and seed the tables and data to your database
php artisan migrate --seed
```
#### Setup Environment

##### Database
Add the right database credentials in the ```.env``` file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=de_koopsom
DB_USERNAME=root
DB_PASSWORD=
```

#### Mail server
Add the right mail credentials. [Mailtrap](https://mailtrap.io/) or [Mailhog](https://github.com/mailhog/MailHog) are recommended.
```
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=noreply@de-koopsom.nl
MAIL_FROM_NAME="${APP_NAME}"
```
