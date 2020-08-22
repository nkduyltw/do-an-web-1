<?php
require_once 'init.php';
$conversations = getLatestConversations($currentUser['id']);
?>
<?php include 'header.php' ?>
<h1>Danh sách tin nhắn</h1>
<a href="new-message.php" class="btn btn-primary" style="margin-left:500px;padding:10px" role="button" aria-pressed="true">Thêm cuộc trò chuyện</a>
<div class="container">
  <?php foreach ($conversations as $conversation) : ?>
  <div class="card" style="margin-bottom: 10px;">
    <div class="card-body">
      <h4 class="card-title">
        <div class="row">
          <div class="col">
            <?php if ($conversation['avatar']) : ?>
              <img src="avatar.php?id=<?php echo $conversation['id']; ?>"class="img-thumbnail" alt="Cinque Terre" width="60px" height="60px">
            <?php else : ?>
            <img class="avatar" src="no-avatar.jpg">
            <?php endif; ?>
          </div>
          <div class="col-11">
            <a href="profile.php?id=<?php echo $conversation['id'] ?>"><?php echo $conversation['displayName'] ?></a>
          </div>
        </div>
      </h4>
      <p class="card-text">
      <small>Tin nhắn cuối: <?php echo $conversation['lastMessage']['createdAt'] ?></small>
      <div class="row">
        <div class="col-1">
          <p><?php echo $conversation['lastMessage']['content'] ?></p>
        </div>
        <div class="col-2">
          <a href="conversation.php?id=<?php echo $conversation['id'] ?>">Trả Lời Tin Nhắn Này</a>
        </div>
      </div>
      </p>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php include 'footer.php' ?>