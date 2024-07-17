@extends('admin.main')
@section('head')
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
@endsection
@section('content')

<form action="" method="post">
    <div class="card-body">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="productName">Tên sản phẩm</label>
                    <select class="form-control" id="productName" name="name">
                        <option value="">Chọn sản phẩm</option>
                        @foreach ($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="productId">ID sản phẩm</label>
                    <input type="text" class="form-control" name="product_id" id="productId" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="supplierName">Tên Nhà cung cấp</label>
                    <select class="form-control" id="supplierName" name="name">
                        <option value="">Chọn sản phẩm</option>
                        @foreach ($suppliers as $supplier)
                        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="supplierId">ID nhà cung cấp</label>
                    <input type="text" class="form-control" name="supplier_id" id="supplierId" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Size</label>
                    <select class="form-control" name="size" id="">
                        <option>chọn size</option>
                        <option>35</option>
                        <option>36</option>
                        <option>37</option>
                        <option>38</option>
                        <option>39</option>
                        <option>40</option>
                        <option>41</option>
                        <option>42</option>
                        <option>43</option>
                        <option>44</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Màu</label>
                    <select class="form-control" name="color" id="">
                        <option>be</option>
                        <option>đen</option>
                        <option>trắng</option>
                        <option>xám</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">số lượng</label>
                    <input type="number" value="" name="quantity" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Giá nhập</label>
                    <input type="number" value="" name="import_price" class="form-control">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
        @csrf
</form>
@endsection

@section('footer')
<script>
CKEDITOR.replace('editor')
</script>
@endsection