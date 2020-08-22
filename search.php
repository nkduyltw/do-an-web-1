<?php
    require_once ('init.php');
    require_once ('functions.php');
    if(!$currentUser){
        header('Location:/WebSite/BTCN08/index.php');
        exit();
    }
    include 'header.php';
    $search=$_POST['searchemail'];
?>
<?php if(isset($_POST['searchemail']) && strlen($search)>0):?>
<?php if(strpos($search,'@')): ?>
    <div class="container" style="margin-top:70px">
    <?php $user=findUserByEmail($search);?>
    <?php if($user) :?>
        <?php
            $isFollowing = getFriendRequest($currentUser['id'], $user['id']);
            $addfriend1 = $isFollowing['follow'];
            $isfollow1=getFollowRequest($currentUser['id'], $user['id']);
            $follow1=$isfollow1['follow'];
            $isFollwer = getFriendRequest( $user['id'],$currentUser['id']);
        ?>
        <div style="background-color: #fff ;padding: 50px;border: 1px solid rgba(33, 33, 33, .33);margin-bottom: 10px;"> 
            <div class="row">
                <div class="col-1">
                    <?php if($user['avatar']): ?>
                    <img src="/WebSite/BTCN08/avatar.php?id=<?php echo $user['id']; ?>"class="rounded-circle" alt="Cinque Terre" width="50px" height="50px"style="margin-left:10px">
                    <?php else: ?>
                    <img src="no-avatar.jpg"class="rounded-circle" alt="Cinque Terre" width="50px" height="50px"style="margin-left:10px">
                    <?php endif;?>
                </div>
                <div class="col-2"style="margin-top:10px">
                    <a href="/WebSite/BTCN08/profile.php?id=<?php echo $user['id']; ?>"><strong id="displayName"> <?php echo $user['displayName']; ?> </strong></a> 
                </div>
                <div class="col-3"></div>
                <div class="col"style="margin-top:30px">
                <?php if($isFollowing && $isFollwer && $follow1==1): ?>
                <div class="row-7">
                <form method="POST" action="remove-friend.php" >
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Xóa kết bạn</button>
                </form>
                <form method="POST" action="remove-follow.php">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Đang Theo dõi</button>
                </form>
                <form method="POST" action="conversation.php?id= <?php echo $user['id']; ?>">
                    <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Nhắn Tin</button>
                </form>
                </div>
                <?php endif;?>
                    <?php if($isFollowing && $isFollwer && $follow1==0):?>
                    <div class="row">
                    <form method="POST" action="remove-friend.php">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Xóa kết bạn</button>
                    </form>
                    <form method="POST" action="add-follow.php">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Theo Dõi</button>
                    </form>
                    <form method="POST" action="conversation.php?id= <?php echo $user['id']; ?>">
                        <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Nhắn Tin</button>
                    </form>
                    </div>
                <?php else: ?>
                    <?php if($isFollowing && !$isFollwer): ?>
                        <div class="row">
                        <form method="POST" action="remove-friend.php">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Xóa lời mời</button>
                        </form>
                        <?php if($addfriend1==1)?>
                            <form method="POST" action="remove-follow.php">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Đang theo dõi</button>
                            </form>
                            <form method="POST" action="conversation.php?id= <?php echo $user['id']; ?>">
                                <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Nhắn Tin</button>
                            </form>
                            </div>
                    <?php endif; ?>
                    <?php if(!$isFollowing&&$isFollwer): ?>
                        <div class="row">
                        <form method="POST" action="remove-friend.php">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Xóa lời mời</button>
                        </form>
                        <form method="POST" action="add-friend.php">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Đồng ý kết bạn</button>
                        </form>
                        </div>
                    <?php endif; ?>
                    <?php  if(!$isFollowing && !$isFollwer&& $follow1==0): ?>
                        <div class="row">
                        <form method="POST" action="add-friend.php">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-primary" style="padding:0px;margin-right:2px">Gửi lời mời kết bạn</button>
                        </form>
                        <form method="POST" action="add-follow.php">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Theo dõi</button>
                        </form>
                        <form method="POST" action="conversation.php?id= <?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Nhắn Tin</button>
                        </form>
                        </div>
                    <?php endif; ?>
                    <?php  if(!$isFollowing && !$isFollwer&& $follow1==1): ?>
                        <div class="row">
                        <form method="POST" action="add-friend.php">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Gửi lời mời kết bạn</button>
                        </form>
                        <form method="POST" action="remove-follow.php">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-primary">Đang Theo dõi</button>
                        </form>
                        <form method="POST" action="conversation.php?id= <?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Nhắn Tin</button>
                        </form>
                        </div>
                <?php endif; ?>
            <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif;?>
