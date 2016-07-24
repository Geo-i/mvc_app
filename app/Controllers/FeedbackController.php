<?php

use Core\Controller;
use Models\FeedbackModel;

class FeedbackController extends Controller
{

    public function index()
    {
        if(isset($_SESSION['added_successfully'])){
            unset($_SESSION['added_successfully']);
            $this->view->added_successfully = true;
        }

        if($_POST){
            $this->add();
        }

        $field = isset($_GET['field']) ? $_GET['field'] : '';
        $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';
        if($order !== 'DESC') $order = 'ASC';

        if(!in_array($field, ['created_at','name','email'])){
            $field = 'created_at';
        }
        $this->view->field = $field;

        $query = "
            SELECT * FROM feedbacks
            WHERE status = 'aproved'
            ORDER BY " . $field . " " . $order;

        $model = new FeedbackModel();

        $this->view->all_items = $model->execute($query);
        $this->view->order = ($order == 'ASC') ? 'DESC' : 'ASC';
    }

    private function add()
    {
        $this->view->messages = [];
        $model = new FeedbackModel();

        if($model->formValidation($_POST, ['name','email','message'])){
            $model->add();
            $_SESSION['added_successfully']= true;
//            header( 'Location: /', true, 301 );
        } else {
            $messages = $model->getMessages();
        }

        $this->view->messages = $messages;

    }

}