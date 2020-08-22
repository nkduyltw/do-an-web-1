
<?php
    require_once ('init.php');
    require_once ('functions.php');
    if(!$currentUser){
        header('Location:/WebSite/BTCN08/index.php');
        exit();
    }
    $userId=$_GET['id'];
    $profile=findUserById($userId);

    $isFollowing = getFriendRequest($currentUser['id'],$userId);
    $addfriend1 = $isFollowing['follow'];
    $isfollow1=getFollowRequest($currentUser['id'],$userId);
    $follow1=$isfollow1['follow'];
    $isFollwer = getFriendRequest($userId,$currentUser['id']);

    $page=1;//khởi tạo trang ban đầu
    $limit=10;//số bản ghi trên 1 trang (2 bản ghi trên 1 trang)


    $total_record = countPage1($userId);

    $total_page=ceil($total_record["COUNT(*)"]/$limit);

    if(isset($_GET['page']))
            $page=$_GET['page'];

    if($page<1) $page=1; 
    if($page>$total_page) $page=$total_page;
    $start=($page-1)*$limit;

    $post= getPostCur($userId,$start,$limit);
?>

<?php include'header.php';?>
<div class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-8">
            <div class="db">
                <?php if($profile['avatar']) :?>
                <img src="/WebSite/BTCN08/avatar.php?id=<?php echo $profile['id']; ?>" alt=""class="db-img">
                <?php else: ?>
                    <img src="no-avatar.jpg" alt=""class="db-img">
                <?php endif;?>
                <a href="#" class="db-profile-name"> <?php echo $profile['displayName']; ?></a>
            </div>
            </div>
            <div class="col-4"style="margin-top:230px">
            <?php if($isFollowing && $isFollwer && $follow1==1): ?>
                <div class="row">
                <form method="POST" action="/WebSite/BTCN08/remove-friend.php" >
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        <button type="submit" class="btn btn-secondary btn-sm"style="padding:0px;margin-right:2px">Xóa kết bạn</button>
                </form>
                <form method="POST" action="/WebSite/BTCN08/remove-follow.php">
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        <button type="submit" class="btn btn-secondary btn-sm"style="padding:0px;margin-right:2px">Đang Theo dõi</button>
                </form>
                <form method="POST" action="/WebSite/BTCN08/conversation.php?id= <?php echo $profile['id']; ?>">
                    <button type="submit" class="btn btn-secondary btn-sm"style="padding:0px;margin-right:2px">Nhắn Tin</button>
                </form>
                </div>
                <?php endif;?>
                    <?php if($isFollowing && $isFollwer && $follow1==0):?>
                    <div class="row">
                    <form method="POST" action="/WebSite/BTCN08/remove-friend.php">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                            <button type="submit" class="btn btn-secondary btn-sm"style="padding:0px;margin-right:2px">Xóa kết bạn</button>
                    </form>
                    <form method="POST" action="/WebSite/BTCN08/add-follow.php">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                            <button type="submit" class="btn btn-secondary btn-sm"style="padding:0px;margin-right:2px">Theo Dõi</button>
                    </form>
                    <form method="POST" action="/WebSite/BTCN08/conversation.php?id= <?php echo $profile['id']; ?>">
                        <button type="submit" class="btn btn-secondary btn-sm"style="padding:0px;margin-right:2px">Nhắn Tin</button>
                    </form>
                    </div>
                <?php else: ?>
                    <?php if($isFollowing && !$isFollwer): ?>
                        <div class="row">
                        <form method="POST" action="/WebSite/BTCN08/remove-friend.php">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                            <button type="submit" class="btn btn-secondary btn-sm"style="padding:0px;margin-right:2px">Xóa lời mời</button>
                        </form>
                        <?php if($addfriend1==1)?>
                            <form method="POST" action="/WebSite/BTCN08/remove-follow.php">
                                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                <button type="submit" class="btn btn-secondary btn-sm"style="padding:0px;margin-right:2px">Đang theo dõi</button>
                            </form>
                            <form method="POST" action="/WebSite/BTCN08/conversation.php?id= <?php echo $profile['id']; ?>">
                                <button type="submit" class="btn btn-secondary btn-sm"style="padding:0px;margin-right:2px">Nhắn Tin</button>
                            </form>
                            </div>
                    <?php endif; ?>
                    <?php if(!$isFollowing&&$isFollwer): ?>
                        <div class="row">
                        <form method="POST" action="/WebSite/BTCN08/remove-friend.php">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                            <button type="submit" class="btn btn-secondary btn-sm"style="padding:0px;margin-right:2px">Xóa lời mời</button>
                        </form>
                        <form method="POST" action="/WebSite/BTCN08/add-friend.php">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                            <button type="submit" class="btn btn-secondary btn-sm"style="padding:0px;margin-right:2px">Đồng ý kết bạn</button>
                        </form>
                        </div>
                    <?php endif; ?>
                    <?php  if(!$isFollowing && !$isFollwer&& $follow1==0): ?>
                        <div class="row">
                        <form method="POST" action="/WebSite/BTCN08/add-friend.php">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                            <button type="submit" class="btn btn-secondary btn-sm"style="padding:0px;margin-right:2px">Gửi lời mời kết bạn</button>
                        </form>
                        <form method="POST" action="/WebSite/BTCN08/add-follow.php">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                            <button type="submit" class="btn btn-secondary btn-sm"style="padding:0px;margin-right:2px">Theo dõi</button>
                        </form>
                        <form method="POST" action="/WebSite/BTCN08/conversation.php?id= <?php echo $profile['id']; ?>">
                            <button type="submit" class="btn btn-secondary btn-sm"style="padding:0px;margin-right:2px">Nhắn Tin</button>
                        </form>
                        </div>
                    <?php endif; ?>
                    <?php  if(!$isFollowing && !$isFollwer&& $follow1==1): ?>
                        <div class="row">
                        <form method="POST" action="/WebSite/BTCN08/add-friend.php">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                            <button type="submit" class="btn btn-secondary btn-sm"style="padding:0px;margin-right:2px">Gửi lời mời kết bạn</button>
                        </form>
                        <form method="POST" action="/WebSite/BTCN08/remove-follow.php">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                            <button type="submit" class="btn btn-secondary btn-sm"style="padding:0px;margin-right:2px">Đang Theo dõi</button>
                        </form>
                        <form method="POST" action="/WebSite/BTCN08/conversation.php?id= <?php echo $profile['id']; ?>">
                            <button type="submit" class="btn btn-secondary btn-sm"style="padding:0px;margin-right:2px">Nhắn Tin</button>
                        </form>
                        </div>
                <?php endif; ?>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="timeline-nav">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#">Dòng thời gian</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#">Giới thiệu</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#">Bạn bè</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#">Ảnh</a>
        </li>
    </ul>
