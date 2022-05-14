<?php

@include 'config.php';

if (isset($_POST['add-category-content']))
{
    $category_name_content = $_POST['category-name-content'];
    $p_category = $_POST['p_category'];

    $insert_query = mysqli_query($conn,"INSERT INTO `loai_spham`(id_danhmuc,loai_sp) VALUES('$p_category','$category_name_content')");
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
</head>

<body>
<?php @include 'header.php'; ?>
    
<!-- ---------------------------------------------------------------- -->
    <div class="container">
        <div class="add-category-content" style="display:flex; justify-content: flex-end;">
            <button class="btn btn-primary js-modal">Thêm loại sản phẩm</button>
        </div>
    </div>
    <table class="type-table">
        <thead>
            <th>ID</th>
            <th>Danh mục</th>
            <th>Loại sản phẩm</th>
            <th>Actions</th>
        </thead>
        <tbody >
        <?php
                $select_category_content= mysqli_query($conn, "SELECT loai_spham.*, category.ten_danhmuc FROM `loai_spham` INNER JOIN `category` ON loai_spham.id_danhmuc = category.id_danhmuc ");
                if(mysqli_num_rows($select_category_content) > 0) {
                    while($row=mysqli_fetch_assoc($select_category_content)){
                            
            ?>
            <tr> 
                <td><?php echo $row['id_loai_sp']; ?></td>
                <td><?php echo $row['ten_danhmuc']; ?></td>
                <td><?php echo $row['loai_sp']; ?></td>
                <td>
                <a href="type-product.php?delete=<?php echo $row['id_loai_sp']; ?>" class="btn btn-danger" style="padding-top: 0px !important; padding-bottom: 0px !important;">Xóa</a>
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
                <h4>Thêm Danh Mục</h4>
            </header>
            <form action="" method="post" class="modal-body" enctype="multipart/form-data">
                <select name="p_category" class="modal-input" required>
                    <option value="">--Chọn danh mục--</option>

                <?php
                $select_category= mysqli_query($conn, "SELECT * FROM `category`");
                if(mysqli_num_rows($select_category) > 0) {
                    while($row=mysqli_fetch_assoc($select_category)){
                ?>
                    <option value="<?php echo $row['id_danhmuc']; ?>"><?php echo $row['ten_danhmuc']; ?></option>
                <?php
                    };
                    }
                ?>    
                </select>
                <input class="modal-input" name="category-name-content" type="text" placeholder="Nhập loại sản phẩm">
                <button class="btn btn-primary" name="add-category-content">Thêm</button>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="index.js"></script>
</body>

</html>