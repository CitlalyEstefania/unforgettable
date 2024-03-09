# UNFORGETTABLE

# Table of Contents

- [UNFORGETTABLE](#unforgettable)
  - [Table of Contents](#table-of-contents)
  - [Description](#description)
  - [How to Install and Run the Project](#how-to-install-and-run-the-project)
    - [Config local host](#config-local-host)
    - [Config the database](#config-the-database)
  - [How to Use the Project](#how-to-use-the-project)
  - [Badges](#badges)

## Description
This is a web blog mainly for the purpose of sharing things about fashion. But it can be used for any other purpose. It is a simple blog that allows users to create, read, update and delete posts. It also allows users to register and login. Comments and likes can be added to posts.

## How to Install and Run the Project

- Clone the project to your local machine
```
git clone git@github.com:CitlalyEstefania/Proyecto-Integrador-Segundo-Semestre.git
```

- Install the dependencies
  1. PHP 7.4
  2. MySQL 8.0
  3. Apache 2.4

### Config local host

I recommend use an Alias to access the project in the browser. You can use the following configuration in the apache2.conf
```
Alias /unforgettable "/Path/To/Project"
<Directory "/Path/To/Project">
    Options Indexes FollowSymLinks
    AllowOverride None
    Require all granted
</Directory>
```
> if you are using other alias or xampp, change in /constants.php the value of the constant ROOT_URL to the alias/folder you are using.

### Config the database

  1. Create a database in MySQL
  2. Import the file database.sql to the database
  3. Change the values of the constants in /config/constants.php to the values of your database, user and password

## How to Use the Project

- Register and login
- Create, read, update and delete posts
- Add comments and likes to posts

> The project is very intuitive, you can use it without any problem.
> The admin role have to be added manually in the database, the value of the role is 1, after made 1 user an admin, you can add more admins in the admin panel.

## Badges

![PHP](https://img.shields.io/badge/PHP-7.4-blue)
![MySQL](https://img.shields.io/badge/MySQL-8.0-blue)
![Apache](https://img.shields.io/badge/Apache-2.4-blue)
