<?php
require_once("Controller.php");

class GameController extends Controller {

    public function newGame() {
        if (isset($_SESSION["user"])) {
            $_SESSION["game"] = [
                "lives" => 6,
                "level" => 1,
            ];
        }
    }

    public function success() {
        if (isset($_SESSION["game"])) {
            $_SESSION["game"]["level"] = $_SESSION["game"]["level"] + 1;
        }
    }

    public function fail() {
        if (isset($_SESSION["game"])) {
            if ($_SESSION["game"]["lives"] > 0) {
                $_SESSION["game"]["lives"] = $_SESSION["game"]["lives"] - 1;
            }

            if ($_SESSION["game"]["lives"] <= 0) {

                header("Location: gameover.php");
            }

            return $_SESSION["game"]["lives"];
        }

        return -1;
    }

    public function level1($post) {
        $data = self::sanitizePost($post);
        $success = false;
        $setSd = @$data["setSd"];
        $set = @$data["set"];
        $answer = @$data["answer"];
        $message = "";

        if ($this->valitateSigned(@$data["setSd"], $set)) {
            $setArray = str_split($set);
            natcasesort($setArray);
            $setFix = implode($setArray);

            if ($setFix === $answer) {
                $success = true;
            } else {
                $fixAns = str_split($answer);
                natcasesort($fixAns);
                $fixAns = implode($fixAns);
                if ($setFix === $fixAns) {
                    $message = "Incorrect – Your letters have not been correctly ordered in ascending order.";
                } else {
                    $containsSearch = count(array_intersect($setArray, str_split($answer)));
                    if ($containsSearch > 0) {
                        $message = "Incorrect – Some of your letters are different than ours.";
                    } else {
                        $message = "Incorrect – All your letters are different than ours.";
                    }
                }
            }
        }

        return [
            "success" => $success,
            "setSd" => $setSd,
            "set" => $set,
            "answer" => $answer,
            "message" => $message,
        ];
    }

    public function level2($post) {
        $data = self::sanitizePost($post);
        $success = false;
        $setSd = @$data["setSd"];
        $set = @$data["set"];
        $answer = @$data["answer"];
        $message = "";

        if ($this->valitateSigned(@$data["setSd"], $set)) {
            $setArray = str_split($set);
            natcasesort($setArray);
            $setArray = array_reverse($setArray);
            $setFix = implode($setArray);

            if ($setFix === $answer) {
                $success = true;
            } else {
                $fixAns = str_split($answer);
                natcasesort($fixAns);
                $fixAns = array_reverse($fixAns);
                $fixAns = implode($fixAns);
                if ($setFix === $fixAns) {
                    $message = "Incorrect – Your letters have not been correctly ordered in descending order.";
                } else {
                    $containsSearch = count(array_intersect($setArray, str_split($answer)));
                    if ($containsSearch > 0) {
                        $message = "Incorrect – Some of your letters are different than ours.";
                    } else {
                        $message = "Incorrect – All your letters are different than ours.";
                    }
                }
            }
        }

        return [
            "success" => $success,
            "setSd" => $setSd,
            "set" => $set,
            "answer" => $answer,
            "message" => $message,
        ];
    }

    public function level3($post) {
        $data = self::sanitizePost($post);
        $success = false;
        $setSd = @$data["setSd"];
        $set = @$data["set"];
        $answer = @$data["answer"];
        $message = "";

        if ($this->valitateSigned(@$data["setSd"], $set)) {
            $answerArr = explode(",", $answer);
            if (count($answerArr) == 6) {
                if (!$this->valitateLimit($answerArr)) {
                    $message = "Incorrect – some of your numbers are out of range (0-100).";
                } else {
                    $setArray = explode(",", $set);
                    sort($setArray);

                    if ($setArray === $answerArr) {
                        $success = true;
                    } else {
                        sort($answerArr);
                        if ($setArray === $answerArr) {
                            $message = "Incorrect – Your numbers have not been correctly ordered in ascending order.";
                        } else {
                            $containsSearch = count(array_intersect($answerArr, $setArray));
                            if ($containsSearch > 0) {
                                $message = "Incorrect – Some of your numbers are different than ours.";
                            } else {
                                $message = "Incorrect – All your numbers are different than ours.";
                            }
                        }
                    }
                }
            } else {
                $message = "You must enter 6 different numbers separated by comma ','.";
            }
        }

        return [
            "success" => $success,
            "setSd" => $setSd,
            "set" => $set,
            "answer" => $answer,
            "message" => $message,
        ];
    }

