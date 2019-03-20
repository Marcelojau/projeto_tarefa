# projeto_tarefa
Projeto tarefa 
Bom dia
Procedimento para gerar o projeto
Também para gerar o banco precisa criar uma database chamada projeto_tarefa, e, dentro dela rodar o arquivo que está em sql_tarefa
com o nome de tarefa.sql
O projeto foi desenvolvido com uma api com um crud, onde pode cadastrar, editar, excluir e atualizar a informação da tarefa
Detalhe: Não se pode cadastrar um mesmo titulo para uma tarefa. ja é verificado isso na função 


 para rodar o projeto por favor, colocar sempre na opção http://localhost:8080, trocar para somente localhost ou colocar
localhost mais a porta usada..

Exemplo do caminho usado na minha máquina : curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/projeto_tarefa/buscarInformacaoParametro");


Exemplo que pode ser usado em outras máquinas : 

curl_setopt($ch, CURLOPT_URL, "http://localhost/projeto_tarefa/buscarInformacaoParametro");
curl_setopt($ch, CURLOPT_URL, "http://localhost:8000/projeto_tarefa/buscarInformacaoParametro");

E a também a pasta precisa se chamar projeto_agenda
...........................................................................
