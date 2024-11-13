<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="Frontend/assets/css/baiviet.css">
</head>
<body>
    <section class="hdr"> 
        <img src="Frontend/assets/images/blog2.jpg" alt="">
        <img src="Frontend/assets/images/blog2.jpg" alt="">
        <img src="Frontend/assets/images/blog2.jpg" alt="">
    </section>
    <div class="hdt">
    
      <div class="hdt1" >
      <?php
require_once('BackEnd/Controller/C_post.php');
$post = new C_post;

$is_liked = $post->is_like();
$is_shared = $post->is_share();
$bainoibat = $post->hotpost();
$post_share = $post->shares();
$post_like = $post->likes();
$posts = $post->post_details();
$sobl = $post->TongBL();

if (is_array($posts) || is_object($posts)):

    foreach ($posts as $baiviet):
        ?>  <div class="hdt11">
        <div class="hdt12">
            <a href="?action=<?php
                if($baiviet['user_id'] != $_SESSION['userid']) {
                    echo 'taikhoankhac&id='. $baiviet['user_id'];
                } else {
                    echo 'taikhoan';
                }
            ?>"><img src="<?php echo $baiviet['profile_picture'];  ?>" class="hdt121" alt="Popular Post">Tác giả: <?php echo $baiviet['username'];  ?> </a>
        </div>
        <div class="hdt13"><?php echo $baiviet['created_at'];  ?></div>
        <h1><?php echo $baiviet['tittle'];  ?></h1>
        <img src="<?php echo $baiviet['image'];  ?>" class="hdt131" alt="">
        <div class="hdt14">
            <p> <?php echo $baiviet['content'];  ?></p>

        </div>
        <div class="hdt15">
        <a href="?action=liked&id=<?php echo $baiviet['post_id']; ?>">
            <button <?php if (!$is_liked): ?>
                style="background-color: gray;"
            <?php endif; ?>>
                Thích <?php echo $post_like; ?>
            </button>
        </a>

        <a href="?action=shared&id=<?php echo $baiviet['post_id']; ?>">
            <button <?php if (!$is_shared): ?>
                style="background-color: gray;"
            <?php endif; ?>>
                Chia sẻ <?php echo $post_share; ?>
            </button>
        </a>

        </div>
    </div>
                    <?php
                    
    endforeach;
endif;
?>
            
            <div class="hdt21">
                <h2><?php echo $sobl ?> bình luận</h2>
                <div>
                    <form class="hdt211" action="?action=cmt&id=<?php echo $_GET['id'] ?>" method="post" id="formcmt">
                        <img src="<?php echo $_SESSION['img'] ?>" alt="Avatar" class="avatar">
                        <input name="cmt" type="text" class="comment-input" id="commentInput" placeholder="Bình luận...">
                        <p id="error"></p>
                        <button type="submit" class="hdt212" id="dang">Đăng</button>
                    </form>
                    <hr>
                    <div class="hdt213" id="binhluan">
                    <?php


