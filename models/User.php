<?php
class User{
    function getUser($where)
    {
        $Db = Db::getConnect('glb');
        $user = array();
        $result = $Db -> query('SELECT * FROM users '.$where.' AND filial = \''.$_SESSION['filial'].'\'');
        while($row = $result -> fetch())
        {
            $user[$row['id']]['id'] = $row['id'];
            $user[$row['id']]['filial'] = $row['filial'];
            $user[$row['id']]['short_name'] = $row['short_name'];
            $user[$row['id']]['full_name'] = $row['full_name'];
            $user[$row['id']]['level_access'] = $row['level_access'];
            $user[$row['id']]['position'] = $row['position'];
            $user[$row['id']]['dep'] = $row['dep'];
            $user[$row['id']]['lang'] = $row['lang'];
            $user[$row['id']]['birthday'] = $row['birthday'];
            $user[$row['id']]['jobday'] = $row['jobday'];
            $user[$row['id']]['email'] = $row['email'];
            $user[$row['id']]['phone'] = $row['phone'];
            $user[$row['id']]['vphone'] = $row['vphone'];
            $user[$row['id']]['login'] = $row['login'];
            $user[$row['id']]['pass'] = $row['pass'];
            $user[$row['id']]['snow'] = $row['snow'];
            $user[$row['id']]['avatar'] = $row['avatar'];
        }
        return $user;
    }
    function getUserById($id)
    {
        $Db = Db::getConnect('glb');
        $user = array();
        $result = $Db -> query('SELECT * FROM users WHERE id =\''.$id.'\'');
        while($row = $result -> fetch())
        {
            $user['id'] = $row['id'];
            $user['filial'] = $row['filial'];
            $user['short_name'] = $row['short_name'];
            $user['full_name'] = $row['full_name'];
            $user['level_access'] = $row['level_access'];
            $user['position'] = $row['position'];
            $user['lang'] = $row['lang'];
            $user['jobday'] = $row['jobday'];
            $user['email'] = $row['email'];
            $user['phone'] = $row['phone'];
            $user['vphone'] = $row['vphone'];
            $user['birthday'] = $row['birthday'];
            $user['login'] = $row['login'];
            $user['pass'] = $row['pass'];
            $user['snow'] = $row['snow'];
            $user['dep'] = $row['dep'];
            $user['avatar'] = $row['avatar'];
        }
        return $user;
    }
    function authData($login,$pass)
    {
        $Db = Db::getConnect('glb');
        $authData = array();
        $pass = md5(md5($pass));
        $q = 'SELECT * FROM users WHERE login = \''.$login.'\' AND pass = \''.$pass.'\'';
        $result = $Db -> query($q);
        if($result -> rowCount() != 0)
        {
            $i=1;
            while($row = $result -> fetch()){
                $authData[$i]['id'] = $row['id'];
                $authData[$i]['filial'] = $row['filial'];
                $authData[$i]['login'] = $row['login'];
                $authData[$i]['pass'] =$row['pass'];
                $authData[$i]['short_name'] = $row['short_name'];
                $authData[$i]['full_name'] = $row['full_name'];
                $authData[$i]['position'] = $row['position'];
                $authData[$i]['level_access'] = $row['level_access'];
                $authData[$i]['dep'] =$row['dep'];
                $authData[$i]['lang'] =$row['lang'];
                $authData[$i]['login'] = $row['login'];
                $authData[$i]['pass'] = $row['pass'];
                $authData[$i]['snow'] = $row['snow'];
                $authData[$i]['avatar'] = $row['avatar'];
                $i++;
            }
        }
        return $authData;
    }
    function auth($data)
    {
        $auth = 0;
        if(count($data) <> 0)
        {
            session_start();
            $_SESSION['auth'] = 1;
            $_SESSION['uid'] = $data[1]['id'];
            $_SESSION['filial'] = $data[1]['filial'];
            $_SESSION['login'] = $data[1]['login'];
            $_SESSION['pass'] = $data[1]['pass'];
            $_SESSION['level'] = $data[1]['level_access'];
            $_SESSION['position'] =  $data[1]['position'];
            $_SESSION['full_name'] = $data[1]['full_name'];
            $_SESSION['short_name'] = $data[1]['short_name'];
            $_SESSION['dep'] = $data[1]['dep'];
            $_SESSION['lang'] = $data[1]['lang'];
            $_SESSION['login'] = $data[1]['login'];
            $_SESSION['pass'] = $data[1]['pass'];
            $_SESSION['snow'] = $data[1]['snow'];
            $_SESSION['avatar'] = $data[1]['avatar'];
            $len = strlen($data[1]['pass'])/2;
            $pass = substr($data[1]['pass'],$len);
            setcookie('uid',$data[1]['id'], 2147483647,'/');
            setcookie('pass',$pass, 2147483647, '/');
            $auth = 1;
        }
        return $auth;
    }
    function isAuth()
    {
        if(isset($_COOKIE['PHPSESSID']))
        {
            session_start();
            if($_SESSION['auth'] != '1')
            {
                header("Location: /user/login"); 
            }
         }
         else
         {
            if(isset($_COOKIE['uid']))
            {
                $user[1] = User::getUserById($_COOKIE['uid']);
                $len = strlen($user[1]['pass'])/2;
                $pass = substr($user[1]['pass'],$len);
                if($_COOKIE['pass'] == $pass)
                {
                    User::auth($user);
                }
                else
                {
                    header("Location: /user/login"); 
                }
            }
            else
            {
                header("Location: /user/login"); 
            }

        }  
    }
    function logOut(){
        unset($_SESSION);
        setcookie('PHPSESSID','',time()-3600,'/');
        setcookie('uid','',time()-3600,'/');
        setcookie('pass','',time()-3600, '/');
        header("Location: /");
    }
    function isAccess($module, $page, $id)
    {
        $user = array();
        $user = User::getUserById($id);
        $modlevel = substr($user['level_access'],$module,1);
        if($modlevel === '')
        {
            header("Location: /user/accessDenied");
            exit;
        }
        if($modlevel <= $page)
        {
            return true;
        }
        else
        {
            header("Location: /user/accessDenied");
            exit;
        }
        
    }
    function addUser($data = array())
    {
        htmlspecialchars($data,'ENT_QUOTES');
        $Db = Db::getConnect('glb');
        $data['pass'] = md5(md5($data['pass']));
        $q = "INSERT INTO users VALUES('',:filial,:short_name,:full_name,:birthday,:jobday,:level_access,:position,:email,:phone,:vphone,:dep,:login,:pass,:lang,'','')";
        $result = $Db->prepare($q);
        $result->bindParam(':filial', $_SESSION['filial'], PDO::PARAM_STR);
        $result->bindParam(':short_name', $data['short_name'], PDO::PARAM_STR);
        $result->bindParam(':full_name', $data['full_name'], PDO::PARAM_STR);
        $result->bindParam(':birthday', date("Y-m-d", strtotime($data['birthday'])));
        $result->bindParam(':jobday', date("Y-m-d", strtotime($data['jobday'])));
        $result->bindParam(':level_access', $data['level_access']);
        $result->bindParam(':position', $data['position'], PDO::PARAM_STR);
        $result->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $result->bindParam(':phone', $data['phone'], PDO::PARAM_STR);
        $result->bindParam(':vphone', $data['vphone'], PDO::PARAM_STR);
        $result->bindParam(':dep', $data['dep'], PDO::PARAM_STR);
        $result->bindParam(':login', $data['login'], PDO::PARAM_STR);
        $result->bindParam(':pass', $data['pass'], PDO::PARAM_STR);
        $result->bindParam(':lang', $data['lang'], PDO::PARAM_STR);
        $result -> execute();
        
        return $result -> errorInfo();
    }
    function editUser($data)
    {
        htmlspecialchars($data,'ENT_QUOTES');
        echo $id;
        $Db = Db::getConnect('glb');
        if(!empty($data['pass']))
        {
            $data['pass'] = md5(md5($data['pass']));
        }
        $pass = !empty($data['pass'])? ', pass = :pass':'';
        $q = 'UPDATE users SET short_name = :short_name,full_name = :full_name, birthday = :birthday, jobday = :jobday,level_access =:level_access,position = :position,email = :email, phone =:phone, vphone = :vphone,dep = :dep,login = :login '.$pass.', lang = :lang WHERE id='.$data['id'];
        
        $result = $Db->prepare($q);
        $result->bindParam(':short_name', $data['short_name'], PDO::PARAM_STR);
        $result->bindParam(':full_name', $data['full_name'], PDO::PARAM_STR);
        $result->bindParam(':birthday', date("Y-m-d", strtotime($data['birthday'])));
        $result->bindParam(':jobday', date("Y-m-d", strtotime($data['jobday'])));
        $result->bindParam(':level_access', $data['level_access']);
        $result->bindParam(':position', $data['position'], PDO::PARAM_STR);
        $result->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $result->bindParam(':phone', $data['phone'], PDO::PARAM_STR);
        $result->bindParam(':vphone', $data['vphone'], PDO::PARAM_STR);
        $result->bindParam(':dep', $data['dep'], PDO::PARAM_STR);
        $result->bindParam(':login', $data['login'], PDO::PARAM_STR);
        if(!empty($data['pass']))
        {
            $result->bindParam(':pass', $data['pass'], PDO::PARAM_STR);
        } 
        $result->bindParam(':lang', $data['lang'], PDO::PARAM_STR);
        echo $data['level_access'];
        $result -> execute();
        print_r($result -> errorInfo());
        return $result -> errorInfo();
    }
    function birthday($date)
    {
        $user = User::getUser(' WHERE birthday LIKE \''.date($date).'\'');
        if(count($user) != 0)
        {
            return $user;
        }
    }
    function calendar($month)
    {   
        $month_arr  = array();
        $Db = Db::getConnect('glb');
        $user = array();
        $result = $Db -> query('SELECT * FROM users WHERE birthday LIKE \'%-'.date($month).'-%\'');
        $s = 0;
        while($row = $result -> fetch())
        {
            $day1 = date('j', strtotime($row['birthday']));
            $days[$s] = $day1; 
            if($days[$s-1] == $day1)
            {
                 $s++;
            } 
            $user[$day1][$s]['id'] = $row['id'];
            $user[$day1][$s]['filial'] = $row['filial'];
            $user[$day1][$s]['short_name'] = $row['short_name'];
            $user[$day1][$s]['full_name'] = $row['full_name'];
            $user[$day1][$s]['position'] = $row['position'];
            $user[$day1][$s]['birthday'] = $row['birthday'];          
        }
        $year = date('Y', time());
        $lastday = date('d',mktime(0, 0, 0, $month+1, 0, $year));
        $firstday = date('N',mktime(0, 0, 0,$month, 1, $year));
        $day = 1;
        $month_arr['month_name'] = date('F',mktime(0,0,0,$month+1,0,$year));
        $month_arr['month_now'] = date('n',mktime(0,0,0,$month+1,0,$year));
        $month_arr['month_prev'] = date('m',mktime(0,0,0,$month,0,$year));
        $month_arr['month_next'] = date('m',mktime(0,0,0,$month+2,0,$year));

        for($i=0;$i<6;$i++)
        {
            for($k=1;$k<=7;$k++)
            {
                if($i==0)
                { 
                    if($k >= $firstday)
                    {
                          $month_arr[$i][$k] = $day;
                            $day++;
                     }else{
                          $month_arr[$i][$k] = '_';
                    }
                }else{
                    if($day <= $lastday){
                        $month_arr[$i][$k] = $day;
                        $day++; 
                    }else{
                        $month_arr[$i][$k] = '_';
                    }

                }
            }
        }
        $month_arr['birthday'] = array();
        for($l=1;$l<=$lastday;$l++)
        {
            if(isset($user[$l]))
            {   
                $h = 0;
                for($h=0;$h<=count($user[$l]);$h++)
                { 
                    if(isset($user[$l][$h]['id']))
                    {
                         $month_arr['birthday'][$l][$h] = array($user[$l][$h]['id'],$user[$l][$h]['full_name'], $user[$l][$h]['birthday'], $user[$l][$h]['position']);
                         
                    }
                }
            }
        }
        return $month_arr;
    }
}