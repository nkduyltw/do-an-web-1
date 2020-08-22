<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/png" href="/WebSite/BTCN08/facebook-new.png"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <link type="text/css" rel="stylesheet" href="style.css" />
    
    <title>facebook</title>
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="/WebSite/BTCN08/" id="fa">facebook</a>
        
        <form class="form-inline my-2 my-lg-0" method="POST" action="/WebSite/BTCN08/search.php">
            <input class="form-control mr-sm-2 input-search" type="search" placeholder="Search" aria-label="Search" id= "serachemail" name="searchemail">
            <button class="btn btn-light btn-search" type="submit"><i class="fas fa-search"></i></button>
        </form>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0"id="header-menu">
            <li style="margin-top:10px">
            <a href="/WebSite/BTCN08/"title="Trang chủ">Trang chủ</i></a>
            </li>
            <li style="margin-top:10px">
            <a href="/WebSite/BTCN08/"title="Trang chủ">|</i></a>
            </li>
            <li style="margin-top:10px;margin-left:0px">
            <a href="/WebSite/BTCN08/profile-user.php"title="Trang cá nhân"><?php echo $currentUser['displayName']; ?></i></a>
            </li>
            <li style="margin-top:10px">
                <a href="/WebSite/BTCN08/"title="Home"><i class="fas fa-home"></i></a>
            </li>
            <li style="margin-top:10px">
                <a href="/WebSite/BTCN08/friendShip.php"title="Danh sách bạn bè"><i class="fas fa-users"></i></a>
            </li>
            <li style="margin-top:10px">
                <a href="/WebSite/BTCN08/message.php"title="Tin nhắn"><i class="fab fa-facebook-messenger"></i></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cog"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                
                <a class="dropdown-item" href="/WebSite/BTCN08/change_password.php">Đổi mật khẩu</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/WebSite/BTCN08/logout.php">Đăng xuất</a>
                </div>
            </li>
        </ul>
    </div>
    </nav>
    


   
    
    

   