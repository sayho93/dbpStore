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

    function categoryInfo(){
        $sql = "
            SELECT * FROM tblCategory WHERE `id` = '{$_REQUEST["categoryId"]}' LIMIT 1
        ";
        return $this->response(1, "succ", $this->getRow($sql));
    }

    function appList(){
        $where = "1=1";
        if($_REQUEST["categoryId"] != "") $where .= " AND categoryId = '{$_REQUEST["categoryId"]}'";
        if($_REQUEST["searchTxt"] != "")
            $where .= " AND (`appTitle` LIKE '%{$_REQUEST["searchTxt"]}%' OR C.desc LIKE '%{$_REQUEST["searchTxt"]}%')";

        $sql = "
            SELECT * 
            FROM tblApp A JOIN tblCorporation C ON A.corporationId = C.id 
            WHERE {$where} 
            ORDER BY A.regDate DESC
        ";

        return $this->response(1, "succ", $this->getArray($sql));
    }

    function userJoin(){
        $password = $this->encryptAES($_REQUEST["password"]);
        $sql = "
            INSERT INTO tblUser(email, password, name, phone, addr, addrDetail, regDate)
            VALUES(
              '{$_REQUEST["email"]}',
              '{$password}',
              '{$_REQUEST["name"]}',
              '{$_REQUEST["phone"]}',
              '{$_REQUEST["addr"]}',
              '{$_REQUEST["addrDetail"]}',
              NOW()
            )
        ";
        $this->update($sql);

        $sql = "SELECT * FROM tblUser WHERE email = '{$_REQUEST["email"]}' LIMIT 1";
        $info = $this->getRow($sql);

        PrefUtil::setPreference("pickleUser", $info);
        return $this->response(1, "가입되었습니다.");
    }

    function appInfo(){
        $sql = "
            SELECT * FROM tblApp WHERE id = '{$_REQUEST["id"]}' LIMIT 1
        ";
        $appData = $this->getRow($sql);
        $sql = "
            SELECT *, (SELECT COUNT(*) FROM tblLike WHERE commentId = C.id) AS likeCnt 
            FROM tblComment C JOIN tblUser U ON C.userId = U.id
            WHERE C.appId = '{$_REQUEST["id"]}' 
        ";
        $commentList = $this->getArray($sql);
    }

    function checkEmail(){
        $sql = "
            SELECT COUNT(*) cnt FROM tblUser WHERE email = '{$_REQUEST["email"]}' AND status != 0 LIMIT 1
        ";
        $cnt = $this->getValue($sql, "cnt");
        
        if($cnt < 1) return $this->response(1, "사용 가능한 이메일입니다.");
        else return $this->response(-1, "이미 사용중인 이메일입니다.");
    }

    function userLogin(){
        $password = $this->encryptAES($_REQUEST["password"]);
        $sql = "
            SELECT * FROM tblUser WHERE `email` = '{$_REQUEST["email"]}' AND password = '{$password}' AND status = 1 LIMIT 1 
        ";
        $row = $this->getRow($sql);
        if($row != ""){
            PrefUtil::setPreference("pickleUser", $row);
            return $this->response(1, "succ");
        }else return $this->response(-1, "failed");
    }

    function currentUserInfo(){
        return PrefUtil::getPreference("pickleUser");
    }

    function userLogout(){
        PrefUtil::emptyPreference("pickleUser");
        return $this->response(1, "succ");
    }

    function test(){
        $str = "test111";
        $encrypted = $this->encryptAES($str);
        echo "encrypted : " . $encrypted . "\n";

        $decrypted = $this->decryptAES($encrypted);
        echo "decrypted : " . $decrypted . "\n";
    }

}