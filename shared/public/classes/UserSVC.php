<?php
/**
 * Created by PhpStorm.
 * User: sayho
 * Date: 2018. 10. 15.
 * Time: PM 2:43
 */
include_once  "Routable.php";
class UserSVC extends Routable{

    function categoryList(){
        $sql = "
            SELECT * FROM tblCategory ORDER BY `id` ASC;
        ";
        return $this->response(1, "succ", $this->getArray($sql));
    }

    function userJoin(){
        $password = $this->encryptAES($_REQUEST["password"]);
        $sql = "
            INSERT INTO tblUser(email, password, accessToken, name, nick, phone, status, accessDate, uptDate, regDate)
            VALUES(
              '{$_REQUEST["email"]}',
              '{$password}',
              '{$_REQUEST["accessToken"]}',
              '{$_REQUEST["name"]}',
              '{$_REQUEST["nick"]}',
              '{$_REQUEST["phone"]}',
              '2',
              NOW(),
              NOW(),
              NOW()
            )
        ";
        $this->update($sql);
        return $this->response(1, "가입되었습니다.");
    }

    function checkEmail(){
        $sql = "
            SELECT COUNT(*) cnt FROM tblUser WHERE email = '{$_REQUEST["email"]}' AND status != 0 LIMIT 1
        ";
        $cnt = $this->getValue($sql, "cnt");
        
        if($cnt < 1) return $this->response(1, "사용 가능한 이메일입니다.");
        else return $this->response(-1, "이미 사용중인 이메일입니다.");
    }

    function test(){
        $str = "test111";
        $encrypted = $this->encryptAES($str);
        echo "encrypted : " . $encrypted . "\n";

        $decrypted = $this->decryptAES($encrypted);
        echo "decrypted : " . $decrypted . "\n";
    }

}