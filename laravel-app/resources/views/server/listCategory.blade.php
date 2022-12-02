@extends('server.layout')

@section('content')

<div style="width: 100%; height: 700px; color: #fff">
    <h1 style="font-size: 1.8rem; margin-left: 50px; margin-top: 20px">Category List</h1>
    <div style="background-color: #f8f9fa; width: 92%; margin-left: 50px; margin-top: 20px; height: 500px; overflow-y:scroll">
        <table class="table" style="background-color: #f8f9fa; width: 100%">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Sort</th>
                <th scope="col">Detail Category</th>
                <th scope="col">Install</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <?php
            $i = 1;
            foreach ($list_category as $l1) {
                $delete = "'".$l1->id."'";
                $detail = '';
                foreach ($list_detail_category as $l2) {
                    if($l2->idCategory==$l1->id) {
                        $detail.=$l2->name.', ';
                    }
                }
                echo '<tr>
                        <td>'.$i.'</td>
                        <td>'.$l1->name.'</td>
                        <td>'.$l1->sort.'</td>
                        <td>'.$detail.'</td>
                        <td><a href="/admin/install_category/'.$l1->id.'"><img src="/storage/exchange.png" class="icon_change"></a></td>
                        <td><img src="/storage/delete.png" class="icon_delete" onclick="deleteCategory('.$delete.')"></td>
                    </tr>';
                $i++;
            }
            
            ?>
            
          </table>
    </div>
</div>
<script>
    document.getElementById("category").style.background="#ccc";
    document.getElementById("p1").style.display="block";
    document.getElementById("list_category").style.background="#007bff";
    document.getElementById("list_category").style.color="#fff";
</script>
@endsection
