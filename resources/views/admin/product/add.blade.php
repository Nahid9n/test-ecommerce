@extends('admin.master')
@section('title','Add Product Page')
@section('body')

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Product Module</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('product.index')}}">Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Product</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->


    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Add Product Form</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-7 border">
                                <div class="my-5">
                                    <h4 class="fw-bold my-4 text-center">GENERAL INFORMATION</h4>
                                    <hr>
                                    <div class="row d-flex form-group">
                                        <label for="name" class="col-md-3 form-label">Product Name <sup class="text-danger">*</sup></label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="name" id="name1" required placeholder="Product Name">{{ old('name') }}</textarea>
                                            <span class="text-danger">{{$errors->has('name') ? $errors->first('name') : ''}}</span>
                                        </div>
                                    </div>
                                    <div class="row d-flex mb-4 form-group">
                                        <label for="name"  class="col-md-3 form-label">Product Code <sup class="text-danger">*</sup></label>
                                        <div class="col-md-9 input-group">
                                            <input class="form-control" value="{{ old('code') }}" name="code" id="sku" placeholder="Product Code" type="text"/>
                                            <button class="input-group-append btn btn-success" type="button" id="generate-sku-btn">Generate Code</button>
                                            <span class="text-danger">{{$errors->has('code') ? $errors->first('code') : ''}}</span>
                                        </div>
                                    </div>
                                    

                                    <div class="row d-flex form-group">
                                        <label for="" class="col-md-3 form-label">Category Name  <sup class="text-danger">*</sup></label>
                                        <div class="col-md-9">
                                            <select name="category_id" onchange="setSubCategory(this.value)" id="" class="form-control select2 select2-show-search form-select" required>
                                                <option value="" disabled selected> -- Select Category --</option>
                                                @foreach($categories as $category)
                                                    <option {{old('category_id') == $category->id ? 'selected':''}} value="{{$category->id}}"> {{$category->name}} </option>
                                                @endforeach
                                            </select>
                                            <span
                                                class="text-danger">{{$errors->has('category_id') ? $errors->first('category_id') : ''}}</span>
                                        </div>
                                    </div>
                                  
                                </div>
                                <div class="">
                                    <h4 class="fw-bold my-4 text-center">PRICING & STOCK INFORMATION</h4><hr>
                                </div>
                                <div class="row d-flex form-group">
                                    <label  class="col-md-3 form-label">Product Price <sup class="text-danger">*</sup></label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input class="form-control"  name="regular_price" value="{{ old('regular_price') }}" placeholder="Regular Price" type="number" required/>
                                            <input class="form-control"  name="selling_price" value="{{ old('selling_price') }}" placeholder="Selling Price" type="number" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex form-group">
                                    <label for="mrp" class="col-md-3 form-label">MRP</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="mrp" value="{{ old('mrp') }}" name="mrp" placeholder="MRP" type="number"/>
                                    </div>
                                </div>
                                <div class="row d-flex form-group">
                                    <label for="stockAmount" class="col-md-3 form-label">Stock Amount</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="stockAmount" value="{{ old('stock_amount') }}" name="stock_amount" placeholder="Stock Amount" type="number"/>
                                    </div>
                                </div>
                                
                               
                
                            
                                <div class="">
                                    <h4 class="fw-bold my-4 uppercase">DESCRIPTION</h4><hr>
                                </div>
                                <div class="row d-flex form-group">
                                    <label for="description" class="col-md-3 form-label">Short Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="5" name="short_description" id="short_description" placeholder="Short Description" >{{ old('short_description')}}</textarea>
                                    </div>
                                </div>
                                <div class="row d-flex form-group">
                                    <label for="summernote" class="col-md-3 form-label">Long Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control summernote" id="summernote"  name="long_description"  placeholder="Long Description"></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-5 border">
                                <div class="">
                                    <h4 class="fw-bold my-4 text-center">MEDIA & FILES</h4><hr>
                                </div>
                                <div class="row d-flex form-group">
                                    <label for="imgInp" class="col-md-3 form-label">Product Image</label>
                                    <div class="col-md-9">
                                        <input type="file" name="image" class="dropify" data-height="200" />
                                    </div>
                                </div>
                                <div class="row d-flex form-group">
                                    <label for="imgInp" class="col-md-3 form-label">Product Back Image</label>
                                    <div class="col-md-9">
                                        <input type="file" name="back_image" class="dropify" data-height="200" />
                                    </div>
                                </div>
                               
                            
                                <div class="row d-flex form-group">
                                    <label class="col-md-3 form-label">Publication Status</label>
                                    <div class="col-md-9 pt-3">
                                        <select class="form-control" name="status" id="">
                                            <option value="1" selected>Published</option>
                                            <option value="0">Unpublished</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success text-dark my-2 rounded-2 float-end" type="submit">Create New Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        function generateSKU() {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let sku = '';

            for (let i = 0; i < 8; i++) {
                sku += characters.charAt(Math.floor(Math.random() * characters.length));
            }

            return sku;
        }

        $(document).ready(function() {
            $('#generate-sku-btn').click(function() {
                const sku = generateSKU();
                $('#sku').val(sku);
            });
        });
    </script>
@endpush
