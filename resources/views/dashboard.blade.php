<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{--            {{ __('Dashboard') }}--}}
            <h2>Hi....... <b>{{ Auth::user()->name }} </b> </h2>
            <b style="float: right">Total Users
                <span class="badge bg-danger ">{{ count($userQuery) }}
                </span></b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Created_at</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach($userQuery as $user)
                    <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
{{--                        This diffForHumans is not supported for Query Builder--}}
{{--                        <td>{{$user->created_at->diffForHumans()}}</td>--}}
{{--                        //if we want to use diffForHumans we have to use Carbon--}}
                        <td>{{Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td>

                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
