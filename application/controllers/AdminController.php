<?php

class AdminController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!UserModel::doesUsersExist()) {
            $this->View->render('admin/register');
        } else {
            // Check if Logged in
            // If not logged in, login page
        }
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = strip_tags($_POST['name']);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $userName = strip_tags($_POST['username']);
            $phone = strip_tags($_POST['phone']);

            if (!RegisterModel::formValidation($userName, $email)) {
                echo 'Invalid Credentials';
            }
            if (!UserModel::getUserByEmail($email)) {
                if (RegisterModel::registerNewUser($name, $email, $userName, $phone, 'admin')) {
                    if (LoginModel::login($userName, $phone)) {
                        Redirect::to('admin/dashboard');
                    }
                    echo 'Registered Successfully';
                } else {
                    echo 'Error with the DB';
                }
            } else {
                echo 'User with email: ' . filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) . ' already exists.';
            }

        } else {
            $this->View->renderWithoutHeaderAndFooter('404.php');
        }
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

        } else {
            // Check if logged in

            //if not logged in
            $this->View->render('admin/login');
        }
    }

    public function dashboard()
    {
        if (LoginModel::isUserLoggedIn() && UserModel::isAdmin()) {
            $this->View->render('admin/dashboard');
        }
    }

    public function question($action) {
        if ($action == "add") {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $this->View->render('admin/questions/add', array(
                    "quiz_type" => Config::get("QUIZ_TYPE")
                ));
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["mcq"])) {
                    if (isset($_POST["question_statement"], $_POST["option_a"], $_POST["option_b"], $_POST["option_c"],
                        $_POST["option_d"], $_POST["answer"])) {
                        $questionStatement = htmlspecialchars($_POST["question_statement"]);
                        $optionA = htmlspecialchars($_POST["option_a"]);
                        $optionB = htmlspecialchars($_POST["option_b"]);
                        $optionC = htmlspecialchars($_POST["option_c"]);
                        $optionD = htmlspecialchars($_POST["option_d"]);
                        $answer = htmlspecialchars($_POST["answer"]);

                        LevelModel::storeMCQQuestion($questionStatement, $optionA, $optionB, $optionC, $optionD, $answer);
                    }
                } elseif (isset($_POST["general"])) {

                } else {

                }
            }
        } else {
            if (LevelModel::getTotalQuestions() != 0) {
                if ($action == "edit") {
                    $this->View->render('admin/questions/edit');
                } elseif ($action == "delete") {
                    $this->View->render('admin/questions/delete');
                }
            } else {
                echo 'No Questions Exist';
            }
        }
    }

    public function instructions() {
        $this->View->render('admin/instructions');
    }
}