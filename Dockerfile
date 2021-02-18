FROM php:7.3.9-cli
COPY . /usr/src/lstventurestrainingexam
WORKDIR /usr/src/lstventurestrainingexam
CMD ["php", "./connection.php"]