$comments = $post->showcmt();
if (is_array($comments) || is_object($comments)):
    foreach ($comments as $comment):
        $is_like_cmt = $post->islikecmt($comment['comment_id']);
        $style = $is_like_cmt ? "color: blue;" : "color: gray;";  // Màu xanh nếu like, màu xám nếu chưa like
        ?>  <div class="hdt214">
        <img src="<?php echo $comment['profile_picture'] ?>" alt="Avatar" class="hdt215">
        <div class="hdt216">
            <div class="hdt216_ten"><?php echo $comment['username'] ?></div>
            <div class="hdt216_content"><?php echo $comment['content'] ?></div>
            <div class="hdt216_cham">
                <span><?php 
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $commentTime = $comment['created_cmt'];
                $created_at = new DateTime($commentTime, new DateTimeZone('Asia/Ho_Chi_Minh'));
                $currentTime = new DateTime("now", new DateTimeZone('Asia/Ho_Chi_Minh'));
                $interval = $currentTime->diff($created_at);
                if ($interval->y > 0) {
                    echo $interval->y . " năm trước";
                } elseif ($interval->m > 0) {
                    echo $interval->m . " tháng trước";
                } elseif ($interval->d > 0) {
                    echo $interval->d . " ngày trước";
                } elseif ($interval->h > 0) {
                    echo $interval->h . " giờ trước";
                } elseif ($interval->i > 0) {
                    echo $interval->i . " phút trước";
                } else {
                    echo $interval->s . " giây trước";
                }
                
                ?></span>
                <span >
                <a 
    class="like-button"  
    style="<?php echo $style; ?>"
    href="?action=likecmt&id=<?php echo $comment['comment_id']; ?>" 
    data-liked="<?php echo $is_like_cmt ? 'true' : 'false'; ?>"
    data-comment-id="<?php echo $comment['comment_id']; ?>" 
    data-user-id="<?php echo $_SESSION['userid']; ?>"        
>
    <span id="soluotthich<?php echo $comment['comment_id']; ?>">
        <?php echo $post->countlike($comment['comment_id']); ?>
    </span> Thích
</a>
                <span class="phanhoi-btn" id="phanhoi<?php echo $comment['profile_picture'] ?>">Phản hồi</span>
            </div>
            <?php
                $cmtreplies = $post->repcmt($comment['comment_id']);
                if (is_array($cmtreplies) || is_object($cmtreplies)):
                    foreach ($cmtreplies as $cmtreply):
            ?>
             <div class="hdt217">
                <img src="<?php echo $cmtreply['profile_picture'] ?>" alt="Avatar" class="avatar">
                <div class="hdt216_content"><?php echo $cmtreply['content'] ?></div>        
            </div>
            <?php
                    
                endforeach;
            endif;
            ?>
           
            
           <form id="formreply-<?php echo $comment['comment_id'] ?>" action="?action=phanhoi&id=<?php echo $comment['comment_id'] ?>" method="post" class="hdt217 hidden reply-input">
                <img src="<?php echo $_SESSION['img'] ?>" alt="Avatar" class="avatar">
                <input id="replycontent-<?php echo $comment['comment_id'] ?>" name="content" type="text" class="comment-input" placeholder="Bình luận...">
                <p id="errorrl-<?php echo $comment['comment_id'] ?>"></p>
                <button id="repbutton-<?php echo $comment['comment_id'] ?>" type="submit" class="hdt218">Đăng</button>
            </form>

        </div>
        </div>
                    <?php
                    
    endforeach;
endif;
?>
                        
                    </div>
                </div>
            </div>
    </div>

    <div class="hdt4">
          <div class="hdt40  hdt41">
              <h3>Bài viết nổi bật</h3>
              <?php
                if (is_array($bainoibat) || is_object($bainoibat)):
                    foreach ($bainoibat as $bnb):
            ?>
             <div class="hdt412">
                  <img src="<?php echo $bnb['image'] ?>" alt="Popular Post">
                  <div class="hdt413">
                      <a href="?action=baiviet&id=<?php echo $bnb['post_id'] ?>"><?php echo $bnb['tittle'] ?></a>
                      <span><i class="fa-regular fa-calendar"></i> <?php echo $bnb['created_at'] ?></span>
                  </div>
              </div>
                    <?php
                    
    endforeach;
endif;
?>
              
          </div>

          <div class="hdt40  hdt42">
              <h3>Labels</h3>
              <ul>
                  <li> Business <span>5 Posts</span></li>
                  <li> Camera <span>3 Posts</span></li>
                  <li> Design <span>5 Posts</span></li>
                  <li> Food <span>2 Posts</span></li>
                  <li> Game <span>1 Post</span></li>
              </ul>
          </div>
      </div>
      <!-- mess -->
    </div>
    <script src="Frontend/assets/js/baiviet.js"></script>

</body>
</html>
