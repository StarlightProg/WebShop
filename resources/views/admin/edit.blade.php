@extends('layouts.admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard v2</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- MAP & BOX PANE -->

            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <div class="card-header">
                    <h3 class="card-title">Edit Post</h3>
                  </div>
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        <form action="{{ route('admin.edit', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data"> 
                            @method('PATCH')
                            @csrf
                                <div class="form-group">
                                   <input type="text" name="product-name" class="form-control" placeholder="Enter product name" value="{{$product->product_name}}" required>
                                </div>
                                <div class="form-group">
                                   <input type="text" name="product-price" class="form-control" placeholder="Enter price" value="{{$product->price}}" required>
                                </div>
    
                                <div class="form-group custom-file mb-3">
                                    <input type="file" class="custom-file-input" id="product-cover" name="product-cover" required>
                                    <label class=" form-group custom-file-label" for="product-cover">Cover image</label>
                                </div>
    
                                <div class="form-group custom-file mb-3">
                                    <input type="file" class="custom-file-input" id="product-images" name="product-images[]" multiple>
                                    <label class="form-group custom-file-label" for="product-images">Product images</label>
                                </div>
    
                                 <div class="form-group">
                                    <input type="text" name="product-description" class="form-control" value="{{$product->description}}" placeholder="Enter description" required>
                                 </div>
                                 <div class="form-group">
                                    <input type="text" name="product-size" class="form-control" value="{{$product->size}}" placeholder="Enter size" required>
                                 </div>
                                 <div class="form-group">
                                    <input type="text" name="product-discount" class="form-control" value="{{$product->discount}}" placeholder="Enter discount percent">
                                 </div>
                                 
                                 <div class="form-group mb-3">
                                    <select class="form-select" name="product-caregory">
                                      @foreach ($categories as $item)
                                        <option value="{{$item->id}}">{{$item->category_name}}</option>
                                      @endforeach
                                    </select>
                                 </div>
    
                                <button type="submit" class="btn btn-primary mb-3">Save Changes</button>
                        </form>
                      <!-- /.item -->
                    </ul>
                  </div>

                {{-- <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">

            <!-- PRODUCT LIST -->
            <div class="card">
              <!-- /.card-header -->
              
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
@endsection