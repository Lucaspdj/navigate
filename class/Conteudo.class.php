<?php
class Conteudo {
	private $id;
	function __construct($id){
		$this->id = base64_decode($id);
	}
	
	public function get($id){
		if(!isset($id)) return null;
		global $core;
		$sql = $core->Select("vw_conteudo", array(
    				"deleted" => '0',
    				"id" => $core->limpa($id)
				), "*", 1);
		if($sql->num_rows > 0){
			return $sql->fetch_array();
		}
		return null;
	}
	
	public function getInstitucional($id){
		if(!isset($id)) return null;
		global $core;
		$sql = $core->Select("institucional", array(
    				"deleted" => '0',
    				"id" => $core->limpa($id)
				), "*", 1);
		if($sql->num_rows > 0){
			return $sql->fetch_array();
		}
		return null;
	}
	
	public function deleteConteudo($id){
		if(!isset($id)) return null;
		global $core;
		return $core->Update("conteudo",
						array( // set
							"deleted" => '1',
							"dt_updated" => date("Y-m-d H:i:s")
						),
						array( // where
							"id" => $core->limpa($id)
						));
	}
	
	public function listAll($id=null){
		global $core;
		if(!isset($id))
			$sql = $core->Select("vw_conteudo", null, "*", null, "id", "DESC");
		else 
			$sql = $core->Select("vw_conteudo", array("secoes_id"=>$core->limpa($id)), "*", null, "id", "DESC");
		
		if($sql->num_rows > 0){
			return $sql;
		}
		return null;
	}
	
	public function HP_List($id){
		if(!isset($id)) return null;
		global $core;
		$sql = $core->Select("vw_conteudo", array("secoes_id"=>$core->limpa($id)), "*", 3, "id", "DESC");
		if($sql->num_rows > 0){
			return $sql;
		}
		return null;
	}
	
	public function find($data){
		global $core;
		$sql = $core->Select("vw_conteudo", array(
    				"titulo" => strip_tags($data['titulo']),
    				"deleted" => '0',
    				"ativo" => strip_tags($data['ativo'])
				), "id", 1, "id", "DESC");
		if($sql->num_rows > 0){
			return $sql->fetch_array();
		}
		return null;
	}
	
	public function findInstitucional($data){
		global $core;
		$sql = $core->Select("institucional", array(
    				"titulo" => strip_tags($data['titulo']),
    				"secoes_id" => strip_tags($data['secoes_id']),
    				"deleted" => '0'
				), "id", 1, "id", "DESC");
		if($sql->num_rows > 0){
			return $sql->fetch_array();
		}
		return null;
	}
	
