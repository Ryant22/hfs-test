Simple Blog is a web application built with Laravel that allows users to create and manage blog posts. Users can register, log in, create, edit, and delete their blog posts. The application also includes a search functionality to find blog posts based on keywords.

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Testing](#testing)

## Features

- User Registration: Users can register an account to access the blog post functionalities.
- User Authentication: Registered users can log in and log out of their accounts.
- Create Blog Posts: Authenticated users can create new blog posts with a title, content, and an optional image.
- Edit Blog Posts: Users can edit their own blog posts, including the title, content, and image.
- Delete Blog Posts: Users can delete their own blog posts permanently.
- Search Blog Posts: Users can search for blog posts based on keywords in the title or content.

## Requirements

- PHP (>= 7.4)
- Composer
- MySQL or another compatible database
- Web server (e.g., Apache, Nginx)

## Installation

1. Clone the repository to your local machine:
```bash
git clone https://github.com/Ryant22/hfs-test.git
```


2. Navigate to the project directory:
```bash
cd hfs-test
```


3. Install PHP dependencies using Composer:
```bash 
composer install
```

4. Create a copy of the `.env.example` file and rename it to `.env`. Update the database connection and other relevant configuration settings in the `.env` file.

5. Generate the application key:
```bash
php artisan key:generate
```

6. Migrate the database:
```bash
php artisan migrate
```
7. (Optional) Seed the database with sample data:
```bash
php artisan db:seed
```
## Usage

1. Start the development server:
```bash
php artisan serve
```

2. Visit `http://localhost:8000` in your web browser to access the application.

3. Register an account or log in if you already have one.

4. Create, edit, and manage your blog posts using the provided interface.

## Testing

To run the unit tests for the application, use the following command:
```bash
php artisan test
```
