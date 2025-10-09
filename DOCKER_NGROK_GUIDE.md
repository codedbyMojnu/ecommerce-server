# Running PHP REST API with Docker, Railway MySQL, and Ngrok

This guide provides step-by-step instructions for containerizing your PHP REST API with Docker, connecting it to your Railway MySQL database, and exposing it publicly using ngrok.

## Prerequisites

1. Docker installed on your machine
2. Ngrok account and installation
3. Your Railway MySQL database credentials (already in your [.env](file:///d:/php-projects/ecommerce-server/.env) file)

## Step 1: Build and Run with Docker

### Option A: Using Docker Compose (Recommended)

1. From your project root directory, run:

   ```bash
   docker-compose up -d
   ```

2. Access your API at `http://localhost:8080`

### Option B: Using Docker Commands

1. Build the Docker image:

   ```bash
   docker build -t ecommerce-api .
   ```

2. Run the container:

   ```bash
   docker run -d -p 8080:80 --env-file .env ecommerce-api
   ```

3. Access your API at `http://localhost:8080`

## Step 2: Verify Local API Functionality

1. Test the health endpoint:

   ```bash
   curl http://localhost:8080
   ```

2. Test your API endpoints:
   - Login: `POST /api/login`
   - Products: `GET /api/products`
   - Product Details: `GET /api/products/{id}`
   - Checkout: `POST /api/checkout`

## Step 3: Expose API Publicly with Ngrok

1. Install ngrok if you haven't already:

   ```bash
   # Download from https://ngrok.com/download
   # Or install via package manager
   ```

2. Authenticate with ngrok (required for first-time use):

   - Visit [https://dashboard.ngrok.com/get-started/your-authtoken](https://dashboard.ngrok.com/get-started/your-authtoken) to get your authtoken
   - Run the authentication command:
     ```bash
     C:\Users\"MD. MOJNU"\Downloads\ngrok-v3-stable-windows-amd64\ngrok.exe config add-authtoken YOUR_AUTHTOKEN_HERE
     ```

3. Expose your Docker container:

   ```bash
   C:\Users\"MD. MOJNU"\Downloads\ngrok-v3-stable-windows-amd64\ngrok.exe http 8080
   ```

4. Note the public URLs provided by ngrok:
   ```
   Forwarding                    https://abcd1234.ngrok.io -> http://localhost:8080
   Forwarding                    http://abcd1234.ngrok.io -> http://localhost:8080
   ```

## Step 4: Test Your Public API

Use the ngrok URL to test your API endpoints:

1. Health check:

   ```bash
   curl https://abcd1234.ngrok.io
   ```

2. API endpoints:
   - Login: `POST https://abcd1234.ngrok.io/api/login`
   - Products: `GET https://abcd1234.ngrok.io/api/products`
   - Product Details: `GET https://abcd1234.ngrok.io/api/products/{id}`
   - Checkout: `POST https://abcd1234.ngrok.io/api/checkout`

## Security Recommendations

1. **Use HTTPS Only**: Configure ngrok to redirect HTTP to HTTPS:

   ```bash
   ngrok http -bind-tls=true 8080
   ```

2. **Add Authentication**: Implement proper authentication for your API endpoints

3. **Rate Limiting**: Consider implementing rate limiting to prevent abuse

4. **Environment Variables**: Store sensitive data like database credentials in environment variables (already done)

5. **Input Validation**: Ensure all inputs are properly validated (your code already does this well)

6. **Logging**: Implement proper logging for monitoring and debugging

7. **CORS**: Review CORS settings in [index.php](file:///d:/php-projects/ecommerce-server/index.php) for production use

## Troubleshooting

### Database Connection Issues

1. Verify your [DATABASE_URL](file:///d:/php-projects/ecommerce-server/.env#L2) in [.env](file:///d:/php-projects/ecommerce-server/.env) is correct:

   ```
   DATABASE_URL="mysql://username:password@host:port/database"
   ```

2. Test the connection manually with:
   ```bash
   mysql -h host -P port -u username -p database
   ```

### Docker Issues

1. **Docker Desktop Not Running**: If you see errors like "error during connect" or "The system cannot find the file specified", Docker Desktop may not be running:
   - Start Docker Desktop from the Start Menu or Desktop shortcut
   - Wait for the Docker whale icon to appear in your system tray
   - Ensure Docker Desktop is running before executing Docker commands

2. **Permission Issues**: On Windows, you may need to run your terminal as Administrator:
   - Right-click on Command Prompt or PowerShell
   - Select "Run as administrator"
   - Navigate to your project directory
   - Run Docker commands

3. Check container logs:

   ```bash
   docker-compose logs app
   ```

4. Rebuild containers:
   ```bash
   docker-compose down
   docker-compose up --build
   ```

### Ngrok Issues

1. **Authentication Required**: If you see an "ERR_NGROK_4018" error, you need to authenticate ngrok:
   - Visit [https://dashboard.ngrok.com/get-started/your-authtoken](https://dashboard.ngrok.com/get-started/your-authtoken) to get your authtoken
   - Run the authentication command:
     ```bash
     C:\Users\"MD. MOJNU"\Downloads\ngrok-v3-stable-windows-amd64\ngrok.exe config add-authtoken YOUR_AUTHTOKEN_HERE
     ```

2. Check ngrok dashboard at `http://localhost:4040` for request inspection

3. Restart ngrok session if connection drops

## Best Practices

1. **Environment Separation**: Maintain separate [.env](file:///d:/php-projects/ecommerce-server/.env) files for different environments

2. **Container Restart Policy**: Add restart policies to your docker-compose.yml:

   ```yaml
   services:
     app:
       restart: unless-stopped
   ```

3. **Health Checks**: Implement health check endpoints in your API

4. **Resource Limits**: Define CPU and memory limits for production:

   ```yaml
   services:
     app:
       deploy:
         resources:
           limits:
             memory: 512M
             cpus: "0.5"
   ```

5. **Backup Strategy**: Regularly backup your Railway database

## Stopping Services

To stop your Docker containers:

```bash
docker-compose down
```

To stop ngrok, press `Ctrl+C` in the terminal where it's running.
