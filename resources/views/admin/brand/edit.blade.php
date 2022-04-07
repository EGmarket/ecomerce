<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{--            {{ __('Dashboard') }}--}}
            <h2> <b>Edit Category </b> </h2>

        </h2>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto ">
            <div>
                <div class="container">
                    <div class="row">


                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">Edit Category</div>
                                <div class="card-body">
                                    <form action="{{ url('brand/update/'.$brands->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="old_img" value="{{$brands->brand_img}}">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Update Category Name</label>
                                            <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $brands->brand_name }}">
                                            @error('brand_name')
                                            <span class="text-danger"> {{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Update Category Name</label>
                                            <input type="file" name="brand_img" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $brands->brand_img }}">
                                            @error('brand_img')
                                            <span class="text-danger"> {{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-4">
                                            <img src="{{asset($brands->brand_img)}}" style="width: 400px; height: 200px" alt="">
                                        </div>

                                        <button type="submit" class="btn btn-primary mb-3">Update</button>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