</div>

<div class="row" style="margin-top:10px">
    <div class="col-md-3 col sm-3">
    <div class="container-fluid">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title fas fa-globe-asia"> Giới thiệu</h5>
                <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-memory"></i> Tiểu sử</h6>

                <?php if($profile['story']) :?>
                <p class="card-text"> <?php echo $profile['story']; ?></p>
                <?php endif;?>

                <?php if($profile['live-at']) :?>
                <p class="card-text"><i class="fas fa-map-marker-alt"></i> <?php echo $profile['live-at']; ?></p>
                <?php endif;?>

                <p class="card-text"><i class="fas fa-envelope-open"></i> <?php echo $profile['email']; ?></p>

                <p class="card-text"><i class="fas fa-phone-alt"></i> <?php echo $profile['phoneNumber']; ?></p>

                <?php if($profile['school-learned']) :?>
                <p class="card-text"><i class="fas fa-graduation-cap"></i> <?php echo $profile['school-learned']; ?></p>
                <?php endif;?>
            </div>
        </div>
    </div>
    </div>
    <div class="col-md-6 col sm-6">
        
    <?php $user=findUserById($userId) ?>
    
    <?php foreach($post as $item): ?>
        <?php if(checkPost2($item,$currentUser['id'])): ?>
        <div class="post">
            <div class="media">
                <?php if($user['avatar']):?>
                <img class="mr-3" src="/WebSite/BTCN08/avatar.php?id=<?php echo $userId; ?>"width="64px" height="64px">
                <?php else:?>
                <img class="mr-3" src="no-avatar.jpg"width="64px" height="64px">
                <?php endif;?>
                <div class="media-body">
                    <h5 class="mt-0"><?php echo $user['displayName']; ?></h5>
                    <p style="opacity: 0.2"><i class="fas fa-globe-africa"></i> 
                        <?php echo $item['time'];?>
                        <?php if ($item['type']==0): ?>
                        <i class="fas fa-globe" title="Công khai"style="margin-bottom:0px"> Công khai</i>
                    <?php endif;?>
                    <?php if ($item['type']==1): ?>
                        
                        <i class="fas fa-user-friends" title="Bạn bè"style="margin-bottom:0px"> Bạn bè</i>
                    <?php endif;?>
                    <?php if ($item['type']==2): ?>
                        <i class="fas fa-user-lock" title="Chỉ mình tôi"style="margin-bottom:0px"> Chỉ mình tôi</i>
                    <?php endif;?>
                    </p>
                </div>
            </div>
            <div class="content">
                <?php echo $item['content'];?>
            </div>
            <?php if($item['image']) :?>
                <div class="img-post">
                    <img src="imgPost.php?id=<?php echo $item['idNewFeed']; ?>" alt="">
                </div>
            <?php endif;?>
        </div>
        <?php endif;?>
    <?php endforeach;?>
    </div>
    <div class="col-md-3 col sm-3">
        
    </div>
</div>
<div class="container"style="margin:10px">
<div class="row">
    <div class="col-4"></div>
    <div class="col-4">
    <?php 
            // PHẦN HIỂN THỊ PHÂN TRANG
            // BƯỚC 7: HIỂN THỊ PHÂN TRANG
 
            // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
            if ($page > 1 && $total_page > 1){
                echo '<a href="/WebSite/BTCN08/profile.php?id='.$userId. '&&page='.($page-1).'">Prev</a> | ';
            }
 
            // Lặp khoảng giữa
            for ($i = 1; $i <= $total_page; $i++){
                // Nếu là trang hiện tại thì hiển thị thẻ span
                // ngược lại hiển thị thẻ a
                if ($i == $page){
                    echo '<span>'.$i.'</span> | ';
                }
                else{
                    echo '<a href="/WebSite/BTCN08/profile.php?id='.$userId. '&&page='.$i.'">'.$i.'</a> | ';
                }
            }
 
            // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
            if ($page < $total_page && $total_page > 1){
                echo '<a href="/WebSite/BTCN08/profile.php?id='.$userId. '&&page='.($page+1).'">Next</a> | ';
            }
           ?>
    </div>
    <div class="col-4"></div>
</div>
          
        </div>
</div>
<?php include'footer.php';?>
