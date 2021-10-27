<?php 
$connection = require_once 'pdo.php';
$products = $connection->getProducts();
?>
<?php include "shared/header.php";?>
    <br>
    <div class="container">
    <?php
        $noOfColumns = 4;
        $bsColWidth = 12 / $noOfColumns ;

        $arrayChunks = array_chunk($products, $noOfColumns);

        if (isset($_GET['id'])) {
            if( preg_match('/^\d+$/',$_GET['id']) ){
                $sel_product = $connection->getProductById($_GET['id']);
            ?>
                <div class="card">
                    <div class="card-horizontal align-items-center">
                        
                        <div class="img-square-wrapper">
                            <img class="" src=<?php echo $sel_product['imageurl']; ?> alt="">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo htmlentities($sel_product['name']) ?></h4>
                            <p class="card-text"><?php echo '$' .htmlentities($sel_product['price']) ?></p>
                            <p class="card-text"><?php echo htmlentities($sel_product['description']) ?></p>
                            <a href="#" class="btn btn-primary">Add to cart</a>
                            <br><br>
                            <a href="index.php"><span class="fa fa-chevron-left"></span> Back</a>
                        </div>
                    </div>
                </div>            
            <?php        
            }
        }else{

            foreach($arrayChunks as $items) {
                echo '<div class="row">';
                foreach($items as $item) {
                ?>
                    <div class="col-md-<?php echo $bsColWidth?>">
                        <div class="card" style="width: 18rem;">
                            <a href="/index.php?id=<?php echo $item['productid']?>">
                                <img src=<?php echo $item['imageurl']; ?> class="card-img-top" alt="...">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlentities($item['name']); ?></h5>
                                <p class="card-text">$<?php echo htmlentities($item['price']); ?></p>
                                <a href="#" class="btn btn-primary">Add to cart</a>
                            </div>
                        </div>
                    </div>
                <?php
                }
                echo '</div>';
            }  
        }

    ?>
    </div>
    <br>
    <?php include "shared/footer.php";?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
        $("#loginButton").click(function(){
            $('#loginModal').modal('show')
        });

        //function to toggle show/hide Login Modal
        toggleLoginModal = () =>  $('#loginModal').modal('toggle');        
    </script>
</body>
</html>