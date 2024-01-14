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
        
        public function inSert($user_name, $score_pretest){
            $sql = "INSERT INTO score_pretest(user_name, score_pretest) VALUES(:user_name, :score_pretest)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["user_name" => $user_name, "score_pretest" => $score_pretest]);
            return true;
        }
    }
?>