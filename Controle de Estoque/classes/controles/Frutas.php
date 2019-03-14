<?php
	require_once "classes/db/DBFruta.php";
	
	class Fruta extends DBFruta
	{
		private $codFRT;
		private $nomeFRT;
		private $precoFRT;
		private $qtdFRT;
		
		public function setcodFRT($valor)
		{
			$this->codFRT = $valor;
		}
		
		public function getcodFRT()
		{
			return $this->codFRT;
		}
		
		public function setnomeFRT($valor)
		{
			$this->nomeFRT = $valor;
		}
		
		public function getnomeFRT()
		{
			return $this->nomeFRT;
		}
		
		public function setprecoFRT($valor)
		{
			$this->precoFRT = $valor;
		}
		
		public function getprecoFRT()
		{
			return $this->precoFRT;
		}

		public function setqtdFRT($valor)
		{
			$this->qtdFRT = $valor;
		}
		
		public function getqtdFRT()
		{
			return $this->qtdFRT;
		}
		
		public function inserir()
		{
			return parent::DBInserir($this);
		}
		
		public function listar()
		{
			return parent::DBListar();
		}

		public function atualizar()
        {
            return parent::DBAtualizar($this);
		}
		
		public function buscar($codFRT)
        {
            return parent::DBBuscar($codFRT);
        }
		public function excluir($codFRT)
        {
            return parent::DBExcluir($codFRT);
        }
	}
?>