
<section>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Item</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $totalCost = 0;
                        foreach($carts as $key => $cart) : 
                    ?>
                        <tr id="cart<?php echo $cart['id']; ?>">
                            <th scope="row"><?php echo $key + 1; ?></th>
                            <td><?php echo $cart['name']; ?></td>
                            <td><?php echo $cart['quantity']; ?></td>
                            <td>$<?php echo $cart['price']; ?></td>
                            <td>$
                                <?php 
                                    $subTotal = $cart['price'] * $cart['quantity'];
                                    $totalCost += $subTotal; 
                                    echo $subTotal;
                                ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-danger btn-sm removeCart" 
                                data-id="<?php echo $cart['id']; ?>"
                                data-url="<?php router(CART_PREFIX."/remove") ?>" 
                                data-csrf="<?php echo CSRF_TOKEN; ?>">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>

                    <?php if(empty($carts )) : ?>
                        <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                                <h1 class="display-4">Nothing here</h1>
                                <p class="lead">You havent added anything to your cart.</p>
                            </div>
                        </div>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>
</section>


<?php if(!empty($carts )) : ?>
    <section id="orderDetail">
        <div class="card">
            <div class="card-header">
                About your order</code>
            </div>
            <div class="card-body">
                <h5 class="card-title" id="totalCost">
                    Total Cost: $<?php echo number_format($totalCost, 2);?>
                    <span id="upsFee" class="do-not-show"> + $5 = $<?php echo (number_format($totalCost, 2) + 5);?></span>
                </h5>

                <p>
                    Order Ref: <code><?php echo $cart['order_id'];?></code>
                </p>
                <p>
                    Order Status: 
                        <?php 
                            if($order['status'] == 'pending')
                            {
                                echo "<span class='badge badge-pill badge-secondary'>{$order['status']}</span>";
                            } 
                            else 
                            {
                                echo "<span class='badge badge-pill badge-success'>{$order['status']}</span>";
                            }
                        ?>
                </p>
                
                <?php if($order['status'] == 'pending') : ?>
                    <form action="<?php router(CART_PREFIX."/checkout") ?>" method="POST" id="checkoutForm">

                        <div class="form-group">
                            <label for="Shipping">Shipping Option: </label>

                            <select name="shipping_option" id="">
                                <option class="form-control" value="not_selected" selected></option>
                                <option class="form-control" value="pick_up">Pick Up</option>
                                <option class="form-control" value="ups">UPS</option>
                            </select>
                            
                            <input type="hidden" name="order_id" value="<?php echo $cart['order_id'];?>" />
                            <small id="emailHelp" class="form-text text-muted">Pick up delivery is free, while UPS cost $5</small>
                        </div>


                        <button type="submit" class="btn btn-primary" id="checkoutButton">Checkout</button>
                    </form>

                <?php else: ?>
                    <p class="card-text">
                        Shipping Option: <?php echo $order['shipping_option'];?>
                    </p>

                    <p class="card-text">
                        Previous Balance: $<?php echo $order['previous_balance'];?>
                    </p>

                    <p class="card-text">
                        Available Balance after paying: $<?php echo $order['available_balance'];?>
                    </p>
                <?php endif; ?>

                <!-- <a href="#" class="btn btn-primary">Checkout</a> -->
            </div>
        </div>
    </section>
<?php endif; ?>
