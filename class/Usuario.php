<?php
class Usuario{
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function setIdusuario($value){
		$this-> idusuario = $value;
	}
	public function setDeslogin($value){
		$this-> deslogin = $value;
	}
	public function setDessenha($value){
		$this-> dessenha = $value;
	}
	public function setDtcadastro($value){
		$this-> dtcadastro = $value;
	}

	public function getIdusuario(){
		return $this -> idusuario;
	}
	public function getDeslogin(){
		return $this-> deslogin;
	}
	public function getDessenha(){
		return $this-> dessenha;
	}
	public function getDtcadastro(){
		return $this-> dtcadastro;
	}
	public function loadById($id){		
		$sql = new Sql();
		//retorna um usuario no formato de array
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID",
			array(":ID" => $id));

		if(count($results) > 0)
		{
			$row =  $results[0];
			$this -> setIdusuario($row['idusuario']);
			$this -> setDessenha($row['dessenha']);
			$this -> setDeslogin($row['deslogin']);
			$this -> setDtcadastro(new DateTime($row['dtcadastro']));
		}
	}
	public static function getList(){
		$sql = new Sql();
		return $sql ->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
	}
	public static function search($login){
		$sql = new Sql();
		return $sql -> select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			':SEARCH'=>"%".$login."%"
		));
	}
	public function login($login, $pass){
		$sql = new Sql();
		//retorna um usuario no formato de array
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha =:PASS" ,
			array(
				":LOGIN" => $login,
				":PASS"=>$pass
			));

		if(count($results) > 0)
		{
			$row =  $results[0];
			$this -> setIdusuario($row['idusuario']);
			$this -> setDessenha($row['dessenha']);
			$this -> setDeslogin($row['deslogin']);
			$this -> setDtcadastro(new DateTime($row['dtcadastro']));
		}else{
			throw new Exception("Loghin e/ou senha invalido");
			
		}
	}
	public function __toString(){
		return json_encode(array(
			"idusuario"=> $this-> getIdusuario(),
			"deslogin"=> $this-> getDeslogin(),
			"dessenha"=> $this-> getDessenha(),
			"dtcadastro"=> $this-> getDtcadastro()->format("d/m/y H:i:s")

		));
	}
}
?>