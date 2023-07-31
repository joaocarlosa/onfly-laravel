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

Todos os endpoints, com exceção do POST `/api/users/new`, exigem autenticação por meio de Bearer Token que deve ser enviado no header da requisição.

## Endpoints

### Users

Cria um novo usuário.

Endpoint: POST `/api/users/new`

```sh
curl --location --request POST 'http://localhost:8000/api/users/new' \
--header 'Content-Type: application/json' \
--data-raw '{
	"name": "user",
    "email": "user@email.com",
    "password": "pass"
}'

```

### Recuperar informações do usuário
Obtenha informações sobre o usuário logado.

Endpoint: GET `/api/users/me`

```sh
curl --location --request GET 'http://localhost:8000/api/users/me' \
--header 'Authorization: Bearer seu_token_aqui'
```

#### Despesas:

Para acessar os seguintes endpoints, é necessário passar o token de autenticação do usuário.

Recuperar todas as despesas
Endpoint: GET `/api/expense`


```sh
curl --location --request GET 'http://localhost:8000/api/expense' \
--header 'Authorization: Bearer seu_token_aqui'
```

### Recuperar uma despesa específica
Endpoint: GET `/api/expense/{id}`

```sh
curl --location --request GET 'http://localhost:8000/api/expense/8' \
--header 'Authorization: Bearer seu_token_aqui'
```


### Criar uma nova despesa
Endpoint: POST `/api/expense`

```sh
curl --location --request POST 'http://localhost:8000/api/expense' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer seu_token_aqui' \
--data-raw '{
	"value": "20",
	"description": "netflix"
}'
```

### Atualizar uma despesa existente
Endpoint: PUT `/api/expense/{id}`

```sh
curl --location --request PUT 'http://localhost:8000/api/expense/9' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer seu_token_aqui' \
--data-raw '{
	"value": "30",
	"description": "Nova descrição"
}'
```


### Remover uma despesa
Endpoint: DELETE `/api/expense/{id}`

```sh
curl --location --request DELETE 'http://localhost:8000/api/expense/43' \
--header 'Authorization: Bearer seu_token_aqui'
```

