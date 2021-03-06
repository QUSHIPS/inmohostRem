<?php
/*
 * jQuery File Upload Plugin PHP Example 5.2.2
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://creativecommons.org/licenses/MIT/
 */

error_reporting(E_ALL | E_STRICT);

include('php/classes/class.upload.php');
include('php/conexion.php');
include('php/configFileUpload.php');

class UploadHandler
{
    private $options;

    function __construct($options=null) {
        $this->options = array(
            'script_url' => $_SERVER['PHP_SELF'],
            'upload_dir' => _URL_FOTOS_INMOCLICK.'/',
            'upload_url' => _URL_FOTOS_INMOCLICK.'/',
            'param_name' => 'files',
            // The php.ini settings upload_max_filesize and post_max_size
            // take precedence over the following max_file_size setting:
            'max_file_size' => null,
            'host_ftp' => _HOST_FTP,
            'usuario_ftp' => _USUARIO_FTP,
            'password_ftp' => _PASSWORD_FTP,
            'max_tam_imagen' => 150000,
            'min_file_size' => 1,
            'accept_file_types' => '/.+$/i',
            'max_number_of_files' => null,
            'discard_aborted_uploads' => true,
            'image_versions' => array(
                // Uncomment the following version to restrict the size of
                // uploaded images. You can also add additional versions with
                // their own upload directories:
                /*
                  'large' => array(
                  'upload_dir' => dirname(__FILE__).'/files/',
                  'upload_url' => dirname($_SERVER['PHP_SELF']).'/files/',
                  'max_width' => 1920,
                  'max_height' => 1200
                  ),
                 */
                'thumbnail' => array(
                    'upload_dir' => dirname(__FILE__).'/../thumbnails/',
                    'upload_url' => '/online/inmohostV2.0/thumbnails/',
                    'max_width' => 80,
                    'max_height' => 80
                )
            )
        );
        if ($options) {
            $this->options = array_merge_recursive($this->options, $options);
        }
    }

    private function get_file_object($file_name) {
        $file_path = $this->options['upload_dir'].$file_name;
        if (is_file($file_path) && $file_name[0] !== '.') {
            $file = new stdClass();
            $file->name = $file_name;
            $file->size = filesize($file_path);
            $file->url = $this->options['upload_url'].'image.php?width=80&height=80&image='.rawurlencode($file->name);
            foreach($this->options['image_versions'] as $version => $options) {
                if (is_file($options['upload_dir'].$file_name)) {
                    $file->{$version.'_url'} = $options['upload_url']
                        .rawurlencode($file->name);
                }
            }
            $file->delete_url = $this->options['script_url']
                .'?file='.rawurlencode($file->name);
            $file->delete_type = 'HEAD';
            return $file;
        }
        return null;
    }
    
    
                 //hacer copia
      private function ftp_copy($conn_id,$foto_original,$foto_nueva){

        //echo $conn_id." -".$foto_original." -".$foto_nueva;
            if(ftp_get($conn_id, '/tmp/'.$foto_original, _PATH_FTP_FOTOS.$foto_original,FTP_BINARY)){  
               // echo "entra 1";
                //ftp_site($conn_id, "chmod 0777 ".TEMPFOLDER.$foto_original);
                    if(ftp_put($conn_id,_PATH_FTP_FOTOS.$foto_nueva,'/tmp/'.$foto_original , FTP_BINARY)){
                 //       echo "entra 2";
                            unlink('/tmp/'.$foto_original) ;                                             
                            return true;
                    } else{                               

                return false;
            }

            }else{

            return false;
        }
    }

    
    

