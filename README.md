## Description

This project is a full stack web application built using PHP, jQuery, MySQL, and MariaDB. It serves as a template for a basic CRUD (Create, Read, Update, Delete) application. The application allows users to interact with a database through a user interface.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Features](#features)
- [API Endpoints](#api-endpoints)
- [Pages](#pages)
- [Technologies Used](#technologies-used)
- [URL](#url)
- [Contact](#contact)

## Installation

1. Make sure you have XAMPP or a similar local web server environment installed on your machine.
2. Clone this repository to your local machine using Git:
3. Start your local web server (e.g., Apache) and make sure MySQL/MariaDB is running.
4. Import the database schema and sample data provided in `userdashboard.sql` using PHPMyAdmin or the command line.
5. Open your web browser and visit `https://github.com/yunuskrt/UserMgmDashboard` to access the application.

## Usage

- Upon accessing the application, you will be presented with a user-friendly interface to interact with the data.
- Use the navigation menu to perform routing between pages..
- The pages are rendered in PHP, and client-side interactions are handled with JavaScript and jQuery.
- AJAX is used to send asynchronous requests to the backend API to handle data manipulation.

- Test the app with userId=34 and projectId = 4 since the user with id 34 and project with Id 4 will possess data when 'userdashboard.sql' uploaded

## Features

- Create new records in the database.
- Read and view existing records.
- Update and modify records.
- Delete records from the database.

## API Endpoints

- **GET /api/users.php**: Fetches all employees from the database.
- **GET /api/users.php?userId={id}**: Fetches a specific user record by ID as well with his/her skills and projects involved..
- **GET /api/projects.php**: Fetches all projects from the database.
- **GET /api/projects.php?projectId={id}**: Fetches a specific project record by ID as well with his/her project steps involved..
- **GET /api/steps.php**: Fetches all steps from the database.

- **POST /api/users.php**: Creates a new data user.
- **POST /api/skills.php**: Creates a new data skill.
- **POST /api/steps.php**: Creates a new data step.

- **PUT /api/user.php**: Updates an existing user record by ID.
- **PUT /api/projects.php**: Updates an existing project record by ID.
- **PUT /api/steps.php**: Updates an existing project step record by ID.

- **DELETE /api/data.php**: Deletes a user record by ID.
- **DELETE /api/projects.php?projectId={id}**: Deletes a project record by ID.
- **DELETE /api/skils.php?skillId={id}**: Deletes a skill record by ID.
- **DELETE /api/steps.php?stepId={id}**: Deletes a step record by ID.

## Pages

### /usermgmdash/

- Description: This page displays four Highcharts visualizing employee data and a data table listing all employees.
- Features:
- Create an employee.
- Edit employee information.
- Delete an employee.

### /usermgmdash/users.php

- Description: This page displays a card for each employee. Clicking on a card redirects to the specific user page (`/usermgmdash/users.php?userId={id}`).
- Features: N/A (Only for viewing employee information)

### /usermgmdash/users.php?userId={id}

- Description: This page shows the skills of a specific user, along with a chart and table displaying projects involved by the user.
- Features:
- Edit projects involved.
- Delete projects involved.
- Create a skill.
- Delete a skill.
- Test this page with `userId=34`, as the user with ID 34 has data.

### /usermgmdash/projects.php

- Description: This page displays a card for each project. Clicking on a card redirects to the specific project page (`/usermgmdash/projects.php?projectId={id}`).
- Features: N/A (Only for viewing project information)

### /usermgmdash/projects.php?projectId={id}

- Description: This page shows detailed information about a specific project, including project steps and progress.
- Features:
- Create a project step.
- Edit a project step.
- Delete a project step.
- Test this page with `projectId=4`, as the project with ID 4 has data.

## Technologies Used

- PHP: Server-side scripting language.
- jQuery: JavaScript library for client-side interactions.
- MySQL: Relational database management system.
- MariaDB: An open-source fork of MySQL.
- AJAX: Asynchronous JavaScript and XML for making API requests.
- Semantic UI: User interface framework to create responsive and modern designs.
- Datatables: A powerful jQuery library for enhancing data tables with advanced features.
- Highcharts: Interactive JavaScript charts library for data visualization.

## URL

http://usermgmdash.42web.io/

This repository provides the deployed version of the project. However, please be aware that there are some issues with HTTP requests in this version, which may result in certain features not working as expected. To ensure a more stable and reliable experience, it is recommended to follow these steps:

1. Clone the repository to your local machine.
2. Set up a local server environment to run the application.
3. Test the application locally to identify and resolve any issues.

By following these steps, you can avoid potential problems and have a healthier testing environment for the application.

## Contact

- Maintainer Name: [Yunus Kerestecioglu](https://github.com/yourusername)
- Email: yunuskrt@gmail.com
