<?php


    //Recebo os parâmestro que são enviados via ajax por post
    $dataInicial = $_POST['data_inicial'];
    $dataFinal = $_POST['data_final'];
    $status = $_POST['status_parametro'];    
        
    $ch = curl_init();

    //Armazendo em um array para depois , gerar um json deles e enviar para a api
	$arrayInfo = array(
        "data_inicial" => $dataInicial,
        "data_final" => $dataFinal,
        "status"=> $status
    );
    
    //armazendo a informação, já em json para enviar por post via api
    $informacao_parametro = json_encode($arrayInfo);

    //Envio a informação dos parâmetros via api 
    //Detalhe na parte do localhost:8080, você pode usar apenas localhost, ou localhost:(porta usada pelo seu xampp ou wampp ou servidor)
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/projeto_tarefa/buscarInformacaoParametro");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST , "POST");
    curl_setopt($ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $informacao_parametro);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
    ));

    //Recebo a resposta
    $response = curl_exec($ch);
    //Uso o json_decode para decodificar a informação e ela me criar o objeto 
    $informacao = json_decode($response);
?>


<div class="table-responsive">
    <table class="table table-hover" id="tabela_tarefa">
        <thead>
            <tr>
                <th><center> Código tarefa </center></th>
                <th><center> Titulo da tarefa </center></th>
                <th><center> Descrição  </center></th>
                <th><center> Status </center></th>
                <th><center> Data de criação </center></th>
                <th><center> Ação </center></th>
            </tr>
        </thead>
        <tbody>
            <?php
                 foreach($informacao as $informacoes_tarefa){
                   
                    //Verifico se a prioridade é alta se for tarefa cancelada ou concluida para mudar a cor delas
                    if ($informacoes_tarefa->status == "Cancelado"){
                        $classe = "background-color: #ff6666;";
                    }else if ($informacoes_tarefa->status == "Concluido"){
                        $classe = "background-color: #66ff33;";
                    }else{
                        $classe = null;
                    }
              
            ?>
            <tr id="tarefa<?= $informacoes_tarefa->codigo ?>" style="<?= $classe ?>">
                <td><center><?= $informacoes_tarefa->codigo ?> </center></td>
                <td><center><?= $informacoes_tarefa->titulo ?> </center></td>
                <td><center><?= $informacoes_tarefa->descricao ?> </center></td>
                <td><center><?= $informacoes_tarefa->status ?> </center></td>
                <td><center><?= date('d/m/Y', strtotime($informacoes_tarefa->data_criacao)) ?> </center></td>
                <td>
                    <center>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12">
                            <!-- Botão para alterar uma tarefa, envio para a função o código, titulo, descrição e status -->  
                            <button type="button" class="btn btn-primary btn-flat" onclick="alterarTarefa('<?= $informacoes_tarefa->codigo ?>', '<?= $informacoes_tarefa->titulo ?>', '<?= $informacoes_tarefa->descricao ?>', '<?= $informacoes_tarefa->status ?>')">Alterar tarefa</button>
                        </div>
                        <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12">
                            <br/>
                            <!-- Botão para excluir uma tarefa, envio para a função o código para excluir -->     
                            <button type="button" class="btn btn-danger btn-flat" onclick="excluirTarefa('<?= $informacoes_tarefa->codigo?>')" >Excluir tarefa</button>
                        </div>
                    </div>
                    </center>
                </td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>   
</div>
