<?php
require_once('./vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sum($a,$b)
{
    $c=$a+$b;
    return $c;
}

function findUserByEmail($email)
{
    global $db;
    $stmt=$db->prepare("SELECT * FROM `user` WHERE `email`  = ?");
    $stmt->execute(array($email));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function findUserByDislayName($displayName,$id)
{
    global $db;
    $displayName='%'.$displayName.'%';
    $stmt=$db->prepare("SELECT * FROM `user` WHERE `displayName` like ? AND id<>?");
    $stmt->execute(array($displayName,$id));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function findUserByPhoneNumber($phoneNumber)
{
    global $db;
    $stmt=$db->prepare("SELECT * FROM `user` WHERE `phoneNumber`  = ?");
    $stmt->execute(array($phoneNumber));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function findUserById($id)
{
    global $db;
    $stmt=$db->prepare("SELECT * FROM `user` WHERE `id`  = ?");
    $stmt->execute(array($id));
    return  $stmt->fetch(PDO::FETCH_ASSOC);
}
function findUserByidUSer($idUser)
{
    global $db;
    $stmt=$db->prepare("SELECT * FROM `newfeed` WHERE `idUser`  = ?");
    $stmt->execute(array($idUser));
    return  $stmt->fetch(PDO::FETCH_ASSOC);
}
function getPage()
{
    $uri=$_SERVER['REQUEST_URI'];
    $parts=explode('/',$uri);
    $fileName=$parts[2];
    $parts=explode('.',$fileName);
    $page=$parts[0];
    return $page;
}
function getdisplayName($id)
{
    global $db;
    $stmt=$db->prepare("SELECT * FROM `user` WHERE `id`  = ?");
    $stmt->execute(array($id));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function register($displayName,$email,$password,$phoneNumber)
{
    global $db,$BASE_URL;
    $hashpassword=password_hash($password,PASSWORD_DEFAULT);
    $code=generateRandomString(16);
    $stmt=$db->prepare("INSERT INTO user (displayName,email,password,code,phoneNumber) VALUES(?,?,?,?,?)");
    $stmt->execute(array($displayName,$email,$hashpassword,$code,$phoneNumber));
    $newUserId=$db->lastInsertId();
    sendEmail($email,$displayName,'Kích hoạt tài khoản',"Mã kích hoạt tài khoản của bạn là : $BASE_URL/activate.php?code=$code");
    return $newUserId;
}
function forgotPW($email)
{
    global $db,$BASE_URL;
    $stmt=$db->prepare("UPDATE user SET code=? WHERE $email=?");
    $code=generateRandomString(16);
    $stmt->execute(array($code,$email));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    $ten=$row['displayName'];
    sendEmail($email,$ten,'Quên mật khẩu',"Click vào đây để lấy lại mật khẩu : $BASE_URL/takePW.php?code=$code");
    return $row['id'];
}
function change_password($newPassword,$id)
{
    global $db;
    $hashPassword=password_hash($newPassword,PASSWORD_DEFAULT);
    $stmt=$db->prepare("UPDATE user SET password=? WHERE id=?");
    return $stmt->execute(array($hashPassword,$id));
}
function change_info($displayName,$avatar,$phoneNumber,$liveAt,$schoolLearned,$story,$id)
{
    global $db;
    $stmt=$db->prepare("UPDATE user SET displayName=?,avatar=?,phoneNumber=?,`live-at`=?,`school-learned`=?,story=? WHERE id=?");
    return $stmt->execute(array($displayName,$avatar,$phoneNumber,$liveAt,$schoolLearned,$story,$id));
}
function getNewFeed()
{
    global $db;
    $stmt=$db->query("SELECT p.*,u.displayName FROM newfeed p,user u WHERE p.idUser=u.id ORDER BY p.time DESC");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
function getNewFeedPage($start,$limit)
{
    global $db;
    $stmt=$db->query('SELECT p.*,u.displayName FROM newfeed p,user u WHERE p.idUser=u.id ORDER BY p.time DESC LIMIT  '.$start.','.$limit);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
function addStatus($idUser,$status,$img,$type)
{
    global $db;
    $stmt=$db->prepare("INSERT INTO newfeed VALUES (null,?,?,?,current_timestamp(),?)");
    $stmt->execute(array($idUser,$status,$img,$type));
}
function resizeImage($filename, $max_width, $max_height)
{
  list($orig_width, $orig_height) = getimagesize($filename);

  $width = $orig_width;
  $height = $orig_height;

  # taller
  if ($height > $max_height) {
      $width = ($max_height / $height) * $width;
      $height = $max_height;
  }

  # wider
  if ($width > $max_width) {
      $height = ($max_width / $width) * $height;
      $width = $max_width;
  }

  $image_p = imagecreatetruecolor($width, $height);

  $image = imagecreatefromjpeg($filename);

  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);

  return $image_p;
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function sendEmail($to,$name,$subject,$content)
{
        global $EMAIL_FROM,$EMAIL_NAME,$EMAIL_PW;

        $mail = new PHPMailer(true);
        //Server settings                     // Enable verbose debug output
        $mail->isSMTP(true);                                            // Send using SMTP
        $mail->CharSet    = 'UTF-8';
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = $EMAIL_FROM;                     // SMTP username
        $mail->Password   = $EMAIL_PW;                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom($EMAIL_FROM, $EMAIL_NAME);
        $mail->addAddress($to, $name);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;

        $mail->send();
}
function ativateUser($code)
{
    global $db;
    $stmt=$db->prepare("SELECT * FROM `user` WHERE `code`  = ? AND status=?");
    $stmt->execute(array($code,0));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user && $user['code']==$code)
    {
        $stmt=$db->prepare("UPDATE user SET code=?,status=? WHERE id=?");
        $stmt->execute(array('',1,$user['id']));
        return true;
    }
    else
        return false;
}
function takePW($code)
{
    global $db,$temp;
    $stmt=$db->prepare("UPDATE `user` SET `code`  = ? WHERE `status` = ? ");
    $stmt->execute(array($code,1));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user&&$user['code']==$code)
    {
        $stmt=$db->prepare("UPDATE user SET code=?WHERE id=?");
        $stmt->execute(array($code,$user['id']));
        return true;
    }
    return false;
}
function setAgainPW($id,$password)
{
    global $db;
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt=$db->prepare("UPDATE `user` SET `password`=? WHERE id=?");
    return $stmt->execute(array($hashPassword,$id));
}
function sendFriendRequest($userId1,$userId2)
{
    global $db;
    $stmt=$db->prepare("INSERT INTO friendship (userId1,userId2,follow) VALUE (?,?,?)");
    $stmt->execute(array($userId1,$userId2,1));
}
function getFriendRequest($userId1,$userId2)
{
    global $db;
    $stmt=$db->prepare("SELECT * FROM `friendship` WHERE userId1=? AND userId2=? ");
    $stmt->execute(array($userId1,$userId2));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function removeFriendRequest($userId1,$userId2)
{
    global $db;
    $stmt=$db->prepare("DELETE FROM friendship WHERE (userId1=? AND userId2=?) OR (userId2=? AND userId1=?)");
    $stmt->execute(array($userId1,$userId2,$userId1,$userId2));
}
function sendFollowRequest($userId1,$userId2)
{
    global $db;
    $stmt=$db->prepare("INSERT INTO followship (userId1,userId2,follow) VALUE (?,?,?)");
    $stmt->execute(array($userId1,$userId2,1));
}
function getFollowRequest($userId1,$userId2)
{
    global $db;
    $stmt=$db->prepare("SELECT * FROM `followship` WHERE userId1=? AND userId2=? ");
    $stmt->execute(array($userId1,$userId2));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function removeFollowRequest($userId1,$userId2)
{
    global $db;
    $stmt=$db->prepare("DELETE FROM followship WHERE userId1=? AND userId2=?");
    $stmt->execute(array($userId1,$userId2));
}
function addlikestatus($userId1,$userId2,$idNewFeed)
{
    global $db;
    $stmt=$db->prepare("INSERT INTO likestatus (userId1,userId2,idNewFeed) VALUE (?,?,?)");
    $stmt->execute(array($userId1,$userId2,$idNewFeed));
}
function getlike($userId1,$userId2,$idNewFeed)
{
    global $db;
    $stmt=$db->prepare("SELECT * FROM `likestatus` WHERE userId1=? AND userId2=? AND idNewFeed=?");
    $stmt->execute(array($userId1,$userId2,$idNewFeed));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function removelike($userId1,$userId2,$idNewFeed)
{
    global $db;
    $stmt=$db->prepare("DELETE FROM likestatus WHERE userId1=? AND userId2=? AND idNewFeed=?");
    $stmt->execute(array($userId1,$userId2,$idNewFeed));
}
function addcomment($userId1,$userId2,$idNewFeed,$content)
{
    global $db;
    $stmt=$db->prepare("INSERT INTO comment (userId1,userId2,idNewFeed,content) VALUE (?,?,?,?)");
    $stmt->execute(array($userId1,$userId2,$idNewFeed,$content));
}
function getcomment($userId1,$userId2,$idNewFeed,$content)
{
    global $db;
    $stmt=$db->prepare("SELECT * FROM `comment` WHERE userId1=? AND userId2=? AND idNewFeed=? AND content=?");
    $stmt->execute(array($userId1,$userId2,$idNewFeed,$content));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function getcommentnotnull($idNewFeed)
{
    global $db;
    $stmt=$db->prepare("SELECT * FROM `comment` WHERE idNewFeed=?");
    $stmt->execute(array($idNewFeed));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function getcontent($idNewFeed)
{
    global $db;
    $stmt=$db->prepare("SELECT * FROM `comment` c,`user` u WHERE c.`userId1`=u.`id` AND c.`idNewFeed`=?");
    $stmt->execute(array($idNewFeed));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
function deletecontentnull($userId1,$userId2,$idNewFeed,$content)
{
    global $db;
    $stmt=$db->prepare("DELETE FROM `comment` WHERE userId1=? AND userId2=? AND idNewFeed=? AND content=?");
    $stmt->execute(array($userId1,$userId2,$idNewFeed,$content));
}
function addcontent($userId1,$userId2,$idNewFeed,$content)
{
    global $db;
    $stmt=$db->prepare("INSERT INTO comment (userId1,userId2,idNewFeed,content) VALUE (?,?,?,?)");
    $stmt->execute(array($userId1,$userId2,$idNewFeed,$content));
}

function getPostCur($id,$start,$limit)
{
    global $db;
    $stmt=$db->prepare('SELECT * FROM newfeed  WHERE idUser=? ORDER BY time DESC LIMIT '.$start.','.$limit);
    $stmt->execute(array($id));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
function findImgByNewFeedId($id)
{
    global $db;
    $stmt=$db->prepare("SELECT * FROM newfeed  WHERE idNewFeed=?");
    $stmt->execute(array($id));
    return  $stmt->fetch(PDO::FETCH_ASSOC);
}

function getLatestConversations($userId) {
    global $db;
    $stmt = $db->prepare("SELECT userId2 AS id, u.displayName, u.avatar FROM messages AS m LEFT JOIN user AS u ON u.id = m.userId2 WHERE userId1 = ? GROUP BY userId2 ORDER BY createdAt DESC");
    $stmt->execute(array($userId));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < count($result); $i++) {
      $stmt = $db->prepare("SELECT * FROM messages WHERE userId1 = ? AND userId2 = ? ORDER BY createdAt DESC LIMIT 1");
      $stmt->execute(array($userId, $result[$i]['id']));
      $lastMessage = $stmt->fetch(PDO::FETCH_ASSOC);
      $result[$i]['lastMessage'] = $lastMessage;
    }
    return $result;
  }
  function sendMessage($userId1, $userId2, $content) {
    global $db;
    $stmt = $db->prepare("INSERT INTO messages (userId1, userId2, content, type, createdAt) VALUE (?, ?, ?, ?, CURRENT_TIMESTAMP())");
    $stmt->execute(array($userId1, $userId2, $content, 0));
    $id = $db->lastInsertId();
    $stmt = $db->prepare("SELECT * FROM messages WHERE id = ?");
    $stmt->execute(array($id));
    $newMessage = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = $db->prepare("INSERT INTO messages (userId2, userId1, content, type, createdAt) VALUE (?, ?, ?, ?, ?)");
    $stmt->execute(array($userId1, $userId2, $content, 1, $newMessage['createdAt']));
  }
  function getMessagesWithUserId($userId1, $userId2) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM messages WHERE userId1 = ? AND userId2 = ? ORDER BY createdAt");
    $stmt->execute(array($userId1, $userId2));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  function getFriends($userId) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM friendship WHERE userId1 = ? OR userId2 = ?");
    $stmt->execute(array($userId, $userId));
    $followings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $friends = array();
    for ($i = 0; $i < count($followings); $i++) {
      $row1 = $followings[$i];
      if ($userId == $row1['userId1']) {
        $userId2 = $row1['userId2'];
        for ($j = 0; $j < count($followings); $j++) {
          $row2 = $followings[$j];
          if ($userId == $row2['userId2'] && $userId2 == $row2['userId1']) {
            $friends[] = findUserById($userId2);
          }
        }
      }
    }
    return $friends;
  }
function change_displayName($displayName,$id,$avatar)
{
    global $db;
    $stmt=$db->prepare("UPDATE user SET displayName=?,avatar=? WHERE id=?");
    return $stmt->execute(array($displayName,$avatar,$id));
}
function getListFriend1($id){
    global $db;
    $stmt=$db->prepare("SELECT userId2 FROM `friendShip` WHERE `userId1`  = ?");
    $stmt->execute(array($id));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getListFriend2($id){
    global $db;
    $stmt=$db->prepare("SELECT userId1 FROM `friendShip` WHERE `userId2`  = ?");
    $stmt->execute(array($id));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function kiemtra($list,$x)
{
    foreach($list as $item){
        if($item['userId2']==$x['userId1'])
        {
            return true;
        }
    }
    return false;
}
function listF($id)
{
       $listF=array();
       $u1=getListFriend1($id);
       $u2=getListFriend2($id);
       foreach($u2 as $item)
       {
           if(kiemtra($u1,$item))
           {
                array_push($listF,$item);
           }
       }
       return $listF;
}
function countPage()
{
    global $db;
    $stmt=$db->query("SELECT COUNT(*) FROM `newfeed` ");
    return  $stmt->fetch(PDO::FETCH_ASSOC);
}
function checkFriend($currentUser,$userId)
{
    $isFollowing = getFriendRequest($currentUser,$userId);
    $isFollwer = getFriendRequest($userId,$currentUser);
    if($isFollowing&&$isFollwer)
    {
        return true;
    }
    else {
        return false;
    }
}
function checkPost($post,$id){
    if($post['type']==0){
        return true;
    }
    if($post['type']==2){
        if($post['idUser']==$id){
            return true;
        }
        else {
            return false;
        }
    }
    if($post['type']==1){
        if($post['idUser']==$id){
            return true;
        }
        if(checkFriend($id,$post['idUser'])){
            return true;
        }
        else {
            return false;
        }
    }
}
function checkPost2($post,$id){
    if($post['type']==0){
        return true;
    }
    if($post['type']==3){
        return false;
    }
    if($post['type']==2){
        if(checkFriend($id,$post['idUser'])){
            return true;
        }
        else {
            return false;
        }
    }
}
function deletemessages($idmessage)
{
    global $db;
    $stmt=$db->prepare("DELETE FROM `messages` WHERE Id=?");
    $stmt->execute(array($idmessage));
}
function SendEmailAddFriend($NamecurrentIid,$displayName,$email,$id)
{
    global $db,$BASE_URL;
    sendEmail($email,$displayName,'Xin chào '.$displayName.' có '.$NamecurrentIid.' Muốn kết bạn với bạn Ấn vào link kế bên dưới để xem chi tiết',"$BASE_URL/profile.php?id=$id");
}
function SendEmailMessages($NamecurrentIid,$displayName,$email,$id,$comment)
{
    global $db,$BASE_URL;
    sendEmail($email,$displayName,'Xin chào '.$displayName.'.    '.$NamecurrentIid.' đã gởi tin nhắc bạn và nói rằng là:'.$comment.'...',"Bấm vào đây để vào xem trang cá nhân: $BASE_URL/profile.php?id=$id");
}
function countPage1($id)
{
    global $db;
    $stmt=$db->prepare("SELECT COUNT(*) FROM newfeed WHERE idUser=?");
    $stmt->execute(array($id));
    return  $stmt->fetch(PDO::FETCH_ASSOC);
}

