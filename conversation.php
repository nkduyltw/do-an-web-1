<?php
require_once 'init.php';
require_once 'functions.php';
if (isset($_POST['content'])) {
  sendMessage($currentUser['id'], $_GET['id'], $_POST['content']);
  $name1=findUserById($currentUser['id']);
  $name2=findUserById($_GET['id']);
  $email=$name2['email'];
  $content=$_POST['content'];
  $noidung=substr($content,0,10);
  SendEmailMessages($name1['displayName'],$name2['displayName'],$email,$currentUser['id'],$noidung);
}
$messages = getMessagesWithUserId($currentUser['id'], $_GET['id']);
$user = findUserById($_GET['id']);
?>
<?php include 'header.php' ?>
<div class="container"style="background: #fff;margin-top:70px;padding:50px">


<h3>Cuộc trò chuyện với: <?php echo $user['displayName'] ?></h3>
<?php foreach ($messages as $message) : ?>
<div class="card" style="margin-bottom: 10px;">
  <div class="card-body">
    <?php if ($message['type'] == 1) : ?>
    <div class="row">
      <div class="col-9">
        <?php if($user['avatar']): ?>
          <img src="avatar.php?id=<?php echo $_GET['id']; ?>"class="rounded-circle" alt="Cinque Terre" width="40px" height="40px">
        <?php else: ?>
          <img src="no-avatar.jpg"class="rounded-circle" alt="Cinque Terre" width="40px" height="40px">
        <?php endif;?>
          <strong style="margin-left:5px"><?php echo $user['displayName'] ?></strong>:
              <?php echo $message['content'] ?>
      </div>
      <div class="col-3">
        <form method="POST" action="delete-messages.php">
          <input type="hidden" name="userId2" value=<?php echo $_GET['userId2']=$message['userId2']; ?>>
          <input type="hidden" name="id" value=<?php echo $_GET['Id']=$message['Id'];?>>
          <button class="btn btn-light"><i class="fas fa-ellipsis-h"></i></button>
        </form>
      </div>
    </div>
    <?php else: ?>
    <p class="card-text text-right">
      <?php echo $message['content'] ?>
      <?php if($user['avatar']): ?>
      <img src="avatar.php?id=<?php echo $_GET['id']; ?>"class="rounded-circle" alt="Cinque Terre" width="40px" height="40px">
      <?php else: ?>
        <img src="no-avatar.jpg"class="rounded-circle" alt="Cinque Terre" width="40px" height="40px">
      <?php endif;?>
      </p>
    <?php endif; ?>
  </div>
</div>
<?php endforeach; ?>
<form method="POST">
  <div class="form-group">
    <label for="content">Tin nhắn:</label>
    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Gửi tin nhắn</button>
</form>
</div>
<?php include 'footer.php' ?>