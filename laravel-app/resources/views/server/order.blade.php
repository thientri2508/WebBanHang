@extends('server.layout')

@section('content')

<div style="width: 100%; height: 700px; color: #fff">
    <h1 style="font-size: 1.8rem; margin-left: 50px; margin-top: 20px">Order List</h1>
    <div style="background-color: #f8f9fa; width: 92%; margin-left: 50px; margin-top: 20px; height: 600px; overflow-y:scroll">
        <table class="table" style="background-color: #f8f9fa; width: 100%">
            <thead>
              <tr>
                <th scope="col">ID Order</th>
                <th scope="col">Customer Email</th>
                <th scope="col">Order Date</th>
                <th scope="col">Order Status</th>
                <th scope="col">Total Money</th>
                <th scope="col">View Details</th>
              </tr>
            </thead>
            <?php
            foreach ($list as $l) {
                echo '<tr>
                        <td>'.$l->OrderID.'</td>
                        <td>'.$l->EmailUser.'</td>
                        <td>'.$l->DateOrder.'</td>
                        <td>'.$l->status.'</td>
                        <td>'.number_format($l->total).' ₫</td>
                        <td><a href="/admin/order_detail/'.$l->OrderID.'"><img src="/storage/more.png" class="icon_more"></a></td>
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
