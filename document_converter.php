<?php 

class Document_converter{
	
	//image converter
	function convert_document($convert_type, $target_dir, $image_name){
		$target_dir = "$target_dir/";
		
		$image = $target_dir.$image_name;
		$file_type = $this->get_file_type($image);
		//remove extension from image;
		$img_name = $this->remove_extension_from_file($image);
        $python_script = "C:\\xampp\\htdocs\\image-converter\\demo.py";
		$output = array();
        //to pdf
		if($convert_type == 'pdf' && ($file_type == 'docx' || $file_type == 'DOCX')){
            $newname = $target_dir.$img_name.'.'.$convert_type;
			exec("docx2pdf $image $newname",$output);
            return $img_name.'.'.$convert_type;
            
		}
		if ($convert_type == 'pdf' && ($file_type == 'pptx' || $file_type == 'PPTX'))
		{
			$newname = $target_dir.$img_name.'.'.$convert_type;
			exec("ppt2pdf file $image",$output);
            if ($output)
			    return $img_name.'.'.$convert_type;
            else    
                return "un-success";
		}
		if ($convert_type == 'docx' && ($file_type == 'pdf' || $file_type == 'PDF'))
        {
            $newname = $target_dir.$img_name.'.'.$convert_type;
            exec("pdf2docx convert $image $newname",$output);
			return $img_name.'.'.$convert_type;
        }
		if ($convert_type == 'pptx' && ($file_type == 'pdf' || $file_type == 'PDF'))
		{
			exec("pdf2pptx $image",$output);
            if ($output)
			    return $img_name.'.'.$convert_type;
            else    
                return "un-success";
		}
		if ($convert_type == 'pdf' && ($file_type == 'TXT' || $file_type == 'txt'))
		{
			$newname = $target_dir.$img_name.'.'.$convert_type;
            exec("python $python_script t-p $image $newname",$output);
            if ($output[0])
			    return $img_name.'.'.$convert_type;
            else    
                return "un-success";
		}		
		return false; 
	}
	
	//image upload handler
	public function upload_document($files, $target_dir, $input_name){
		
		$target_dir = "$target_dir/";
		
		//get the basename of the uploaded file
		$base_name = basename($files[$input_name]["name"]);

		//get the image type from the uploaded image
		$imageFileType = $this->get_file_type($base_name);
		
		//set dynamic name for the uploaded file
		$new_name = $this->get_dynamic_name($base_name, $imageFileType);
		
		//set the target file for uploading
		$target_file = $target_dir . $new_name;
	
		// // Check uploaded is a valid image
		// $validate = $this->validate_image($files[$input_name]["tmp_name"]);
		// if(!$validate){
		// 	echo "Doesn't seem like an image file :(";
		// 	return false;
		// }
		
		// Check file size - restrict if greater than 1 MB 
		$file_size = $this->check_file_size($files[$input_name]["size"], 1000000);
		if(!$file_size){
			echo "You cannot upload more than 1MB file";
			return false;
		}

		// Allow certain file formats
		$file_type = $this->check_only_allowed_file_types($imageFileType);
		if(!$file_type){
			echo "You cannot upload other than DOCX,PDF,PPTX";
			return false;
		}
		
		if (move_uploaded_file($files[$input_name]["tmp_name"], $target_file)) {
			//return new image name and image file type;
			return array($new_name, $imageFileType);
		} else {
			echo "Sorry, there was an error uploading your file.";
		}

	}
	
	protected function get_file_type($target_file){
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		return $imageFileType;
	}
	
	// protected function validate_image($file){
	// 	$check = getimagesize($file);
	// 	if($check !== false) {
	// 		return true;
	// 	} 
	// 	return false;
	// }
	
	protected function check_file_size($file, $size_limit){
		if ($file > $size_limit) {
			return false;
		}
		return true;
	}
	
	protected function check_only_allowed_file_types($imagetype){
		if($imagetype != "docx" && $imagetype != "pdf" && $imagetype != "pptx" && $imagetype != "PPTX" && $imagetype != "txt" && $imagetype != "PDF" && $imagetype != "DOCX" && $imagetype != "xlsx" && $imagetype != "XLSX" && $imagetype != "txt" && $imagetype != "TXT" ) {
			return false;
		}
		return true;
	}
	
	protected function get_dynamic_name($basename, $imagetype){
		$only_name = basename($basename, '.'.$imagetype); // remove extension
		$combine_time = $only_name.'_'.time();
		$new_name = $combine_time.'.'.$imagetype;
		return $new_name;
	}
	
	protected function remove_extension_from_file($file){
		$extension = $this->get_file_type($file); //get extension
		$only_name = basename($file, '.'.$extension); // remove extension
		return $only_name;
	}
}
?>