</div>
<?php else : ?>
    <?php $item=findUserByDislayName($search,$currentUser['id']); ?>
    <div class="container" style="margin-top:70px;background-color: #fff">
    <?php foreach($item as $user): ?>
        <?php
            $isFollowing = getFriendRequest($currentUser['id'], $user['id']);
            $addfriend1 = $isFollowing['follow'];
            $isfollow1=getFollowRequest($currentUser['id'], $user['id']);
            $follow1=$isfollow1['follow'];
            $isFollwer = getFriendRequest( $user['id'],$currentUser['id']);
        ?>
    <div>
    <div style="padding:50px; border-bottom: 1px solid">
        <div class="row">
            <div class="col-1">
                <?php if($user['avatar']): ?>
                <img src="/WebSite/BTCN08/avatar.php?id=<?php echo $user['id']; ?>"class="rounded-circle" alt="Cinque Terre" width="50px" height="50px"style="margin-left:10px">
                <?php else: ?>
                <img src="no-avatar.jpg"class="rounded-circle" alt="Cinque Terre" width="50px" height="50px"style="margin-left:10px">
                <?php endif;?>
            </div>
            <div class="col-3"style="margin-top:10px">
                <a href="/WebSite/BTCN08/profile.php?id=<?php echo $user['id']; ?>"><strong id="displayName"> <?php echo $user['displayName']; ?> </strong></a> 
            </div>
        
            <div class="col"style="margin-left:200px">
            <?php if($isFollowing && $isFollwer && $follow1==1): ?>
                <div class="row">
                <form method="POST" action="/WebSite/BTCN08/remove-friend.php" >
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Xóa kết bạn</button>
                </form>
                <form method="POST" action="/WebSite/BTCN08/remove-follow.php">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Đang Theo dõi</button>
                </form>
                <form method="POST" action="/WebSite/BTCN08/conversation.php?id= <?php echo $user['id']; ?>">
                    <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Nhắn Tin</button>
                </form>
            </div>
            <?php endif;?>
                <?php if($isFollowing && $isFollwer && $follow1==0):?>
                <div class="row">
                <form method="POST" action="/WebSite/BTCN08/remove-friend.php">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Xóa kết bạn</button>
                </form>
                <form method="POST" action="/WebSite/BTCN08/add-follow.php">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Theo Dõi</button>
                </form>
                <form method="POST" action="/WebSite/BTCN08/conversation.php?id= <?php echo $user['id']; ?>">
                    <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Nhắn Tin</button>
                </form>
            </div>
                <?php else: ?>
                    <?php if($isFollowing && !$isFollwer): ?>
                        <div class="row">
                        <form method="POST" action="/WebSite/BTCN08/remove-friend.php">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Xóa lời mời</button>
                        </form>
                        <?php if($addfriend1==1)?>
                            <form method="POST" action="/WebSite/BTCN08/remove-follow.php">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Đang theo dõi</button>
                            </form>
                            <form method="POST" action="/WebSite/BTCN08/conversation.php?id= <?php echo $user['id']; ?>">
                                <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Nhắn Tin</button>
                            </form>
                            </div>
                    <?php endif; ?>
                    <?php if(!$isFollowing&&$isFollwer): ?>
                        <div class="row">
                        <form method="POST" action="/WebSite/BTCN08/remove-friend.php">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Xóa lời mời</button>
                        </form>
                        <form method="POST" action="/WebSite/BTCN08/add-friend.php">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Đồng ý kết bạn</button>
                        </form>
                        </div>
                    <?php endif; ?>
                    <?php  if(!$isFollowing && !$isFollwer&& $follow1==0): ?>
                        <div class="row">
                        <form method="POST" action="/WebSite/BTCN08/add-friend.php">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-primary" style="padding:0px;margin-right:2px">Gửi lời mời kết bạn</button>
                        </form>
                        <form method="POST" action="/WebSite/BTCN08/add-follow.php">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Theo dõi</button>
                        </form>
                        <form method="POST" action="/WebSite/BTCN08/conversation.php?id= <?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Nhắn Tin</button>
                        </form>
                        </div>
                    <?php endif; ?>
                <?php  if(!$isFollowing && !$isFollwer&& $follow1==1): ?>
                    <div class="row">
                    <form method="POST" action="/WebSite/BTCN08/add-friend.php">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Gửi lời mời kết bạn</button>
                    </form>
                    <form method="POST" action="/WebSite/BTCN08/remove-follow.php">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Đang Theo dõi</button>
                    </form>
                    <form method="POST" action="/WebSite/BTCN08/conversation.php?id= <?php echo $user['id']; ?>">
                        <button type="submit" class="btn btn-primary"style="padding:0px;margin-right:2px">Nhắn Tin</button>
                    </form>
                    </div>
            <?php endif; ?>
        <?php endif; ?>
        </div>
    </div>
    </div>
    <?php endforeach;?>
</div>
<?php endif; ?>
<?php else :?>

<?php endif;?>
<?php include 'footer.php'?>    