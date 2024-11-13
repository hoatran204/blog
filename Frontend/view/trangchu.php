<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="Frontend/assets/css/trangchu.css">
</head>
<body>
    
    <div style="background-image: url('Frontend/assets/images/blog.jpg'); border-radius: 10px;width:100vw">
      <div class="hdt1">
          <h1>Hello! Đây là trang Blog.</h1>
          <p>A modern and customizable Blogger theme for publications, blogs, journals and more.</p>
      </div>
      <div class="hdt2">
          <div class="hdt21" data-tag="Lamdep">
              <img src="Frontend/assets/images/lamdep.jpg" alt="Makeup">
              <span class="tag">Làm đẹp</span>
          </div>
          <div class="hdt21" data-tag="Nauan">
              <img src="Frontend/assets/images/nauan.jpg" alt="Beauty">
              <span class="tag">Nấu ăn</span>
          </div>
          <div class="hdt21" data-tag="Kinhte">
              <img src="Frontend/assets/images/kinhte.jpg" alt="TRAVEL">
              <span class="tag">Kinh tế</span>
          </div>
          <div class="hdt21" data-tag="Thethao">
              <img src="Frontend/assets/images/thethao.jpg" alt="Dieting">
              <span class="tag">Thể thao</span>
          </div>
          <div class="hdt21" data-tag="Suckhoe">
              <img src="Frontend/assets/images/suckhoe.jpg" alt="Tips">
              <span class="tag">Sức khỏe</span>
          </div>
          <div class="hdt21" data-tag="Trithuc">
              <img src="Frontend/assets/images/trithuc.jpg" alt="Fitness">
              <span class="tag">Tri thức</span>
          </div>
      </div>
    </div>
    <div class="hdt3">
      <div class="hdt31">
      <?php
require_once('BackEnd/Controller/C_post.php');
$post = new C_post;
$posts = $post->post();

if ($posts !== null):
    foreach ($posts as $post):
        ?>  <div class="hdt311" data-tag="<?php echo $post['tag'];  ?>">
        <a href='?action=baiviet&id=<?php echo $post['post_id'];  ?>' >
          <div class="hdt-img">
              <img src="<?php echo $post['image'];  ?>" >
              <span class="tag1 travel"><?php echo $post['tag'];  ?></span>
          </div>
          <div class="hdt312">
              <h3><?php echo $post['tittle'];  ?></h3>
              <p><?php echo $post['content'];  ?></p>
           
              <div class="hdt313">
                  <span><i class="fa-solid fa-person"></i><?php echo $post['username'];  ?></span>
                  <span>📅 <?php echo $post['created_at'];  ?></span>
              </div>
          </div>
        </a>
      </div>
                    <?php
                    
    endforeach;
endif;
?>
          
      </div>

      <div class="hdt4">
          <div class="hdt40  hdt41">
              <h3>Bài viết nổi bật</h3>
              <?php
        require_once "BackEnd/Controller/C_post.php";
        $post = new C_post();
        $bainoibat = $post->hotpost();
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
    <script src="Frontend/assets/js/trangchu.js"></script>
</body>
</html>
