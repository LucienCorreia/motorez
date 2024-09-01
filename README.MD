## Overview

Para gerar dados fakes para importar esse projeto tem uma API que retorna vários dados para testes (com nomes e valores aleatórios) no padrão da WebMotors e RevendaMais

A aplicação principal possibilita importar desses dois padrões por upload de um arquivo, esse mesmo q pode ser gerado no proeto de mock

Antes de mais nada é necessário subir os containers e na primeira vez criar o banco e popular com dados alsos para testes que pode ser rodado quantas vezes quiser, sempre gerando mais dados além dos já gerados

### Subindo os containers

Para subir os containers basta entrar dentro da raiz do projeto e rodar `docker compose up`

#### Gerando banco e dados

Para criar o banco da API de mock rode o comando: `docker compose exec mocks-php-fpm php artisan migrate --seed`

Isso irá criar as tabelas e já popular com 100 registros de véiculos, se quiser ter mais registros rode `docker compose exec mocks-php-fpm php atisan db:seed` para ir criando novos registros de 100 em 100

Já a aplicação principal precisa somente da criação das tabelas, rodando `docker compose exec app-php-fpm php artisan migrate`

##### Obtendo arquivos de exemplo para importar

Os arquivos podem ser obtidos por dois endpoints, `/webmotors` e `/revenda-mais`, a aplicação de mocks está para rodar na porta 8080, então podemos rodar `curl localhost:8080/webmotors > webmotors-mock.json` para salvar um exemplo de arquivo de importação webmotors ou `curl localhost:8080/revenda-mais > revenda-mais-mock.xml` para um exemplo de arquivo de importação revenda mais

### Acessando a aplicação

A aplicação roda na porta 80, então basta acessar localhost no navegador, logo de cara irá abrir a tabela com listagem e no canto superior direito as opções para importar ou exportar os dados.

Na tela de importação basta selecionar o arquivo e qual o serviço de importação, logo após irá retornar para a tela principal já listando os dados importados

A exportação retorna tudo o que tiver no banco de dados em um arquivo .csv

As opções de filtros atualizam a tabela quando algum valor é selecionado em selects ou quando tira o foco de algum valor de input numérico

### Criando um novo serviço

Para criar um novo serviço primeiramente precisamos criar uma nova classe que estende de `App\Services\ImportVehicles\Contracts\ImportVehicles` e implementar os métodos dela:

- getServiceName: deve retornar uma String com o nome do serviço
- getKeysNames: deve retornar uma instância da classe `App\Services\ImportVehicles\Contracts\KeysNames` com todas as propriedades cujo valor seja o nome do campo/chave do arquivo de importação referente a qual tipo de informação ele se trata, por exemplo:

```PHP
    public function getKeysNames(): KeysNames
    {
        return new KeysNames(
            codigo: 'codigoVeiculo',
            modelo: 'modelo',
            marca: 'marca',
            ano: 'ano',
            quilometragem: 'quilometragem',
            combustivel: 'tipoCombustivel',
            preco: 'precoVenda',
        );
    }
```

O trecho acima representa o mapeamento para o arquivo de importação do RevendaMais, definindo como estará as tags xml no arquivo que refere a cada informação que precisa ser importada

- getParsedFileContent: esse método irá receber o contéudo do arquivo em String e retornar um array com a listagem de veiculos, se for um JSON deve fazer o parse e retornar somente a lista de veiculos, tirando fora outras informações que pode estar junto ao arquivo

Logo após adicinar mais uma opção no front-end e no controller de importação quando selecionar essa criar a intância da nova classe do tipo `ImportVehicles`

## Stack

Esse projeto usa a seguinte pilha tecnológica:

- PHP 8.3
- Laravel 11
- Tailwind 3
- jQuery 3
- DataTables 2
- Mysql 8
- Nginx

## Observações finais

Esse projeto foi focado na solução de uma importação que seja simples adicionar novos serviços, não tendo uma atenção muito grande para design e front-end.

A importação pode ser feita por diferentes meios já que ele requer o conteúdo em texto puro dos dados, nesse caso se usa por arquivos mas pode ser direto em requisições HTTP de preferir, com pouco código consegue fazer a mesma coisa para diferentes cenários.

Para melhor otimização em uma importação automática, sem interface, as taks do laravel poderão ser utilizadas em outras instâncias rodando por batches em background.

PS: o `.env` e pasta `vendor` está nos commits pra facilitar a vida, NÃO FAÇA EM PROD!!!