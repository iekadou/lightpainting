# Lightpainting Browser App

## Setup
- Install composer (https://getcomposer.org/doc/00-intro.md)
- php composer.phar install
- add a file into config folder named db.php, with:
```php
    <?php
      $DB_HOST=< IP OF MYSQL DB >;
      $DB_NAME=< DATABASE NAME OF MYSQL DB >;
      $DB_USER="< USERNAME OF MYSQL DB USER>;
      $DB_PASS=< PASS OF MYSQL DB USER >;
      ```
- adjust the path located at inc/include.php
- import SQL file in DB
- run http://..../migrate.php

... to be completed
