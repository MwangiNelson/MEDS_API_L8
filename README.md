Here's a step by step procedure to set up this project, I'll split ito 2 sections (Backend && frontend)
For organization purposes, I suggest u make a new folder on your desktop. Name it `The Dawa`

## ##Pre-configs

These are the requirements to run this project:
1.php
2.composer
3.node js
4.xampp

Create a new db on your xampp phpmyadmin and name it `the_dawa_app`
Import the `dawa.sql` from the cloned project.[Check how to clone below.👇]

## ##Backend

1. Clone project into the desktop folder
   `git clone https://github.com/MwangiNelson/MEDS_API_L8.git DAWA_BACKEND`

2. `cd` into the new folder
   `cd DAWA_BACKEND`

3. Install composer packages
   `composer install`

4. Get a new App Key
   `php artisan key:generate`

5. Confirm database
   Go to the `.env` file and confirm `DB_DATABASE = the_dawa_db`

6. Start the backend server
   `php artisan serve`

## Server should be running on this port

(http://127.0.0.1:8000)

## ##Frontend

1. Clone project into the desktop folder(make sure you're in the correct location)

    Your terminal should look like this

    (base) PS C:\Users\zod\Desktop\The Dawa>

    ***

    ## then run this command

    `git clone https://github.com/MwangiNelson/med_app_react.git DAWA_FRONTEND`

2. `cd` into the new folder
   `cd DAWA_FRONTEND`

3. Install node packages
   `npm install`

4. Run the app
   `npm run dev`

---

You should be able to see the exposed url (http://127.0.0.1:5173)
