<?php

class RegisterController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->View->render('register/index');
        } else {
            // error
        }
    }

    public function action() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = strip_tags($_POST['name']);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $userName = strip_tags($_POST['username']);
            $phone = strip_tags($_POST['phone']);
            $password = strip_tags($_POST['password']);

            if (!RegisterModel::formValidation($userName, $email)) {
                echo 'Invalid Credentials';
            }
            if (!UserModel::getUserByEmail($email)) {
                if (!UserModel::getUserByUsername($userName)) {
                    if (RegisterModel::registerNewUser($name, $email, $userName, $phone, $password)) {
                        if (LoginModel::login($userName, $phone)) {
                            Redirect::to('level/index/0');
                        }

                        echo 'Registered Successfully';
                    } else {
                        echo 'Error with the DB';
                    }
                } else {
                    echo 'User with username: ' . $userName . ' already exists.';
                }
            } else {
                echo 'User with email: ' . filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) . ' already exists.';
            }

        } else {
            // redirect
        }
    }
}