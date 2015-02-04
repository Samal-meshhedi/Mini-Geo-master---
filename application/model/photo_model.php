<?php

class PhotoModel
{
    
    public function getAllPhotos()
    {
        $sql = "SELECT id,filename ,longitude, latitude, userid FROM photo";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    // هنا ناخذ جميع الحقائق التي تريدها ان تاخذ منك 
    public function addPhoto($filedata)
    {
        if ($targetfile = $this->storePhoto($filedata))
        {
            $location = $this->readGPSinfoEXIF($targetfile);
            $sql = "INSERT INTO photo (filename, longitude, latitude) VALUES (:filename, :longitude, :latitude)";
            $query = $this->db->prepare($sql);
            $parameters = array(':filename' => $filedata['name'],':longitude' => $location[1], ':latitude' => $location[0]);

            $query->execute($parameters);
        } 
    }
    // هنا لا بد من اخذ العينات التي ترتبط من الصور والطرع على الجميع 
    public function storePhoto($filedata)
    {
        $target_dir = ROOT . "public/img/";
        $target_file = $target_dir . basename($filedata["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($filedata["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($filedata["size"] > 50000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        $imageFileType = strtolower($imageFileType);

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {

            if (move_uploaded_file($filedata["tmp_name"], ROOT . "public/img/" . $filedata['name'])) {
                echo "The file ". basename( $filedata["name"]). " has been uploaded.";
                return $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        return false;
    }
    // عندما ناخذ الصور ونضعها على الموقع سوف يتضح انه هنال ك سوف سحدد المكان 
    function readGPSinfoEXIF($image_full_name)
    {   
        $exif = exif_read_data($image_full_name, 0, true);
        if(!$exif || $exif['GPS']['GPSLatitude'] == '') {
           return false;
        } else {
        $lat_ref = $exif['GPS']['GPSLatitudeRef']; 
        $lat = $exif['GPS']['GPSLatitude'];
        list($num, $dec) = explode('/', $lat[0]);
        $lat_s = $num / $dec;
        list($num, $dec) = explode('/', $lat[1]);
        $lat_m = $num / $dec;
        list($num, $dec) = explode('/', $lat[2]);
        $lat_v = $num / $dec;
     
        $lon_ref = $exif['GPS']['GPSLongitudeRef'];
        $lon = $exif['GPS']['GPSLongitude'];
        list($num, $dec) = explode('/', $lon[0]);
        $lon_s = $num / $dec;
        list($num, $dec) = explode('/', $lon[1]);
        $lon_m = $num / $dec;
        list($num, $dec) = explode('/', $lon[2]);
        $lon_v = $num / $dec;
     
        $gps_int = array($lat_s + $lat_m / 60.0 + $lat_v / 3600.0, $lon_s 
                + $lon_m / 60.0 + $lon_v / 3600.0);
        return $gps_int;
        }
    }
}