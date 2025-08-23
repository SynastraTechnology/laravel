# API Documentation - Synastra Starter Kit

## Base URL
```
http://localhost:8000/api/v1
```

## Authentication
All protected endpoints require Bearer token authentication. Include the token in the Authorization header:
```
Authorization: Bearer {your_token}
```

## Endpoints

### 1. Authentication Module

#### Register User
- **POST** `/api/v1/register`
- **Body**: 
  ```json
  {
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }
  ```

#### Login
- **POST** `/api/v1/login`
- **Body**: 
  ```json
  {
    "email": "john@example.com",
    "password": "password123"
  }
  ```

#### Logout
- **POST** `/api/v1/logout`
- **Headers**: Authorization Bearer token

#### Get Current User
- **GET** `/api/v1/user`
- **Headers**: Authorization Bearer token

#### Refresh Token
- **POST** `/api/v1/refresh-token`
- **Headers**: Authorization Bearer token

#### Forgot Password
- **POST** `/api/v1/forgot-password`
- **Body**: 
  ```json
  {
    "email": "john@example.com"
  }
  ```

#### Reset Password
- **POST** `/api/v1/reset-password`
- **Body**: 
  ```json
  {
    "token": "reset_token_from_email",
    "email": "john@example.com",
    "password": "newpassword123",
    "password_confirmation": "newpassword123"
  }
  ```

### 2. Products Module

#### Get All Products
- **GET** `/api/v1/products`
- **Query Parameters**:
  - `per_page` (default: 10)
  - `sort_by` (default: created_at)
  - `sort_order` (default: desc)

#### Get Single Product
- **GET** `/api/v1/products/{id}`

#### Create Product
- **POST** `/api/v1/products`
- **Headers**: Authorization Bearer token
- **Body** (multipart/form-data):
  - `name` (required)
  - `description` (optional)
  - `price` (required, numeric)
  - `stock` (required, integer)
  - `image` (optional, file)
  - `category` (optional)

#### Update Product
- **PUT** `/api/v1/products/{id}`
- **Headers**: Authorization Bearer token
- **Body** (multipart/form-data): Same as create

#### Delete Product
- **DELETE** `/api/v1/products/{id}`
- **Headers**: Authorization Bearer token

#### Search Products
- **GET** `/api/v1/products/search/{keyword}`
- **Query Parameters**: Same as get all

#### Get Products by Category
- **GET** `/api/v1/products/category/{category}`
- **Query Parameters**: Same as get all

#### Update Product Stock
- **PATCH** `/api/v1/products/{id}/stock`
- **Headers**: Authorization Bearer token
- **Body**: 
  ```json
  {
    "stock": 50
  }
  ```

#### Get Low Stock Products
- **GET** `/api/v1/products/low-stock`
- **Query Parameters**:
  - `threshold` (default: 5)

### 3. Posts Module

#### Get All Posts
- **GET** `/api/v1/posts`
- **Query Parameters**:
  - `per_page` (default: 10)
  - `sort_by` (default: created_at)
  - `sort_order` (default: desc)
  - `status` (draft|published)

#### Get Single Post
- **GET** `/api/v1/posts/{id}`

#### Create Post
- **POST** `/api/v1/posts`
- **Headers**: Authorization Bearer token
- **Body**: 
  ```json
  {
    "title": "Post Title",
    "content": "Post content...",
    "status": "draft",
    "tags": "tag1,tag2,tag3",
    "featured_image": "https://example.com/image.jpg"
  }
  ```

#### Update Post
- **PUT** `/api/v1/posts/{id}`
- **Headers**: Authorization Bearer token
- **Body**: Same as create

#### Delete Post
- **DELETE** `/api/v1/posts/{id}`
- **Headers**: Authorization Bearer token

#### Search Posts
- **GET** `/api/v1/posts/search/{keyword}`
- **Query Parameters**: Same as get all

#### Get Posts by User
- **GET** `/api/v1/posts/user/{userId}`
- **Query Parameters**: Same as get all

#### Publish Post
- **PATCH** `/api/v1/posts/{id}/publish`
- **Headers**: Authorization Bearer token

#### Unpublish Post
- **PATCH** `/api/v1/posts/{id}/unpublish`
- **Headers**: Authorization Bearer token

### 4. Profile Module

#### Get User Profile
- **GET** `/api/v1/profile`
- **Headers**: Authorization Bearer token

#### Update Profile
- **PUT** `/api/v1/profile`
- **Headers**: Authorization Bearer token
- **Body** (multipart/form-data):
  ```json
  {
    "name": "Updated Name",
    "email": "updated@example.com",
    "bio": "User bio",
    "phone": "+1234567890",
    "address": "User address"
  }
  ```

#### Update Avatar
- **POST** `/api/v1/profile/avatar`
- **Headers**: Authorization Bearer token
- **Body** (multipart/form-data):
  - `profile_photo` (required, image file)

#### Delete Avatar
- **DELETE** `/api/v1/profile/avatar`
- **Headers**: Authorization Bearer token

#### Update Password
- **POST** `/api/v1/profile/password`
- **Headers**: Authorization Bearer token
- **Body**: 
  ```json
  {
    "current_password": "currentpassword",
    "password": "newpassword123",
    "password_confirmation": "newpassword123"
  }
  ```

## Response Format

### Success Response
```json
{
  "message": "Success message",
  "data": { ... }
}
```

### Error Response
```json
{
  "message": "Error message",
  "errors": {
    "field_name": ["Error details"]
  }
}
```

### Pagination Response
```json
{
  "data": [...],
  "meta": {
    "current_page": 1,
    "per_page": 10,
    "total": 100,
    "last_page": 10
  }
}
```

## HTTP Status Codes
- `200` - Success
- `201` - Created
- `204` - No Content (successful deletion)
- `400` - Bad Request
- `401` - Unauthorized
- `422` - Validation Error
- `500` - Server Error

## Rate Limiting
- All authenticated endpoints: 60 requests per minute
- Authentication endpoints: 10 requests per minute

## Testing the API

### Using cURL
```bash
# Register
curl -X POST http://localhost:8000/api/v1/register \
  -H "Content-Type: application/json" \
  -d '{"name":"John Doe","email":"john@example.com","password":"password123","password_confirmation":"password123"}'

# Login
curl -X POST http://localhost:8000/api/v1/login \
  -H "Content-Type: application/json" \
  -d '{"email":"john@example.com","password":"password123"}'

# Get products (authenticated)
curl -X GET http://localhost:8000/api/v1/products \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### Using Postman
1. Import the endpoints into Postman
2. Set the base URL as `http://localhost:8000/api/v1`
3. For authenticated endpoints, add the Bearer token in the Authorization tab
