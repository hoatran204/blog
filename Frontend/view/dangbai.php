<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="Frontend/assets/css/dangbai.css">
    <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>
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
                    <form class="hdt12" id="formdangbai" action="?action=posting" method="post">
                        <h1>ĐĂNG BÀI MỚI</h1>
                        <div class="hdt13">
                            <input name="file-upload" type="file" id="file-upload" accept="image/*">
                            <label for="file-upload" class="upload-label">CHỌN ẢNH</label>
                            <p>Tải lên ảnh đại diện cho bài viết tại đây.<br>Lưu ý không sử dụng ảnh có dung lượng quá 1MB.</p>
                        </div>
                        <input name="title" type="text" id="title" placeholder="Tiêu đề bài viết...">
                        <select name="tags" id="hdt14">
                            <option value="Lamdep">Làm đẹp</option>
                            <option value="Nauan">Nấu ăn</option>
                            <option value="Kinhte">Kinh tế</option>
                            <option value="Thethao">Thể thao</option>
                            <option value="Suckhoe">Sức khỏe</option>
                            <option value="Trithuc">Tri thức</option>
                        </select>
                        <textarea id="example" name="content" id="hdt15" placeholder="Nội dung..."></textarea>
                        
                        <div id="errorMessages"></div>         
                        <button type="submit" class="submit-btn">ĐĂNG BÀI</button>
                    </form>
                </div>
        </div>

        <aside class="hdt2">
    <div class="hdt21 ">
        <h3>Bài viết nổi bật</h3>
        <?php
        require_once "BackEnd/Controller/C_post.php";
        $post = new C_post();
        $bainoibat = $post->hotpost();
                if (is_array($bainoibat) || is_object($bainoibat)):
                    foreach ($bainoibat as $bnb):
            ?>
             <div class="hdt22">
                  <img src="<?php echo $bnb['image'] ?>" alt="Popular Post">
                  <div class="hdt23">
                      <a href="?action=baiviet&id=<?php echo $bnb['post_id'] ?>"><?php echo $bnb['tittle'] ?></a>
                      <span><i class="fa-regular fa-calendar"></i> <?php echo $bnb['created_at'] ?></span>
                  </div>
              </div>
                    <?php
                    
    endforeach;
endif;
?>
    </div>

    <div class="hdt21 hst24">
        <h3>Labels</h3>
        <ul>
            <li>📁 Business <span>5 Posts</span></li>
            <li>📁 Camera <span>3 Posts</span></li>
            <li>📁 Design <span>5 Posts</span></li>
            <li>📁 Food <span>2 Posts</span></li>
            <li>📁 Game <span>1 Post</span></li>
        </ul>
    </div>
</aside>
<!-- mess -->
    </div>     
    <script src="Frontend/assets/js/dangbai.js"></script>
    <script>
        var editor = new FroalaEditor('#example');
    </script>
</body>
</html>