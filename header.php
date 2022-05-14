<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:../BTL/account/login.php');
}
if (isset($_POST['logout'])){
    unset($_SESSION['username']);
    header('location:../BTL/account/login.php');
}
?>
<header class="d-flex justify-content-start py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="index.php" class="nav-link" aria-current="page">Admin</a></li>
            <li class="nav-item"><a href="category.php" class="nav-link">Danh mục sản phẩm</a></li>
            <li class="nav-item"><a href="type-product.php" class="nav-link">Loại sản phẩm</a></li>
            <li class="nav-item">
                <form method="post" action=""> 
                    <button type="submit" name="logout" class="nav-link text-danger" style="margin-left: 700px;">Đăng xuất</button>
                </form>
            </li>
        </ul>
</header>