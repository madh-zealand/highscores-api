# Highscores API Documentation

A guide to managing games and leaderboards via the Highscores API. This API allows developers to create and manage games, maintain player highscores, and integrate public leaderboards seamlessly into their applications.

---

## Table of Contents

- [Base URL](#base-url)
- [Authentication](#authentication)
- [Resources & Endpoints](#resources--endpoints)
  - [Games](#games)
      - [GET /games](#get-games)
      - [POST /games](#post-games)
      - [GET /games/{game_id}](#get-gamesgame_id)
      - [PUT /games/{game_id}](#put-gamesgame_id)
      - [DELETE /games/{game_id}](#delete-gamesgame_id)
  - [Highscores](#highscores)
      - [GET /games/{game_id}/highscores](#get-gamesgame_idhighscores)
      - [POST /games/{game_id}/highscores](#post-gamesgame_idhighscores)
      - [GET /games/{game_id}/highscores/{highscore_id}](#get-gamesgame_idhighscoreshighscore_id)
      - [PUT /games/{game_id}/highscores/{highscore_id}](#delete-gamesgame_idhighscoreshighscore_id)
      - [DELETE /games/{game_id}/highscores/{highscore_id}](#delete-gamesgame_idhighscoreshighscore_id)
- [Validation Rules](#validation-rules)
- [Error Responses](#error-responses)

---

## Base URL

The Base URL is the root endpoint for all API requests. It defines the starting point from which all resources and endpoints are accessed.

```
https://highscores.martindilling.com/api/v1
```

When making a request, append the desired endpoint to this URL. For example, when writing:
```
/games
```

You need to prefix it with the Base URL:
```
https://highscores.martindilling.com/api/v1/games
```

---

## Authentication

All endpoints require a **bearer token**. Include this token in every request’s `Authorization` header:
```
Authorization: Bearer YOUR_TOKEN_HERE
```

- **Obtaining a token**: Sign up on the website and generate a token on your profile page.
- **Token security**: The token will allow everyone to make calls to the API as if they were you, so only use the token to make calls from secure spaces, such as a PHP backend.

---

## Resources & Endpoints

### Games

| Method | Endpoint               | Description                                     |
|-------:|:-----------------------|:------------------------------------------------|
| **GET**    | `/games`                | List all games owned by the authenticated user. |
| **POST**   | `/games`                | Create a new game.                              |
| **GET**    | `/games/{game_id}`      | Retrieve a specific game by ID.                 |
| **PUT**    | `/games/{game_id}`      | Update an existing game’s title.                |
| **DELETE** | `/games/{game_id}`      | Delete a game by ID.                            |

#### Examples

##### **GET /games**

  ```http
  GET /v1/games
  Authorization: Bearer YOUR_TOKEN
  Accept: application/json
  ```
**Response (200)**
  ```json
  {
    "data": [
      {
        "id": 1,
        "title": "My first game",
        "created_at": "2025-01-20T12:25:52.000000Z"
      },
      {
        "id": 2,
        "title": "Second game",
        "created_at": "2025-01-20T12:25:52.000000Z"
      }
    ]
  }
  ```

##### **POST /games**

  ```http
  POST /v1/games
  Authorization: Bearer YOUR_TOKEN
  Content-Type: application/json
  Accept: application/json

  {
    "title": "ClickClack DEV"
  }
  ```
  **Response (201)**
  ```json
  {
    "data": {
      "id": 3,
      "title": "ClickClack DEV",
      "created_at": "2025-01-24T10:08:21.000000Z"
    }
  }
  ```

##### **GET /games/{game_id}**

  ```http
  GET /v1/games/1
  Authorization: Bearer YOUR_TOKEN
  Accept: application/json
  ```
  **Response (200)**
  ```json
  {
    "data": {
      "id": 1,
      "title": "ClickClack DEV",
      "created_at": "2025-01-20T10:08:21.000000Z"
    }
  }
  ```

##### **PUT /games/{game_id}**

  ```http
  PUT /v1/games/1
  Authorization: Bearer YOUR_TOKEN
  Content-Type: application/json
  Accept: application/json

  {
    "title": "My Updated Game Title"
  }
  ```
  **Response (200)**
  ```json
  {
    "data": {
      "id": 1,
      "title": "My Updated Game Title",
      "created_at": "2025-01-20T10:08:21.000000Z"
    }
  }
  ```

##### **DELETE /games/{game_id}**

  ```http
  DELETE /v1/games/2
  Authorization: Bearer YOUR_TOKEN
  Accept: application/json
  ```
  **Response (204 or 200)**
  ```json
  []
  ```

### Highscores

All highscore endpoints are nested under a specific game.

| Method | Endpoint                                       | Description                                                 |
|-------:|:-----------------------------------------------|:------------------------------------------------------------|
| **GET**    | `/games/{game_id}/highscores`                | List all highscores for a game, sorted by score descending. |
| **POST**   | `/games/{game_id}/highscores`                | Create a highscore.                                         |
| **GET**    | `/games/{game_id}/highscores/{highscore_id}` | Retrieve a specific highscore by ID.                        |
| **PUT**    | `/games/{game_id}/highscores/{highscore_id}` | Update a highscore’s fields.                                |
| **DELETE** | `/games/{game_id}/highscores/{highscore_id}` | Delete a specific highscore by ID.                          |

#### Examples

##### **GET /games/{game_id}/highscores**

  ```http
  GET /v1/games/1/highscores
  Authorization: Bearer YOUR_TOKEN
  Accept: application/json
  ```
  **Response (200)**
  ```json
  {
    "data": [
      {
        "id": 3,
        "game_id": 1,
        "player": "Mikkel",
        "score": 348,
        "created_at": "2025-01-20T10:09:46.000000Z"
      },
      {
        "id": 2,
        "game_id": 1,
        "player": "Camilla",
        "score": 117,
        "created_at": "2025-01-20T10:09:35.000000Z"
      }
    ]
  }
  ```

##### **POST /games/{game_id}/highscores**

  ```http
  POST /v1/games/1/highscores
  Authorization: Bearer YOUR_TOKEN
  Content-Type: application/json
  Accept: application/json

  {
    "player": "Nadia",
    "score": 24
  }
  ```
  **Response (201)**
  ```json
  {
    "data": {
      "id": 4,
      "game_id": 1,
      "player": "Nadia",
      "score": 24,
      "created_at": "2025-01-20T10:09:59.000000Z"
    }
  }
  ```

##### **GET /games/{game_id}/highscores/{highscore_id}**

  ```http
  GET /v1/games/1/highscores/1
  Authorization: Bearer YOUR_TOKEN
  Accept: application/json
  ```
  **Response (200)**
  ```json
  {
    "data": {
      "id": 1,
      "game_id": 1,
      "player": "Martin",
      "score": 100,
      "created_at": "2025-01-20T10:09:13.000000Z"
    }
  }
  ```

##### **PUT /games/{game_id}/highscores/{highscore_id}**

  ```http
  PUT /v1/games/1/highscores/1
  Authorization: Bearer YOUR_TOKEN
  Content-Type: application/json
  Accept: application/json

  {
    "score": 150
  }
  ```
  **Response (200)**
  ```json
  {
    "data": {
      "id": 1,
      "game_id": 1,
      "player": "Martin",
      "score": 150,
      "created_at": "2025-01-20T10:09:13.000000Z"
    }
  }
  ```

##### **DELETE /games/{game_id}/highscores/{highscore_id}**

  ```http
  DELETE /v1/games/1/highscores/1
  Authorization: Bearer YOUR_TOKEN
  Accept: application/json
  ```
  **Response (204 or 200)**
  ```json
  []
  ```

---

## Validation Rules

- **Game**
    - `title`: **required** (string)

- **Highscore**
    - `player`: **required** (string)
    - `score`: **required**, numeric ≥ 0

---

## Error Responses

Each error follow the same JSON structure.

Examples:

- **401 Unauthenticated**
  ```json
  {
    "status": 401,
    "type": "unauthenticated",
    "title": "Unauthenticated",
    "detail": "Your authentication credentials were incorrect.",
    "instance": "https://highscores.martindilling.com/api/v1/games",
    "timestamp": "2025-01-24T12:49:33+00:00"
  }
  ```
- **404 Not Found**
  ```json
  {
    "status": 404,
    "type": "not-found",
    "title": "Resource not found",
    "detail": "The requested resource was not found.",
    "instance": "https://highscores.martindilling.com/api/v1/games/2",
    "timestamp": "2025-01-24T12:50:54+00:00"
  }
  ```
- **422 Validation Error**
  ```json
  {
    "status": 422,
    "type": "validation-error",
    "title": "Validation error",
    "detail": "You have validation errors in the request.",
    "instance": "https://highscores.martindilling.com/api/v1/games/1/highscores",
    "timestamp": "2025-01-24T12:53:01+00:00",
    "additional": {
      "errors": {
        "player": [
          "The player field is required."
        ]
      }
    }
  }
  ```
