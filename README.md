# Sales Control API

O projeto consiste em uma API de controle de vendas, com diferentes unidades, diretorias e gerenciamento de acesso.
Além disto, o sistema também faz o controle de geolocalização das vendas e suas respectivas unidades.

## Pré-requisitos

* Docker >= 24.0.5
* Docker Compose >= 2.20.2

## Instalação

Antes de tudo, é necessário instalar o [Docker Desktop](https://docker.com) em sua máquina.

Após a instalação do Docker, clone este repositório:

```shell
git clone https://github.com/herberthleao/sales-control-api.git
```

Acesse o diretório do repositório:

```shell
cd sales-control-api
```

Execute os contêineres, usando o Docker Compose:

```shell
docker compose up -d
```

Acesse o contêiner do projeto, usando o Docker:

```shell
docker exec -it sales-app sh
```

Dentro do contêiner, instale as dependências do projeto:

```shell
composer install
```

Copie o arquivo `.env` padrão para definir as configurações da aplicação:

```shell
cp .env.example .env
```

Gere uma nova chave exclusiva para o Laravel, que será armazenada no `.env`:

```shell
php artisan key:generate
```

Por fim, migre as tabelas do banco de dados e popule-as:

```shell
php artisan migrate --seed
```

## Uso

> O endereço base para as requisições é: `http://localhost:8080/api`.

> A comunicação com a API ocorre exclusivamente por meio de JSON.

### Endpoints

#### Autenticação

| **Método** | **Rota**     | **Descrição**                 |
|------------|--------------|-------------------------------|
| POST       | /auth/tokens | Emite um novo token de acesso |

Exemplo de corpo desta requisição:

```json
{
  "email": "john@doe.test",
  "password": "123mudar"
}
```

Exemplo de resposta desta requisição:

```json
{
    "data": {
        "access_token": "8|dln7JJWmYNpLwz3k9BRzaQwGamORaNA5BipXGv1s8876b4bb",
        "token_type": "Bearer"
    }
}
```

---

#### Diretorias

| **Método** | **Rota**   | **Descrição**         |
|------------|------------|-----------------------|
| GET        | /divisions | Resgata as diretorias |

> Esta rota exige autenticação.

Exemplo de resposta desta requisição:

```json
{
    "data": {
        "id": 3,
        "name": "Centro-oeste",
        "director_id": 4,
        "created_at": "2023-09-04T22:44:42.000000Z",
        "updated_at": "2023-09-04T22:44:42.000000Z"
    }
}
```

---

#### Unidades

| **Método** | **Rota**              | **Descrição**                |
|------------|-----------------------|------------------------------|
| GET        | /divisions/{id}/units | Resgata as unidades de venda |

> Esta rota exige autenticação.

Exemplo de resposta desta requisição:

```json
{
    "data": [
        {
            "id": 8,
            "name": "Campo Grande",
            "latitude": "-20.46265201",
            "longitude": "-54.61565894",
            "manager_id": 12,
            "division_id": 3,
            "created_at": "2023-09-04T22:44:42.000000Z",
            "updated_at": "2023-09-04T22:44:42.000000Z"
        }
    ],
    "total": 1
}
```

---

#### Vendedores

| **Método** | **Rota**                                       | **Descrição**         |
|------------|------------------------------------------------|-----------------------|
| GET        | /divisions/{divisionID}/units/{unitID}/sellers | Resgata os vendedores |

> Esta rota exige autenticação.

Exemplo de resposta desta requisição:

```json
{
    "data": [
        {
            "id": 20,
            "name": "Breno",
            "email": "breno@magazineaziul.com.br",
            "email_verified_at": null,
            "role": "SELLER",
            "unit_id": 8,
            "created_at": "2023-09-04T22:44:41.000000Z",
            "updated_at": "2023-09-04T22:44:41.000000Z"
        }
    ],
    "total": 1
}
```

---

#### Vendas

##### Criação de Vendas

| **Método** | **Rota** | **Descrição**           |
|------------|----------|-------------------------|
| POST       | /sales   | Registra uma nova venda |

> Esta rota exige autenticação.

Exemplo de corpo desta requisição:

```json
{
    "date": "2023-01-02 12:31:03",
    "value": "10.00",
    "latitude": -20.46265201,
    "longitude": -54.61565894
}
```

Exemplo de resposta desta requisição:

```json
{
    "data": {
        "date": "2023-01-02 12:31:03",
        "value": "10.00",
        "latitude": -20.46265201,
        "longitude": -54.61565894,
        "unit_id": 8,
        "seller_id": 21,
        "updated_at": "2023-09-05T04:55:24.000000Z",
        "created_at": "2023-09-05T04:55:24.000000Z",
        "id": 3
    }
}
```

##### Leitura de Vendas

| **Método** | **Rota** | **Descrição**     |
|------------|----------|-------------------|
| GET        | /sales   | Resgata as vendas |

> Esta rota exige autenticação.

Este _endpoint_ possui alguns filtros opcionais que podem ser passados como _query string_:

- `from`: a data inicial de criação;
- `to`: a data final de criação;
- `division`: o ID da diretoria;
- `unit`: o ID da unidade;
- `seller`: o ID do vendedor.

Exemplo de requisição filtrada:

```http
GET /sales?from=2023-01-01&to=2023-09-05&division=3&unit=8&seller=21
```

Exemplo de resposta:

```json
{
    "data": [
        {
            "id": 1,
            "date": "2023-01-02 12:31:02",
            "value": "10.00",
            "latitude": "-20.46265201",
            "longitude": "-54.61565894",
            "seller_id": 21,
            "unit_id": 8,
            "roaming_unit_id": null,
            "created_at": "2023-09-05T04:55:04.000000Z",
            "updated_at": "2023-09-05T04:55:04.000000Z"
        }
    ],
    "total": 1
}
```

##### Leitura de Vendas por ID

| **Método** | **Rota**    | **Descrição**     |
|------------|-------------|-------------------|
| GET        | /sales/{id} | Resgata uma venda |

> Esta rota exige autenticação.

Exemplo de resposta:

```json
{
    "data": {
        "id": 4,
        "date": "2023-01-02 12:31:03",
        "value": "10.00",
        "latitude": "-16.67312624",
        "longitude": "-49.25248826",
        "seller_id": 21,
        "unit_id": 8,
        "roaming_unit_id": 9,
        "created_at": "2023-09-05T05:13:26.000000Z",
        "updated_at": "2023-09-05T05:13:26.000000Z",
        "unit": {
            "id": 8,
            "name": "Campo Grande",
            "latitude": "-20.46265201",
            "longitude": "-54.61565894",
            "manager_id": 12,
            "division_id": 3,
            "created_at": "2023-09-05T04:54:46.000000Z",
            "updated_at": "2023-09-05T04:54:46.000000Z"
        },
        "seller": {
            "id": 21,
            "name": "Emanuel",
            "email": "emanuel@magazineaziul.com.br",
            "email_verified_at": null,
            "role": "SELLER",
            "unit_id": 8,
            "created_at": "2023-09-05T04:54:46.000000Z",
            "updated_at": "2023-09-05T04:54:46.000000Z"
        },
        "roaming_unit": {
            "id": 9,
            "name": "Goiânia",
            "latitude": "-16.67312624",
            "longitude": "-49.25248826",
            "manager_id": 13,
            "division_id": 3,
            "created_at": "2023-09-05T04:54:46.000000Z",
            "updated_at": "2023-09-05T04:54:46.000000Z"
        }
    }
}
```

## Teste

Para realizar os testes, execute:

```shell
php artisan test
```

## Licença

Este projeto é de código aberto e está licenciado sob a [Licença MIT](LICENSE.md).
