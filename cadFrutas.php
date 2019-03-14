<?php
    require_once "classes/controles/Frutas.php";

    //$fruta = new fruta();
	//O nome da classe de controle é Fruta, com a primeira maiúscula então
	$fruta = new Fruta();
	
    //Inserir funcionário
	//Verificar se alguém clicou em submit
    if (isset($_POST["cadastrar"])){
		
		//no campo input nome do formulário você colocou
		//para ele o nome "nomeTFR" e aqui no setnomeFRT, você
		//colocou "nomeFRT", letras invertidas eheh
        //$fruta->setnomeFRT($_POST["nomeFRT"]);
		$fruta->setnomeFRT($_POST["nomeTFR"]);
        
		$fruta->setprecoFRT($_POST["precoFRT"]);
        $fruta->setqtdFRT($_POST["qtdFRT"]);
        
        if ($fruta->inserir() == "Inserido com sucesso"){
            header("Location: cadFrutas.php");
        } else {
            echo '<script type="text/javascript">alert("Erro ao inserir");</script>';
        }
    }

    	 //Selecionar o funcionário ao clicar no link EDITAR
    //e carregar seus dados nos inputs do formulário desta página
    //lembrando que os inputs são carregados no código que existe direto no
    //input, ver código colocado no value de cada input
    if (isset($_GET["acao"])){
        switch ($_GET["acao"]){
            case "editar":
                $fruta_busca = $fruta->buscar($_GET["codfrt"]);
                break;
				
			case "excluir": 
                if ($fruta->excluir($_GET["codfrt"]) == "Excluído com sucesso"){
                    header("Location: cadFrutas.php");
                } else {
                    echo '<script type="text/javascript">alert("Erro ao deletar");</script>';
                }
                break;
        }
    }
	


    //Alterar funcionário
    //Ao clicar no botão submit do formulário
    //será verificado se o valor dele é alterar,
    //sendo alterar ele fará a chamada para o método atualizar
    if(isset($_POST["alterar"])){
		
		//Quando vamos alterar algo no banco, usamos a chave primária
		//como filtro no WHERE do UPDATE
		//Então você precisa passar para o objeto $fruta o código da fruta
		//Veja que no form eu coloquei mais um input type chamado de codigo
		$fruta->setcodFRT($_POST["codigo"]);
		
		//no campo input nome do formulário você colocou
		//para ele o nome "nomeTFR" e aqui no setnomeFRT, você
		//colocou "nomeFRT", letras invertidas eheh
        //$fruta->setnomeFRT($_POST["nomeFRT"]);
        $fruta->setnomeFRT($_POST["nomeTFR"]);
        
		$fruta->setprecoFRT($_POST["precoFRT"]);
        $fruta->setqtdFRT($_POST["qtdFRT"]);

        if($fruta->atualizar() == "Alterado com sucesso"){
            header("Location: cadFrutas.php");
        }else{
            echo '<script type="text/javascript">alert("Erro em alterar");</script>';
        }
    }


?>
<html lang="pt-br">
	<head>
		<meta charset="utf-8"/>
		<title>Cadastro de Frutas</title>
		<meta name="author" content="frutolandia">
		<meta name="description" content="Sistemas de Informação Manda">
	</head>
	<body>
		<form action="" method="POST">
			<!-- espaço para o código da fruta no formulário -->
			<div>Código</div>
			<input type="text" name="codigo"
				value="<?=(isset($fruta_busca))?($fruta_busca->getcodFRT()):("")?>"
				>
			
            <div>Nome</div>
            <input type="text" name="nomeTFR"
                value="<?=(isset($fruta_busca))?($fruta_busca->getnomeFRT()):("")?>"
                >
            

            <div>PREÇO</div>
            <input type="text" name="precoFRT" 
            	value="<?=(isset($fruta_busca))?($fruta_busca->getprecoFRT()):("")?>"
            	>

             <div>QUANTIDADE</div>
            <input type="text" name="qtdFRT"
            	 value="<?=(isset($fruta_busca))?($fruta_busca->getqtdFRT()):("")?>"
            	 >

            <div></div>
			<input type="submit"
                name="<?=(isset($_GET["acao"]) == "editar")?("alterar"):("cadastrar")?>"
                value="<?=(isset($_GET["acao"]) == "editar")?("Alterar"):("Cadastrar")?>"
            >
		</form>

        <div>
        <table>
            <tr>
                <td>CÓDIGO</td>
                <td>NOME</td>
                <td>PREÇO</td>
                <td>QUANTIDADE</td>

            </tr>
            <?php foreach((array)$fruta->listar() as $item){ ?>
                <tr>
                    <td><?=$item["codfrt"]?></td>
                    <td><?=$item["nomefrt"]?></td>
                    <td><?=$item["precofrt"]?></td>
                    <td><?=$item["qtdfrt"]?></td>

                    <td>
                        <a href="?acao=editar&codfrt=<?=$item["codfrt"]?>" title="Editar">Editar</a>
						<td>
                        <a href="?acao=excluir&codfrt=<?=$item["codfrt"]?>"
                            title="Excluir"
                            onclick="return confirm('Tem certeza que deseja deletar esse registro?');">
                            Excluir
                        </a>
                    </td>
                    </td>
                </tr>
            <?php } ?>
        </table>
        </div>
	</body>
</html>