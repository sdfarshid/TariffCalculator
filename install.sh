#!/bin/bash


#Current DIR
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )"



#check have PHP
if ! [ -x "$(command -v php)" ]; then
  echo 'Error: PHP is not installed.' >&2
  exit 1
fi



#Check Composer
if ! [ -x  "$(command -v composer)" ]; then
  echo "Composer is not installed. Installing Composer"
  curl -sS https://getcomposer.org/installer | php
  mv composer.phar /usr/local/bin/composer
else
  echo 'Composer is already installed.'
fi


echo "Installing project dependencies..."
composer install

echo "Dependencies installed successfully."



echo 'Enter the port number (default 8083):'
read PORT

PORT=${PORT:-8083}

echo "Starting PHP built-in server on port ${PORT} at directory ${DIR}..."
php -S localhost:${PORT} -t "${DIR}"