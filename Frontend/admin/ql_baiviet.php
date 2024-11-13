<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="frontend/admin/assets/css/ql_baiviet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'admin.php'?>
        <div class="main-content">
            <?php include 'header.php' ?>
            <div class="content">
                <div class="card">
                    <div class="card-header">
                        <h2 style="text-align: center;">Danh sách Bài Viết</h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr style="text-align: center;">
                                    <th>post_id</th>
                                    <th>user_id</th>
                                    <th>title</th>
                                    <th>content</th>
                                    <th>image</th>
                                    <th>create_at</th>
                                    <th>Người Tạo</th>
                                    <th>Lượt thích</th>
                                    <th>Bình Luận</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require_once "BackEnd/Controller/C_admin.php";
                                $adm = new C_admin();
                                $posts = $adm->allpost();
                                if (is_array($posts) || is_object($posts)):
                                foreach ($posts as $post):
                                ?>
                                        <tr id="dong<?php echo $post['post_id'] ?>" style="text-align: center;">
                                            <td><?php echo $post['post_id'] ?></td>
                                            <td><?php echo $post['user_id'] ?></td>
                                            <td><?php echo $post['tittle'] ?></td>
                                            <td><?php echo $post['content'] ?></td>
                                            <td><img src="<?php echo $post['image'] ?>"></td>
                                            <td><?php echo $post['created_at'] ?></td>
                                            <td><?php echo $post['username'] ?></td>
                                            <td><?php echo $post['total_likes'] ?></td>
                                            <td><?php echo $post['total_comments'] ?></td>
                                            <td>
                                                <a data-href="?action=adDP&id=<?php echo $post['post_id'] ?>" 
                                                    data-id="<?php echo $post['post_id'] ?>" 
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
    <script src="Frontend/admin/assets/js/baiviet.js"></script>
</body>
</html>
