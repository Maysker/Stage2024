<p align="center"><a href="https://github.com/Maysker/Stage2024" target="_blank"><img src="https://raw.githubusercontent.com/Maysker/Stage2024/main/assets/logo.png" width="150" alt="Squad Scope Logo"></a></p>

Stage2024 is a web-based internship management system designed to streamline the process of managing internship placements, courses, and student interactions for educational institutions. The system facilitates the management of user roles, session security, and data integrity while providing comprehensive administrative functionalities through a user-friendly interface.

## Technology Stack

- **Backend:** PHP
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript
- **Version Control System:** Git
- **Task Management:** Trello Kanban
- **Testing and Development Utilities:**
  - TablePlus for database inspection
  - Postman for API testing
  - MAMP for local server hosting
  - Local development environment hosted within the `htdocs` directory typical for Apache servers

## Features

### User Management
- **Authentication:** Secure login and logout capabilities with session management to maintain user states.
- **User Roles:** Distinct user roles (Admin and Docent) with different access levels and functionalities.
- **Session Management:** Secure session handling with timeouts and automatic logouts to prevent unauthorized access.

### Database Design
- **Schema Creation:** Well-structured MySQL database schema to store and manage data efficiently.
- **Security:** Secure data connections using best practices, with password hashing for data protection.

### Admin Dashboard
- **Docent Management (CRUD):** Create, Read, Update, and Delete functionalities for managing docent profiles.
- **Course Management:** Comprehensive management of courses including association with skills and docents.
- **Skills Management:** Handles both soft and hard skills, allowing for additions, deletions, and modifications.

### Course and Docent Interactions
- **Many-to-Many Relationships:** Manage multiple associations between docents and courses, docents and campuses, ensuring data consistency and integrity.
- **Detailed Views and Filters:** Advanced filtering options and detailed views for managing courses, docents, and campuses efficiently.

### Security Features
- **Data Security:** Implementation of strong password policies, password hashing (potentially using Bcrypt).
- **Session Security:** Secure session management with robust policies on session IDs and timeouts.

### Design and Usability
- **Responsive Design:** Utilizing Bootstrap for a responsive layout compatible with various devices.
- **Branding:** Adheres to the branding guidelines of SyntraPXL, including logo and color schemes.

### Testing
- **Bug Fixes:** Regular updates and bug fixes to ensure the system operates smoothly without disruptions.

## Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/RVicki/Stage2024.git
   ```
2. **Set up MAMP or a similar local server environment:**
   - Place the project folder in the `htdocs` directory.
   - Configure your Apache and MySQL to run on standard ports (80 for HTTP, 3306 for MySQL).

3. **Configure the database:**
   - Create a new MySQL database and import the provided SQL schema and test data.
   - Configure the `db_connect.php` and `db_config.php` file to set up the database connection.

4. **Install dependencies:**
   ```bash
   # There are no specific PHP dependencies mentioned; ensure PHP is updated and configured correctly.
   ```

5. **Start the server:**
   ```bash
   # Use MAMP to start the Apache and MySQL servers.
   ```

6. **Access the project:**
   - Open a web browser and go to `localhost/Stage2024` to start using the application.

## Developers

This project is a collaborative effort, made possible by the contributions of:

- [Adam Gazdiev](https://github.com/Maysker)
- [Beau Pirard](https://github.com/beaupirard)
- [Mert Alnuaimi](https://github.com/MertCode)
- [Shelsy De Ryck](https://github.com/ShelsyDeRyck)
- [Vicki Ramsdonck](https://github.com/RVicki)

## Contributing

Contributions are welcome! Please fork the repository and submit pull requests with your suggested changes.

## License

This project is licensed under the MIT License - see the LICENSE.md file for details.


