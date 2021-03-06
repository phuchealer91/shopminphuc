<?php
require_once  __DIR__."/../../autoload/autoload.php";
$open = "product";
$product = $db->fetchAll("product");
    if(isset($_GET['page'])){
        $p = $_GET['page'];
    }
    else {
        $p = 1;
    }
    //Select dữ liệu lấy hết dữ liệu bên bảng trái (product) bên phải ko có dữ liệu thì để trống
    $sql = "SELECT product.*, category.name AS category_id FROM product LEFT JOIN 
            category ON category.id = product.category_id ORDER BY id DESC ";
    $product = $db->fetchJone("product",$sql,$p,5,true);
    if(isset($product['page'])){
        $sotrang = $product['page'];
        unset($product['page']);
    }

?>
<?php require_once  __DIR__."/../../layouts/header.php"; ?>
<!--Page Heading NOI DUNG-->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Danh sách danh mục
            <a href="add.php" class="btn btn-success pull-right">Thêm mới</a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Danh mục
            </li>
        </ol>
        <div class="clearfix"></div>
        <!--        THÔNG BÁO LỖI-->
        <?php require_once  __DIR__. "/../../../partials/notification.php";   ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Viết tắt</th>
                    <th>ID danh mục</th>
                    <th>Hình ảnh</th>
                    <th>Thông tin</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                <?php $stt = 1; foreach ($product as $item) { ?>
                    <tr>
                        <td><?php echo $stt;?></td>
                        <td><?php echo $item['name']?></td>
                        <td><?php echo $item['slug'] ?></td>
                        <td><?php echo $item['category_id'] ?></td>
                        <td>
                            <img style="border-radius: 8px" src="<?php echo uploads() ?>product/<?php echo $item['thunbar']; ?>" alt="" width="80px" href="80px">
                        </td>
                        <td>
                            <ul class="nav">
                                <li><b>Giá:</b> <?php echo $item['price']?> VND</li>
                                <li><b>Số lượng:</b> <?php echo $item['number']?></li>
                            </ul>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-success" href="edit.php?id=<?php echo $item['id'];?>"><i class="fa fa-edit"></i> Sửa</a>
                            <a onclick="return confirm('Bạn có muốn xóa không?');" class="btn btn-danger" href="delete.php?id=<?php echo $item['id'];?>"><i class="fa fa-times"></i> Xóa</a>
                        </td>
                    </tr>
                    <?php $stt++; }?>
                </tbody>
            </table>
            <div class="pull-right">
                <nav aria-label="Page navigation example" >
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo ($p > 1 && $sotrang > 1) ? $p-1 : $p; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <?php for($i=1; $i <= $sotrang; $i++) { ?>
                        <?php
                            if(isset($_GET['page'])){
                                $p = $_GET['page'];
                            }
                            else {
                                $p = 1;
                            }
                        ?>
                        <li class="page-item <?php echo ($i == $p) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                        <?php } ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo ($p < $sotrang && $sotrang > 1) ? $p+1 : $p; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- /.row -->
<?php require_once  __DIR__."/../../layouts/footer.php"; ?>

