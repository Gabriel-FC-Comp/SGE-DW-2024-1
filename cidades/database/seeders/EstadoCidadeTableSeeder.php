<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PDO;

class EstadoCidadeTableSeeder extends Seeder
{

    function executarSQL($db, $sql){

		try {

			if($db->query($sql)){
				echo "<h3>SQL: [". $sql ."] realizada com sucesso!</h3>";
			} else {
				echo "<h3>ERRO na SQL: ". $sql ." </h3>";
			}

		} catch(PDOException $e){
			echo '<h3>EXCEPTION1: ' . $e->getMessage() . '</h3>';
		}
	}

	function lerArquivoCidades($db, $fp, $fname){
		
		$separador = ',';
		$delimitador = '"'; //aspas duplas

		//Ignora a primeira linha (cabecalho do arquivo)
		if(is_resource($fp))
			$linha = fgetcsv($fp, 0, $separador, $delimitador); //$linha eh um vetor

		//Leh as demais linhas
		$status = true;
		while(!feof($fp)){
			
			//Ler uma linha do arquivo
			$linha = fgetcsv($fp, 0, $separador, $delimitador); //$linha eh um vetor

			if($linha!=NULL){
				//var_dump($linha);
				if($status)
					echo '<div class="selecionado">';
				else
					echo '<div>';

				echo 'Estado: ' . $linha[0] . ' CodigoCidade: ' . $linha[2] . ' Nome: ' . $linha[3];
				
				//Consulta a tabela de 'estados' para buscar a 'sigla'
				$sql = 'SELECT sigla FROM estados WHERE sigla=\'' . $linha[0] .'\';';
				//echo $sql;
				//executarSQL($db,$sql);

				$res = $db->query($sql);
				if($res){
					$res->setFetchMode(PDO::FETCH_OBJ);
	
					while( $tupla = $res->fetch() ){ //recupera uma linha por vez
				
						foreach($tupla as $coluna){
							echo ' Sigla_Estado: ' . $coluna;
							$sigla_estado = $coluna;
						}
					}
					echo "<h3>SELECT: Consulta realizada com sucesso!</h3>";
				} else {
					echo "<h3>ERRO6: Erro na consulta.</h3>";
				}

				$status = !$status; //Apenas para exibir no CSS
			
				$nome = $linha[3];
				$codigo_cidade = $linha[2];
				$this->executarSQL($db, 'INSERT INTO cidades(codigo,nome,sigla_estado) VALUES ( "' . 
				$codigo_cidade . '", "' . 
				$nome . '", "' . 
				$sigla_estado . '");', $status);
				
				echo '</div>';
			}

		}

		echo '<h3>Fim da leitura do arquivo: [' . $fname . ']</h3><br>';
		
	}
	
	function lerArquivoEstados($db, $fp, $fname){
		
		$separador = '|';
		$delimitador = '"'; //aspas duplas

		//Ignora a primeira linha (cabecalho do arquivo)
		if(is_resource($fp))
			$linha = fgetcsv($fp, 0, $separador, $delimitador); //$linha eh um vetor

		//Leh as demais linhas
		$status = true;
		while(!feof($fp)){
			
			if($status)
				echo '<div class="selecionado">';
			else
				echo '<div>';

			//Ler uma linha do arquivo
			$linha = fgetcsv($fp, 0, $separador, $delimitador); //$linha eh um vetor

			if($linha!=NULL){
				//var_dump($linha);
				/*echo $linha[0] . ' ' . $linha[1];
				for($i=0;$i<count($linha);$i++){
					$linha[i] = utf8_encode($linha[i]);
					echo '<h3>' . $linha[i] . '</h3><br>';

				}*/
				$status = !$status;

				$this->executarSQL($db, 'INSERT INTO estados(sigla,nome) VALUES ( "' . \ 
				utf8_encode($linha[0]) . '", "' . \
				utf8_encode($linha[1]) . '");', $status);
			
			}
			echo '</div>';
		}

		echo '<h3>Fim da leitura do arquivo: [' . $fname . ']</h3><br>';
		
	}

	function fecharArquivo($fp,$fname){
		
		echo '<h3>'.var_dump($fp).'</h3><br>';
		fclose($fp);
		echo '<h3>'.var_dump($fp).'</h3><br>';
		if(is_resource($fp)){ //Da documentacao do PHP
			echo '<h3>ERRO: Erro ao fechar o arquivo: [' . $fname . ']</h3><br>';
		} else {
			echo '<h3>Arquivo: [' . $fname . '] fechado com sucesso!</h3><br>';
		}
	}

    function abrirArquivo($db,$fname){

		$fp = fopen('./'.$fname, 'r');
		var_dump($fp);
		if(!$fp){
			echo '<h3>ERRO: Erro na leitura do arquivo: ' . $fname . '</h3><br>';
		} else {
			echo '<h3>Arquivo: [' . $fname . '] aberto com sucesso!</h3><br>';
		}
		return $fp;
	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $DATABASE = "mysql";
		$HOST = "localhost";
		$DBNAME = "db_cidades"; //mysql> create database db_cidades;
		$USER = "ubuntu";
		$PASSWORD = "finger";
        $db = new PDO("$DATABASE: host=$HOST; dbname=$DBNAME", $USER, $PASSWORD); //Para o MySQL

        $fname = 'estados.txt';
		$fp = $this->abrirArquivo($db,$fname);

		//TODO5
        $this->lerArquivoEstados($db,$fp,$fname);

		//TODO7
		$this->fecharArquivo($fp,$fname);

		//TODO8
		$fname = 'municipios.csv';
		$fp = $this->abrirArquivo($db,$fname);

		//TODO9
		$this->lerArquivoCidades($db,$fp,$fname);
    }
}