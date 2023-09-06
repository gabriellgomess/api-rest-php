
# API REST em PHP para Gerenciamento de Produtos

Esta é uma API RESTful simples para gerenciamento de produtos, implementada em PHP.

## Estrutura do Projeto

O projeto está estruturado da seguinte forma:

- `api/`  
  - `config/`
    - `database.php` - Configurações de conexão com o banco de dados.
  - `objects/`
    - `produto.php` - Definição da classe Produto e suas operações.
  - `index.php` - Ponto de entrada da API, responsável por lidar com as requisições HTTP.

## Requisitos

- PHP 7.x ou superior
- MySQL
- Servidor Web (como Apache ou Nginx)

## Configuração

1. Clone este repositório.
2. Modifique o arquivo `api/config/database.php` para incluir suas próprias credenciais de banco de dados.
3. Coloque os arquivos em seu servidor web.

## Uso

A API fornece os seguintes endpoints:

- `GET /produtos`: Listar todos os produtos.
- `POST /produtos`: Criar um novo produto.
- `PUT /produtos`: Atualizar um produto existente.
- `DELETE /produtos`: Excluir um produto.

### Exemplos

#### Listar todos os produtos

```bash
curl -X GET http://your-server/api/produtos
```

#### Criar novo produto
```bash
curl -X POST http://your-server/api/produtos -d '{
    "nome": "Novo Produto",
    "preco": 29.99
}'
```
#### Atualizar um produto existente
```bash
curl -X PUT http://your-server/api/produtos -d '{
    "id": 1,
    "nome": "Produto Atualizado",
    "preco": 19.99
}'
```

#### Excluir um produto
```bash
curl -X DELETE http://your-server/api/produtos -d '{
    "id": 1
}'
```


## Contribuindo

Contribuições são sempre bem-vindas!

## Licença

Este projeto está sob a licença MIT. Para mais informações, consulte o arquivo LICENSE.

[MIT](https://choosealicense.com/licenses/mit/)

