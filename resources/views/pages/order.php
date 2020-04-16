
<section>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Order Ref</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $totalCost = 0;
                        foreach($orders as $key => $order) : 
                    ?>
                        <tr>
                            <th scope="row"><?php echo $key + 1; ?></th>
                            <td><?php echo $order['id']; ?></td>
                            <td><?php echo $order['status']; ?></td>
                            <td>
                                <a class="btn btn-outline-primary btn-sm" href="<?php router("cart/view", [
                                        "order_id"  => $order['id']
                                    ]) ?>">view</a>
                            </td>
                        </tr>
                    <?php endforeach ?>

                </tbody>
            </table>
        </div>
    </div>
</section>
