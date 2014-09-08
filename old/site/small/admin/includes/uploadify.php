<?php
/*
Uploadify v2.1.0
Release Date: August 24, 2009

Copyright (c) 2009 Ronnie Garcia, Travis Nickels

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/
if (!empty($_FILES)) {
	require('inc/imagemanipulation.php');
$tempFile = $_FILES['Filedata']['tmp_name'];
$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
$targetFile =  str_replace('//','/',$targetPath) . "orig_".$_FILES['Filedata']['name'];
$smallerFile =  str_replace('//','/',$targetPath) .$_FILES['Filedata']['name'];
$debug = "/site/small/images/work/DEBUG.txt";
	// $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	// $fileTypes  = str_replace(';','|',$fileTypes);
	// $typesArray = split('\|',$fileTypes);
	// $fileParts  = pathinfo($_FILES['Filedata']['name']);
	
	// if (in_array($fileParts['extension'],$typesArray)) {
		// Uncomment the following line if you want to make the directory if it doesn't exist
		// mkdir(str_replace('//','/',$targetPath), 0755, true);
		
		if (move_uploaded_file($tempFile,$targetFile)){
		 	sleep(3);
			unlink($tempFile);
				$objImage = new ImageManipulation($targetFile);
				echo "ObjImg: ".print_r($objImage,true);
				file_put_contents($debug, "something\r\n", FILE_APPEND);
				$objImage->resize(500);
				$objImage->save($smallerFile);
		} else {
			sleep(10);
			file_put_contents($debug,"something\r\n", FILE_APPEND);
			$objImage = new ImageManipulation($targetFile);
			$objImage->resize(500);
			$objImage->save($smallerFile);
		}
	
		echo "1";
	// } else {
	// 	echo 'Invalid file type.';
	// }
	
	

//        class Image {
//            
//            var $uploaddir;
//            var $quality = 80;
//            var $ext;
//            var $dst_r;
//            var $img_r;
//            var $img_w;
//            var $img_h;
//            var $output;
//            var $data;
//            var $datathumb;
//            
//            function setFile($src = null) {
//                $this->ext = strtoupper(pathinfo($src, PATHINFO_EXTENSION));
//                if(is_file($src) && ($this->ext == "JPG" OR $this->ext == "JPEG")) {
//                    $this->img_r = ImageCreateFromJPEG($src);
//                } elseif(is_file($src) && $this->ext == "PNG") {
//                    $this->img_r = ImageCreateFromPNG($src);      
//                } elseif(is_file($src) && $this->ext == "GIF") {
//                    $this->img_r = ImageCreateFromGIF($src);
//                }
//                $this->img_w = imagesx($this->img_r);
//                $this->img_h = imagesy($this->img_r);
//            }
//            
//            function resize($w = 100) {
//                $h =  $this->img_h / ($this->img_w / $w);
//                $this->dst_r = ImageCreateTrueColor($w, $h);
//                imagecopyresampled($this->dst_r, $this->img_r, 0, 0, 0, 0, $w, $h, $this->img_w, $this->img_h);
//                $this->img_r = $this->dst_r;
//                $this->img_h = $h;
//                $this->img_w = $w;
//            }
//            
//            function createFile($output_filename = null) {
//                if($this->ext == "JPG" OR $this->ext == "JPEG") {
//                    imageJPEG($this->dst_r, $this->uploaddir.$output_filename.'.'.$this->ext, $this->quality);
//                } elseif($this->ext == "PNG") {
//                    imagePNG($this->dst_r, $this->uploaddir.$output_filename.'.'.$this->ext);
//                } elseif($this->ext == "GIF") {
//                    imageGIF($this->dst_r, $this->uploaddir.$output_filename.'.'.$this->ext);
//                }
//                $this->output = $this->uploaddir.$output_filename.'.'.$this->ext;
//            }
//            
//            function setUploadDir($dirname) {
//                $this->uploaddir = $dirname;
//            }
//            
//            function flushe() {
//        $tempFile = $_FILES['Filedata']['tmp_name'];
//        $targetPath = $_SERVER['DOCUMENT_ROOT'] . $_GET['folder'] . '/';
//        $targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
//                
//                imagedestroy($this->dst_r);
//                unlink($targetFile);
//                //imagedestroy($this->img_r);
//                
//            }
//            
//        }
//        
//        $tempFile = $_FILES['Filedata']['tmp_name'];
//        $targetPath = $_SERVER['DOCUMENT_ROOT'] . $_GET['folder'] . '/';
//        $targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
//        
//        move_uploaded_file ($tempFile, $targetFile);
//        
////        $image = new Image();
////        $image->setFile($targetFile);
////        $image->setUploadDir($targetPath);
////        $image->resize(640);
////        $image->createFile("s_".md5($tempFile));
////        $image->flushe();
//    
	
	
}
?>