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

Exemple:

```dotenv
ADDRESS_API= address.api.collect.verything
ADMIN_API= admin.api.collect.verything
BILLING_API= billing.api.collect.verything
CART_API= cart.api.collect.verything
COMMAND_API= command.api.collect.verything
EMPLOYEE_API= employee.api.collect.verything
IMAGE_API= image.api.collect.verything
MAIL_API= mail.api.collect.verything
PAYMENT_API= payment.api.collect.verything
PRODUCT_API= product.api.collect.verything
STORE_API= store.api.collect.verything
USER_API= user.api.collect.verything
```

Lancer le serveur:
```bash
php artisan serve --port=optionalport
```
