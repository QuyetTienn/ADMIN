<?php

@include 'config.php';
// session_start();
// if(!isset($_SESSION['username'])){
//     header('location:../BTL/account/login.php');
// }
if (isset($_POST['add-product']))
{
    $p_name = $_POST['p_name'];
    $p_type = $_POST['p_type'];
    $p_price = $_POST['p_price'];
    $p_category = $_POST['p_category'];
    $p_image1 = $_FILES['p_image1']['name'];
    $p_image1_tmp_name = $_FILES['p_image1']['tmp_name'];
    $p_image1_folder = 'upload_img/'.$p_image1;
    $p_image2 = $_FILES['p_image2']['name'];
    $p_image2_tmp_name = $_FILES['p_image2']['tmp_name'];
    $p_image2_folder = 'upload_img/'.$p_image2;
    $p_image3 = $_FILES['p_image3']['name'];
    $p_image3_tmp_name = $_FILES['p_image3']['tmp_name'];
    $p_image3_folder = 'upload_img/'.$p_image3;

    $insert_query = mysqli_query($conn,"INSERT INTO `product`(ten_sp,id_danhmuc,id_loai_sp,gia_sp,img_1,img_2,img_3) VALUES('$p_name','$p_category','$p_type','$p_price','$p_image1','$p_image2','$p_image3')");
    if($insert_query){
        move_uploaded_file($p_image1_tmp_name,$p_image1_folder);
        move_uploaded_file($p_image2_tmp_name,$p_image2_folder);
        move_uploaded_file($p_image3_tmp_name,$p_image3_folder);
    }
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn,"DELETE FROM `loai_spham` WHERE id_loai_sp = $delete_id");
    // if($delete_query){}
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>admin page</title>
    <link rel="stylesheet" href="style-admin.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
    <?php @include 'header.php';?>
<!-- ---------------------------------------------------------------- -->
    <div class="container">
        <div class="add-product">
            <button class="btn btn-primary js-modal">Thêm sản phẩm</button>
        </div>
    </div>
    <table class="product-table table-bordered">
        <thead>
            <th>ID</th>
            <th>Tên SP</th>
            <th>Danh mục</th>
            <th>Loại SP</th>
            <th>Giá</th>
            <th>Ảnh</th>
            <th>Actions</th>
        </thead>
        <tbody>
        <?php
                $select_product= mysqli_query($conn, "SELECT product.*, category.ten_danhmuc, loai_spham.loai_sp FROM `product` INNER JOIN `loai_spham` ON product.id_loai_sp = loai_spham.id_loai_sp INNER JOIN `category` ON product.id_danhmuc = category.id_danhmuc ");
                $total= mysqli_num_rows($select_product);
                $limit = 6;
                $page = ceil($total / $limit);
                $cr_page = (isset($_GET['page']) ? $_GET['page'] : 1);
                $start = ($cr_page - 1) * $limit;
                $select_product= mysqli_query($conn, "SELECT product.*, category.ten_danhmuc, loai_spham.loai_sp FROM `product` INNER JOIN `loai_spham` ON product.id_loai_sp = loai_spham.id_loai_sp INNER JOIN `category` ON product.id_danhmuc = category.id_danhmuc LIMIT $start, $limit");
                if(mysqli_num_rows($select_product) > 0) {
                    while($row=mysqli_fetch_assoc($select_product)){
                            
            ?>
            <tr> 
                <td><?php echo $row['id_sp']; ?></td>
                <td><?php echo $row['ten_sp']; ?></td>
                <td><?php echo $row['ten_danhmuc']; ?></td>
                <td><?php echo $row['loai_sp']; ?></td>
                <td><?php echo $row['gia_sp']; ?></td>
                <td width="200px">
                    <img src="image/<?php echo $row['img_2']; ?>" height="50"> 
                    <img src="image/<?php echo $row['img_3']; ?>" height="50"> 
                    <img src="image/<?php echo $row['img_1']; ?>" height="50"> 
                </td>
                <td width="50px">
                <a href="test2.php?delete=<?php echo $row['id_sp']; ?>" class="btn btn-danger" style="padding-top: 0px !important; padding-bottom: 0px !important;">Xóa</a>
                </td>
            </tr>
            <?php
                };
            }else{
                echo "<span></span>";
            }
            ?>
        </tbody>
    </table>
    <nav aria-label="..." style="margin-top: 2rem; margin-bottom: 2rem;">
        <ul class="pagination" style="justify-content: center;">
        <?php for($i=1;$i<= $page; $i++){ ?>
            <li class="page-item <?php echo($cr_page == $i ? 'active' :'') ?>"><a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i?></a></li>
        <?php } ?>
        </ul>
    </nav>

 <!-- ---------------------------- -->
    <div class="modal-category">
        <div class="modal-container">
            <div class="modal-close">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                    <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                </svg>
            </div>
            <header>
                <h4>Thêm Sản Phẩm</h4>
            </header>
            <form action="" method="post" class="modal-body" enctype="multipart/form-data">
                <select name="p_category" id="p_category" class="modal-input" required>
                    <option value="0">--Chọn danh mục--</option>
                </select>
                <select name="p_type" id="p_type" class="modal-input" required>
                    <option value="0">--Loại sản phẩm--</option>
                </select>
                <input type="text" name="p_name" placeholder="Tên sản phẩm" class="modal-input" required>
                <input type="number" name="p_price" min="0" placeholder="Giá sản phẩm" class="modal-input" required>
                <label>Ảnh 1</label>
                <input type="file" name="p_image1" accept="image/png, image/jpg, image/jpeg" class="modal-input-img" required>
                <label>Ảnh 2</label>
                <input type="file" name="p_image2" accept="image/png, image/jpg, image/jpeg" class="modal-input-img" required>
                <label>Ảnh 3</label>
                <input type="file" name="p_image3" accept="image/png, image/jpg, image/jpeg" class="modal-input-img" required>
                <button class="btn btn-primary" name="add-product">Thêm</button>
            </form>
        </div>
    </div>
    <script>
$(document).ready(function(){    
    $.ajax({
        url: "http://localhost/admin/document/laydanhmuc.php",       
        dataType:'json',         
        success: function(data){     
            for (i=0; i<data.length; i++){            
                var danhmuc = data[i]; 
                var str = ` 
                    <option value="${danhmuc['id_danhmuc']}">
                        ${danhmuc['ten_danhmuc']} 
                    </option>`;
                $("#p_category").append(str);
            }
            $( "#p_category").on("change", function(e) { layloaisp();  });
        }
    });
})
</script>
<script>
function layloaisp(){
    var id_danhmuc = $("#p_category").val();
    $.ajax({
        url: "http://localhost/admin/document/layloaisp.php?id_danhmuc=" + id_danhmuc,
        dataType:'json',         
        success: function(data){     
            $("#p_type").html("");
            for (i=0; i<data.length; i++){            
                var p_type = data[i]; 
                var str = ` 
                    <option value="${p_type['id_loai_sp']}">
                         ${p_type['loai_sp']} 
                    </option>`;
                $("#p_type").append(str);
            }            
        }
    });
}
</script>
<script type="text/javascript" src="index.js"></script>

</body>
</html>