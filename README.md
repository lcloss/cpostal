# Códigos Postais

<p>Este projeto pretende ser um exercício sobre uso do Laravel + Livewire para pesquisa de códigos postais localmente.</p>

## Instalação

1. Clone o repositório para o seu local de trabalho com `git clone https://github.com/lcloss/cpostal`.
2. Instale as dependências com o comando `composer install`.
3. Instale as dependências do front-end com o comando `npm install && npm run build`.
4. Crie o ficheiro `.env` com o comando `cp .env.example .env`.
5. Crie a chave da aplicação com o comando `php artisan key:generate`.
6. Configure a base de dados no ficheiro `.env`. Dica: pode usar o SQLite.
7. Faça download dos ficheiros de códigos postais dos CTT e coloque-os na pasta `storage/csv/`. <br><strong>Nota</strong>: o projeto usa o código de caracteres UTF-8. Os ficheiros disponíveis no site do CTT tem código de caracteres ANSI. Antes de alimentar a base de dados, lembre-se de converter os ficheiros do CTT de ANSI para UTF-8. Com o Notepad++, por exemplo, é fácil de executar essa tarefa. Basta abrir o ficheiro, ir no menu Encoding > Convert to UTF-8 e guardar o ficheiro.
8. Execute a migração da base de dados e alimentação dos dados com o comando `php artisan migrate --seed`.<br><strong>Nota</strong>: a alimentação dos dados pode demorar alguns minutos (~30 a 50 min).

## Códigos de Terceiros

Este projeto utiliza a base de dados dos CTT Portugal (disponível em [Download de ficheiros: Códigos postais e apartados](https://www.ctt.pt/feapl_2/app/restricted/postalCodeSearch/postalCodeDownloadFiles.jspx)).

Também poderá consultar os códigos postais diretamente no site dos CTT em [Pesquisa de moradas e códigos postais](https://www.ctt.pt/feapl_2/app/open/postalCodeSearch/postalCodeSearch.jspx#fndtn-addressSearchPanel).

Como front-end, o projeto utiliza o framework Bootstrap com o tema [SimpleSidebar](https://startbootstrap.com/template/simple-sidebar).

## Contribuições e correções

Todas as contribuições são bem-vindas. Se encontrou algo que está com erro, ou tem alguma sugestão de melhoria, utilize o Github para abrir um issue ou submeter um pull request.

## Licença

Este projeto é open-source e licenciado através da [licença MIT](https://opensource.org/licenses/MIT).
