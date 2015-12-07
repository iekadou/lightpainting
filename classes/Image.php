<?php

namespace Iekadou\Webapp;

class Image extends BaseModel
{
    protected $table = 'image';
    protected $fields = array('userid', 'path');


    public function get_path() {
        return $this->path;
    }

    public function get_image_aspect_ratio() {
        list($width, $height, $type, $attr) = getimagesize(PATH."images_dir/".$this->path);
        return $width/$height;
    }

    public function set_path($path) {
        $this->path = $path;
        return $this;
    }

    public function get_userid() {
        return $this->userid;
    }

    public function set_userid($userid) {
        $this->userid = $userid;
        return $this;
    }

    public function interpret_request($POST, $FILES) {
        $image = null;
        if (isset($FILES['image']) && isset($FILES['image']['error']) && $FILES['image']['error'] == 0) {
            $image = $FILES['image'];
            $uploaddir = PATH."images_dir/";
            $ext = pathinfo(basename($image['name']), PATHINFO_EXTENSION);
            $uniqueId = uniqid();
            $uploadfile = $uploaddir.$uniqueId.basename($image['name']);
            $allowed_extensions = Files::get_allowed_extensions();
            if (in_array($image['type'], $allowed_extensions[strtolower($ext)]['mime'])) {
                if (move_uploaded_file($image['tmp_name'], $uploadfile)) {
                    $image = $uniqueId.basename($image['name']);
                    fixOrientation($uploadfile);
                } else {
                    $image = null;
                }
            } else {
                $image = null;
            }
        }
        if (!isset($image)) {
            $this->errors[] = 'image';
        }
        if (!empty($this->errors)) {
            throw new ValidationError($this->errors);
        }
        if (isset($image)) {
            $this->set_path($image);
        }
        return $this;
    }
}