    private function get_file_objects($conn_id) {

        $fotos = array();

        if(isset($_GET['prp_id'])&&$_GET['prp_id']&&isset($_GET['usr_id'])&&$_GET['usr_id']){
            $query = "select * from fotos where prp_id=".$_GET['prp_id']." and usr_id=".$_GET['usr_id'];
            $result = mysql_query($query);
            if(mysql_num_rows($result)){

                while($fila = mysql_fetch_array($result)){

		    if(ftp_size($conn_id,_PATH_FTP_FOTOS.$fila['fo_enl'])!=-1&&ftp_size($conn_id,_PATH_FTP_FOTOS.$fila['fo_enl'])>0){
                       
                        if(!isset($_GET['duplicar']) || !($_GET['duplicar'])){
                            
                            $hash =$this->genRandomString(20);// md5_file($this->options['upload_dir'].$fila['fo_enl']);
                              
                            $fotos[] = array(
                                        "name"=>$fila['fo_enl'],
                                        "size"=>0,
                                        "url" => _URL_FOTOS_INMOCLICK.'/image.php?width=80&height=80&image='.$fila['fo_enl'],
                                        "delete_url"=> _PATH_INMOHOST."/system/fileupload.php?file=".$fila['fo_enl'],
                                        "delete_type"=>"HEAD",
                                        "hash" => $hash,
                                        "orden" => $fila['fo_nro'],
                                        "descripcion"=>  utf8_encode($fila['fo_desc']),
                                        "eliminada" =>0
                                );
                        }else{
               
                            
                            $name = $this->genRandomString(20);

                            if($this->ftp_copy($conn_id, $fila['fo_enl'], $name.'.jpg')){
                                $hash = $this->genRandomString(20);//md5_file( $this->options['upload_dir'].$name.'.jpg');

                                $fotos[] = array(
                                        "name"=>$name,
                                        "size"=>0,
                                        "url"=>_URL_FOTOS_INMOCLICK.'/'.$name.'.jpg',
                                        "delete_url"=>_PATH_INMOHOST."/system/fileupload.php?file=".$name,
                                        "delete_type"=>"HEAD",
                                    "hash" => $hash,
                                    "orden" => $fila['fo_nro'],
                                        "descripcion"=>  utf8_encode($fila['fo_desc']),
                                        "eliminada" =>0
                                );
                            }else{
                                $fotos[] = array(
                                        "name"=>  'eliminada',
                                        "size"=>0,
                                        "url"=>'',
                                        "delete_url"=>_PATH_INMOHOST."/system/fileupload.php?file=".$fila['fo_enl'],
                                        "delete_type"=>"HEAD",
                                        "error"=>"Foto Eliminada",
                                        "eliminada" =>1
                                );
                            }
                        }
                            
                    }else{
                        $fotos[] = array(
                                        "name"=>  'eliminada',
                                        "size"=>0,
                                        "url"=>'',
                                        "delete_url"=>_PATH_INMOHOST."/system/fileupload.php?file=".$fila['fo_enl'],
                                        "delete_type"=>"HEAD",
                                        "error"=>"Foto Eliminada",
                                        "eliminada" =>1
                        );
                    }
                }
                //die();
                ftp_close($conn_id);
            }
        }

        return $fotos;
    }

    private function create_scaled_image($file_name, $options) {
        $file_path = $this->options['upload_dir'].$file_name;
        $new_file_path = $options['upload_dir'].$file_name;
        list($img_width, $img_height) = @getimagesize($file_path);
        if (!$img_width || !$img_height) {
            return false;
        }
        $scale = min(
            $options['max_width'] / $img_width,
            $options['max_height'] / $img_height
        );
        if ($scale > 1) {
            $scale = 1;
        }
        $new_width = $img_width * $scale;
        $new_height = $img_height * $scale;
        $new_img = @imagecreatetruecolor($new_width, $new_height);
        switch (strtolower(substr(strrchr($file_name, '.'), 1))) {
            case 'jpg':
            case 'jpeg':
                $src_img = @imagecreatefromjpeg($file_path);
                $write_image = 'imagejpeg';
                break;
            case 'gif':
                $src_img = @imagecreatefromgif($file_path);
                $write_image = 'imagegif';
                break;
            case 'png':
                $src_img = @imagecreatefrompng($file_path);
                $write_image = 'imagepng';
                break;
            default:
                $src_img = $image_method = null;
        }
        $success = $src_img && @imagecopyresampled(
            $new_img,
            $src_img,
            0, 0, 0, 0,
            $new_width,
            $new_height,
            $img_width,
            $img_height
                ) && $write_image($new_img, $new_file_path);
        // Free up memory (imagedestroy does not delete files):
        @imagedestroy($src_img);
        @imagedestroy($new_img);
        return $success;
    }

    private function has_error($uploaded_file, $file, $error,$conn_id) {
        if ($error) {
            return $error;
        }
        if (!preg_match($this->options['accept_file_types'], $file->name)) {
            return 'acceptFileTypes';
        }
        if ($uploaded_file && is_uploaded_file($uploaded_file)) {
            $file_size = filesize($uploaded_file);
        } else {
            $file_size = $_SERVER['CONTENT_LENGTH'];
        }
        if ($this->options['max_file_size'] && (
                $file_size > $this->options['max_file_size'] ||
                $file->size > $this->options['max_file_size'])
        ) {
            return 'maxFileSize';
        }
        if ($this->options['min_file_size'] &&
                $file_size < $this->options['min_file_size']) {
            return 'minFileSize';
        }
        if (is_int($this->options['max_number_of_files']) && (
                count($this->get_file_objects($conn_id)) >= $this->options['max_number_of_files'])
        ) {
            return 'maxNumberOfFiles';
        }
        return $error;
    }


