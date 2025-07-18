# Real-Time Bidding (RTB) System

A Laravel-based backend for a simplified Real-Time Bidding system.

## Features

- User authentication with Laravel Sanctum
- Ad slot management with automatic status updates
- Concurrent bid processing using Database queues
- Automatic bid evaluation with Laravel Scheduler
- RESTful API endpoints



## API Documentation

Available endpoints:

- `POST /api/login` - User login
- `POST /api/register` - User registration
- `POST /api/logout` - User logout
- `GET /api/slots` - List all ad slots (filter with ?status=open)
- `GET /api/slots/{id}` - Get ad slot details
- `GET /api/slots/{id}/bids` - List bids for a slot
- `GET /api/slots/{id}/winner` - Get winning bid (if awarded)
- `POST /api/bids` - Place a bid
- `GET /api/user/bids` - Get user's bid history
- `POST /api/admin/slots` - Create new ad slot (admin only)

## Sample Credentials

- Admin: admin@example.com / password
- Regular User: user@example.com / password

## Running Workers and Scheduler
php artisan queue:work


## Whatis missing
I didnt test with docker implementation

