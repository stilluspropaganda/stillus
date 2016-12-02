<?php class sistema{
	private $_tipo = 'mysql';
	private $_servidor = '186.250.243.55';
	private $_usuario = 'stillus_user';
	private $_senha = 'eph3kPF';
	private $_banco = 'stillus_stillus2017';
	
	public $_ADM_NOME = "Stillus Propaganda";
	public $_ADM_EMAIL = "guilherme@stilluspropaganda.com";
	
	//Configuração Padrão
	public $_PROJETO_TITULO = "Stillus Propaganda";
	public $_PROJETO_DESCRICAO = "Stillus Propaganda";
	public $_PROJETO_KEYWORDS = "Stillus Propaganda";
	public $_PROJETO_AUTHOR = "Stillus Propaganda";
	public $_TEMPLATE = "stillus";
	
	//DADOS ONLINE
	private $_URL = "http://www.stilluspropaganda.com/2017/";
	private $_PASTA = "/home/stillus/public_html/2017/";
	
	//DADOS LOCALHOST
	private $_L_URL = "http://localhost/stillus2017/";
	private $_L_PASTA = "C:/xampp/htdocs/stillus2017/";
	
	//DADOS SMTP
	private $_SMTP_NOME_REMETENTE = "Stillus Propaganda";
	private $_SMTP_EMAIL = "guilherme@stilluspropaganda.com";
	private $_SMTP_HOST = "mail.stilluspropaganda.com";
	private $_SMTP_PORTA = "587";
	private $_SMTP_SEGURANCA = "tls";
	private $_SMTP_USER = "guilherme@stilluspropaganda.com";
	private $_SMTP_SENHA = "mt1630STILLUS";
	
	private function pdo(){
		if($_SERVER['HTTP_HOST']=='localhost'){
			try{
				$pdo = new PDO("mysql:host=localhost;dbname=stillus2017","root","",
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}else{
			try{
				$pdo = new PDO($this->_tipo.":host=".$this->_servidor.";dbname=".$this->_banco."",$this->_usuario,$this->_senha,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		return $pdo;
	}//Fehca pdo
	
	public function select($tabela, $campos=NULL, $inner=NULL, $where=NULL, $order=NULL, $limit=NULL){
		$pdo = $this->pdo();
		$sql = "SELECT ";
		if(!is_null($campos)){
			$sql .= $campos." FROM ";
		}else{$sql .= "* FROM ";}
		$sql .= $tabela;
		if(!is_null($inner)){
			$sql .= " INNER JOIN ".$inner;
		}
		if(!is_null($where)){
			$sql .= " WHERE ".$where;
		}
		if(!is_null($order)){
			$sql .= " ORDER BY ".$order;
		}
		if(!is_null($limit)){
			$sql .= " LIMIT ".$limit;
		}
		$busca = $pdo->prepare($sql);
		$busca->execute();
		
		$retorno = $busca->fetchAll(PDO::FETCH_ASSOC);
		return $retorno;
	}//Fecha select
	
	public function insert($tabela, $dados){
		$pdo = $this->pdo();
		$sql = "INSERT INTO ".$tabela." SET ".$dados;
		$insert = $pdo->prepare($sql);
		$insert->execute();
		$lastId = $pdo->lastInsertId();
		return $lastId;
	}//Fecha insert
	
	public function update($tabela, $dados, $chave, $chave_valor){
		$pdo = $this->pdo();
		$sql = "UPDATE ".$tabela." SET ".$dados." WHERE ".$chave."='".$chave_valor."'";
		$update = $pdo->prepare($sql);
		$update->execute();
		if($update->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}//Fecha update
	
	public function delete($tabela, $chave, $chave_valor){
		$pdo = $this->pdo();
		$sql = "DELETE FROM ".$tabela." WHERE ".$chave."='".$chave_valor."'";
		$delete = $pdo->prepare($sql);
		$delete->execute();
		if($delete->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}//Fecha delete
	
	public function url_base(){
		if($_SERVER['HTTP_HOST']=='localhost'){
			return $this->_L_URL;
		}else{
			return $this->_URL;
		}
	}//Fecha url_base
	
	public function pasta_base(){
		if($_SERVER['HTTP_HOST']=='localhost'){
			return $this->_L_PASTA;
		}else{
			return $this->_PASTA;
		}
	}//Fecha url_base
	
	public function data_padrao($data){
		$d = explode("/",$data);
		return $d['2'].'-'.$d['1'].'-'.$d['0'];
	}//Fecha data_padrao
	
	public function data($data,$mascara){
		return date_format(date_create($data),$mascara);
	}//Fecha data
	
	public function enviaEmail($nome,$email,$assunto,$corpo,$array=false){
		require("phpmailer/class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = $this->_SMTP_HOST;
		$mail->Port = $this->_SMTP_PORTA;
		$mail->SMTPAuth = true;
		//$mail->SMTPSecure = "ssl";
		$mail->Username = $this->_SMTP_USER;
		$mail->Password = $this->_SMTP_SENHA;
		$mail->From = $this->_SMTP_EMAIL;
		$mail->Sender = $this->_SMTP_EMAIL;
		$mail->FromName = $this->_SMTP_NOME_REMETENTE;
		if($array){
			$cNome = count($nome);
			for($i=0;$i<$cNome;$i++){
				$mail->AddAddress($email[$i], $nome[$i]);
			}
		}else{
			$mail->AddAddress($email, $nome);
		}
		$mail->IsHTML(true);
		$mail->CharSet = 'utf-8';
		$mail->Subject  = $assunto;
		$mail->Body = $corpo;
		$mail->AltBody = 'Para ler este e-mail é necessário um leitor de e-mail que suporte mensagens em HTML.';
		$enviado = $mail->Send();
		$mail->ClearAllRecipients();
		$mail->ClearAttachments();
		if ($enviado) {
			return true;
		}else{
			return false;
		}
	}//Fecha enviaEmail
	
	public function slug($str, $replace=array(), $delimiter='-') {
		if( !empty($replace) ) {
			$str = str_replace((array)$replace, ' ', $str);
		}
	 
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z.0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
	 
		return $clean;
	}//Fecha Slug
	
	public function ver_permissao($permissoes,$modulo){
		$array_permissoes = explode(",",$permissoes);
		$select = $this->select("users_modulos","id",null,"modulo='$modulo'",null,null);
		if(is_array($select) && (count($select) > 0)){
			$dados = $select[0];
			$id_modulo = $dados['id'];
			if(in_array($id_modulo,$array_permissoes)){
				return true;
			}else{
				return false;
			}	
		}else{
			return false;
		}
	}//Fecha ver_permissao
	
	
}//Fecha class sistema
?>