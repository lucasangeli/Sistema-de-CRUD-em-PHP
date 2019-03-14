<?php
	require_once "classes/db/DBConexao.php";

	abstract class DBFruta extends DBConexao
	{	
		//DBInserir
        public static function DBInserir(Fruta $fruta)
        {
            $conexao = parent::getDB();
    
            $query = pg_query($conexao, "INSERT INTO fruta (nomeFRT, precoFRT, qtdFRT) 
                                        VALUES ('".$fruta->getnomeFRT()."', '".$fruta->getprecoFRT()."' , '".$fruta->getqtdFRT()."')");
                
            if ($query)
            {
                return "Inserido com sucesso";
            }
            else
            {
                return "Erro ao inserir";
            }
        }
		
		public static function DBListar()
        {
            $conexao = parent::getDB();

            $query = pg_query($conexao, "SELECT codFRT, nomeFRT, precoFRT, qtdFRT FROM fruta ORDER BY codFRT");

            return pg_fetch_all($query);
        }

        //DBAtualizar
        public static function DBAtualizar(Fruta $fruta)
        {
            $conexao = parent::getDB();

            $query = pg_query("UPDATE fruta SET nomefrt = '".$fruta->getnomeFRT()."', qtdfrt = '".$fruta->getqtdFRT()."', precofrt = '".$fruta->getprecoFRT()."' WHERE codfrt = ".$fruta->getcodFRT());
            
            if ($query)
            {
                return "Alterado com sucesso";
            }
            else
            {
                return "Erro ao alterar";
            }
        }

        //Função DBBuscar
        //Função usada quando o usuário clica no link EDITAR da tabela que lista
        //os funcionários
        //O objetivo aqui é retornar todos os dados do funcionário que teve seu botão
        //EDITAR clicado
        public static function DBBuscar($codFRT)
        {
            $conexao = parent::getDB();

            $query = pg_query($conexao,"SELECT codFRT, nomeFRT, precoFRT, qtdFRT  FROM fruta
                                         WHERE codFRT = '".$codFRT."'");

            $dataSetFruta = pg_fetch_assoc($query);

            //Será carregado um objeto Funcionario
            if($dataSetFruta) {
                $fruta = new Fruta();
                $fruta->setcodFRT($dataSetFruta["codfrt"]);
                $fruta->setnomeFRT($dataSetFruta["nomefrt"]);
                $fruta->setprecoFRT($dataSetFruta["precofrt"]);
                $fruta->setqtdFRT($dataSetFruta["qtdfrt"]);
   
                return $fruta;
            }

            return false;
        }
		//função para excluir
		public static function DBExcluir($codFRT)
        {
            $conexao = parent::getDB();

            $query = pg_query($conexao, "DELETE FROM fruta WHERE codFRT = '".$codFRT."'");

            if ($query)
            {
                return "Excluído com sucesso";
            }
            else
            {
                return "Erro ao excluir";
            }
        }
	}
			
?>
