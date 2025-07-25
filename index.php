
<?php require_once 'inc/header.php' ?>
<?php require_once 'inc/conn.php' ?>
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            <!-- <h4>Best Offer</h4> -->
            <!-- <h2>New Arrivals On Sale</h2> -->
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
            <!-- <h4>Flash Deals</h4> -->
            <!-- <h2>Get your best products</h2> -->
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content">
            <!-- <h4>Last Minute</h4> -->
            <!-- <h2>Grab last minute deals</h2> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->

    <div class="latest-products">
      <div class="container">
       
      <div class="row">
      <?php
        require_once 'inc/success.php';
        require_once 'inc/errors.php';
      ?>
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Latest Posts</h2>
              <!-- <a href="products.html">view all products <i class="fa fa-angle-right"></i></a> -->
            </div>
          </div>

          <?php

            $limit = 2;

            if(isset($_GET['page']))
            {
              $page = $_GET['page'];
            }else{
              $page = 1;
            }
             

            $query = "select count(id) as total from posts ";
            $runQuery =  mysqli_query($conn,$query);
            $total =  mysqli_fetch_assoc($runQuery)['total'];

            $numberOfPages =ceil($total/$limit); 

            $offset = ($page-1)*$limit;

            if($page > $numberOfPages) {
              header("location:{$_SERVER['PHP_SELF']}?page=$numberOfPages");

            }elseif($page <1 ){
              header("location:{$_SERVER['PHP_SELF']}?page=1");

            }

            $query = "select id, title ,substr(`body`,1,48) as body , image , created_at from posts limit $limit offset $offset";
            $runQuery =  mysqli_query($conn,$query);

              if(mysqli_num_rows($runQuery)>0):

               $posts =  mysqli_fetch_all($runQuery,MYSQLI_ASSOC);
              else:
                // header("location:404.php");
                $msg = "no data founded";
              endif;  
          ?>

    
            
          <?php
          if(! empty($posts)):
              foreach ($posts as $post) : ?>

                  <div class="col-md-4">
                    <div class="product-item">
                      <a href="#"><img src="uploads/<?php echo $post['image'] ?>" alt=""></a>
                      <div class="down-content">
                        <a href="#"><h4><?php echo $post['title'] ?></h4></a>
                        <h6><?php echo $post['created_at'] ?></h6>
                        <p><?php echo $post['body'] ."... read more" ?></p>
                        <div class="d-flex justify-content-end">
                          <a href="viewPost.php?id=<?php echo $post['id'] ?>" class="btn btn-info "> view</a>
                        </div>
                        
                      </div>
                    </div>
                  </div>

            <?php endforeach;
          else:
            echo $msg;
          endif;
          ?>

          


         
        </div>

      </div>
    </div>


    <div class="container d-flex justify-content-center">

      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item <?php if($page == 1) echo "disabled" ?>">
            <a class="page-link" href="<?php echo $_SERVER['PHP_SELF']."?page=".$page-1 ?>">Previous</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item <?php if($page == $numberOfPages) echo "disabled" ?>">
            <a class="page-link" href="<?php echo $_SERVER['PHP_SELF']."?page=".$page+1 ?>">Next</a>
          </li>
        </ul>
      </nav>
    </div>

   
 
    
<?php require_once 'inc/footer.php' ?>
