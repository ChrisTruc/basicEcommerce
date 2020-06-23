# BasicECommerce

BasicEcommerce est une application basique de e-commerce

## Installation

### Prérequis

- Avoir PHP installé (version >= 7.3.18) 
- Avoir composer installé 
- Avoir webpack et npm installé
- Avoir récupérer le projet sur Git

### Installer les dépendances

Lancer la commande :
```bash
composer install
```

### Compiler les assets

Lancer les deux commandes :
```bash
yarn
yarn encore dev
```

### Ajouter des données Produit dans l'application

Lancer la commande :
```bash
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

### Lancer l'application

- Sur votre console, lancez la commande :
```bash
php -S 127.0.0.1:8001 -t public
```
- Se rendre sur la page : http://127.0.0.1:8001/

### Executer les tests fonctionnels et unitaires

Lancer la commande :
```bash
php bin/phpunit
```