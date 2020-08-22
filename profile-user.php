<?php
    require_once ('init.php');
    require_once ('functions.php');
    if(!$currentUser){
        header('Location:/WebSite/BTCN08/index.php');
        exit();
    }
    $page=1;//khởi tạo trang ban đầu
    $limit=10;//số bản ghi trên 1 trang (2 bản ghi trên 1 trang)


    $total_record = countPage1($currentUser['id']);

    $total_page=ceil($total_record["COUNT(*)"]/$limit);

    if(isset($_GET['page']))
            $page=$_GET['page'];

    if($page<1) $page=1; 
    if($page>$total_page) $page=$total_page;
    $start=($page-1)*$limit;
    $image=findUserById($currentUser['id']);
?>

<?php include'header.php';?>

<div class="jumbotron">
    <div class="container">
        <div class="db">
            <?php if($image['avatar']): ?>
                <img src="avatar.php?id=<?php echo $currentUser['id']; ?> ?>" alt=""class="db-img">
            <?php else: ?>
                <img src="no-avatar.jpg"alt=""class="db-img">
            <?php endif; ?>
            <a href="#" class="db-profile-name"> <?php echo $currentUser['displayName']; ?></a>
        </div>
    </div>
</div>
<div class="timeline-nav">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="/WebSite/BTCN08/profile-user.php">Dòng thời gian</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#">Giới thiệu</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="/WebSite/BTCN08/friendShip.php">Bạn bè</a>
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

                <?php if($currentUser['story']) :?>
                <p class="card-text"> <?php echo $currentUser['story']; ?></p>
                <?php endif;?>

                <?php if($currentUser['live-at']) :?>
                <p class="card-text"><i class="fas fa-map-marker-alt"></i> <?php echo $currentUser['live-at']; ?></p>
                <?php endif;?>

                <p class="card-text"><i class="fas fa-envelope-open"></i> <?php echo $currentUser['email']; ?></p>

                <p class="card-text"><i class="fas fa-phone-alt"></i> <?php echo $currentUser['phoneNumber']; ?></p>

                <?php if($currentUser['school-learned']) :?>
                <p class="card-text"><i class="fas fa-graduation-cap"></i> <?php echo $currentUser['school-learned']; ?></p>
                <?php endif;?>
                
                <a href="/WebSite/BTCN08/update_profile.php">Cập nhật thông tin chi tiết</a>
            </div>
        </div>
    </div>
    </div>
    <div class="col-md-6 col sm-6">
        <div class="postStatus">
            <form action="/WebSite/BTCN08/addStatus.php" method="post"enctype="multipart/form-data">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"placeholder="Bạn đang nghĩ gì?"name="content"></textarea>
                
                <span class="badge badge-pill badge-light">
                    <i class='far fa-image'data-toggle="tooltip" title="Thêm ảnh ">
                    <strong style="color:black" data-toggle="collapse" data-target="#demo"> Ảnh</strong>
                    <div id="demo" class="collapse">
                    <input type="file" name="img">
                    </div>
                    </i>
                </span>
                <div class="row">
                    <div class="col-8">
                        <div class="dropdown"style="margin-top:10px">											
                            <select name="id_privacy" aria-labelledby="dropdownMenuButton">
                                <option value="0" selected>Mọi người</option>
                                <option value ="1" >Bạn bè</option>
                                <option value ="2" >Chỉ mình tôi</option>
                            </select>					
                        </div>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary" type="submit"name="submit">Đăng trạng thái</button>
                    </div>
                </div>
            </form>
        </div>
    <?php $post= getPostCur($currentUser['id'],$start,$limit); ?>
    <?php foreach($post as $item): ?>
        <div class="post">
            <div class="media">
                <img class="mr-3" src="avatar.php?id=<?php echo $currentUser['id']; ?>"width="64px" height="64px">
                <div class="media-body">
                    <h5 class="mt-0"><?php echo $currentUser['displayName']; ?></h5>
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
                echo '<a href="/WebSite/BTCN08/profile-user.php?id='.$currentUser['id']. '&&page='.($page-1).'">Prev</a> | ';
            }
 
            // Lặp khoảng giữa
            for ($i = 1; $i <= $total_page; $i++){
                // Nếu là trang hiện tại thì hiển thị thẻ span
                // ngược lại hiển thị thẻ a
                if ($i == $page){
                    echo '<span>'.$i.'</span> | ';
                }
                else{
                    echo '<a href="/WebSite/BTCN08/profile-user.php?id='.$currentUser['id']. '&&page='.$i.'">'.$i.'</a> | ';
                }
            }
 
            // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
            if ($page < $total_page && $total_page > 1){
                echo '<a href="/WebSite/BTCN08/profile-user.php?id='.$currentUser['id']. '&&page='.($page+1).'">Next</a> | ';
            }
           ?>
    </div>
    <div class="col-4"></div>
</div>
          
        </div>
</div>
<?php include'footer.php';?>