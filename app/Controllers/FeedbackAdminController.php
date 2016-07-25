<?php

namespace App\Controllers;

use Core\Controller;
use Models\FeedbackModel;
use Core\Helpers\Helper;

class FeedbackAdminController extends Controller
{

    public function __construct()
    {
        parent::__construct();

        if (empty($_SESSION['auth']) && $_SERVER['REQUEST_URI'] != '/administrator/login') {
            header('Location: /administrator/login', true, 301);
            die;
        }
    }

    public function login()
    {
        $login        = 'admin'; //заглушка
        $pass         = '123'; //заглушка - должен хранится только хеш
        $current_pass = Helper::getPasswordHash($pass); //заглушка


        if (empty($_POST['login']) xor empty($_POST['password'])) {
            $this->view->messages = ['error'];
        } else {
            if (isset($_POST['login']) && $_POST['login'] == $login) {

                if (Helper::getPasswordHash($_POST['password']) == $current_pass) {
                    $_SESSION['auth'] = 1;
                    header('Location: /administrator', true, 301);
                } else {
                    //@todo after users table creation
                }
            } else {
                //@todo after users table creation
            }
        }
    }

    public function logout()
    {
        if(isset($_SESSION['auth'])){
            unset($_SESSION['auth']);
        }
        header('Location: /administrator/login', true, 301);
        $this->view->disable();
    }

    public function index()
    {
        $query = "
            SELECT * FROM feedbacks
            ORDER BY created_at DESC";

        $model = new FeedbackModel();

        $this->view->all_items = $model->execute($query);
    }

    public function reject()
    {
        $this->view->disable();
        if (!empty($_GET['id'])) {
            $id    = (int)$_GET['id'];
            $model = new FeedbackModel();
            $model->rejectById($id);
            header('Location: /administrator', true, 301);
        }
    }

    public function aprove()
    {
        $this->view->disable();
        if (!empty($_GET['id'])) {
            $id    = (int)$_GET['id'];
            $model = new FeedbackModel();
            $model->aproveById($id);
            header('Location: /administrator', true, 301);
        }
    }

    public function edit()
    {
        if (!empty($_GET['id'])) {
            $id               = (int)$_GET['id'];
            $model            = new FeedbackModel();
            $item             = $model->findById($id);
            $this->view->item = $item;

            if ($_POST) {
                $_POST['id'] = $id;
                if ($model->formValidation($_POST)) {
                    $model->update();
                    header('Location: /feedback/edit/?id=' . $id, true, 301);
                } else {
                    $messages = $model->getMessages();
                    //@todo - доделать вывод сообщений
                }
            }
        }
    }
}