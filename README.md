# WebChat

## About
Project made to get better at SOLID design pattern and get deeper into Laravel 

## Confirmed Requirements

- NodeJS v20.6.1
- NPM 9.8.1

## Initial Setup

### Backend

1. Run docker

```shell
docker-compose up
```

2. Copy environment variables
```shell
cp .env.example .env
```

3. Install composer dependencies
```shell
docker exec webchat-app-1 composer install
```

4. Run migrations
```shell
docker exec webchat-app-1 php artisan migrate
```

5. Run seeders
```shell
docker exec webchat-app-1 php artisan db:seed
```

6. Install [Passport](https://laravel.com/docs/10.x/passport)
```shell
docker exec webchat-app-1 php artisan passport:install
```

8. Check heartbeat
```shell
curl localhost:9000/ping 
```

Sample response
```json
{
  "pong":1700908454
}
```

## Project maintenance

Running [PHP Stan](https://phpstan.org/user-guide/getting-started)
```shell
docker exec webchat-app-1 composer stan
```

Running PHP Unit Tests
```shell
docker exec webchat-app-1 composer test
```

## Default Access

If you followed steps from this file you should be able to log in with following credentials:

| **E-mail**        | **Password** | **Role** |
|-------------------|--------------|----------|
| admin@example.com | password     | Admin    |
| user@example.com  | user         | User     |

## Application URLs

### Frontend
`http://localhost:9000`

### Mailhog
`http://localhost:9025`
