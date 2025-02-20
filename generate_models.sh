#!/bin/bash

# Generate Laravel models from the database
php artisan code:models

# Loop through all generated models, excluding 'User.php'
for model in app/Models/*.php; do
    model_name=$(basename "$model" .php)



    # Generate Filament Resource for each model
    php artisan make:filament-resource "$model_name"
done

echo "Et maintenant il faut rollback les modifs sur User.php"
