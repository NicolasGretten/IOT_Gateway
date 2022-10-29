# API GATEWAY
Point d'entrée et routeur de l'API Collect&Verything.

L'API Gateway contiens également l'authentification.

## Mise en place

```bash
php artisan migrate:fresh --seed
```

La commande va créer un compte:
```bash
john@doe.com
12345678
```
Renseigner également dans le .env l'URI des différents microservice.
