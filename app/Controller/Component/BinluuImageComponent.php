<?php

App::uses('Component', 'Controller');

/**
 * Componente para el manejo de imágenes de perfil de usuario
 */
class BinluuImageComponent extends Component {

	/**
	 * Función que salva o actualiza la imagen del perfil de un usuario.
	 * @param  [int]  $user_id    [id del usuario]
	 * @param  [file] $post_image [Archivo temporal que contiene la imagen]
	 * @return [bool]             [Estatus del guardado o actuzalición]
	 */
	public function saveImage($user_id, $post_image){
    	$user = ClassRegistry::init('User');
    	$user->id = $user_id;
    	$user_db = $user->read();
		if ($post_image['error'] === UPLOAD_ERR_OK) {
			if (move_uploaded_file($post_image['tmp_name'], WWW_ROOT.DS.'files'.DS.$post_image['name'])) {
				$user_db['User']['image'] = $post_image['name'];
				if($user->save($user_db, false)){
					return true;
				}else{
					return false;
				}	
			}else{
				return false;			
			}
		}
		else{
			return false;
		}
	}

	/**
	 * Función que genera una miniatura de la imagen del usuario
	 * @param  [int]     $user_id [id del usuario a obtener imagen miniatura]
	 * @param  [decimal] $percent [Porcentaje de reducción de ministura]
	 * @return [bool]             [Estatus del proceso a miniatura]
	 */
	public function thumb($user_id, $percent){
		$user = ClassRegistry::init('User');
		$user->id = $user_id;
    	$user_db = $user->read();
		$filename = WWW_ROOT.DS.'files'.DS.$user_db['User']['image'];

		$format='';
	    if(preg_match("/.jpg/i", "$filename"))
	    {
	        $format = 'image/jpeg';
	    }
	    if (preg_match("/.gif/i", "$filename"))
	    {
	        $format = 'image/gif';
	    }
	    if(preg_match("/.png/i", "$filename"))
	    {
	        $format = 'image/png';
	    }
	    if($format!='')
	    {
			list($width, $height) = getimagesize($filename);
			$newwidth = $width * $percent;
			$newheight = $height * $percent;
			switch($format)
	        {
	            case 'image/jpeg':
	            	$source = imagecreatefromjpeg($filename);
	            	break;
	            case 'image/gif';
	            	$source = imagecreatefromgif($filename);
	            	break;
	            case 'image/png':
	            	$source = imagecreatefrompng($filename);
	            	break;
	        }
	        $thumb = imagecreatetruecolor($newwidth, $newheight);
	        imagealphablending($thumb, false);
			imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

			if(imagejpeg($thumb, WWW_ROOT.DS.'files'.DS.'thumb_'.$user_db['User']['image'])){
				return true;
			}else{
				return false;
			}
		}
		return false;
	}

	/**
	 * Función que regresa la imagen por default para un usuario sin imagen.
	 * @param  [string] $user_sex ['M' o 'F']
	 * @return [string]           [Url de la imagen default]
	 */
	public function getDefaultImage($user_sex){
		switch ($user_sex) {
			case 'M':
				return WWW_ROOT.DS.'files'.DS.'default_img_male.jpg';
			case 'F':
				return WWW_ROOT.DS.'files'.DS.'default_img_female.jpg';
			default:
				return null;
		}		
	}
}

?>