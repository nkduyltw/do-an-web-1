
<?php
    require_once 'init.php';
    require_once 'functions.php';
    if(!$currentUser){
        header('Location:/WebSite/BTCN08/loginAndRegister.php');
        exit();
    }   
    $page=1;//khởi tạo trang ban đầu
    $limit=10;//số bản ghi trên 1 trang (2 bản ghi trên 1 trang)


    $total_record = countPage();

    $total_page=ceil($total_record["COUNT(*)"]/$limit);

    if(isset($_GET['page']))
            $page=$_GET['page'];
    if($page<1) $page=1; 
    if($page>$total_page) $page=$total_page;
    $start=($page-1)*$limit;
    $newFeed1 =getNewFeedPage($start,$limit);
    $ten=findUserById($currentUser['id']);
?>
<?php include 'header.php'?>
<div class="container" style="margin-top:70px">
<div class="postStatus"style="border-radius:4px/4px;margin-left:10px;margin-right:10px;padding:30px">
    <form action="/WebSite/BTCN08/addStatusIndex.php" method="post"enctype="multipart/form-data">
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"placeholder="Bạn đang nghĩ gì?"name="content"></textarea>
        
        <span class="badge badge-pill badge-light">
            <i class='far fa-image'data-toggle="tooltip" title="Thêm ảnh ">
            <strong style="color:black" data-toggle="collapse" data-target="#demo"> Ảnh</strong>
            <div id="demo" class="collapse">
            <input type="file" name="img">
            </div>
            </i>
        </span>
        <div class="dropdown"style="margin-top:10px">											
            <select name="id_privacy" aria-labelledby="dropdownMenuButton">
                <option value="0" selected>Mọi người</option>
                <option value ="1" >Bạn bè</option>
                <option value ="2" >Chỉ mình tôi</option>
            </select>					
        </div>
        <button class="btn btn-primary"style="margin-left:800px" type="submit"name="submit">Đăng trạng thái</button>
    </form>
