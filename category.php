<?php

@include 'config.php';

if (isset($_POST['add-category']))
{
    $category_name = $_POST['category-name'];

    $insert_query = mysqli_query($conn,"INSERT INTO `category`(ten_danhmuc) VALUES('$category_name')");
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn,"DELETE FROM `category` WHERE id_danhmuc = $delete_id");
    // if($delete_query){}
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Category</title>
    <link rel="stylesheet" href="style-admin.css"> 
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
</head>

<body>

<?php @include 'header.php'; ?>
<!-- ---------------------------------------------------------------- -->
    <div class="container">
        <div class="add-category">
            <button class="btn btn-primary js-modal">Thêm danh mục</button>
        </div>
    </div>
    <table class="category-table" style="width:100%; margin-top: 3rem; margin-left: 7rem;">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên danh mục</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            <?php
                $select_category= mysqli_query($conn, "SELECT * FROM `category`");
                if(mysqli_num_rows($select_category) > 0) {
                    while($row=mysqli_fetch_assoc($select_category)){
                            
            ?>
            <tr> 
                <td><?php echo $row['id_danhmuc']; ?></td>
                <td><?php echo $row['ten_danhmuc']; ?></td>
                <td>
                    <a href="category.php?delete=<?php echo $row['id_danhmuc']; ?>" class="btn btn-danger">Xóa</a>
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
                <input class="modal-input" name="category-name" type="text" placeholder="Nhập tên danh mục">
                <button class="btn btn-primary" name="add-category">Thêm</button>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="index.js"></script>
</body>

</html>