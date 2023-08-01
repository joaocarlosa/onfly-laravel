## Instalação
```sh
git clone https://github.com/joaocarlosa/onfly-laravel.git
```

```sh
docker-compose up -d
```

```sh
docker-compose exec app bash
```

```sh
composer install
```


Gere a key do projeto Laravel
```sh
php artisan key:generate
```

## Autenticação

Todos os endpoints, com exceção do POST `/api/users`, exigem autenticação por meio de Bearer Token que deve ser enviado no header da requisição.

## Endpoints

### Users

Cria um novo usuário.

Endpoint: POST `/api/users`

```sh
curl -X POST -H "Content-Type: application/json" -d
'{
	"name": "user",
    "email": "user@email.com",
    "password": "pass"
}'
http://localhost:8000/api/users


```
Retorno:

```json
{
"user": {
    "name": "User",
    "email": "user@example.com",
    "updated_at": "2023-08-01T21:39:55.000000Z",
    "created_at": "2023-08-01T21:39:55.000000Z",
    "id": 12
},
"token": "your_token"
}
```

### Recuperar informações do usuário
Obtenha informações sobre o usuário logado.

Endpoint: GET `/api/users`

```sh
curl -X GET -H "Authorization: Bearer seu_token_aqui"
http://localhost:8000/api/users

```
Retorno:

```json
{
"id": 1,
"name": "user",
"email": "user@email.com",
"email_verified_at": null,
"remember_token": null,
"created_at": "2023-07-30T08:13:32.000000Z",
"updated_at": "2023-07-30T08:13:32.000000Z"
}
```

### Atualizar informações do usuário
Atualize informações sobre o usuário logado.

Endpoint: PUT `/api/users`

```sh
curl -X PUT -H "Content-Type: application/json" -d
'{
	"name": "user",
    "password": "pass"
}'
http://localhost:8000/api/users

Retorno:

```json
{
"data": {
    "id": 1,
    "name": "user",
    "email": "user@example.com",
    "created_at": "2023-08-01T23:28:14.000000Z",
    "updated_at": "2023-08-01T23:28:49.000000Z"
}
}
```
### Deletar o usuário
Exclua o usuário logado.

Endpoint: DELETE `/api/users`

```sh
curl -X DELETE -H "Authorization: Bearer seu_token_aqui"
http://localhost:8000/api/users

```

#### Despesas:

Para acessar os seguintes endpoints, é necessário passar o token de autenticação do usuário.

Recuperar todas as despesas
Endpoint: GET `/api/expense`


```sh
curl -X GET -H "Authorization: Bearer seu_token_aqui"
http://localhost:8000/api/expense

```

Retorno:

```json
{
"id": 1,
"description": "netflix",
"user_id": 10,
"value": "25.00",
"created_at": "2023-07-30T21:00:28.000000Z",
"updated_at": "2023-07-30T21:00:28.000000Z"
},
{
"id": 2,
"description": "disneyPlus",
"user_id": 10,
"value": "35.00",
"created_at": "2023-07-30T21:00:29.000000Z",
"updated_at": "2023-07-30T21:00:29.000000Z"
}

```

### Recuperar uma despesa específica
Endpoint: GET `/api/expense/{id}`

```sh
curl -X GET -H "Authorization: Bearer seu_token_aqui"
http://localhost:8000/api/expense/$ID

```

Retorno:

```json
{ 
"id": 8,
"description": "youtube",
"user_id": 10,
"value": "22.00",
"created_at": "2023-07-30T21:00:28.000000Z",
"updated_at": "2023-07-30T21:00:28.000000Z"
}
```


### Criar uma nova despesa
Endpoint: POST `/api/expense`

```sh
curl -X POST -H "Content-Type: application/json" -H "Authorization: Bearer seu_token_aqui" -d
'{
	"value": "20",
	"description": "netflix"
}'
http://localhost/api/expense

```

Retorno:

```json
{
"expense": {
    "description": "youtube",
    "value": "-20",
    "user_id": 14,
    "updated_at": "2023-07-31T14:42:19.000000Z",
    "created_at": "2023-07-31T14:42:19.000000Z",
    "id": 51
},
"emailMessage": "Sent with success."
}
```


### Atualizar uma despesa existente
Endpoint: PUT `/api/expense/{id}`

```sh
curl -X PUT -H "Content-Type: application/json" -H "Authorization: Bearer seu_token_aqui" -d
'{
	"value": "30",
	"description": "Nova descrição"
}'
http://localhost:8000/api/expense/$ID

```
Retorno:

```json
{
"id": 9,
"description": "Nova descrição",
"user_id": 14,
"value": "30.00",
"created_at": "2023-07-30T20:58:29.000000Z",
"updated_at": "2023-07-31T14:42:05.000000Z"
}

```

### Remover uma despesa
Endpoint: DELETE `/api/expense/{id}`

```sh
curl -X DELETE -H "Authorization: Bearer seu_token_aqui"
http://localhost:8000/api/expense/$ID

```

Retorno:

```json
{
"success": "successfully deleted"
}
```