<?php
require_once 'init.php';
if (isset($_POST['userId']) && isset($_POST['content'])) {
  sendMessage($currentUser['id'], $_POST['userId'], $_POST['content']);
  header('Location: conversation.php?id=' . $_POST['userId']);
}
$friends = getFriends($currentUser['id']);
?>
<?php include 'header.php' ?>
<div class="container"style="margin-top:70px;background: #fff;padding:30px">
<form method="POST">
  <div class="form-group">
    <label for="userId">Người nhận</label>
    <select class="form-control" id="userId" name="userId">
      <?php foreach($friends as $friend) : ?>
      <?php
        $user = findUserById($friend['id']);
      ?>
      <option value="<?php echo $user['id'] ?>"><?php echo $user['displayName'] ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="content">Tin nhắn:</label>
    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Gửi tin nhắn</button>
</form>
</div>
<?php include 'footer.php' ?>