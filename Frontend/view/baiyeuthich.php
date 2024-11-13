<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="Frontend/assets/css/baiyeuthich.css">
</head>
<body>
    <section class="hdr"> 
    <img src="Frontend/assets/images/blog2.jpg" alt="">
    <img src="Frontend/assets/images/blog2.jpg" alt="">
    <img src="Frontend/assets/images/blog2.jpg" alt="">
    </section>
    <div class="hdt">
    
      <div class="hdt1">
            <div class="hdt11">
                <h1>Bài viết bạn đã yêu thích</h1>
                <div class="hdt12">
                    <i class="fa fa-search"></i>
                    <input type="text" id="hdt13" placeholder="Tìm kiếm.....">
                </div>
            <div class="hdt2">
            <?php
require_once('BackEnd/Controller/C_post.php');
$post = new C_post;
$bainoibat = $post->hotpost();
$posts = $post->InterestedPost($_SESSION['userid']);

if ($posts !== null):
    foreach ($posts as $post):
        ?>  
        
            <div class="hdt21">
            <a href="?action=baiviet&id=<?php echo $post['post_id']; ?>">
                <div class="hdt22">
                    <img src="<?php echo $post['image']; ?>" alt="Post Image">
                    <span class="tag1 living"><?php echo $post['tag']; ?></span>
                </div>
                <div class="hdt23">
                    <h3><?php echo $post['tittle']; ?></h3>
                    <p><?php echo $post['content']; ?></p>                    
                    <div class="hdt24">
                        <span>👤 <?php echo $post['username']; ?></span>
                        <span>📅 <?php echo $post['created_at']; ?></span>
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
    
<script src="assets/js/baiyeuthich.js"></script>
</body>
</html>