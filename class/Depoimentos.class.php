<?php
class Depoimentos {
	private $id;
	function __construct($id){
		$this->id = base64_decode($id);
	}
	
	public function getDepoimento($id){
		if(!isset($id)) return null;
		global $core;
		$sql = $core->Select("depoimentos", array(
    				"deleted" => '0',
    				"id" => $core->limpa($id)
				), "*", 1);
		if($sql->num_rows > 0){
			return $sql->fetch_array();
		}
		return null;
	}
	
	public function deleteDepoimento($id){
		if(!isset($id)) return null;
		global $core;
		return $core->Update("depoimentos",
						array( // set
							"deleted" => '1',
							"dt_updated" => date("Y-m-d H:i:s")
						),
						array( // where
							"id" => $core->limpa($id)
						));
	}
	
	public function findDepoimento($data, $image){
		global $core;
		$sql = $core->Select("depoimentos", array(
    				"nome" => strip_tags($data['depoimento_nome']),
    				"deleted" => '0',
    				"foto" => strip_tags($image),
				), "id", 1);
		if($sql->num_rows > 0){
			return $sql->fetch_array();
		}
		return null;
	}
	
	public function HP_listDepoimentos(){
		global $core;
		$sql = $core->Select("depoimentos", array("deleted"=>0, "ativo"=>1), "*", 3, "id", "DESC");
		if($sql->num_rows > 0){
			return $sql;
		}
		return null;
	}
	
	public function listDepoimentos(){
		global $core;
		$sql = $core->Select("depoimentos", array("deleted"=>0), "*", null, "id");
		if($sql->num_rows > 0){
			return $sql;
		}
		return null;
	}
	
	public function saveDepoimento($data, $image){
		try{
			global $core;
			if(is_array($data)){
				unset($data["action"]);
				$check = $this->getDepoimento($this->id);
				
				if($check!=null){
					return $core->Update("depoimentos",
											array( // set
												"nome" => strip_tags($data['depoimento_nome']),
												"foto" => strip_tags($image),
												"depoimento" => strip_tags($data['depoimento_texto']),
												"ativo" => strip_tags($data['depoimento_ativo']),
												"dt_updated" => date("Y-m-d H:i:s")
											),
											array( // where
												"id" => $core->limpa($this->id)
											));
				}
				else{
					return $core->Insert("depoimentos", 
											array(
												"nome" => strip_tags($data['depoimento_nome']),
												"foto" => strip_tags($image),
												"depoimento" => strip_tags($data['depoimento_texto']),
												"ativo" => strip_tags($data['depoimento_ativo'])
											));
				}
			}
			return false;
		}
		catch(Error $e){
			return false;
		}
	}
}
?>