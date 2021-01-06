<?

	header('Content-Type: image/jpeg');

        extract($_GET);

	$img_f=ImageCreateFromJpeg($foto);//crea una variable para manejar la imagen
	
	if (!$img_f) { /* si fallo */
		
		$img_f  = ImageCreateFromJpeg('../../../fotos/0-0-0.jpg'); /* crea una imagen en blanco */
       	$prop=$tam/imagesy($img_f);//calcula proporci�n
		$tam_x=$prop*(imagesx($img_f));//recalcula los nuevos tama�os
		$tam_y=$prop*(imagesy($img_f));
       	$img_d=ImageCreatetruecolor($tam_x,$tam_y);//crea imagen
       	ImageCopyResized($img_d,$img_f,0,0,0,0,$tam_x,$tam_y,imagesx($img_f),imagesy($img_f));//copia cambiando de tama�o
	    imagejpeg($img_d);   
		  
   }else{
	
		$prop=$tam/imagesx($img_f);//calcula proporci�n
		$tam_x=$prop*(imagesx($img_f));//recalcula los nuevos tama�os
		$tam_y=$prop*(imagesy($img_f));
		$img_d=ImageCreatetruecolor($tam_x,$tam_y);//crea imagen
		$img_entre = imageinterlace ( $img_d, 0); // con esto saco el progresivo de la imagen jpg
	//	ImageCopyResized($img_d,$img_f,0,0,0,0,$tam_x,$tam_y,imagesx($img_f),imagesy($img_f));//copia cambiando de tama�o
		imagecopyresampled ($img_d,$img_f,0,0,0,0,$tam_x,$tam_y,imagesx($img_f),imagesy($img_f));
		imagejpeg($img_d);//muestra
	}
?>
