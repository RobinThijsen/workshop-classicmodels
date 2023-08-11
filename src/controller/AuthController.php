<?php
declare(strict_types=1);
namespace controller;

use Exception;
use models\User;
use PDO;

class AuthController extends User
{
    /**
     * display register form or result of error
     * @param array $post field value of user
     * @return void
     */
    public function register(array $post): void
    {
        if (!empty($post)) {
            try {
                if (empty($post['username']) || empty($post['email']) || empty($post['password'])) {
                    throw new Exception("error_0_nodata");
                }

                $username = htmlspecialchars($post['username']);
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("error_1_email");
                }
                $password_hash = password_hash($post['password'], PASSWORD_DEFAULT);

                $sql = "SELECT * FROM users WHERE username = :username AND email = :email";
                $result = $this->db->request($sql, ["username" => $username, "email" => $email]);
                $user = $result->fetch(PDO::FETCH_ASSOC);

                if (!empty($user)) {
                    throw new Exception('error_2_exists');
                }

                User::insertNewUser(["username" => $username, "email" => $email, "password" => $password_hash]);
                $user = User::getUserByNameAndEmail($username, $email);

                $_SESSION['user'] = array(
                    "id" => $user['id'],
                    "username" => $username,
                    "email" => $email
                );

                http_response_code(302);
                header('Location: /');

            } catch (Exception $e) {
                $loc = 'Location: register?error-value=';
                if ($e->getMessage() == "error_0_nodata") $loc .= 'nodata';
                else if ($e->getMessage() == "error_1_email") $loc .= 'email';
                else if ($e->getMessage() == "error_2_exists") $loc .= "exists";
                else header('Location: error');
                header($loc);
            }
        } else {
            if (!empty($_GET)) {
                $errorValue = $_GET['error-value'];
            }
            include_once "views/layout/header.view.php";
            include_once "views/register.view.php";
            include_once "views/layout/footer.view.php";
        }
    }

    /**
     * display login form or result of error
     * @param array $post field value of user
     * @return void
     */
    public function login(array $post): void
    {

        if (!empty($post)) {
            try {
                if (empty($post['email']) || empty($post['password'])) {
                    throw new Exception("error_0_empty_field");
                }

                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("error_1_email");
                }
                $user  =User::getUserByEmail($email);

                if (empty($user)) {
                    throw new Exception("error_2_empty_users");
                }

                if (!password_verify($post['password'], $user['password'])) {
                    throw new Exception("error_3_pwd");
                }

                $_SESSION['user'] = array(
                    "id" => $user['id'],
                    "username" => $user['username'],
                    "email" => $email
                );

                http_response_code(302);
                header('Location: /');
            } catch (Exception $e) {
                $loc = 'Location: login?error-value=';
                // check what type of error we got
                if ($e->getMessage() == "error_2_empty_users") {
                    // if no user found redirect to log in with error value
                    $loc .= 'not-exist';
                } else if ($e->getMessage() == "error_3_pwd") {
                    // if password not equal redirect to log in with error value
                    $loc .= 'wrong-pwd';
                } else if ($e->getMessage() == "error_1_email") {
                    // if email not valid redirect to log in with error value
                    $loc .= 'wrong-email';
                } else if ($e->getMessage() == "error_0_empty_field") {
                    // if no information return by user redirect to log in with error value
                    $loc .= 'nodata';
                } else {
                    echo $e->getMessage();
                    die();
                }
                header($loc);
            }
        } else {
            if (!empty($_GET)) {
                $errorValue = $_GET['error-value'];
            }
            include_once "views/layout/header.view.php";
            include_once "views/login.view.php";
            include_once "views/layout/footer.view.php";
        }
    }

    /**
     * @return void
     */
    public function profil(): void
    {
        $user = User::getUserById($_SESSION['user']['id']);
        if (empty($_POST)) {
            if (empty($_GET)) {
                try {

                    include_once "views/layout/header.view.php";
                    include_once "views/profil.view.php";
                    include_once "views/layout/footer.view.php";
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                if (isset($_GET['error-value'])) {
                    $errorValue = $_GET['error-value'];
                }

                if (isset($_GET['success'])) {
                    $success = $_GET['success'];
                }

                include_once "views/layout/header.view.php";
                include_once "views/profil.view.php";
                include_once "views/layout/footer.view.php";
            }
        } else {
            try {
                if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['cPassword'])) {
                    throw new Exception("error_0_nodata");
                }

                $username = htmlspecialchars($_POST['username']);
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("error_1_email");
                }

                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

                if (empty($user)) {
                    throw new Exception("error_404");
                }

                if (!password_verify($_POST['cPassword'], $user['password'])) {
                    throw new Exception("error_2_pwd");
                }

                if ($user['username'] != $username) {
                    if ($user['email'] != $email) {
                        $result = User::updateUsersUsernameAndEmail(["username" => $username, "email" => $email, "id" => $_SESSION['user']['id']]);
                    } else {
                        $result = User::updateUsersUsername(["username" => $username, "id" => $_SESSION['user']['id']]);
                    }
                } else {
                    if ($user['email'] != $email) {
                        $result = User::updateUsersEmail(["email" => $email, "id" => $_SESSION['user']['id']]);
                    } else {
                        header('Location: /profil?warning=nodata');
                    }
                }
                if ($result) {
                    $_SESSION['user'] = array(
                        "id" => $_SESSION['id'],
                        "username" => $username,
                        "email" => $email
                    );
                } else {
                    throw new Exception("error_500");
                }

                $_SESSION['user'] = array(
                    "id" => $user['id'],
                    "username" => $username,
                    "email" => $email
                );

                header('Location: /profil?success=true');
            } catch (Exception $e) {
                $loc = "/profil?error-value=";
                if ($e->getMessage() == "error_0_nodata") {
                    $loc .= "nodata";
                } else if ($e->getMessage() == "error_1_email") {
                    $loc .= "email";
                } else if ($e->getMessage() == "error_2_pwd") {
                    $loc .= "pass";
                } else {
                    echo $e->getMessage();
                }
                header($loc);
            }
        }
    }

    /**
     * user's logout
     * @return void
     */
    public function logout(): void
    {
        unset($_SESSION['user']);
        header('Location: /');
    }

    /**
     * @return void
     */
    public function delete(): void
    {
        if (empty($_GET)) {
            include_once "views/layout/header.view.php";
            include_once "views/delete.view.php";
            include_once "views/layout/footer.view.php";
        } else {
            try {
                $result = User::deleteUserById($_SESSION['user']['id']);
                if ($result) {
                    unset($_SESSION['user']);
                    header('Location: /?msg=delete');
                } else {
                    header('Location: /profil?error-value=delete');
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }
}