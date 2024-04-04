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
    class ScoreUnittestAirport extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM unit_test_airport";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($username, $score_airport){
            $sql = "INSERT INTO unit_test_airport(username, score) VALUES(:username, :score_airport)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["username" => $username, "score_airport" => $score_airport]);
            return true;
        }

    }
    class ScoreUnittestActivities extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM unit_test_activities";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($username, $score_activities){
            $sql = "INSERT INTO unit_test_activities(username, score) VALUES(:username, :score_activities)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["username" => $username, "score_activities" => $score_activities]);
            return true;
        }

    }
    class ScoreUnittestTourist extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM unit_test_tourist";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($username, $score_tourist){
            $sql = "INSERT INTO unit_test_tourist(username, score) VALUES(:username, :score_tourist)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["username" => $username, "score_tourist" => $score_tourist]);
            return true;
        }

    }
    class ScoreUnittestShopping extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM unit_test_shopping";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($username, $score_shopping){
            $sql = "INSERT INTO unit_test_shopping(username, score) VALUES(:username, :score_shopping)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["username" => $username, "score_shopping" => $score_shopping]);
            return true;
        }

    }
    class ScoreUnittestRestaurant extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM unit_test_restaurant";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($username, $score_restaurant){
            $sql = "INSERT INTO unit_test_restaurant(username, score) VALUES(:username, :score_restaurant)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["username" => $username, "score_restaurant" => $score_restaurant]);
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
    
    class ScoreProductionAirport extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM production_airport";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($username, $word_1, $word_2, $word_3, $word_4, $score){
            $sql = "INSERT INTO production_airport(username, word_1, word_2, word_3, word_4, score) VALUES(:username, :word_1, :word_2, :word_3, :word_4, :score)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["username" => $username, "word_1" => $word_1, "word_2" => $word_2, "word_3" => $word_3, "word_4" => $word_4, "score" => $score]);
            return true;
        }
    }
    class ScoreProductionActivities extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM production_activities";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($username, $word_1, $word_2, $word_3, $word_4, $score){
            $sql = "INSERT INTO production_activities(username, word_1, word_2, word_3, word_4, score) VALUES(:username, :word_1, :word_2, :word_3, :word_4, :score)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["username" => $username, "word_1" => $word_1, "word_2" => $word_2, "word_3" => $word_3, "word_4" => $word_4, "score" => $score]);
            return true;
        }
    }
    class ScoreProductionTourist extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM production_tourist";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($username, $word_1, $word_2, $word_3, $word_4, $score){
            $sql = "INSERT INTO production_tourist(username, word_1, word_2, word_3, word_4, score) VALUES(:username, :word_1, :word_2, :word_3, :word_4, :score)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["username" => $username, "word_1" => $word_1, "word_2" => $word_2, "word_3" => $word_3, "word_4" => $word_4, "score" => $score]);
            return true;
        }
    }
    class ScoreProductionShopping extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM production_shopping";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($username, $word_1, $word_2, $word_3, $word_4, $score){
            $sql = "INSERT INTO production_shopping(username, word_1, word_2, word_3, word_4, score) VALUES(:username, :word_1, :word_2, :word_3, :word_4, :score)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["username" => $username, "word_1" => $word_1, "word_2" => $word_2, "word_3" => $word_3, "word_4" => $word_4, "score" => $score]);
            return true;
        }
    }
    class ScoreProductionRestaurant extends Config {
        public function fetchAll(){
            $sql = "SELECT * FROM production_restaurant";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        public function inSert($username, $word_1, $word_2, $word_3, $word_4, $score){
            $sql = "INSERT INTO production_restaurant(username, word_1, word_2, word_3, word_4, score) VALUES(:username, :word_1, :word_2, :word_3, :word_4, :score)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["username" => $username, "word_1" => $word_1, "word_2" => $word_2, "word_3" => $word_3, "word_4" => $word_4, "score" => $score]);
            return true;
        }
    }
    
    class UserName extends Config {
        public function fetchAll(){
            $sql = "SELECT u_airport.username, u_activities.username, u_tourist.username, u_shopping.username, u_restaurant.username, p_airport.username, p_activities.username, p_tourist.username, p_shopping.username, p_restaurant.username FROM unit_test_airport u_airport 
            INNER JOIN unit_test_activities u_activities ON u_airport.username = u_activities.username 
            INNER JOIN unit_test_tourist u_tourist ON u_airport.username = u_tourist.username 
            INNER JOIN unit_test_shopping u_shopping ON u_airport.username = u_shopping.username 
            INNER JOIN unit_test_restaurant u_restaurant ON u_airport.username = u_restaurant.username 
            INNER JOIN production_airport p_airport ON u_airport.username = p_airport.username 
            INNER JOIN production_activities p_activities ON u_airport.username = p_activities.username 
            INNER JOIN production_tourist p_tourist ON u_airport.username = p_tourist.username 
            INNER JOIN production_shopping p_shopping ON u_airport.username = p_shopping.username 
            INNER JOIN production_restaurant p_restaurant ON u_airport.username = p_restaurant.username";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
    }
    class UserSession extends Config {
        public function fetchAll(){
            $sql = "SELECT Name, Email FROM user";
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
        public function fetchAll()
        {
            $sql = "SELECT username AS username, unit AS unit, score AS score, unitTestComplete AS unitTestComplete FROM unit_test_airport
            UNION ALL
            SELECT username, unit, score, unitTestComplete FROM unit_test_activities
            UNION ALL
            SELECT username, unit, score, unitTestComplete FROM unit_test_tourist
            UNION ALL
            SELECT username, unit, score, unitTestComplete FROM unit_test_shopping
            UNION ALL
            SELECT username, unit, score, unitTestComplete FROM unit_test_restaurant;
            ;";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
    }
    class ScoreProduction extends Config {
                public function fetchAll()
        {
            $sql = "SELECT username AS username, unit AS unit, word_1 AS word_1,word_2 AS word_2,word_3 AS word_3,word_4 AS word_4, score AS score, productionComplete AS productionComplete FROM production_airport
            UNION ALL
            SELECT username, unit, word_1, word_2 ,word_3 ,word_4 , score, productionComplete FROM production_activities
            UNION ALL
            SELECT username, unit,word_1, word_2 ,word_3 ,word_4 , score, productionComplete FROM production_tourist
            UNION ALL
            SELECT username, unit, word_1, word_2 ,word_3 ,word_4 , score, productionComplete FROM production_shopping
            UNION ALL
            SELECT username, unit, word_1, word_2 ,word_3 ,word_4 , score, productionComplete FROM production_restaurant;
            ;";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }
        
    }
    class ForgetPassword extends Config {
        public function fetchAll(){
            $sql = "SELECT  Email FROM user";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }  
    }
    class NewPassword extends Config {
        public function fetchAll($email){
            $sql = "SELECT Passwords FROM user WHERE Email = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$email]);
            $row = $stmt->fetchAll();
            return $row;
        }
        
        // public function update($email, $passwords) {
        //     $sql = "UPDATE user SET Passwords = :Passwords WHERE Email = :Email";
        //     $stmt = $this->conn->prepare($sql);
        //     $stmt->bindValue(':Email', $email);
        //     $stmt->bindValue(':Passwords', $passwords);
        //     return $stmt->execute();
        // }

        public function update($email, $passwords) {
            $sql = "UPDATE user SET Passwords = :Passwords WHERE Email = :Email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':Email', $email);
            $stmt->bindValue(':Passwords', $passwords);
            return $stmt->execute();
            
        }
    }
