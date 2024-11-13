<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="frontend/admin/assets/css/ql_binhluan.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'admin.php'?>
        <div class="main-content">
            <?php include 'header.php' ?>
            <div class="content">
                <div class="card">
                    <div class="card-header">
                        <h2 style="text-align: center;">Danh sách Bình Luận</h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr style="text-align: center;">
                                    <th>comment_id</th>
                                    <th>post_id</th>
                                    <th>user_id</th>
                                    <th>content</th>
                                    <th>create_at</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                require_once "BackEnd/Controller/C_admin.php";
                                $adm = new C_admin();
                                $cmts = $adm->showbl();
                                if (is_array($cmts) || is_object($cmts)):
                                foreach ($cmts as $cmt):
                                ?>
                                        <tr id="dong<?php echo $cmt['comment_id'] ?>" style="text-align: center;">
                                        <td><?php echo $cmt['comment_id'] ?></td>
                                        <td><?php echo $cmt['post_id'] ?></td>
                                        <td><?php echo $cmt['user_id'] ?></td>
                                        <td><?php echo $cmt['content'] ?></td>
                                        <td><?php echo $cmt['created_cmt'] ?></td>
                                        <td>
                                            <a data-href="?action=adDC&id=<?php echo $cmt['comment_id'] ?>" 
                                                    data-id="<?php echo $cmt['comment_id'] ?>"
                                                     class="btn btn-danger delete-button">
                                            <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    endforeach;
                                endif;
                                    ?>
                                    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="Frontend/admin/assets/js/binhluan.js"></script>
</body>
</html>
