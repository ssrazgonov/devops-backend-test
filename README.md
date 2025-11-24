### Установка:
```
docker compose up -d --build
```

### Регистрация пользователя и получение Bearer токена:
```
//регистрация пользователя, обязательные поля - username, password, email.
POST http://localhost:8080/signup
```

```
//получение Bearer токена, необходимые поля username, password
POST http://localhost:8080/login
```

### Endpoints:
#### Для работы API необходимо наличие заголовков:
- Accept: application/json
- Authorization: Bearer ...token_data
```
//Список постов
GET http://localhost:8080/v1/post/

//Информация о посте с id - 1
GET http://localhost:8080/v1/post/1

//создание поста, title - required|string, body - string
POST http://localhost:8080/v1/post/

//обновление поста, title - string, body - string
PUT http://localhost:8080/v1/post/

//удаление поста
DELETE http://localhost:8080/v1/post/1
```
### Prometheus
```http://localhost:9090/targets```
### Grafana
Предустановлены экспортеры и дашборды по mysql, nginx
#### URl: http://localhost:3000, admin:admin
