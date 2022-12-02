@extends('server.layout')

@section('content')

<div style="width: 100%; height: 1150px; color: #fff; position: relative;">
    <h1 style="font-size: 1.8rem; margin-left: 50px; margin-top: 20px">Order Details</h1>
    <div style="font-size: 1.4rem; margin-left: 50px; margin-top: 50px;"><b>Order Status</b></div>
    <div class="progress" style="width: 80%; margin-left: 50px; margin-top: 15px">
        <?php
        if($order[0]->status=='Unconfimred'||$order[0]->status=='Cancel') {
            echo '<div class="progress-bar" role="progressbar" aria-label="Basic example"></div>';
        } else if($order[0]->status=='Confimred') {
            echo '<div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 33%"></div>';
        } else if($order[0]->status=='Delivering'){
            echo '<div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 66%"></div>';
        } else echo '<div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 100%"></div>';  
        ?>
    </div>
    <div style="width: 80%; margin-left: 50px; margin-top: 15px; position: relative;">
        <?php
        if($order[0]->status=='Unconfimred') {
            echo '<div style="position: absolute; left: 0px">Unconfimred</div>';
        } else if($order[0]->status=='Cancel') {
            echo '<div style="position: absolute; left: 0px">Cancel</div>';
        } else if($order[0]->status=='Confimred') {
            echo '<div style="position: absolute; left: 0px">Unconfimred</div>';
            echo '<div style="position: absolute; left: 29%">Confimred</div>';
        } else if($order[0]->status=='Delivering'){
            echo '<div style="position: absolute; left: 0px">Unconfimred</div>';
            echo '<div style="position: absolute; left: 29%">Confimred</div>';
            echo '<div style="position: absolute; left: 62.5%">Delivering</div>';
        } else {
            echo '<div style="position: absolute; left: 0px">Unconfimred</div>';
            echo '<div style="position: absolute; left: 29%">Confimred</div>';
            echo '<div style="position: absolute; left: 62.5%">Delivering</div>';
            echo '<div style="position: absolute; left: 96.5%">Complete</div>';  
        }
        ?>
    </div>
    <?php
    if($order[0]->status=='Unconfimred') {
        echo '<a href="/update_status/Confimred/'.$order[0]->OrderID.'"><button type="button" class="btn btn-info" style="width: 150px; margin-left: 50px; margin-top: 70px; font-weight: bold">Update Status</button></a>';
    } else if($order[0]->status=='Confimred') {
        echo '<a href="/update_status/Delivering/'.$order[0]->OrderID.'"><button type="button" class="btn btn-info" style="width: 150px; margin-left: 50px; margin-top: 70px; font-weight: bold">Update Status</button></a>';
    } else if($order[0]->status=='Delivering'){
        echo '<a href="/update_status/Complete/'.$order[0]->OrderID.'"><button type="button" class="btn btn-info" style="width: 150px; margin-left: 50px; margin-top: 70px; font-weight: bold">Update Status</button></a>';
    }
    ?>
    <div style="font-size: 1.4rem; margin-left: 50px; margin-top: 40px"><b>Order Information</b></div>
    <div style="margin-top: 20px; margin-left: 50px;"><b>Customer Name:</b> <?php echo $customer['fullname'] ?></div>
    <div style="margin-top: 20px; margin-left: 50px;"><b>Delivery Address:</b>  <?php echo $order[0]->delivery_address; ?></div>
    <div style="margin-top: 20px; margin-left: 50px;"><b>Order Date:</b> <?php echo $order[0]->DateOrder ?></div>
    <div style="margin-top: 20px; margin-left: 50px;"><b>Total Money:</b> <?php echo number_format($order[0]->total) ?> ₫</div>
    <div style="background-color: #f8f9fa; width: 92%; margin-left: 50px; margin-top: 30px; height: 500px; overflow-y:scroll">
        <table class="table" style="background-color: #f8f9fa; width: 100%">
            <thead>
              <tr>
                <th scope="col">Product Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Price</th>
                <th scope="col">Size</th>
                <th scope="col">Amount</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <?php
            for($i=0;$i<count($order_detail);$i++){
                echo '<tr>
                        <td><img src="/storage/'.$list_product_order[$i]->image.'" style="width: 50px; height: 60px"></td>
                        <td>'.$list_product_order[$i]->name.'</td>
                        <td>'.$order_detail[$i]->price.'</td>
                        <td>'.$order_detail[$i]->size.'</td>
                        <td>'.$order_detail[$i]->amount.'</td>
                        <td>'.number_format($order_detail[$i]->price*$order_detail[$i]->amount).' ₫</td>
                    </tr>';
            }
            ?>
          </table>
    </div>
</div>
<script>
    document.getElementById("order").style.background="#ccc";
</script>
@endsection
