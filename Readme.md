# Demo for Symfony Encryption component

## Installation

Clone the repo and run `composer install`. Then modify `.env` to add a database
connection.

Setup your database with
```
bin/console doctrine:database:create
bin/console doctrine:schema:update --force
```

Now you can run the following commands:

```
bin/console app:user:create tobias tobias@email.com
bin/console app:user:list
bin/console app:user:update tobias new-email@email.com
bin/console app:user:list
```