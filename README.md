# Run app

    docker-compose up -d
    docker-compose exec php bin/console app:test-http

# Run tests

    docker-compose exec php bin/phpunit