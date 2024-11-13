<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="frontend/admin/assets/css/ql_nguoidung.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'admin.php'?>
        <div class="main-content">
            <?php include 'header.php' ?>
            <div class="content">
                <div class="card">
                    <div class="card-header">
                        <h2 style="text-align: center;">Danh sách Người Dùng</h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr style="text-align: center;">
                                    <th>user_id</th>
                                    <th>user_name</th>
                                    <th>email</th>
                                    <th>password</th>
                                    <th>profile_picture</th>
                                    <th>bio</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                require_once "BackEnd/Controller/C_admin.php";
                                $adm = new C_admin();
                                $users = $adm->showusers();
                                if (is_array($users) || is_object($users)):
                                foreach ($users as $user):
                                ?>
                                        <tr id="dong<?php echo $user['user_id'] ?>" style="text-align: center;">
                                        <td><?php echo $user['user_id'] ?></td>
                                        <td><?php echo $user['username'] ?></td>
                                        <td><?php echo $user['email'] ?></td>
                                        <td><?php echo $user['password'] ?></td>
                                        <td><img src="<?php echo $user['profile_picture'] ?>"></td>
                                        <td><?php echo $user['bio'] ?></td>
                                        <td>
                                            <a data-href="?action=adDU&id=<?php echo $user['user_id'] ?>" 
                                            data-id="<?php echo $user['user_id'] ?>"
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
    <script src="Frontend/admin/assets/js/nguoidung.js"></script>

</body>
</html>
