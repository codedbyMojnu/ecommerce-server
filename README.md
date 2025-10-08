# Ecommerce Server API

A simple PHP-based RESTful API for an e-commerce platform with JWT authentication.

## Features

- User authentication with JWT tokens
- Product listing and details
- Protected checkout endpoint
- MySQL database integration
- CORS support for frontend applications

## Prerequisites

- PHP 7.4 or higher
- Composer
- MySQL database (via DBngin on port 3307)
- DBngin or similar MySQL server

## Installation

1. Clone the repository:

   ```bash
   git clone <repository-url>
   ```

2. Install PHP dependencies:

   ```bash
   composer install
   ```

3. Start DBngin on port 3307

4. Set up the database:

   ```bash
   php setup-database.php
   ```

5. Start the development server:
   ```bash
   php -S localhost:8080
   ```

## API Endpoints

### Authentication

- `POST /api/login` - User login to obtain JWT token

### Products

- `GET /api/products` - Get all products
- `GET /api/products/{id}` - Get product by ID

### Checkout

- `POST /api/checkout` - Process checkout (requires authentication)

## Checkout Body Format

When making a POST request to `/api/checkout`, the body should be in the following format:

```json
{
  "items": [
    {
      "product_id": 1,
      "quantity": 1
    },
    {
      "product_id": 2,
      "quantity": 2
    }
  ]
}
```

Each item in the `items` array should have:

- `product_id`: The ID of the product to purchase
- `quantity`: The quantity of that product

## Testing with Postman

This project includes a Postman collection for easy API testing:

1. Import `Ecommerce_API.postman_collection.json` into Postman
2. Import `Ecommerce_API.postman_environment.json` as environment
3. Follow the instructions in `POSTMAN_INSTRUCTIONS.md`

## Sample User Credentials

- Email: `john@example.com`
- Password: `password123`

## Project Structure

```
ecommerce-server/
├── config/
│   └── database-connection.php
├── controllers/
│   ├── AuthController.php
│   └── ProductController.php
├── middleware/
│   └── AuthMiddleware.php
├── models/
│   ├── Product.php
│   └── User.php
├── routes/
│   └── api-endpoints.php
├── setup-database.php
├── test-api.php
├── check-users.php
├── Ecommerce_API.postman_collection.json
├── Ecommerce_API.postman_environment.json
├── POSTMAN_INSTRUCTIONS.md
├── README.md
├── index.php
├── composer.json
└── composer.lock
```

## Troubleshooting

### Database Connection Failed

Ensure DBngin is running on port 3307 and the database `ecommerce` exists.

### Function Redefinition Errors

The project already includes `function_exists()` checks to prevent this issue.

### Authentication Issues

Run `php setup-database.php` to ensure the sample user exists with the correct credentials.
