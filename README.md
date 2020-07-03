## Deployment Instruction

To deploy this application, first clone the repository onto your server.

<code>git clone https://github.com/GeorgesOwens/YarakuCodingTask.git</code>

Make sure you have composer and npm installed and run the deploy script.

<code>./Deploy.sh</code>

The deploy script will install composer and npm packages required for the application, bundle js and css files, create the .env file from .env.Dev and generate an application key.

Once the deploy script is done, you'll need to add your database connection and credentials into the .env file and run the migrate command.

<code>
DB_CONNECTION=mysql
<br/>
DB_HOST=localhost
<br/>
DB_PORT=
<br/>
DB_DATABASE='DatabaseName'
<br/>
DB_USERNAME='Username'
<br/>
DB_PASSWORD='Password'
</code>

<code>php artisan migrate</code>

Now all you need to do is host the site from the public folder.