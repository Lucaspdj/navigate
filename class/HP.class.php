<?php
class HP {
	private $id;
	function __construct($id){
		$this->id = base64_decode($id);
	}
	
	public function getBanner($id){
		if(!isset($id)) return null;
		global $core;
		$sql = $core->Select("hp_banners", array(
    				"deleted" => '0',
    				"id" => $core->limpa($id)
				), "*", 1);
		if($sql->num_rows > 0){
			return $sql->fetch_array();
		}
		return null;
	}
	
	public function getLastPublicidade(){
		global $core;
		$sql = $core->Select("publicidade", array(
    				"deleted" => '0',
    				"ativo" => '1'
				), "*", 1, "id", "DESC");
		if($sql->num_rows > 0){
			return $sql->fetch_array();
		}
		return null;
	}
	
	public function getPublicidade($id){
		if(!isset($id)) return null;
		global $core;
		$sql = $core->Select("publicidade", array(
    				"deleted" => '0',
    				"id" => $core->limpa($id)
				), "*", 1);
		if($sql->num_rows > 0){
			return $sql->fetch_array();
		}
		return null;
	}
	
	public function deleteBanner($id){
		if(!isset($id)) return null;
		global $core;
		return $core->Update("hp_banners",
						array( // set
							"deleted" => '1',
							"dt_updated" => date("Y-m-d H:i:s")
						),
						array( // where
							"id" => $core->limpa($id)
						));
	}
	
	public function deletePublicidade($id){
		if(!isset($id)) return null;
		global $core;
		return $core->Update("publicidade",
						array( // set
							"deleted" => '1',
							"dt_updated" => date("Y-m-d H:i:s")
						),
						array( // where
							"id" => $core->limpa($id)
						));
	}
	
	public function findBanner($data, $image){
		global $core;
		$sql = $core->Select("hp_banners", array(
    				"titulo" => strip_tags($data['banner_nome']),
    				"deleted" => '0',
    				"image" => strip_tags($image),
    				"url" => strip_tags($data['banner_url'])
				), "id", 1);
		if($sql->num_rows > 0){
			return $sql->fetch_array();
		}
		return null;
	}
	
	public function findPublicidade($data, $image){
		global $core;
		$sql = $core->Select("publicidade", array(
    				"titulo" => strip_tags($data['banner_nome']),
    				"deleted" => '0',
    				"arquivo" => strip_tags($image),
    				"url" => strip_tags($data['banner_url'])
				), "id", 1);
		if($sql->num_rows > 0){
			return $sql->fetch_array();
		}
		return null;
	}
	
	public function listBanners(){
		global $core;
		$sql = $core->Select("hp_banners", array("deleted"=>0), "*", null, "id");
		if($sql->num_rows > 0){
			return $sql;
		}
		return null;
	}
	
	public function listPublicidade(){
		global $core;
		$sql = $core->Select("publicidade", array("deleted"=>0), "*", null, "id");
		if($sql->num_rows > 0){
			return $sql;
		}
		return null;
	}
	
	public function saveBanner($data, $image){
		try{
			global $core;
			if(is_array($data)){
				unset($data["action"]);
				$check = $this->getBanner($this->id);
				
				if($check!=null){
					return $core->Update("hp_banners",
											array( // set
												"titulo" => strip_tags($data['banner_nome']),
												"image" => strip_tags($image),
												"url" => strip_tags($data['banner_url']),
												"ativo" => strip_tags($data['banner_ativo']),
												"dt_updated" => date("Y-m-d H:i:s")
											),
											array( // where
												"id" => $core->limpa($this->id)
											));
				}
				else{
					return $core->Insert("hp_banners", 
											array(
												"titulo" => strip_tags($data['banner_nome']),
												"image" => strip_tags($image),
												"url" => strip_tags($data['banner_url']),
												"ativo" => strip_tags($data['banner_ativo'])
											));
				}
			}
			return false;
		}
		catch(Error $e){
			return false;
		}
	}
	
	public function savePublicidade($data, $image){
		try{
			global $core;
			if(is_array($data)){
				unset($data["action"]);
				$check = $this->getPublicidade($this->id);
				if($check!=null){
					return $core->Update("publicidade",
											array( // set
												"titulo" => strip_tags($data['banner_nome']),
												"arquivo" => strip_tags($image),
												"url" => strip_tags($data['banner_url']),
												"ativo" => strip_tags($data['banner_ativo']),
												"dt_updated" => date("Y-m-d H:i:s")
											),
											array( // where
												"id" => $core->limpa($this->id)
											));
				}
				else{
					return $core->Insert("publicidade", 
											array(
												"titulo" => strip_tags($data['banner_nome']),
												"arquivo" => strip_tags($image),
												"url" => strip_tags($data['banner_url']),
												"ativo" => strip_tags($data['banner_ativo'])
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