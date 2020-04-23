<?php 

class Photo extends Db_object {

  protected static $db_table = "photos";
  protected static $db_table_fields = array('title', 'description', 'caption', 'filename', 'alternate_text', 'type', 'size');
  public $id;
  public $title;
  public $description;
  public $caption;
  public $filename;
  public $alternate_text;
  public $type;
  public $size;

  public $tmp_path;
  public $upload_directory = "images";
  public $errors = array();
  public $upload_errors_array = array ( 
    0=>"There is no error, the file uploaded with success",
    1=>"The uploaded file exceeds the upload_max_filesize directive in php.ini",
    2=>"The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
    3=>"The uploaded file was only partially uploaded",
    4=>"No file was uploaded",
    6=>"Missing a temporary folder"
  );

  // This is passing $_FILES['upload_file'] as an argument

  public function picture_path() {

    return $this->upload_directory.DS.$this->filename;
  }


  public function save() {

    if($this->id) {

      $this->update();

    }else {

      if(!empty($this->errors)) {

        return false;

      }

      if(empty($this->filename) || empty($this->tmp_path)) {

        $this->errors[] = "The file was not available";

        return false;

      }

      $target_path = $this->upload_directory . DS . $this->filename;

      if(file_exists($target_path)) {

        $this->errors[] = "The file {$this->filename} already exists";

        return false;

      }
      if(move_uploaded_file($this->tmp_path, $target_path)){

        if ($this->create()) {

          unset($this->tmp_path);

          return true;

        }

      } else {

        $this->errors[] = "the file directory probably does not have permission";

        return false;

      }

    }
    
  }

  public function delete_photo() {

    if($this->delete()) {

      $target_path = SITE_ROOT.DS. 'admin' . DS . $this->picture_path();

      return unlink($target_path) ? true : false;

    } else {

      return false;

    }

  }

} // End of Class



?>