    private function genRandomString($length = 10) {

            $string = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,$length);

        return $string;
    }


    private function handle_file_upload($uploaded_file, $name, $size, $type, $error,$upload,$conn_id){

        $file = new stdClass();

        $file->name = $this->genRandomString(20);
        $file->size = intval($size);
        $file->type = $type;
        $file->error = "";
        $file->hash = "";
        $file->eliminada = 0;
        $error = $this->has_error($uploaded_file, $file, $error,$conn_id);
        if (!$error && $file->name) {
            if ($file->name[0] === '.') {
                $file->name = substr($file->name, 1);
            }

            clearstatcache();

//             if($this->options['max_tam_imagen']<$file->size){
//                 $result = $this->redim_foto($upload,$file->name,$conn_id);
//                 
//                 if($result['error'] != ""){
//                     $file->error = $result['error'];
//                     $file->eliminada = 1;
//                 }else{
//                     $file->hash = $result['hash'];
//                 }
//             }else
                 if ($uploaded_file && is_uploaded_file($uploaded_file)) {

                $fo = new Upload($upload);
			     if ($fo->uploaded){
			 		if(getimagesize($uploaded_file)){
                        // guarda la foto con un nuevo nombre y tamaño de 100px de ancho
                        $fo->file_new_name_body = $file->name;
                        $fo->image_convert = 'jpg';

		                  //$fo->image_ratio_x = true;
		                  $fo->Process('/tmp/');
		                  if ($fo->processed) {
                                      
                                    $hashs = explode(",",$_POST['cadena_hash']);
                                    $hash = md5_file('/tmp/'.$file->name.".jpg");

                                    if(in_array($hash, $hashs)){
                                        $file->error = "La foto esta duplicada";
                                        $file->eliminada = 1;
                                    }else{
 //                                       conexion
					   
                                            if(ftp_put($conn_id, _PATH_FTP_FOTOS.$file->name.'.jpg', '/tmp/'.$file->name.".jpg", FTP_BINARY)){
                                                ftp_close($conn_id);
                                                $fo->Clean();
                                                $file->hash = $hash;
                                            }else{
                                                $file->error = "Error al subir la foto";
                                                $file->eliminada = 1;
                                            }
                                    }
                                          
                                      
		                    //echo '<BR>foto renombrada, achicada, y convertida a JPG';
		                    

//		                    

		                  }else {
                            //    echo "entra por aca";
                            $file->error = $result;
                            $file->eliminada = 1;
                        }
		              }else{
                        $file->error = "Error, tipo de archivo no es una imagen ";
                        $file->eliminada = 1;
                    }
                }

            }
            if($file->error==""){
                $file_path = $this->options['upload_dir'].$file->name.".jpg";
                $file_size = 0;
            }

            $file->url = $this->options['upload_url'].'image.php?width=80&height=80&image='.rawurlencode($file->name.".jpg");
            $file->size = isset($file_size)?$file_size:'';
            $file->delete_url = $this->options['script_url']
                .'?file='.rawurlencode($file->name.".jpg");
            $file->delete_type = 'HEAD';

//            if(file_exists($this->options['upload_dir'].$file->name.".jpg")){
//                $file->hash = md5_file($this->options['upload_dir'].$file->name.".jpg");
//            }else{
//                echo 'no existe'.$this->options['upload_dir'].$file->name.".jpg";
//            }
                
            
        } else {
            $file->error = $error;
            $file->eliminada = 1;
        }
        return $file;
    }

    public function redim_foto($foto,$name,$conn_id){

        $fo = new Upload($foto);

                $resultado = array('error'=>'','hash'=>'');
		if ($fo->uploaded){

		  // guarda la foto con un nuevo nombre y tamaño de 100px de ancho
		  $fo->file_new_name_body = $name;
		  $fo->image_resize = true;
		  $fo->image_convert = 'jpg';
		  $fo->image_ratio=true;
		  $fo->image_x = 640;
		  $fo->image_y = 480;
		  $fo->jpeg_quality = 95;
                  $fo->file_dst_name = $name;
		  //$fo->image_ratio_x = true;
		  $fo->Process('/tmp/');
		  if ($fo->processed) {
                      
                     
                         
                          
                        $hashs = explode(",",$_POST['cadena_hash']);
                        $hash = md5_file('/tmp/'.$name.".jpg");
                                          
                        if(in_array($hash, $hashs)){
                            $resultado['error'] = 'La foto esta duplicada';
                        }else{
                            
                            if(ftp_put($conn_id, _PATH_FTP_FOTOS.$name.'.jpg', '/tmp/'.$name.".jpg", FTP_BINARY)){
                                ftp_close($conn_id);
                                $fo->Clean();
                                $resultado['hash'] = $hash;
                            }else{
                                $resultado['error'] = 'No se pudo subir la foto'.$name.'.jpg';
                            }
                        }
		   
		  }else {
                      $resultado['error'] = $fo->error;
                   //     echo 'Error al achicar la foto: ' . $fo->error." Foto: ".$foto ." _FILES=".$_FILES[$foto];
		  }
		}else{
                      $resultado['error'] = 'no subio la foto';
			//print "<br>Error : " . $fo->error ." Foto: ".$foto ." _FILES=".$_FILES[$foto];
		}
                
                return $resultado;
    }



    public function get() {
        $conn_id = $this->traer_conexion_ftp();
        $file_name = isset($_REQUEST['file']) ?
                basename(stripslashes($_REQUEST['file'])) : null;
        if ($file_name) {
            $info = $this->get_file_object($file_name,$conn_id);
        } else {

            $info = $this->get_file_objects($conn_id);
            // die(1);
        }
        header('Content-type: application/json');
        echo json_encode($info);
    }

    public function post() {
        $upload = isset($_FILES[$this->options['param_name']]) ?
                $_FILES[$this->options['param_name']] : array(
            'tmp_name' => null,
            'name' => null,
            'size' => null,
            'type' => null,
            'error' => null
        );

        $files = $this->convertir_array_files();

        $conn_id = $this->traer_conexion_ftp();

        $info = array();
        if (is_array($upload['tmp_name'])) {
            foreach ($upload['tmp_name'] as $index => $value) {
                $info[] = $this->handle_file_upload(
                    $upload['tmp_name'][$index],
                    isset($_SERVER['HTTP_X_FILE_NAME']) ?
                        $_SERVER['HTTP_X_FILE_NAME'] : $upload['name'][$index],
                    isset($_SERVER['HTTP_X_FILE_SIZE']) ?
                        $_SERVER['HTTP_X_FILE_SIZE'] : $upload['size'][$index],
                    isset($_SERVER['HTTP_X_FILE_TYPE']) ?
                        $_SERVER['HTTP_X_FILE_TYPE'] : $upload['type'][$index],
                    $upload['error'][$index],
                    $files[$index],
                    $conn_id
                );
            }
        } else {
            $info[] = $this->handle_file_upload(
                $upload['tmp_name'],
                isset($_SERVER['HTTP_X_FILE_NAME']) ?
                    $_SERVER['HTTP_X_FILE_NAME'] : $upload['name'],
                isset($_SERVER['HTTP_X_FILE_SIZE']) ?
                    $_SERVER['HTTP_X_FILE_SIZE'] : $upload['size'],
                isset($_SERVER['HTTP_X_FILE_TYPE']) ?
                    $_SERVER['HTTP_X_FILE_TYPE'] : $upload['type'],
                $upload['error'],
                $conn_id
            );
        }
        header('Vary: Accept');
        if (isset($_SERVER['HTTP_ACCEPT']) &&
                (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }
        echo json_encode($info);
    }

    public function convertir_array_files(){
        //// transformar array files

        $files = array();
        foreach ($_FILES[$this->options['param_name']] as $k => $l) {
            foreach ($l as $i => $v) {
                if (!array_key_exists($i, $files))
                    $files[$i] = array();
                $files[$i][$k] = $v;
            }
        }

        return $files;
        ////
    }

    public function delete() {
        $file_name = isset($_REQUEST['file']) ?
                basename(stripslashes($_REQUEST['file'])) : null;
        $file_path = $this->options['upload_dir'].$file_name;

        //conecto al ftp
        $conn_id = $this->traer_conexion_ftp();
        if(ftp_size($conn_id, _PATH_FTP_FOTOS . $file_name) != -1){
            ftp_delete($conn_id, _PATH_FTP_FOTOS . $file_name);
            $success = true;
        }else{
            $success = false;
        }
        ftp_close($conn_id);


        header('Content-type: application/json');
        echo json_encode($success);
    }
    
    public function traer_conexion_ftp(){
        $conn_id = ftp_connect($this->options['host_ftp']);
        ftp_login($conn_id,$this->options['usuario_ftp'],$this->options['password_ftp']);
        return $conn_id;
    }
}



$upload_handler = new UploadHandler();

header('Pragma: no-cache');
header('Cache-Control: private, no-cache');
header('Content-Disposition: inline; filename="files.json"');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'HEAD':
        $upload_handler->delete();
    case 'GET':
        $upload_handler->get();
        break;
    case 'POST':
        $upload_handler->post();
        break;
    case 'DELETE':
        //$upload_handler->delete();
        break;
    default:
        header('HTTP/1.0 405 Method Not Allowed');
}



?>
