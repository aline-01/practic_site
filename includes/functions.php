<?php
//all my functions is here 

class functions {
    public function say_hello($name) {
        echo "<h1>hello {$name}</h1>";
        //the functions for test
    }
    public function header_to($location) {
        header("Location:{$location}");
    }
    public function uniq_user($username) {
        global $connection;
        $sql = "select * from users where username = ?";
        $query = $connection->prepare($sql);       
        $query->bindValue(1,$username);
        $query->execute();
        $selected = $query->rowCount();
        if ($selected > 0) {
            return false;
        }else if ($selected == 0) {
            return true;
        }
    }
    public function safe_input($input) {
        $lv1 = htmlspecialchars($input);
        $lv2 = addslashes($lv1);
        $lv3 = htmlentities($lv2);
        return $lv3;
    }
    public function hash_password($password) {
        $safe_password = $this->safe_input($password);
        $salt = "91!ssd?0h#5s;4cg";
        $hashed_password = crypt($salt,$password);
        return $hashed_password;
    }
    public function get_user_info() {
        if (isset($_COOKIE["user_access"]) == 1) {
            global $connection;
            $sql = "select * from users where id = ?";
            $query = $connection->prepare($sql);
            $safe_id = $this->safe_input($_COOKIE["user_access"]);
            $query->bindValue(1,$safe_id);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;      
        }else {
            return false;
        }
    }
    public function get_all_users() {
        global $connection;
        $sql = "select * from users";
        $query = $connection->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function access_to_admin() {
        if (isset($_COOKIE["user_access"]) == 1) {
            global $connection;
            $id = $_COOKIE["user_access"];
            $sql = "select * from users where id = ? && add_access = 1";
            $query = $connection->prepare($sql);
            $query->bindValue(1,$id);
            $query->execute();
            $selected_rows = $query->rowCount();
            if ($selected_rows > 0) {
                //do nothing
            }else if ($selected_rows == 0) {
                $this->header_to("/index.php");
            }

        }else {
            $this->header_to("/index.php");
        }
    }
    public function get_all_posts() {
        global $connection;
        $sql = "select * from blogs";
        $query = $connection->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function get_admin_by_id($id) {
        global $connection;
        $sql = "select * from users where id = ?";
        $query = $connection->prepare($sql);
        $safe_id = $this->safe_input($id);
        $query->bindValue(1,$safe_id);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]["username"];
    }
    public function get_post_by_id($id) {
        global $connection;
        $sql = "select * from blogs where id = ?";
        $query = $connection->prepare($sql);
        $safe_id = $this->safe_input($id);
        $query->bindValue(1,$safe_id);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function split_the_content($content,$end) {
        $content_array = str_split($content);
        $end_of_loop = $end;
        $result_array = array();
        for ($i = 0;$i<=$end_of_loop;$i+=1) {
            array_push($result_array,$content_array[$i]);
        }
        $results = implode("",$result_array);
        return $results;
    }
    public function get_all_comments_accepting() {
        global $connection;
        $sql = "select * from comments where accepted = 0"; 
        $query = $connection->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function get_comment_for_post($blog_id) {
        global $connection;
        $sql = "select * from comments where blog_id = ? && accepted = 1";
        $query = $connection->prepare($sql);
        $safe_blogid = $this->safe_input($blog_id);
        $query->bindValue(1,$safe_blogid);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function get_socialAccount_information() {
        global $connection;
        $sql = "select * from social_media";
        $query = $connection->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result) == 1) {
           return false;
        }else {
           return $result;
        }        
    }
    public function search($search) {
        global $connection;
        $sql = "select * from blogs where title like '%{$search}%'";
        $query = $connection->prepare($sql);
        // $query->bindValue(1,$search);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result; 
    }
}

$functions = new functions();
?>
