# Coding Tips!

Welcome to Stu’s **Coding Tips**—the one-stop shop for PHP package goodness! This project exists to make your coding life easier and save you from the hair-pulling moments that usually come with technical tests. The goal? To equip you with the tools to nail technical tests.

## Features

- **Docker Support**: This package includes a sample Dockerfile and docker-compose.yml for easy development and testing. Please ensure you have [Docker Desktop](https://www.docker.com/products/docker-desktop) installed to get started.

- **Composer Scripts**: Leverage Composer for dependency management. The repository comes with useful Composer scripts, including:
  - `phpcs`: For checking coding standards.
  - `phpmd`: For code analysis.
  - `phpstan`: For static analysis.
  - `rector`: For automated code upgrades and refactoring.
  - `tests`: Run tests found within the `tests` directory.
  
- **Automated Testing**: A GitHub Actions workflow is set up to automatically run tests whenever you push to the repository, ensuring your code remains reliable and up to standards.

- **Editable Code**: You can modify the code in the `src` directory and add your own unit tests in the `tests` directory to extend functionality.

- **GitHub Template**: The repository includes a template for pull requests that you can customise to fit your project needs.

## Getting Started

1. **Clone the Repository**:
   ```
   git clone git@github.com:stuarttodd-dev/coding-tips.git
   ```

2. **Navigate to repo**:
   ```
   cd coding-tips
   ```

3. **Set Up Docker**:
   Ensure Docker Desktop is installed and running. Build Docker container:
   ```
   docker compose build
   ```

4. **Spin up Docker Container**:
   Run the Docker container:
   ```
   docker compose up -d
   ```

5. **Install Dependencies**:
   Inside your Docker container, install the project dependencies using Composer:
   ```
   docker exec coding-tips composer install
   ```

6. **Run the Standards Check**:
   Execute the following command to check coding standards and static analysis:
   ```
   docker exec coding-tips composer standards:check
   ```

 7. **Run Tests**:
   Execute the following command to run tests:
   ```
   docker exec coding-tips composer tests
   ```
   
## Don't forget...
Each folder within the src directory has it's own README file.
