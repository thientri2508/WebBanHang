@extends('server.layout')

@section('content')

<div style="width: 100%; height: 700px; color: #fff">
    <h1 style="font-size: 1.8rem; margin-left: 50px; margin-top: 20px">Product List</h1>
    <div style="background-color: #f8f9fa; width: 92%; margin-left: 50px; margin-top: 20px; height: 600px; overflow-y:scroll">
        <table class="table" style="background-color: #f8f9fa; width: 100%">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">View Details</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <?php
            $i = 1;
            foreach ($list as $l) {
                $delete = "'".$l->id."'";
                echo '<tr>
                        <td>'.$i.'</td>
                        <td><img src="/storage/'.$l->image.'" style="width: 50px; height: 60px"></td>
                        <td>'.$l->name.'</td>
                        <td>'.$l->price.'</td>
                        <td><a href="/admin/install_product/'.$l->id.'"><img src="/storage/more.png" class="icon_more"></a></td>
                        <td><img src="/storage/delete.png" class="icon_delete" onclick="deleteProduct('.$delete.')"></td>
                    </tr>';
                $i++;
            }
            ?>
          </table>
    </div>
</div>
<script>
    document.getElementById("product").style.background="#ccc";
    document.getElementById("p2").style.display="block";
    document.getElementById("list_product").style.background="#007bff";
    document.getElementById("list_product").style.color="#fff";
</script>
@endsection
