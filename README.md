# API Laravel com autenticação e autorizado usando Sanctum 
| API | Sanctum | Tokens | 

Este projeto tem como objetivo o estudo do pacote *Sanctum* do ecossistema *Laravel* para autenticação de APIs.

A API implementa todas as operações **CRUD** relacionadas a uma lista de clientes, com os campos:

- `name`
- `email`
- `phone`


Também inclui:

- Paginação na listagem de clientes
- Visualização detalhada via endpoint por ID
- Autenticação baseada em tokens com **Sanctum**
- Uso das **Abilities** para gerenciar permissões de acesso a determinadas rotas e métodos

## Autenticação

A autenticação é feita por meio de tokens pessoais gerados com Sanctum. O sistema diferencia os acessos com base nas *abilities* atribuídas a cada token, permitindo aplicar políticas de autorização em rotas específicas.
