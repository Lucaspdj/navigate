<?php
class ReservaOnline {
	private $id;
	function __construct($id){
		$this->id = base64_decode($id);
	}
	
	public function get($id){
		if(!isset($id)) return null;
		global $core;
		$sql = $core->Select("reservas_online", array(
    				"deleted" => '0',
    				"id" => $core->limpa($id)
				), "*", 1);
		if($sql->num_rows > 0){
			return $sql->fetch_array();
		}
		return null;
	}
	
	public function deleteReserva($id){
		if(!isset($id)) return null;
		global $core;
		return $core->Update("reservas_online",
						array( // set
							"deleted" => '1',
							"dt_updated" => date("Y-m-d H:i:s")
						),
						array( // where
							"id" => $core->limpa($id)
						));
	}
	
	public function find($data, $image){
		global $core;
		$sql = $core->Select("reservas_online", array(
    				"reserva_nome" => strip_tags($data['reserva_nome']),
    				"deleted" => '0'
				), "id", 1, "reserva_nome", "DESC");
		if($sql->num_rows > 0){
			return $sql->fetch_array();
		}
		return null;
	}
	
	public function listAll(){
		global $core;
		$sql = $core->Select("reservas_online", array("deleted"=>0), "*", null, "id");
		if($sql->num_rows > 0){
			return $sql;
		}
		return null;
	}
	
	public function HP_list(){
		global $core;
		$sql = $core->Select("reservas_online", array("deleted"=>0), "*", 3, "id", "DESC");
		if($sql->num_rows > 0){
			return $sql;
		}
		return null;
	}
	
	public function save($data, $image){
		try{
			global $core;
			if(is_array($data)){
				unset($data["action"]);
				$check = $this->get($this->id);
				
				if($check!=null){
					return $core->Update("reservas_online",
											array( // set
												"reserva_nome" => strip_tags($data['reserva_nome']),
												"reserva_logo" => strip_tags($image),
												"reserva_url" => strip_tags($data['reserva_url']),
												"reserva_script" => $data['reserva_script'],
												"ativo" => strip_tags($data['reserva_ativo']),
												"dt_updated" => date("Y-m-d H:i:s")
											),
											array( // where
												"id" => $core->limpa($this->id)
											));
				}
				else{
					return $core->Insert("reservas_online", 
											array(
												"reserva_nome" => strip_tags($data['reserva_nome']),
												"reserva_logo" => strip_tags($image),
												"reserva_url" => strip_tags($data['reserva_url']),
												"reserva_script" => $data['reserva_script'],
												"ativo" => strip_tags($data['reserva_ativo'])
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