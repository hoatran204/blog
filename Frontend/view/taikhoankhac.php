<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="Frontend/assets/css/taikhoankhac.css">
</head>
<body>
    <?php include 'header.php'?>
    <div class="hdr"> 
    <img src="Frontend/assets/images/blog2.jpg" alt="">
    <img src="Frontend/assets/images/blog2.jpg" alt="">
    <img src="Frontend/assets/images/blog2.jpg" alt="">
    </div>
    <div class="hdt0">
      <div class="hdt1">
            <div class="hdt2">
            <?php
require_once('BackEnd/Controller/C_user.php');
require_once('BackEnd/Controller/C_post.php');
$user = new C_user();
$following = $user->following($_SESSION['userid'], $_GET['id']);
$num_follow = $user->num_follow($_GET['id']);
$num_follower = $user->num_follower($_GET['id']);
$users = $user->ortherUser();

$post = new C_post();

if (!empty($users)):
    foreach ($users as $user):
        ?>  <div class="hdt21">
        <div class="hdt211">
            <div class="hdt213">
                <img src="<?php echo $user['profile_picture'] ?>">
            </div>
            <div class="hdt214">
                <h1><?php echo $user['username'] ?></h1>
                <p><?php 
                echo $post->count($_GET['id']);
                ?> post | <?php echo $num_follow;  ?> followers | <?php echo $num_follower;  ?> following</p>
            </div>
            <div class="hdt215">
                <a href="?action=follow&id=<?php echo $_GET['id']; ?>">
                <button class="following"><?php
                if (!$following) {
                echo  "Follow" ;
                } else {
                    echo "Hủy Follow";
                }?> 
                </button></a>
                <a href="?action=message&friend_id=2"><button id="message"><i class="fa-brands fa-facebook-messenger"></i></button></a>
            </div>
        </div>
        <div class="hdt216">
            <div class="hdt217">Posts</div>
            <div class="hdt217">Saved</div>
            <div class="hdt217">Tagged</div>
        </div>
    </div>
                    <?php
                    
    endforeach;
endif;
?>
                
                <div class="hdt22">
                <?php
$posts = $post->getpostUser($_GET['id']);

if ($posts !== null):
    foreach ($posts as $post):
        ?>  <div class="hdt221">
        <a href='?action=baiviet&id=<?php echo $post['post_id'] ?>'>
        <div class="hdt222">
            <img src="<?php echo $post['image'] ?>" alt="Post Image">
            <span class="tag1 travel"><?php echo $post['tag'] ?></span>
        </div>
        <div class="hdt223">
            <h3><?php echo $post['tittle'] ?></h3>
            <p><?php echo $post['content'] ?></p>
            <div class="hdt224">
                <span><i class="fa-solid fa-person"></i> <?php echo $post['user_id'] ?></span>
                <span><i class="fa-regular fa-calendar"></i> <?php echo $post['created_at'] ?></span>
            </div>
        </div>
        </a>
    </div>

                    <?php
                    
    endforeach;
endif;
?>
                    
                </div>
            </div>
    </div>
      <div class="hdt3">
          <div class="hdt30 hdt31">
              <h3>Bài viết nổi bật</h3>
              <?php
        require_once "BackEnd/Controller/C_post.php";
        $post = new C_post();
        $bainoibat = $post->hotpost();
                if (is_array($bainoibat) || is_object($bainoibat)):
                    foreach ($bainoibat as $bnb):
            ?>
             <div class="hdt312">
                  <img src="<?php echo $bnb['image'] ?>" alt="Popular Post">
                  <div class="hdt313">
                      <a href="?action=baiviet&id=<?php echo $bnb['post_id'] ?>"><?php echo $bnb['tittle'] ?></a>
                      <span><i class="fa-regular fa-calendar"></i> <?php echo $bnb['created_at'] ?></span>
                  </div>
              </div>
                    <?php
                    
    endforeach;
endif;
?>
          </div>

          <div class="hdt30 hdt32">
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
      <!-- mess -->
    </div>
    <script src="assets/js/taikhoankhac.js"></script>
</body>
</html>