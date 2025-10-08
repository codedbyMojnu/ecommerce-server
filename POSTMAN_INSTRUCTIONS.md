# Ecommerce API - Postman Collection Instructions

This document provides instructions on how to use the Postman collection for testing the Ecommerce Server API endpoints.

## Prerequisites

1. Install [Postman](https://www.postman.com/downloads/)
2. Ensure the Ecommerce Server is running on `http://localhost:8080`
3. Make sure the database is set up with sample data

## Importing the Collection

1. Open Postman
2. Click on "Import" in the top left corner
3. Select the `Ecommerce_API.postman_collection.json` file
4. Click "Import"

## Importing the Environment

1. In Postman, click on the "Environment" dropdown (top right)
2. Click the gear icon to open Environment settings
3. Click "Import"
4. Select the `Ecommerce_API.postman_environment.json` file
5. Click "Import"

## Using the Collection

### 1. Get All Products

- Endpoint: `GET http://localhost:8080/api/products`
- This endpoint does not require authentication
- Click "Send" to retrieve all products

### 2. Get Product by ID

- Endpoint: `GET http://localhost:8080/api/products/{id}`
- Replace `{id}` with a valid product ID (e.g., 1, 2, or 3)
- This endpoint does not require authentication
- Click "Send" to retrieve a specific product

### 3. User Login

- Endpoint: `POST http://localhost:8080/api/login`
- Request Body:
  ```json
  {
    "email": "john@example.com",
    "password": "password123"
  }
  ```
- Click "Send" to authenticate and receive a JWT token

### 4. Process Checkout

- Endpoint: `POST http://localhost:8080/api/checkout`
- First, you need to set the auth token:
  1. After logging in, copy the token from the response
  2. Open the "Environment" quick look (eye icon in top right)
  3. Edit the `auth_token` variable and paste the token value
  4. Save the environment
- Request Body:
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
- Click "Send" to process the checkout

## Checkout Body Format

The checkout endpoint expects a JSON body with an `items` array. Each item should contain:

- `product_id`: The ID of the product to purchase
- `quantity`: The quantity of that product

## Troubleshooting

### Database Connection Issues

If you receive database connection errors:

1. Ensure DBngin is running on port 3307
2. Verify the database credentials in `config/database-connection.php`
3. Run the setup script: `php setup-database.php`

### Function Redefinition Errors

If you encounter "Cannot redeclare function" errors:

1. Ensure all controller and middleware files have function_exists() checks
2. The current implementation already includes these checks

### Authentication Issues

If login fails:

1. Verify the sample user exists in the database
2. Run the setup script to recreate the sample data: `php setup-database.php`
3. Check that the password is correct (default: password123)
