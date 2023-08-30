This is a document re writer application. In this present time the application is accepting just .docx file and extracting the contents as text.
N.B=> For testing purpose I will put a sample .docx file in project root folder.
After uploading the .docx file the file will be opened in an text editor (ckeditor). You can just edit and add new text contents in this version. No images or media is not addable in this version now.

=> If you process a file 3 times within 10 minutes then you will be blocked for next 20 minutes.
                *Here file process means save or download the document after editing it.
=> For automatic unblocked there is used scheduler. The scheduler is set for every 1 minute.

❏Project Setup Instruction for Local Server....
    1. After cloning from github you will get some folders. There will be a folder named 'application'. The main project and all codes are inside it.

    2. Open terminal inside 'application' folder...
        *Run commands=> 1. composer install
                        2. npm install
                        3. cp .env.example .env (It will copy the .env.example into .env file)
                        4. php artisan key:generate
                        5. create a database named 'documentrewriter' into your local database server
                        6. php artisan migrate
N.B.=> Now the project is ready to run in the local server. As we are using scheduler to unblock a user after the 20 minutes of blocking, so you have to run a command 
'php artisan schedule:work' inside the application folder (directory)

❏Project Setup Instruction for Docker....
    1. Change .env file database configuration like this
        DB_CONNECTION=mysql
        DB_HOST=db
        DB_PORT=3306
        DB_DATABASE=documentrewriter
        DB_USERNAME=root
        DB_PASSWORD=root
    2. Now run the following command from the project root folder where docker-compose.yml file is exist to start all the 3 services
       * docker-compose up --build    
    3. Now open up a new terminal tab inside the root directory where docker-compose.yml file is exist. Run the following commands to do a composer install   in the container
    *docker-compose exec php sh
    *cd /var/www/html
    *composer install

    3. Run the following command to generate the application key in the .env file
       *php artisan key:generate
