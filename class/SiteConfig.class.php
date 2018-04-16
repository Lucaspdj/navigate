<?php
class SiteConfig {
	private $id;
	public function getValues(){
		try{
			global $core;
			$return = null;
			$sql = $core->Select("site_config", null, "name, value", null, "name");
			if($sql->num_rows > 0){
				$return = array();
				while($rows = $sql->fetch_array()) {
					$return[$rows['name']] = $rows['value']; 
				}
			}
			return $return;
		}catch(Error $e){
			return null;
		}
	}
	public function getSecao($id){
		if(!isset($id)) return null;
		global $core;
		$sql = $core->Select("secoes", array(
    				"id" => $core->limpa($id)
				), "*", 1);
		if($sql->num_rows > 0){
			return $sql->fetch_array();
		}
		return null;
	}
	public function getSecoes(){
		try{
			global $core;
			$return = null;
			$sql = $core->Select("secoes", null, "id, secao, banner", null, "id", "ASC");
			if($sql->num_rows > 0){
				$return = array();
				while($rows = $sql->fetch_array()) {
					$return[] = array('id' => $rows['id'], 'secao' => $rows['secao'], 'banner' => $rows['banner']);  
				}
			}
			return $return;
		}catch(Error $e){
			return null;
		}
	}
	public function listAllSubMenu(){
		global $core;
		$sql = $core->Select("vw_categorias", null, "*", null, "id", "ASC");
		if($sql->num_rows > 0){
			return $sql;
		}
		return null;
	}
	public function listSubMenu_Secao($secoes_id){
		if(!isset($secoes_id)) return null;
		global $core;
		$sql = $core->Select("vw_categorias", array("secoes_id"=> $core->limpa($secoes_id)), "*", null, "categoria", "ASC");
		if($sql->num_rows > 0){
			return $sql;
		}
		return null;
	}
	public function getSubmenu($id){
		if(!isset($id)) return null;
		global $core;
		$sql = $core->Select("vw_categorias", array(
    				"id" => $core->limpa($id)
				), "*", 1);
		if($sql->num_rows > 0){
			return $sql->fetch_array();
		}
		return null;
	}
	public function deleteSubMenu($id){
		if(!isset($id)) return null;
		global $core;
		$sql = $core->Delete("categorias", array(
    				"id" => $core->limpa($id)
				), "*", 1);
		if($sql->num_rows > 0){
			return $sql->fetch_array();
		}
		return null;
	}
	public function findSubmenu($secao, $categoria){
		global $core;
		$sql = $core->Select("vw_categorias", array(
    				"secoes_id" => strip_tags($secao),
    				"categoria" => strip_tags($categoria)
				), "id", 1, "categoria", "DESC");
		if($sql->num_rows > 0){
			return $sql->fetch_array();
		}
		return null;
	}
	public function findInstitucional($secao){
		global $core;
		$sql = $core->Select("institucional", array(
    				"secoes_id" => strip_tags($secao),
    				"deleted" => '0'
				), "id", 1, "id", "DESC");
		if($sql->num_rows > 0){
			return $sql->fetch_array();
		}
		return null;
	}
	public function saveSubmenu($data){
		try{
			global $core;
			if(is_array($data)){
				unset($data["action"]);
				$check = $this->getSubmenu(base64_decode($data['id']));
				if($check!=null){
					return $core->Update("categorias",
											array( // set
												"categoria" => strip_tags($data['categoria']),
												"secoes_id" => strip_tags($data['secao']),
												"dt_updated" => date("Y-m-d H:i:s")
											),
											array( // where
												"id" => $core->limpa($check['id'])
											));
				}
				else{
					return $core->Insert("categorias", 
											array(
												"secoes_id" => strip_tags($data['secao']),
												"categoria" => strip_tags($data['categoria'])
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