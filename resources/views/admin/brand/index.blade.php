<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{--            {{ __('Dashboard') }}--}}
            <h2> <b>All Brand </b> </h2>

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto ">
            <div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                @if(session('success'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>{{session('success')}}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="card-header"> All Brand</div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Brand Name</th>
                                        <th scope="col">Brand Image</th>
                                        <th scope="col">Created_at</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{--                                    @php($i = 1)--}}
                                    @foreach($brands as $brand)
                                        <tr>
                                            <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                                            <td>{{$brand->brand_name}}</td>
                                            <td><img src="{{asset($brand->brand_img)}}" style="height:50px; width: 120px; "  alt=""></td>
{{--                                            <td>{{$brand->user->name}}</td>--}}
                                            {{--                                        <td>{{$category->created_at->diffForHumans()}}</td>--}}
                                            <td>
                                                @if($brand->created_at == NULL)
                                                    <span class="text-danger">No Date Set</span>
                                                @else
                                                {{\Carbon\Carbon::parse($brand->created_at)->diffForHumans()}}
                                                    @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ url('softdelete/brand/'.$brand->id) }}" class="btn btn-danger">Delete</a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $brands->links() }}
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">Add Brand</div>
                                <div class="card-body">
                                    <form action="{{route('store.brand')}}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                                            <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            @error('brand_name')
                                            <span class="text-danger"> {{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Brand Image</label>
                                            <input type="file" name="brand_img" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            @error('brand_img')
                                            <span class="text-danger"> {{$message}}</span>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary mb-3">Add</button>
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

