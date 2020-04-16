<section>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://via.placeholder.com/728x190.png?text=Welcome+To+ABC+eCommerce" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://via.placeholder.com/728x190.png?text=Stock+Up+Groceries+During+COVID-19" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://via.placeholder.com/728x190.png?text=Visit+WhoIsHostingThis.com+Buyers+Guide" class="d-block w-100" alt="...">
        </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
    </div>
</section>

<section>
    <div class="card-deck">

        <?php foreach($products as $product) : ?>
            <div class="card" style="width: 18rem;">

                <div id="productImages<?php echo $product['detail']['id']; ?>" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                    <li data-target="#productImages<?php echo $product['detail']['id']; ?>" data-slide-to="0" class="active"></li>
                    <li data-target="#productImages<?php echo $product['detail']['id']; ?>" data-slide-to="1"></li>
                    <li data-target="#productImages<?php echo $product['detail']['id']; ?>" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">

                        <?php foreach($product['images'] as $key => $image) : ?>
                            <div class="carousel-item
                                <?php if($key == 0){ echo "active"; } ?>">
                                <img src="<?php echo $image['file_path']; ?> " class="d-block w-100" alt="...">
                            </div>
                        <?php endforeach ?>
                    </div>
                    <a class="carousel-control-prev" href="#productImages<?php echo $product['detail']['id']; ?>" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#productImages<?php echo $product['detail']['id']; ?>" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="card-body">
                    <h5 class="card-title">
                        <a href="#"><?php echo $product['detail']['name']; ?></a>
                    </h5>
                    <p class="card-text">
                        <small class="text-muted">
                            &#36;<?php echo $product['detail']['price']; ?>
                            <?php if($product['detail']['unit']){echo " per " .$product['detail']['unit'];} ?>
                        </small>
                    </p>

                    <p class="card-text">
                        <small class="text-muted">
                            Overall rating: 
                            <?php echo $product['detail']['average_rating']; ?>
                        </small>
                    </p>

                    <p class="card-text"><?php echo $product['detail']['description']; ?></p>


                    <div class="star-rating" id="rating-<?php echo $product['detail']['id']; ?>" data-id="<?php echo $product['detail']['id']; ?>" 
                    data-url="<?php router(PRODUCT_PREFIX."/add/rating") ?>" 
                    data-csrf="<?php echo CSRF_TOKEN; ?>">
                        <span class="fa fa-star-o" data-rating="1"></span>
                        <span class="fa fa-star-o" data-rating="2"></span>
                        <span class="fa fa-star-o" data-rating="3"></span>
                        <span class="fa fa-star-o" data-rating="4"></span>
                        <span class="fa fa-star-o" data-rating="5"></span>
                        <input type="hidden" id="rating<?php echo $product['detail']['id']; ?>" name="rating" class="rating-value" value="<?php echo $product['detail']['average_rating']; ?>">
                    </div>

                    <a href="#" class="btn btn-primary addToCart" id="addToCartButton<?php echo $product['detail']['id']; ?>" data-id="<?php echo $product['detail']['id']; ?>">Add to cart</a>

                    <form id="quantityForm<?php echo $product['detail']['id']; ?>" 
                    class="do-not-show"
                    action="<?php router(CART_PREFIX."/add"); ?>">
                        <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Quantity</span>
                            </div>
                            <input type="hidden" name="product_id" value="<?php echo $product['detail']['id']; ?>">
                            <input type="number" name="quantity" class="form-control col-sm-4" placeholder="" aria-label="Numbers of <?php echo $product['detail']['name']; ?>" aria-describedby="button-addon2" maxlength="4" size="4">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary sendToCart" type="button" 
                                id="button-addon2"
                                data-id="<?php echo $product['detail']['id']; ?>" >Add</button>
                            </div>
                        </div>

                        <a href="#" class="cancelAddToCart" data-id="<?php echo $product['detail']['id']; ?>">Cancel</a>
                    </form>
                </div>
            </div>
        <?php endforeach ?>


    </div>
</section>