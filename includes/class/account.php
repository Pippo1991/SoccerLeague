<?
class Account{
	public $account_id;
	protected $email;
	private $password;
	protected $prodays;
	private $refeer_id;
	public $language;
	protected $permissions;
	public $flag;

	public function __construct($id){
		$this->account_id=$id;
	}
	public function setEmail($e):boolean{

	}
	public function getEmail():string{
		return $this->email;
	}
	public function getProDays():int{

	}
	private function setProDays($days):boolean{
		$this->prodays=$days;
	}
	public function setPassword($p):boolean{
		$this->password=$p;
	}
	private function getPassword():string{

	}
	private function getPermission():string{

	}
	private function setPermission($perm){
		$this->permissions=$perm;
	}
	private function deleteAccount():boolean{

	}
}


/*
CREATE ACCOUNT CLASS
this class should create account and return account id for create a club
07/05/2015 - ADD checkclub name
*/

class CreateAccount{
	private $email;
	private $password;
	public $father;
	public $id_account;
	public $club;
	const $options = [
		    'cost' => 10
		];
	public $connection;

	public function __construct($c, $e,$p,$f='NULL'){
		$this->email=$e;
		$this->password=password_hash($p, PASSWORD_BCRYPT, $this->options);
		$this->father=$f;
		$this->connection=$c;
	}
	public function check():int{
		$query=pg_query($this->connection, "SELECT id_account FROM account where email='".$this->email."'");
		return pg_num_rows($query);
	}
	function clubname($clubname):int{
		$this->club=$clubname;
		$query=pg_query($this->connection, "SELECT id_club FROM club where clubname='".$this->club."'");
		return pg_num_rows($query);
	}
	function create(){
		$query=pg_query($this->connection, "INSERT INTO account(email, password, father, language, slvip) values ('".$this->email."', '".$this->password."', ".$this->father.", '1', '15') RETURNING id_account");
		$results=pg_fetch_array($query);
		$this->id_account=$results['id_account'];
	}
}