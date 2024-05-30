# TariffCalculator
Tariff Comparison Service
Tariff Comparison Service

-----
Tariff Comparison Service
This project is a sample PHP implementation for comparing electricity tariffs based on different calculation models. It allows users to compare the annual costs of various electricity products given their consumption. Additionally, the project includes a custom mini framework for handling HTTP requests and responses, demonstrating an organized approach to request management.

----------
# Description
The Tariff Comparison Service is designed to help users compare the annual costs of different electricity tariff plans based on their yearly consumption. The service supports various tariff models including basic electricity tariffs and packaged tariffs. By using a factory pattern, the service dynamically selects the appropriate tariff calculation strategy and computes the costs.

Key features of this project include:

* Dynamic Tariff Strategy Calculation: Automatically selects and uses the correct tariff strategy based on the product type.
* **Cost Comparison**: Provides an easy way to compare the annual costs of different electricity products.
* **Custom Mini Framework**: Includes a lightweight framework for managing HTTP requests and responses, demonstrating an organized approach to handling web requests.
* **Unit Tests**: Comprehensive unit tests ensure the accuracy and reliability of the tariff calculations.
* **built-in PHP server with SH file** using the shell file to start php in linux base OS with  custom port 
---------

# Installation 

Clone the repository:


git clone https://github.com/yourusername/tariff-comparison-service.git
cd tariff-comparison-service

# Usage
To use the Tariff Comparison Service, you can start the built-in PHP server using the provided script:

`./install.sh`

after that  install composer dependencies
`composer install `

------

# Running Tests
To run the unit tests for this project
including  Integration and unittests
`vendor/bin/phpunit --testdox tests/TariffComparison/TariffComparisonServiceTest.php`
`vendor/bin/phpunit --testdox tests/services/TariffComparison/strategies/PackagedTariffStrategyTest.php`