    public function level4($post) {
        $data = self::sanitizePost($post);
        $success = false;
        $setSd = @$data["setSd"];
        $set = @$data["set"];
        $answer = @$data["answer"];
        $message = "";

        if ($this->valitateSigned(@$data["setSd"], $set)) {
            $answerArr = explode(",", $answer);
            if (count($answerArr) == 6) {
                if (!$this->valitateLimit($answerArr)) {
                    $message = "Incorrect – some of your numbers are out of range (0-100).";
                } else {
                    $setArray = explode(",", $set);
                    rsort($setArray);

                    if ($setArray === $answerArr) {
                        $success = true;
                    } else {
                        rsort($answerArr);
                        if ($setArray === $answerArr) {
                            $message = "Incorrect – Your numbers have not been correctly ordered in descending order.";
                        } else {
                            $containsSearch = count(array_intersect($answerArr, $setArray));
                            if ($containsSearch > 0) {
                                $message = "Incorrect – Some of your numbers are different than ours.";
                            } else {
                                $message = "Incorrect – All your numbers are different than ours.";
                            }
                        }
                    }
                }
            } else {
                $message = "You must enter 6 different numbers separated by comma ','.";
            }
        }

        return [
            "success" => $success,
            "setSd" => $setSd,
            "set" => $set,
            "answer" => $answer,
            "message" => $message,
        ];
    }

    public function level5($post) {
        $data = self::sanitizePost($post);
        $success = false;
        $setSd = @$data["setSd"];
        $set = @$data["set"];
        $first = @$data["first"];
        $last = @$data["last"];
        $message = "";

        if ($this->valitateSigned(@$data["setSd"], $set)) {
            $listSet = str_split($set);
            natcasesort($listSet);
            $listSet = array_values($listSet);
            if (in_array($first, $listSet) && in_array($last, $listSet) ) {
                if ($listSet[0] == $first && $listSet[5] == $last) {
                    $success = true;
                } else {
                    $message = "Some of the letters do not fix to the first or last of the given list.";
                }
            } else {
                $message = "Some of the letters are not in the given list.";
            }
        }

        return [
            "success" => $success,
            "setSd" => $setSd,
            "set" => $set,
            "first" => $first,
            "last" => $last,
            "message" => $message,
        ];
    }

    public function level6($post) {
        $data = self::sanitizePost($post);
        $success = false;
        $setSd = @$data["setSd"];
        $set = @$data["set"];
        $first = @$data["first"];
        $last = @$data["last"];
        $message = "";

        if ($this->valitateSigned(@$data["setSd"], $set)) {
            $listSet = explode(",", $set);
            sort($listSet);
            $listSet = array_values($listSet);
            if (in_array($first, $listSet) && in_array($last, $listSet) ) {
                if ($listSet[0] == $first && $listSet[5] == $last) {
                    $success = true;
                } else {
                    $message = "Some of the numbers do not fix to the first or last of the given list.";
                }
            } else {
                $message = "Some of the numbers are not in the given list.";
            }
        }

        return [
            "success" => $success,
            "setSd" => $setSd,
            "set" => $set,
            "first" => $first,
            "last" => $last,
            "message" => $message,
        ];
    }

    public function getSetByLevel($level) {
        $set = [];
        switch (true){
            case $level == 1 || $level == 2 || $level == 5:
                $set = $this->getRandomChars(); //Get random Letters
                break;
            case $level == 3 || $level == 4 || $level == 6:
                $set = $this->getRandomNums(); //Get random Numbers
                break;
        }

        $setSigned = hash("sha256", json_encode($set));

        return [
            "set" => $set,
            "setSigned" => $setSigned,
        ];
    }

    private function valitateSigned($signed, $set) {
        if (hash_equals(hash("sha256", json_encode($set)), $signed)) {

            return true;
        }

        return false;
    }

    private function getRandomChars() {
        $base = 'abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ';
        $alphaLength = strlen($base) - 1;

        $set = [];
        for ($i = 0; $i < 6; $i++) {
            $n = rand(0, $alphaLength);
            $set[] = $base[$n];
        }

        return trim(implode($set));
    }

    private function getRandomNums() {
        $set = [];
        for ($i = 0; $i < 6; $i++) {
            $n = rand(0, 100);
            $set[] = $n;
        }

        return trim(implode( ",", $set));
    }

    private function valitateLimit($array) {
        $range = range(0, 100);
        if (count(array_intersect($array, $range)) == 6) {

            return true;
        }

        return false;
    }

}