# Library Project

# Présentation

Projet réalisé en APP3 à Polytech Paris-Saclay

Projet réalisé par :
- [Wilhem M.](https://github.com/Guenks)
- [Rémi L.](https://github.com/remi-lem/)

## Mise en place
```shell
composer update
composer install
npm update
npm install
npm run build
```

## Lancement
```shell
php artisan serve
```

## Déploiement
- récupérer le projet via git
  - le token est à récupérer sur [Github](https://github.com/settings/personal-access-tokens/) : accès read-only sur Contents pour ce repo
```shell
git clone https://<USER>:<TOKEN>@github.com/remi-lem/library-project.git
```
- récupérer le fichier .env et modifier les valeurs suivantes
```
APP_ENV=production
APP_DEBUG=false
APP_URL=http://localhost
```
- effectuer les commandes de mise en place
```shell
composer update
composer install --no-dev
npm update
npm install --omit=dev
npm run build
```
- mettre la racine du serveur sur /public

## Accès
/ : dashboard  
/login : accès au compte  
/admin : accès au dashboard d'administration filament  

## Outils utilisés
### Frameworks
![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-FFAA00?style=for-the-badge&logoColor=%23000000)
![Bootstrap](https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white)

### Hébergement
<img src="https://security.alwaysdata.com/new-logo-crop.png" alt="Alwaysdata" width="150"/>

### IDE
![PhpStorm](https://img.shields.io/badge/phpstorm-143?style=for-the-badge&logo=phpstorm&logoColor=black&color=black&labelColor=darkorchid)
