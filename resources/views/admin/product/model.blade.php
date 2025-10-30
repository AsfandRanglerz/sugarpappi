<div class="modal-content">
    <h1 class="border">Product Details</h1>
    <div class="d-flex justify-content-center tbl">
    </div>
    <div class="p-5">
        <table class="table table-striped ">
            <tbody class="text-center">
                    <tr>
                        <th scope="col">Pharmacy Name</th>
                        <th scope="col">Product Name</th>
                    </tr>
                    <tr>
                        <td scope="col">{{$data->pharmacy->branch_name}}</td>
                        <td scope="col">{{ $data->name }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Category</th>
                        <th scope="col">Sub Category</th>
                    </tr>
                    <tr>
                        <td scope="col">{{ $data->category->title }} </td>
                        <td scope="col">{{ $data->subCategory->title }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Description</th>
                        <th scope="col">Brand</th>
                    </tr>
                    <tr>
                        <td scope="col">{{ $data->description }}</td>
                        <td scope="col">{{ $data->brand->title }}</td>
                    </tr>
                    <tr>
                        <th scope="col">type</th>
                    </tr>
                    <tr>
                        <td scope="col">{{ $data->type }}</td>
                    </tr>

                @foreach ($data->productDetail as $productDetail)
                    <tr>
                        <th scope="col">Units</th>
                        <th scope="col">Quantity</th>
                    </tr>
                    <tr>
                    <td scope="col">{{ $productDetail->units }} </td>
                    <td scope="col">{{ $productDetail->quantity }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Price</th>
                        <th scope="col">Dscount</th>
                    </tr>
                    <tr>
                        <td scope="col">{{ $productDetail->price }}</td>
                        <td scope="col">{{ $productDetail->discount }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Total Stock</th>
                    </tr>
                    <tr>
                        <td scope="col">{{ $productDetail->total_stock }}</td>
                    </tr>
                @endforeach
                @foreach ($data->productInstruction as $productInstruction)
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                    </tr>
                    <tr>
                    <td scope="col">{{ $productInstruction->title }} </td>
                    <td scope="col">{{ $productInstruction->description }}</td>
                    </tr>
                @endforeach
            </tbody>
         </table>
    </div>
</div>
