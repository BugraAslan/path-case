# Installation

#### Docker
Build containers
```
docker-compose build
```
Let's up containers
```
docker-compose up -d
```

#### Symfony
Enter php container bash
```
docker exec -it path-php bash
```
Go to Symfony directory
```
cd /var/www
```
Install Dependencies
```
composer install
```
Migrate Migrations
```
php bin/console doctrine:migrations:migrate
```
Load Fixtures
```
php bin/console doctrine:fixtures:load
```
Change Mysql Host (.env)
```
DATABASE_URL=mysql://root:symfony@mysql:3306/path_case?serverVersion=5.7
```