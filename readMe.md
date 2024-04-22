# User Management System

This is a user management system built using [Slim Framework](https://www.slimframework.com/) and [Doctrine ORM](https://www.doctrine-project.org/projects/orm.html). It provides CRUD (Create, Read, Update, Delete) operations for managing users.

## Features

- **User Management**: Allows administrators to create, read, update, and delete user accounts.
- **Authentication**: Provides secure authentication for user login and logout.
- **Authorization**: Implements role-based access control (RBAC) to restrict access to certain features based on user roles.
- **Logging**: Utilizes Monolog for logging application events and errors.
- **Database**: Uses MySQL/MariaDB as the database backend.

## Installation

1. Clone the repository to your local machine:

```bash
git clone https://github.com/yourusername/user-management.git

2. Install dependencies using Composer

composer install

3. Set up the database configuration by editing config/rdbms.yaml:

4. Run the database migrations to create the necessary tables:

php vendor/bin/doctrine orm:schema-tool:update --force --dump-sql

5. Start the development server:

php -S localhost:8000 -t public

6. Access the application in your web browser at http://localhost:8000.

Usage

Register a User: Navigate to the /users/create route and fill in the required information.
Updating a User: Click on the "Edit" button next to a user's details to modify their information.
Deleting a User: Select the "Delete" option to remove a user from the system.
Login a User: Select the "Login" option to Login a user from the system.
ValidateLogin a User: Select the "Validate" option to Validate a user from the system.
Activate a User: Select the "Activate" option to Activate a user from the system.
DeActivate a User: Select the "De-activate" option to De-activate a user from the system.
ResetPassword a User: Select the "ResetPassword" option to ResetPassword a user from the system.

Contributing
Contributions are welcome! Please fork the repository and submit a pull request with your changes.

License
This project is licensed under the MIT License.

