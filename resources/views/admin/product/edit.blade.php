@extends('admin.master')
@section('title','Edit Product Page')
@section('body')

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Product Module</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('product.index')}}">Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->


    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header border-bottom justify-content-between">
                    <h3 class="card-title">Edit Product Form</h3>
                    <!-- <a href="{{route('product.show', $product->code)}}" class="btn btn-success my-1 float-end mx-2 text-center">View</a> -->
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('product.update',$product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-7 border">
                                <div class="my-5">
                                    <h4 class="fw-bold my-4 text-center">GENERAL INFORMATION</h4>
                                    <hr>
                                    <div class="row d-flex form-group">
                                        <label for="name" class="col-md-3 form-label">Product Name <sup class="text-danger">*</sup></label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="name" id="name1" required placeholder="Product Name">{{ $product->name }}</textarea>
                                            <span class="text-danger">{{$errors->has('name') ? $errors->first('name') : ''}}</span>
                                        </div>
                                    </div>
                                    <div class="row d-flex mb-4 form-group">
                                        <label for="name"  class="col-md-3 form-label">Product Code</label>
                                        <div class="col-md-9 input-group">
                                            <input class="form-control" value="{{ $product->code }}" name="code" id="sku" placeholder="Product Code" type="text"/>
                                            <button class="input-group-append btn btn-success" type="button" id="generate-sku-btn">Generate Code</button>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row d-flex form-group">
                                        <label for="" class="col-md-3 form-label">Category Name</label>
                                        <div class="col-md-9">
                                            <select name="category_id" onchange="setSubCategory(this.value)" id="" class="form-control select2 select2-show-search form-select" required>
                                                <option value="" disabled selected> -- Select Category --</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" {{ $product->category_id == $category->id ? 'selected' : '' }}> {{$category->name}} </option>
                                                @endforeach
                                            </select>
                                            <span
                                                class="text-danger">{{$errors->has('category_id') ? $errors->first('category_id') : ''}}</span>
                                        </div>
                                    </div>
                                    
                                
                                </div>
                                <div class="">
                                    <h4 class="fw-bold my-4 text-center">PRICING & STOCK INFORMATION</h4><hr>
                                    <div class="row mb-4">
                                        <label  class="col-md-3 form-label">Product Price <sup class="text-danger">*</sup></label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input class="form-control" value="{{ $product->regular_price }}"  name="regular_price" placeholder="Regular Price" type="number" required/>
                                                <input class="form-control" value="{{ $product->selling_price }}" name="selling_price" placeholder="Selling Price" type="number" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-flex form-group">
                                        <label for="mrp" class="col-md-3 form-label">MRP</label>
                                        <div class="col-md-9">
                                            <input class="form-control" id="mrp" value="{{ $product->mrp }}"  name="mrp" placeholder="MRP" type="number"/>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="stockAmount" class="col-md-3 form-label">Stock Amount</label>
                                        <div class="col-md-9">
                                            <input class="form-control" id="stockAmount" value="{{ $product->stock_amount }}"  name="stock_amount" placeholder="Stock Amount" type="number"/>
                                        </div>
                                    </div>
                                
                                </div>
                                <div class="">
                                    <h4 class="fw-bold my-4 uppercase">DESCRIPTION</h4><hr>
                                    <div class="row mb-4">
                                        <label for="description" class="col-md-3 form-label">Short Description</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="short_description" rows="4" id="short_description" placeholder="Short Description" >{{ $product->short_description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="summernote" class="col-md-3 form-label">Long Description</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control summernote" id="summernote"  name="long_description"  placeholder="Long Description">{{ $product->long_description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 border">
                                <div class="">
                                    <h4 class="fw-bold my-4 text-center">MEDIA & FILES</h4><hr>
                                    <div class="row mb-4">
                                        <label for="imgInp" class="col-md-3 form-label">Product Image</label>
                                        <div class="col-md-9">
                                            <input type="file" name="image" class="dropify" data-height="200" />
                                            <img src="{{ asset($product->image) }}" alt="" height="100" width="100" />
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="imgInp" class="col-md-3 form-label">Product Back Image</label>
                                        <div class="col-md-9">
                                            <input type="file" name="back_image" class="dropify" data-height="200" />
                                            <img src="{{ asset($product->back_image) }}" alt="" height="100" width="100" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Publication Status</label>
                                    <div class="col-md-9 pt-3">
                                        <select class="form-control" name="status" id="">
                                            <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Published</option>
                                            <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Unpublished</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn my-2 btn-primary rounded-2 float-end" type="submit">Update Product Info</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header border-bottom justify-content-between">
                    <h3 class="card-title">Product Other Images</h3>
                    <a class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#addColor" href="">ADD <i class="fa fa-plus"></i></a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">SL NO</th>
                                <th class="border-bottom-0">Image</th>
                                <th class="border-bottom-0">Alt</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product->productImages as $key => $productImage)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><img src="{{asset($productImage->image)}}" alt="" height="50"/></td>
                                    <td>{{$productImage->alt_text}}</td>
                                    <td>
                                        <a data-bs-toggle="modal" data-bs-target="#editOtherImages{{$key}}"   class="btn btn-success btn-sm float-start m-1">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.other.images.destroy',$productImage->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm float-start m-1" onclick="return confirm('Are you want to delete this !!!')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editOtherImages{{$key}}">
                                    <div class="modal-dialog modal-dialog-centered task-view-modal" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header p-5">
                                                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="card-header border-bottom">
                                                        <h3 class="card-title">Edit Color Form</h3>
                                                    </div>
                                                    <div class="card-body">

                                                        <form class="form-horizontal" action="{{ route('admin.other.images.update',$productImage->id) }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" value="{{$product->id}}" name="product_id">
                                                            <div class="row mb-4">
                                                                <label for="images"  class="col-md-3 form-label">Image</label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control" value="{{ old('name') }}" name="image" id="images" type="file"/>
                                                                    <img src="{{asset($productImage->image)}}" height="50" alt="{{$productImage->alt_text}}">
                                                                    <span class="text-danger">{{$errors->has('name') ? $errors->first('name') : ''}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <label for="alt_textImages"  class="col-md-3 form-label">Alt Text</label>
                                                                <div class="col-md-9">
                                                                    <textarea class="form-control" name="alt_text" placeholder="Alt Text" id="alt_textImages" cols="30" rows="3">{{ $productImage->alt_text }}</textarea>
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-primary rounded-0 float-end" type="submit">Update Image Info</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addColor">
        <div class="modal-dialog modal-dialog-centered task-view-modal" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header p-5">
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h3 class="card-title">Add Image Form</h3>
                        </div>
                        <div class="card-body">

                            <form class="form-horizontal" action="{{ route('admin.other.images.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{$product->id}}" name="product_id">
                                <div class="row mb-4">
                                    <label for="images"  class="col-md-3 form-label">Image <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class="form-control" name="image" id="images" type="file" required/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="alt_textImages"  class="col-md-3 form-label">Alt Text</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="alt_text" placeholder="Alt Text" id="alt_textImages" cols="30" rows="3">{{ old('alt_text') }}</textarea>
                                    </div>
                                </div>
                                <button class="btn btn-primary rounded-0 float-end" type="submit">Add New Image</button>
                            </form>
                        </div>
                    </div>
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
