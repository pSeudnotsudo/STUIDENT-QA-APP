# Student Q&A Application

This is a simple Student Q&A CRUD system built with PHP, using PDO for database access and MySQL as the database. The frontend is styled with Bootstrap to provide a responsive and user-friendly interface.

## Project Structure

```
student-qa-app
├── src
│   ├── config
│   │   └── database.php
│   ├── controllers
│   │   └── QuestionController.php
│   ├── models
│   │   └── Question.php
│   ├── views
│   │   ├── index.php
│   │   ├── create.php
│   │   ├── edit.php
│   │   └── show.php
│   └── public
│       ├── css
│       │   └── bootstrap.min.css
│       ├── js
│       │   └── bootstrap.min.js
│       └── index.php
├── composer.json
└── README.md
```

## Installation

1. Clone the repository:
   ```
   git clone <repository-url>
   ```

2. Navigate to the project directory:
   ```
   cd student-qa-app
   ```

3. Install dependencies using Composer:
   ```
   composer install
   ```

4. Configure the database connection in `src/config/database.php`.

5. Create the necessary database tables for questions.

## Usage

- Access the application by navigating to `src/public/index.php` in your web browser.
- You can create, read, update, and delete questions using the provided interface.

## Features

- Create new questions
- View a list of all questions
- Edit existing questions
- Delete questions
- Responsive design using Bootstrap

## Contributing

Feel free to submit issues or pull requests for improvements or bug fixes.