# employee-restfull-api

Este projeto é um simples CRUD de cadastro de funcionários utilizando PHP como linguagem de programação e banco de dados Mysql.

# Requisitos
* [Docker](https://www.docker.com/)
* [Docker Compose](https://docs.docker.com/compose/)


# Instalacao do ambiente
```sh
$ git clone https://github.com/adrianoantonucci/employee-restfull-api.git
$ cd employee-restfull-api
$ make install
```

# Iniciar ambiente
```sh
$ make start
```

# Parar ambiente
```sh
$ make stop
```
## Extras
# Instalar dependencias
```sh
$ make docker-install-dependencies
```

# Executar migrations
```sh
$ make docker-run-migrations
```

# Visualizar logs do docker
```sh
$ make docker-logs
```

# Endpoints
 Para testar foi utilizado o https://www.getpostman.com/

### GET
Listar todos os desenvolvedores cadastrados
```
http://localhost:8085/api/developers

```
Utilizando filtros (exemplo)
```
http://localhost:8085/api/developers?nome=Adriano&idade=29

```
Listando desenvolvedores excluidos
```
http://localhost:8085/api/developers?excluido=true

```
### Parametros disponiveis
    - nome (ex: nome=adriano)
    - sexo (ex: sexo=masculino)
    - idade (ex: idade=29)
    - data de nascimento (ex: datanascimento=08-11-1989)
    - hobby (ex: hobby=programar)
    - excluidos (ex: excluido=true)
### GET / id
Listar apenas um registro
```
http://localhost:8085/api/developers/1
```

### POST 
Inserir desenvolvedor
```
http://localhost:8085/api/developers

{
        "nome": "Adriano Antonucci",
        "sexo": "Masculino",
        "idade": "29",
        "hobby": "Programar",
        "datanascimento": "08/11/1989",
}

### PUT /ID
Editar registro
```
http://localhost:8085/api/developers/1

{
        "nome": "Adriano Rusinelli Antonucci",
        "hobby": "Programar",
}
```

### DELETE
Excluir registro
http://localhost:8085/api/developers/1

