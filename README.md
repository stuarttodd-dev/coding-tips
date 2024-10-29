# Package Sample Repository

Welcome to the **Package Sample Repository**! This project aims to help developers by providing a solid foundation for creating and maintaining PHP packages. The goal behind this repository is to simplify technical tests while showcasing your skills in building effective PHP packages.

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
   git clone git@github.com:stuarttodd-dev/package-sample.git
   ```

2. **Navigate to repo**:
   ```
   cd package-sample
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
   docker exec php-composer-package composer install
   ```

6. **Run the Standards Check**:
   Execute the following command to check coding standards and static analysis:
   ```
   docker exec php-composer-package composer standards:check
   ```

 7. **Run Tests**:
   Execute the following command to run tests:
   ```
   docker exec php-composer-package composer tests
   ```

## Sharing Your Package

To make your package publicly accessible, you can either add it to **Packagist** for installation via Composer or adjust your composer.json file to include the VCS URL:

### Option 1. Add to Packagist

Submit your package to [Packagist.org](https://packagist.org).

### Option 2. Add VCS Line in Composer

Adjust your composer.json file to include the VCS URL, e.g to include this:
```
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/stuarttodd-dev/package-sample.git" 
        }
    ]
}
```

## Tagging Your Releases

To create a new release for your package, you can tag your repository using the following commands:

1. Create a new tag:
   ```
   git tag -a v1.0.0 -m "Release version 1.0.0"
   ```
3. Push the tag to GitHub:
   ```
   git push origin v1.0.0
   ```

## Usage Examples

Once you've pulled down the package (either by adjusing your composer.json with a VCS path or adding it to packagist), it will be stored in your `vendor` folder for local access. 

Here’s how you can use the `Greeter` class in your PHP project (but obviously it'd be whatever you've coded into your ``src`` directory:

```
use HalfShellStudios\PackageSample\Greeter;

$greeter = new Greeter();
echo $greeter->sayHello();   // Outputs: Well, hello there!
echo $greeter->sayGoodbye(); // Outputs: Errr... Goodbye!
echo $greeter->greet();      // Outputs: Well, hello there! Errr... Goodbye!
```

Thats it!
   
## Conclusion

This repository serves as a foundation for creating a PHP package, making it easier for you to develop, test, and maintain your projects. Feel free to modify the code and templates to suit your needs!

If you have any questions or suggestions, feel free to open an issue in this repository.

Happy coding!
