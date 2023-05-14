# CollectiveBank Web App Documentation

CollectiveBank is a web application built with the Laravel framework. It utilizes PHP, Nginx, MySQL, and WebSockets for asynchronous notification functionality. The application includes a [PaymentService](https://github.com/frenkiherlambang/cc/blob/master/src/ewallet/app/Services/PaymentService.php)  that showcases integration with a simulated third-party service for deposit and withdrawal processes. The bearer token used for authentication with the third-party service is generated using the base64 encoding of the developer's full name, "Frenki Herlambang Prasetyo". The web app incorporates [Laravel Livewire](https://laravel-livewire.com) for user interaction.

The Docker Compose configuration defines the following services:

- **nginx**: Nginx service responsible for serving the web application. It listens on port 80 and forwards requests to the PHP service.
- **php**: PHP service built using the provided Dockerfile. It hosts the Laravel application and mounts the necessary volumes for source code, logs, and supervisor configuration. It listens on port 3000.
- **laravel-horizon**: Laravel Horizon service built using the provided Dockerfile. It mounts the necessary volumes for source code and supervisord configuration. It listens on port 6001.
- **mysql**: MySQL service using the `mysql/mysql-server:8.0` image. It sets up the MySQL database for the application, with the root password as "root". It mounts volumes for MySQL configuration and data storage. It listens on port 3305.
- **redis**: Redis service using the `redis:alpine` image. It runs Redis server with a password "secret".

## Running CollectiveBank Web App

To run the CollectiveBank web app, follow these steps:

1. Ensure that you have Docker and Docker Compose installed on your system.

2. Clone the project repository to your local machine.

3. Open a terminal and navigate to the root directory of the cloned project.

4. Build the Docker containers by running the following command:

   ```shell
   docker-compose build
   ```

5. Once the build process is complete, start the containers using the following command:

   ```shell
   docker-compose up
   ```

6. Wait for the containers to start up. You will see the logs from each container displayed in the terminal.

7. Once all the containers are up and running, you can access the CollectiveBank web app in your browser by visiting `http://localhost`. The Nginx service is mapped to port 80 on your local machine.

8. If the database migrations and seeding were successful, you should be able to interact with the web app and explore its features.

9. To stop the containers, press `Ctrl + C` in the terminal where the `docker-compose up` command was executed.
