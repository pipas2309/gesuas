# Sistema de Gerenciamento de Cidadãos

O Sistema de Gerenciamento de Cidadãos é uma aplicação PHP que gerencia informações de cidadãos. Ele utiliza SQLite como banco de dados, FastRoute para roteamento e Guzzle para implementação de mensagens PSR-7. A aplicação é containerizada usando Docker.

## Começando

Estas instruções permitirão que você obtenha uma cópia do projeto em funcionamento na sua máquina local para fins de desenvolvimento e teste.

### Pré-requisitos

Você precisa ter o Docker e Docker Compose instalados na sua máquina. Você também precisa do Composer para gerenciar as dependências do PHP.

### Instalação

1. Clone o repositório:

```bash
git clone <url_do_repositório>
```

2. Navegue até o diretório do projeto:

```bash
cd <diretório_do_projeto>
```

3. Instale as dependências do PHP:

```bash
composer install
```

4. Construa e inicie o contêiner Docker:

```bash
docker-compose up --build
```

Agora a aplicação deve estar acessível em `http://localhost:8000`.

## Estrutura do Projeto

O projeto é organizado em vários diretórios:

- `src`: Contém o código-fonte da aplicação.
    - `Controller`: Contém as classes do controlador.
    - `Model`: Contém as classes de modelo.
    - `Repository`: Contém as classes de repositório para interação com o banco de dados.
    - `Util`: Contém classes utilitárias.
    - `View`: Contém classes de visualização para formatar mensagens de resposta.
    - `config`: Contém arquivos de configuração.

## Uso

A aplicação fornece os seguintes endpoints:

- `POST /citizen`: Adiciona um novo cidadão. O corpo da requisição deve conter um campo `name`.
- `GET /citizen/{nis}`: Procura um cidadão pelo NIS.
- `GET /verify/{nis}`: Verifica um NIS.

### Endpoints Detalhados

#### `POST /citizen`

Este endpoint é usado para adicionar um novo cidadão ao sistema. O corpo da requisição deve ser um JSON contendo um campo `name`, que é o nome do cidadão.

Exemplo de corpo de requisição:

```json
{
    "name": "João Silva"
}
```

#### `GET /citizen/{nis}`

Este endpoint é usado para procurar um cidadão pelo NIS. O NIS deve ser fornecido como parâmetro na URL.

Exemplo de URL: `GET /citizen/12345678900`

#### `GET /verify/{nis}`

Este endpoint é usado para verificar se um NIS é válido. O NIS deve ser fornecido como parâmetro na URL.

Exemplo de URL: `GET /verify/12345678900`

## Construído Com

- [PHP](https://www.php.net/)
- [SQLite](https://www.sqlite.org/index.html)
- [FastRoute](https://github.com/nikic/FastRoute)
- [Guzzle](https://docs.guzzlephp.org/en/stable/)
- [Docker](https://www.docker.com/)

## Contribuindo

Por favor, leia `CONTRIBUTING.md` para detalhes sobre nosso código de conduta e o processo para nos enviar pull requests.

## Licença

Este projeto está licenciado sob a Licença MIT - veja o arquivo `LICENSE.md` para detalhes.