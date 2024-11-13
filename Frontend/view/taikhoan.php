<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="Frontend/assets/css/taikhoan.css">
</head>
<body>
    <section class="hdr"> 
    <img src="Frontend/assets/images/blog2.jpg" alt="">
    <img src="Frontend/assets/images/blog2.jpg" alt="">
    <img src="Frontend/assets/images/blog2.jpg" alt="">
    </section>
    <div class="hdt0">
    
      <div class="hdt1">
            <div class="hdt2">
                <div class="hdt21">
                    <div class="hdt211">
                        <div class="hdt212">
                            <img src="<?php echo $_SESSION['img'] ?>">
                        </div>
                        <div class="hdt213">
                            <h1><?php echo $_SESSION['username'] ?></h1>
                            <p>
                                <?php
                                require_once "BackEnd/Controller/C_post.php";
                                require_once "BackEnd/Controller/C_user.php";
                                $user = new C_user();
                                $post = new C_post();
                                $bainoibat = $post->hotpost();
                                echo $post->count($_SESSION['userid']);
                                ?> post | 
                                <?php echo $user->num_follow($_SESSION['userid']); ?> followers | 
                                <?php echo $user->num_follower($_SESSION['userid']) ?> following</p>
                            <h7><?php echo $_SESSION['bio'] ?></h7>
                        </div>
                        <div class="hdt214">
                            <button class="edit-profile">Edit profile</button>
                            
                        </div>
                    </div>
                    <div class="hdt215">
                        <div class="tab" data-tab="posts">Bài viết</div>
                        <div class="tab" data-tab="liked">Đã thích</div>
                        <div class="tab" data-tab="shared">Đã chia sẻ</div>
                    </div>
                </div>
                <div class="edittk">
                    
                    <div class="overlay hidden" id="overlay"></div>
                    <div class="edit-form  hidden" id="editForm">
                        <h2>Cập nhật thông tin cá nhân</h2>
                        <form id="updateForm" action="?action=update_profile" method="POST" enctype="multipart/form-data">
                            <label for="username">Tên người dùng</label>
                            <input type="text" id="username" name="username" placeholder="Nhập tên người dùng">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Nhập email">
                            <label for="bio">Giới thiệu</label>
                            <textarea id="bio" name="bio" rows="4" placeholder="Viết vài dòng giới thiệu..."></textarea>
                            <label for="profile_picture">Ảnh đại diện</label>
                            <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                            
                            <div id="errorMessages"></div>
                            <div class="form-actions">
                                <button type="submit">Lưu</button>
                                <button type="button" id="cancelButton">Hủy</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div  id="posts-content" class="tab-content"><div class="hdt3">
                <?php
                
$posts = $post->getpostUser($_SESSION['userid']);

if ($posts !== null):
    foreach ($posts as $baiviet):
        ?>  <div class="hdt31">
        <a href='?action=baiviet&id=<?php echo $baiviet['post_id'] ?>'>
        <div class="hdt32">
            <img src="<?php echo $baiviet['image'] ?>" alt="Post Image">
            <span class="tag1 travel"><?php echo $baiviet['tag'] ?></span>
        </div>
        <div class="hdt33">
            <h3><?php echo $baiviet['tittle'] ?></h3>
            <p><?php echo $baiviet['content'] ?></p>
            <div class="hdt34">
                <span><i class="fa-solid fa-person"></i> <?php echo $baiviet['username'] ?></span>
                <span><i class="fa-regular fa-calendar"></i> <?php echo $baiviet['created_at'] ?></span>
            </div>
        </div>
        </a>
    </div>
                    <?php
                    
    endforeach;
endif;
?>
                    

                </div></div>
                <div  id="liked-content" class="tab-content" style="display: none;">
                    <div class="hdt3">
                <?php
                
                $likeds = $post->InterestedPost($_SESSION['userid']);
                
                if ($likeds !== null):
                    foreach ($likeds as $liked):
                        ?>  <div class="hdt31">
                        <a href='?action=baiviet&id=<?php echo $liked['post_id'] ?>'>
                        <div class="hdt32">
                            <img src="<?php echo $liked['image'] ?>" alt="Post Image">
                            <span class="tag1 travel"><?php echo $liked['tag'] ?></span>
                        </div>
                        <div class="hdt33">
                            <h3><?php echo $liked['tittle'] ?></h3>
                            <p><?php echo $liked['content'] ?></p>
                            <div class="hdt34">
                                <span><i class="fa-solid fa-person"></i> <?php echo $liked['username'] ?></span>
                                <span><i class="fa-regular fa-calendar"></i> <?php echo $liked['created_at'] ?></span>
                            </div>
                        </div>
                        </a>
                    </div>
                                    <?php
                                    
                    endforeach;
                endif;
                ?> </div>
                </div>
                <div  id="shared-content" class="tab-content" style="display: none;">
                <div class="hdt3">
                <?php
                
                $Shares = $post->LuotShare($_SESSION['userid']);
                if ($Shares !== null):
                    foreach ($Shares as $share):
                        ?>  <div class="hdt31">
                        <a href='?action=baiviet&id=<?php echo $share['post_id'] ?>'>
                        <div class="hdt32">
                            <img src="<?php echo $share['image'] ?>" alt="Post Image">
                            <span class="tag1 travel"><?php echo $share['tag'] ?></span>
                        </div>
                        <div class="hdt33">
                            <h3><?php echo $share['tittle'] ?></h3>
                            <p><?php echo $share['content'] ?></p>
                            <div class="hdt34">
                                <span><i class="fa-solid fa-person"></i> <?php echo $share['username'] ?></span>
                                <span><i class="fa-regular fa-calendar"></i> <?php echo $share['created_at'] ?></span>
                            </div>
                        </div>
                        </a>
                    </div>
                                    <?php
                                    
                    endforeach;
                endif;
                ?> </div>
                </div>
                
            </div>
    </div>

      <div class="hdt4">
          <div class="hdt41 ">
              <h3>Bài viết nổi bật</h3>
              <?php
        
                if (is_array($bainoibat) || is_object($bainoibat)):
                    foreach ($bainoibat as $bnb):
            ?>
             <div class="hdt42">
                  <img src="<?php echo $bnb['image'] ?>" alt="Popular Post">
                  <div class="hdt43">
                      <a href="?action=baiviet&id=<?php echo $bnb['post_id'] ?>"><?php echo $bnb['tittle'] ?></a>
                      <span><i class="fa-regular fa-calendar"></i> <?php echo $bnb['created_at'] ?></span>
                  </div>
              </div>
                    <?php
                    
    endforeach;
endif;
?>
          </div>

          <div class="hdt41 hdt44">
              <h3>Labels</h3>
              <ul>
                  <li>📁 Business <span>5 Posts</span></li>
                  <li>📁 Camera <span>3 Posts</span></li>
                  <li>📁 Design <span>5 Posts</span></li>
                  <li>📁 Food <span>2 Posts</span></li>
                  <li>📁 Game <span>1 Post</span></li>
              </ul>
          </div>
      </div>
    </div>
    <script src="Frontend/assets/js/taikhoan.js"></script>
</body>
</html>