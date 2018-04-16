<?php
class UploadImage {
	private $arquivo;
	private $altura;
	private $largura;
	private $pasta;
	public $fileName;

	function __construct($arquivo, $altura, $largura, $pasta){
		$this->arquivo = $arquivo;
		$this->altura  = $altura;
		$this->largura = $largura;
		$this->pasta   = $pasta;
	}
	
	private function getExtensao(){
		return $extensao = strtolower(end(explode('.', $this->arquivo['name'])));
	}
	
	private function ehImagem($extensao){
		$extensoes = array('gif', 'jpeg', 'jpg', 'png');
		if (in_array($extensao, $extensoes))
			return true;
		else 
			return false;
	}
	
	private function redimensionar($imgLarg, $imgAlt, $tipo, $img_localizacao){
		//descobrir novo tamanho sem perder a proporcao
		if ( $imgLarg > $imgAlt ){
			$novaLarg = $this->largura;
			$novaAlt = round( ($novaLarg / $imgLarg) * $imgAlt );
		}
		elseif ( $imgAlt > $imgLarg ){
			$novaAlt = $this->altura;
			$novaLarg = round( ($novaAlt / $imgAlt) * $imgLarg );
		}
		else // altura == largura
			$novaAltura = $novaLargura = max($this->largura, $this->altura);
		
		//redimencionar a imagem
		
		//cria uma nova imagem com o novo tamanho	
		$novaimagem = imagecreatetruecolor($novaLarg, $novaAlt);
		
		switch ($tipo){
			case 1:	// gif
				$origem = imagecreatefromgif($img_localizacao);
				imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0,
				$novaLarg, $novaAlt, $imgLarg, $imgAlt);
				imagegif($novaimagem, $img_localizacao);
				break;
			case 2:	// jpg
				$origem = imagecreatefromjpeg($img_localizacao);
				imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0,
				$novaLarg, $novaAlt, $imgLarg, $imgAlt);
				imagejpeg($novaimagem, $img_localizacao);
				break;
			case 3:	// png
				$origem = imagecreatefrompng($img_localizacao);
				imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0,
				$novaLarg, $novaAlt, $imgLarg, $imgAlt);
				imagepng($novaimagem, $img_localizacao);
				break;
		}
		
		//destroi as imagens criadas
		imagedestroy($novaimagem);
		imagedestroy($origem);
	}
	
	public function salvar(){
		$extensao = $this->getExtensao();
		if ($this->ehImagem($extensao) === true){
			$novo_nome = time() . '.' . $extensao;
			$destino = $this->pasta . $novo_nome;
			$this->fileName = $novo_nome;
			if (! move_uploaded_file($this->arquivo['tmp_name'], $destino)){
				if ($this->arquivo['error'] == 1)
					return "Tamanho excede o permitido";
				else
					return "Erro " . $this->arquivo['error'];
			}
			list($largura, $altura, $tipo, $atributo) = getimagesize($destino);
			
			//if(($largura > $this->largura) || ($altura > $this->altura))
			//	$this->redimensionar($largura, $altura, $tipo, $destino);
			return true;
		}
		return "Formato inválido de imagem. Apenas formatos: GIF, JPG e PNG";
	}
}
?>