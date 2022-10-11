<?php
    require "Database.php"; //fatal error if  not found

    class User extends Database{

        public function store($request)
        {
            $first_name = $request['first_name'];
            $last_name = $request['last_name'];
            $username = $request['username'];
            $password = $request['password'];

            $password = password_hash($password, PASSWORD_DEFAULT);

            //query string
            $sql = "INSERT INTO users(first_name, last_name, username, password) VALUES('$first_name', '$last_name', '$username', '$password')";

            if ($this->conn->query($sql)) {
                header('location:../views'); //index.php
                exit;
            }else {
                die("Unable to create user " . $this->conn->error);
            }
        }

        public function login($request){
            $username = $request['username'];
            $password = $request['password'];

            //query string
            $sql = "SELECT * FROM users WHERE username='$username'";
            $result = $this->conn->query($sql);

            //check if the username is available
            if ($result->num_rows == 1) {
                //check for the password if correct
                $user = $result->fetch_assoc();
              
                //first_name, last_name, username, password, photo
                if (password_verify($password, $user['password'])) {
                    // initialize session variables
                    session_start();
                    
                    //session variables
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['full_name'] = $user['first_name'] . " " . $user['last_name'];

                    header('location:../views/dashboard.php');
                    exit;
                }else {
                    die("Password is incorrect.");
                }

            }else {
                echo "Username Not Found.";
            }
        }
        public function logout(){
            session_start();
            session_unset();
            session_destroy();

            header('location:../views');
            exit;
        }

        //retrieve all details in the database
        public function getAllUsers(){
            //create a query string
            $sql = "SELECT id, first_name, last_name, username, photo FROM users";

            if ($result = $this->conn->query($sql)) {
                return $result;
            }else {
                die("Error in retrieving user data" . $this->conn->error);
            }
        }
        public function getUser(){
            //the user id who is logged in
            $id = $_SESSION['id'];

            //create a query string
            $sql = "SELECT first_name, last_name, username, photo FROM users WHERE id='$id'";

            //execute the query string
            if ($result = $this->conn->query($sql)) {
                return $result->fetch_assoc();
            }else {
                die("Error geting user " . $this->conn->error);
            }
        }

        public function update($request, $files){
            session_start();
            $id = $_SESSION['id'];
            $first_name = $request['first_name'];
            $last_name = $request['last_name'];
            $username = $request['username'];
            $photo = $files['photo']['name'];
            $tmp_photo = $files['photo']['tmp_name']; //to be changed

            //query string
            $sql = "UPDATE users SET first_name = '$first_name', last_name='$last_name', username='$username' WHERE id='$id'";

            if ($this->conn->query($sql)) { // to be changed
                $_SESSION['username'] = $username;
                $_SESSION['full_name'] = "$first_name $last_name";
            

                if ($photo) {
                    //create string
                    $sql = "UPDATE users SET photo='$photo' WHERE id='$id'";
                    $destination = "../assets/images/$photo";

                    if ($this->conn->query($sql)) {
                        //move the images to the images folder
                        if (move_uploaded_file($tmp_photo, $destination)) {
                            header('location:../views/dashboard.php');
                            exit;
                        }else {
                            die("Error moving the images to the folder");
                        }
                    }else {
                        die("Error uploading the images to the database. " . $this->conn->error);
                    }
                }
                header('location:../views/dashboard.php');
                exit;
            }else {
                die("Error in updating the user " . $this->conn->error);
            }

        }
        public function delete(){
            
            session_start();

            $id = $_SESSION['id'];

            $sql = "DELETE FROM users WHERE id=$id";

            if ($this->conn->query($sql)) {
                $this->logout();
            }else {
                die("Error in deleting the account " . $this->conn->error);
            }
        }
    }

?>