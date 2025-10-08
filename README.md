# Ecommerce Server API

A simple PHP-based RESTful API for an e-commerce platform with JWT authentication.

## Features

- User authentication with JWT tokens
- Product listing and details
- Protected checkout endpoint
- MySQL database integration
- CORS support for frontend applications
- Environment-based configuration (development/production)

## Prerequisites

- PHP 7.4 or higher
- Composer
- MySQL database (via DBngin on port 3307 for development)

## Installation

1. Clone the repository:

   ```bash
   git clone <repository-url>
   ```

2. Install PHP dependencies:

   ```bash
   composer install
   ```

3. For development:
   - Start DBngin on port 3307
   - Set up the database:
     ```bash
     php setup-database.php
     ```
   - Start the development server:
     ```bash
     php -S localhost:8080
     ```

## Production Deployment

### Option 1: Generic Production Server

1. Set the `DATABASE_URL` environment variable to your production database URL:

   ```
   DATABASE_URL="mysql://root:vZfoFPPbhNIAuwhozsqbpiaGXsxxSUBG@shortline.proxy.rlwy.net:22824/railway"
   ```

2. Run the production deployment script:

   ```bash
   php deploy-production.php
   ```

3. Deploy your application to your production server

### Option 2: Railway Deployment

1. Create a new Railway project
2. Add the MySQL database URL as an environment variable in Railway:
   ```
   DATABASE_URL="mysql://root:vZfoFPPbhNIAuwhozsqbpiaGXsxxSUBG@shortline.proxy.rlwy.net:22824/railway"
   ```
3. Deploy your code to Railway
4. Run the database setup command in the Railway console:
   ```bash
   php deploy-production.php
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
│   ├── database-connection.php
│   └── dotenv.php
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
├── deploy-production.php
├── test-api.php
├── check-users.php
├── test-railway-connection.php
├── Ecommerce_API.postman_collection.json
├── Ecommerce_API.postman_environment.json
├── POSTMAN_INSTRUCTIONS.md
├── README.md
├── index.php
├── .env
├── composer.json
└── composer.lock
```

## Environment Configuration

The application supports environment-based configuration:

- Development: Uses DBngin on localhost:3307
- Production: Uses DATABASE_URL environment variable

To set up for production, add your database connection string to the `.env` file or set it as an environment variable.

## Troubleshooting

### Database Connection Failed

- For development: Ensure DBngin is running on port 3307
- For production: Verify the DATABASE_URL environment variable is set correctly

### Function Redefinition Errors

The project already includes `function_exists()` checks to prevent this issue.

### Authentication Issues

Run `php setup-database.php` to ensure the sample user exists with the correct credentials.