</div>
<?php foreach($newFeed1 as $item): ?>
    <?php if(checkPost($item,$currentUser['id'])):?>
    <div id="example1">
    <?php $id= $item['idUser'];$image=findUserById($item['idUser']); ?>
        <?php $getlike=getlike($currentUser['id'],$item['idUser'],$item['idNewFeed']); ?>
        <?php $comment=getcomment($currentUser['id'],$item['idUser'],$item['idNewFeed'],'') ?>
        <?php $notnull =getcommentnotnull($item['idNewFeed']);?>
        <div class="row">
            <div class="col-1">
                <?php if($image['avatar']): ?>
                    <img src="avatar.php?id=<?php echo $id; ?>"class="rounded-circle" alt="Cinque Terre" width="50px" height="50px"style="margin-left:10px">
                <?php else: ?>
                    <img src="no-avatar.jpg"class="rounded-circle" alt="Cinque Terre" width="40px" height="40px">
                <?php endif; ?>
            </div>
            <div class="col-0.25">
                <?php if($item['idUser']!=$currentUser['id']): ?>
                <h5><a href="/WebSite/BTCN08/profile.php?id=<?php echo $item['idUser']; ?>"><strong id="displayName"> <?php echo $item['displayName']; ?> </strong></a></h5>
                <?php else:?>
              <h5> <a href="/WebSite/BTCN08/profile-user.php"><strong id="displayName"> <?php echo $item['displayName']; ?> </strong></a></h5>
                 <?php endif;?>
                <p style="opacity: 0.2">
                    <?php echo $item['time']; ?> 
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
        <p id="content"><?php echo $item['content']; ?> </p>
        
        <?php if($item['image']) :?>
            <div class="img-index">
                <img src="imgPost.php?id=<?php echo $item['idNewFeed']; ?>" alt="">
            </div>
        <?php endif;?>
        
        <?php if($getlike==null): ?>
            <div class="row">
                <div class="col-6">
                    <form method="POST" action="addlike.php">
                        <input type="hidden" name="id" value=<?php echo $_GET['idUser']=$item['idUser'];?>>
                        <input type="hidden" name="idnewfeed" value=<?php echo $_GET['idNewFeed']=$item['idNewFeed'];?>>
                        <button  type="submit"name ="like" class="btn btn-primary text-white btn-block"style="border: 0px">LIKE</button>
                    </form>
                </div>
                <div class="col-6">
                    <form method="POST" action="addcomment.php">
                        <input type="hidden" name="id" value=<?php echo $_GET['idUser']=$item['idUser']; ?>>
                        <input type="hidden" name="idnewfeed" value=<?php echo $_GET['idNewFeed']=$item['idNewFeed'];?>>
                        <button  type="submit"name ="comment" class="btn btn-primary text-white btn-block"style="border: 0px">Comment</button>
                    </form>
                </div>
            </div>
            <?php endif; ?>
                <?php if($getlike!=null): ?>
             <div class="row">
                <div class="col-6">
                    <form method="POST" action="removelike.php">
                        <input type="hidden" name="id" value=<?php echo $_GET['idUser']=$item['idUser']; ?>>
                        <input type="hidden" name="idnewfeed" value=<?php echo $_GET['idNewFeed']=$item['idNewFeed'];?>>
                        <button  type="submit"name ="like" class="btn btn-primary text-white btn-block"style="border: 0px">UNLIKE</button>
                    </form>
                </div>
                <div class="col-6">
                    <form method="POST" action="addcomment.php">
                        <input type="hidden" name="id" value=<?php echo $_GET['idUser']=$item['idUser']; ?>>
                        <input type="hidden" name="idnewfeed" value=<?php echo $_GET['idNewFeed']=$item['idNewFeed'];?>>
                        <button  type="submit"name ="comment" class="btn btn-primary text-white btn-block" style="border:0px">Comment</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
        <?php if($notnull!=null&&$comment==null): ?>
            <?php $tmp=getcontent($item['idNewFeed']); ?>
            <?php foreach($tmp as $content): ?>
                <form method="POST" action="index.php">
                    <div class="row">
                        <div class="col-1"style="margin-top: 20px">
                            <img src="avatar.php?id=<?php echo $content['id']; ?>"class="rounded-circle" alt="Cinque Terre" width="40px" height="40px"style="margin-left:10px">
                        </div>
                        <div class="col-0.25" style="margin-top: 20px">
                            <p class="card-title"><a href="/WebSite/BTCN08/profile.php?id=<?php echo $content['id']; ?>"><strong id="displayName"> <?php echo $item['displayName']; ?> </strong></a></p>
                            <p><div class = "blue-square"  style='word-wrap:break-word'><div class ="center"><?php echo $content['content'];?></div></div></p>
                        </div>
                    </div>
                </form>
             <?php endforeach?>
        <?php endif; ?>
        <?php deletecontentnull($currentUser['id'],$item['idUser'],$item['idNewFeed'],' '); ?>
        <?php if($comment!=null): ?>
                <form method="POST" action="addcontent.php">
                    <div class="row">
                        <div class="col-1"style="margin-top: 20px">
                            <img src="avatar.php?id=<?php echo $currentUser['id']; ?>"class="rounded-circle" alt="Cinque Terre" width="40px" height="40px"style="margin-left:10px">
                        </div>
                        <div class="col-0.25"style="margin-top: 20px">
                            <p class="card-title"><a href="/WebSite/BTCN08/profile-user.php"><strong id="displayName"> <?php echo $ten['displayName']; ?> </strong></a></p>
                            <input type="hidden" name="id" value=<?php echo $_GET['idUser']=$item['idUser']; ?>>
                            <input type="hidden" name="idnewfeed" value=<?php echo $_GET['idNewFeed']=$item['idNewFeed'];?>>
                            <input class="form-control " type="text" name ="content"style="width:800px"placeholder="Viết bình luận..." >
                            <button type="submit"name ="BinhLuan" class="btn btn-primary"style="margin-top:10px ">Bình Luận</button>
                        </div>
                    </div>
                </form>
        <?php endif; ?>
    </div>
                <?php endif;?>
<?php endforeach?>
        <div class="container"style="margin:10px">
           <?php 
            // PHẦN HIỂN THỊ PHÂN TRANG
 
            // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
            if ($page > 1 && $total_page > 1){
                echo '<a href="index.php?page='.($page-1).'">Prev</a> | ';
            }
 
            // Lặp khoảng giữa
            for ($i = 1; $i <= $total_page; $i++){
                // Nếu là trang hiện tại thì hiển thị thẻ span
                // ngược lại hiển thị thẻ a
                if ($i == $page){
                    echo '<span>'.$i.'</span> | ';
                }
                else{
                    echo '<a href="index.php?page='.$i.'">'.$i.'</a> | ';
                }
            }
 
            // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
            if ($page < $total_page && $total_page > 1){
                echo '<a href="/WebSite/BTCN08/index.php?page='.($page+1).'">Next</a> | ';
            }
           ?>
        </div>
<?php include 'footer.php'?>