	public function save($data){
		try{
			global $core;
			if(is_array($data)){
				unset($data["action"]);
				$check = $this->get(base64_decode($data["id"]));
				if($check!=null){
					return $core->Update("conteudo",
											array( // set
												"categorias_id" => strip_tags($data['categorias_id']),
												"banner" => strip_tags($data['banner']),
												"titulo" => strip_tags($data['titulo']),
												"destaque" => str_replace("<script","<5cr1pt",trim($data['destaque'])),
												"img_destaque" => strip_tags($data['img_destaque']),
												"conteudo" => str_replace("<script","<5cr1pt",trim($data['conteudo'])),
												"aba_roteiro" => str_replace("<script","<5cr1pt",trim($data['aba_roteiro'])),
												"aba_oque_inclui" => str_replace("<script","<5cr1pt",trim($data['aba_oque_inclui'])),
												"preco" => strip_tags($data['preco']),
												"preco_detalhe" => strip_tags($data['preco_detalhe']),
												"periodo_inicio" => strip_tags($data['periodo_inicio']),
												"periodo_fim" => strip_tags($data['periodo_fim']),
												"periodo_duracao" => strip_tags($data['periodo_duracao']),
												"passagens" => (isset($data['passagens'])) ? '1':'0',
												"estadia" => (isset($data['estadia'])) ? '1':'0',
												"alimentacao" => (isset($data['alimentacao'])) ? '1':'0',
												"pdf_file" => strip_tags($data['pdf_file']),
												"ativo" => strip_tags($data['ativo']),
												"dt_updated" => date("Y-m-d H:i:s")
											),
											array( // where
												"id" => $core->limpa($check['id'])
											));
				}
				else{
					return $core->Insert("conteudo", 
											array(
												"categorias_id" => (isset($data['categorias_id'])) ? strip_tags($data['categorias_id']) : null,
												"banner" => strip_tags($data['banner']),
												"titulo" => strip_tags($data['titulo']),
												"destaque" => str_replace("<script","<5cr1pt",trim($data['destaque'])),
												"img_destaque" => strip_tags($data['img_destaque']),
												"conteudo" => str_replace("<script","<5cr1pt",trim($data['conteudo'])),
												"aba_roteiro" => str_replace("<script","<5cr1pt",trim($data['aba_roteiro'])),
												"aba_oque_inclui" => str_replace("<script","<5cr1pt",trim($data['aba_oque_inclui'])),
												"preco" => strip_tags($data['preco']),
												"preco_detalhe" => strip_tags($data['preco_detalhe']),
												"periodo_inicio" => strip_tags($data['periodo_inicio']),
												"periodo_fim" => strip_tags($data['periodo_fim']),
												"periodo_duracao" => strip_tags($data['periodo_duracao']),
												"passagens" => (isset($data['passagens'])) ? '1':'0',
												"estadia" => (isset($data['estadia'])) ? '1':'0',
												"alimentacao" => (isset($data['alimentacao'])) ? '1':'0',
												"pdf_file" => strip_tags($data['pdf_file']),
												"ativo" => strip_tags($data['ativo'])
											));
				}
			}
			return false;
		}
		catch(Error $e){
			return false;
		}
	}
	
	public function saveInstitucional($data){
		try{
			global $core;
			if(is_array($data)){
				unset($data["action"]);
				$check = $this->getInstitucional(base64_decode($data["id"]));
				if($check!=null){
					return $core->Update("institucional",
											array( // set
												"titulo" => strip_tags($data['titulo']),
												"secoes_id" => strip_tags($data['secoes_id']),
												"conteudo" => str_replace("<script","<5cr1pt",trim($data['conteudo'])),
												"dt_updated" => date("Y-m-d H:i:s")
											),
											array( // where
												"id" => $core->limpa($this->id)
											));
				}
				else{
					return $core->Insert("institucional", 
											array(
												"titulo" => strip_tags($data['titulo']),
												"secoes_id" => strip_tags($data['secoes_id']),
												"conteudo" => str_replace("<script","<5cr1pt",trim($data['conteudo']))
											));
				}
			}
			return false;
		}
		catch(Error $e){
			return false;
		}
	}
	
	public function getCross($id){
		try{
			if(!isset($id)) return null;
			global $core;
			$return=null;
			$sql = $core->Select("cross_content", array("conteudo_id"=>$core->limpa($id)), "*", 2, "id", "ASC");
			if($sql->num_rows > 0){
				$return = array();
				while($rows = $sql->fetch_array()) {
					$return[] = array('id' => $rows['id'], 'conteudo_id' => $rows['conteudo_id'], 'conteudo_vinculado' => $rows['conteudo_vinculado']);  
				}
			}
			return $return;
		}
		catch(Error $e){
			return false;
		}
	}
	
	public function saveCross($id, $cross1, $cross2){
		try{
			if(isset($id) && (isset($cross1) || isset($cross2)))
			{
				global $core;
				$core->delete("cross_content", array("conteudo_id"=>$id));
				
				if(!empty($cross1)) $core->Insert("cross_content", array("conteudo_id" => strip_tags($id),"conteudo_vinculado" => strip_tags($cross1)));
				if(!empty($cross2)) $core->Insert("cross_content", array("conteudo_id" => strip_tags($id),"conteudo_vinculado" => strip_tags($cross2)));
			}
			return true;
		}
		catch(Error $e){
			return false;
		}
	}
}
?>