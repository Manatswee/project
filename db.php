<?php
    require_once("config.php");

    class ScorePretest extends Config {
        
        public function fetchAll(){
            $sql = "SELECT * FROM score_pretest";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        
        public function inSert($user_name, $score_pretest, $email){
            $sql = "INSERT INTO score_pretest(user_name, score_pretest, email) VALUES(:user_name, :score_pretest, :email)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["user_name" => $user_name, "score_pretest" => $score_pretest, "email" => $email]);
            return true;
        }
        
    }

    class ScorePosttest extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM score_posttest";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($user_name, $score_posttest, $email){
            $sql = "INSERT INTO score_posttest(user_name, score_posttest, email) VALUES(:user_name, :score_posttest, :email)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["user_name" => $user_name, "score_posttest" => $score_posttest, "email" => $email]);
            return true;
        }

    }
    class ScoreUnittest1 extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM unit_test1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($user_name, $unit_test1){
            $sql = "INSERT INTO unit_test1(user_name, unit_test1) VALUES(:user_name, :unit_test1)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["user_name" => $user_name, "unit_test1" => $unit_test1]);
            return true;
        }

    }
    class ScoreUnittest2 extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM unit_test2";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($user_name, $unit_test2){
            $sql = "INSERT INTO unit_test2(user_name, unit_test2) VALUES(:user_name, :unit_test2)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["user_name" => $user_name, "unit_test2" => $unit_test2]);
            return true;
        }

    }
    class ScoreUnittest3 extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM unit_test3";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($user_name, $unit_test3){
            $sql = "INSERT INTO unit_test3(user_name, unit_test3) VALUES(:user_name, :unit_test3)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["user_name" => $user_name, "unit_test3" => $unit_test3]);
            return true;
        }

    }
    class ScoreUnittest4 extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM unit_test4";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($user_name, $unit_test4){
            $sql = "INSERT INTO unit_test4(user_name, unit_test4) VALUES(:user_name, :unit_test4)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["user_name" => $user_name, "unit_test4" => $unit_test4]);
            return true;
        }

    }
    class ScoreUnittest5 extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM unit_test5";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($user_name, $unit_test5){
            $sql = "INSERT INTO unit_test5(user_name, unit_test5) VALUES(:user_name, :unit_test5)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["user_name" => $user_name, "unit_test5" => $unit_test5]);
            return true;
        }

    }
    class User extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM user";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($Name, $Email, $passwords){
            $sql = "INSERT INTO user(Name, Email, Passwords) VALUES(:Name, :Email, :Passwords)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["Name" => $Name, "Email" => $Email ,"Passwords" => $passwords]);
            return true;
        }

    }
    
    class Production1 extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM production_1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($user_name, $production_1, $production_1_2, $production_1_3, $production_1_4, $score_1){
            $sql = "INSERT INTO production_1(user_name, production_1, production_1_2, production_1_3, production_1_4, score_1) VALUES(:user_name, :production_1, :production_1_2, :production_1_3, :production_1_4, :score_1)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["user_name" => $user_name, "production_1" => $production_1, "production_1_2" => $production_1_2, "production_1_3" => $production_1_3, "production_1_4" => $production_1_4, "score_1" => $score_1]);
            return true;
        }
    }
    class Production2 extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM production_2";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($user_name, $production_2, $production_2_2, $production_2_3, $production_2_4, $score_2){
            $sql = "INSERT INTO production_2(user_name, production_2, production_2_2, production_2_3, production_2_4, score_2) VALUES(:user_name, :production_2, :production_2_2, :production_2_3, :production_2_4, :score_2)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["user_name" => $user_name, "production_2" => $production_2, "production_2_2" => $production_2_2, "production_2_3" => $production_2_3, "production_2_4" => $production_2_4, "score_2" => $score_2]);
            return true;
        }
    }
    class Production3 extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM production_3";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($user_name, $production_3, $production_3_2, $production_3_3, $production_3_4, $score_3){
            $sql = "INSERT INTO production_3(user_name, production_3, production_3_2, production_3_3, production_3_4, score_3) VALUES(:user_name, :production_3, :production_3_2, :production_3_3, :production_3_4, :score_3)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["user_name" => $user_name, "production_3" => $production_3, "production_3_2" => $production_3_2, "production_3_3" => $production_3_3, "production_3_4" => $production_3_4, "score_3" => $score_3]);
            return true;
        }
    }
    class Production4 extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM production_4";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($user_name, $production_4, $production_4_2, $production_4_3, $production_4_4, $score_4){
            $sql = "INSERT INTO production_4(user_name, production_4, production_4_2, production_4_3, production_4_4, score_4) VALUES(:user_name, :production_4, :production_4_2, :production_4_3, :production_4_4, :score_4)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["user_name" => $user_name, "production_4" => $production_4, "production_4_2" => $production_4_2, "production_4_3" => $production_4_3, "production_4_4" => $production_4_4, "score_4" => $score_4]);
            return true;
        }
    }
    class Production5 extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM production_5";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($user_name, $production_5, $production_5_2, $production_5_3, $production_5_4, $score_5){
            $sql = "INSERT INTO production_5(user_name, production_5, production_5_2, production_5_3, production_5_4, score_5) VALUES(:user_name, :production_5, :production_5_2, :production_5_3, :production_5_4, :score_5)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["user_name" => $user_name, "production_5" => $production_5, "production_5_2" => $production_5_2, "production_5_3" => $production_5_3, "production_5_4" => $production_5_4, "score_5" => $score_5]);
            return true;
        }
    }
    
    class UserName extends Config {
        public function fetchAll(){
            $sql = "SELECT u1.user_name, u2.user_name, u3.user_name, u4.user_name, u5.user_name, p1.user_name, p2.user_name, p3.user_name, p4.user_name, p5.user_name FROM unit_test1 u1 INNER JOIN unit_test2 u2 ON u1.user_name = u2.user_name INNER JOIN unit_test3 u3 ON u1.user_name = u3.user_name INNER JOIN unit_test4 u4 ON u1.user_name = u4.user_name INNER JOIN unit_test5 u5 ON u1.user_name = u5.user_name INNER JOIN production_1 p1 ON u1.user_name = p1.user_name INNER JOIN production_2 p2 ON u1.user_name = p2.user_name INNER JOIN production_3 p3 ON u1.user_name = p3.user_name INNER JOIN production_4 p4 ON u1.user_name = p4.user_name INNER JOIN production_5 p5 ON u1.user_name = p5.user_name";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
    }
    class AdminScore extends Config {
        public function fetchAll(){
            $sql = "SELECT ur.Name, ur.Last_Name, ur.Email, ur.Status, sp.score_pretest, st.score_posttest, ABS(sp.score_pretest - st.score_posttest) AS score_difference FROM user AS ur LEFT JOIN score_pretest AS sp ON ur.Name = sp.user_name LEFT JOIN score_posttest AS st ON ur.Name = st.user_name;";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
    }
    class ScorePractice extends Config {
        public function fetchAll(){
            $sql = "SELECT u1.user_name, u1.unit_test1, u2.unit_test2, u3.unit_test3, u4.unit_test4, u5.unit_test5, u1.time_stamp, u2.time_stamp, u3.time_stamp, u4.time_stamp, u5.time_stamp FROM unit_test1 AS u1 LEFT JOIN unit_test2 AS u2 ON u1.user_name = u2.user_name LEFT JOIN unit_test3 AS u3 ON u1.user_name = u3.user_name LEFT JOIN unit_test4 AS u4 ON u1.user_name = u4.user_name LEFT JOIN unit_test5 AS u5 ON u1.user_name= u5.user_name;";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
    }
?>