<?php

namespace Models;

use Core\Model;

class FeedbackModel extends Model
{

    public $required_fields = ['name', 'email', 'message'];
    public $all_fields      = ['name', 'email', 'message', 'status', 'image', 'created_at', 'id', 'admin_edited'];
    public $messages = [];
    public $ready_to_save = [];
    public $query_params = [];

    public function formValidation($data, $whitelist = [])
    {
        if(empty($whitelist)){
            $whitelist = $this->all_fields;
        }

        $result = [];
        foreach($whitelist as $value){ //чистим от лишних полей, вроде status или created_at
            $result[$value] = $data[$value];
        }

        $diff = array_diff($this->required_fields, array_keys($result));
        //проверить, все ли обязательные поля есть, посторонних быть уже не может, они отфильтрованы выше
        if($diff){
            foreach($diff as $v){
                $this->messages[$v] = $v . ' is Required';
            }
        } else {
            foreach($result as $k => $value){
                if($this->specialValidation($k, $value)){
                    $result[$k] = $this->stdFilter($value);
                } else {
                    $this->messages[$k] = 'Wrong ' . $k . ' format';
                }
            }
        }

        if(count($this->messages)){//если больше нуля, значит есть ошибки и надо запросить getMessages() в контроллере
            return false;
        } else {
            $this->ready_to_save = $result;
            return true;
        }
    }

    public function specialValidation($key, $value)
    {
        if($key == 'email'){
            return filter_var($value, FILTER_VALIDATE_EMAIL);
        }

        return true;
    }

    public function stdFilter($value)
    {
        $value = htmlspecialchars($value);
        return $value;
    }

    public function getMessages()
    {
        return $this->messages;
    }

    public function add()
    {
        $v = $this->ready_to_save;

        $query = "INSERT INTO feedbacks VALUES  (null, 'new', :email, :name, :message, null, now(), null)";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['email' => $v['email'], 'name' => $v['name'], 'message' => $v['message']]);

        $new_id = $this->db->lastInsertId();

        $images_folder = ROOT_DIR . '/avatars/';
        $tmp_img = $_FILES['image']['tmp_name'];
        $saved_image = $images_folder . $new_id . '.jpg';

        if($tmp_img){
            $image_info = getimagesize ($tmp_img);

            if($image_info[0] > 320 ||  $image_info[1] > 240){ //проверка для картинок, где высота больше ширины
                $this->mini_img($tmp_img, 320, 240, $saved_image);
                $query = "UPDATE feedbacks SET image='1' WHERE id=" . $new_id;
                $this->db->query($query);
            }
        }

        return true;
    }

    function mini_img($file_in, $width_out, $height_out, $file_out)//файл входящий, ширина миниатюры, высота миниатюры, новое имя миниатюры
    {
        $size=getimagesize($file_in);
        switch($size["mime"])
        {
            case "image/jpeg":
                $im = imagecreatefromjpeg($file_in); //jpeg file
                break;
            case "image/pjpeg":
                $im = imagecreatefromjpeg($file_in); //jpeg file
                break;
            case "image/gif":
                $im = imagecreatefromgif($file_in); //gif file
                break;
            case "image/png":
                $im = imagecreatefrompng($file_in); //png file
                break;
            default:
                $im=false;
                break;
        }
        // определим новый размер изображения с привязкой по ширине, сохраняя пропорции
        if($size[0] > $width_out) //$size[0] - ширина $size[1] - высота
        {
            $new_h = round($size[1]/($size[0] / $width_out));

            //если по ширине подходит а по высоте нет, надо за основу вычислений брать высоту
            if($new_h > $height_out){
                $new_h = $height_out;
                $width_out = round($size[0]/($size[1] / $new_h));
            }
            $new_img=imagecreatetruecolor($width_out,$new_h);
            imagecopyresized($new_img,$im,0,0,0,0,$width_out,$new_h,$size[0],$size[1]);
        }
        else {$new_img = $im; }

        imagejpeg($new_img,$file_out,100);
        imagedestroy($im);
        if(empty ($new_img)){ imagedestroy($new_img); }
    }

    public function update()
    {
        $v = $this->ready_to_save;
        $query = "UPDATE feedbacks SET
          admin_edited = '1',
          email='" . $v['email']   . "',
          name='" . $v['name']    . "',
          message='" . $v['message'] . "' WHERE id=" . $v['id'];

        $this->db->query($query);
        return true;
    }

    public function execute($query)
    {
        $all_items = [];
        $stmt = $this->db->query($query);
        while ($row = $stmt->fetch()) {
            $all_items[] = $row;
        }

        return $all_items;
    }

    public function rejectById($id)
    {
        $query = "UPDATE feedbacks SET status='rejected' WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['id' => $id]);
    }

    public function aproveById($id)
    {
        $query = "UPDATE feedbacks SET status='aproved' WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['id' => $id]);
    }

    public function findById($id)
    {
        $query = "SELECT * FROM feedbacks WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }


}