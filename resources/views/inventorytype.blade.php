<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Type Page</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-navbar  name={{$name}} ></x-navbar>
    @if(session('inventorytype'))
    <div class=" bg-green-800 text-white pl-5">{{session('inventorytype')}}</div>
    @endif
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">

    <div class=" bg-white p-8 rounded-2xl  shadow-lg w-full max-w-sm">
        <h2 class="text-2xl text-center text-gray-800 mb-6 ">Add Inventory Types </h2>
    
        <form action="{{ isset($editItem) ? url('/inventorytype/update/' . $editItem->id) : url('/addinventorytype') }}" method="post" class="space-y-4">
            @csrf
            @if(isset($editItem))
                @method('PUT')
            @endif
            <div>
                <input type="text" placeholder="Enter inventory type" name="inventorytype"
                    value="{{ old('inventorytype', $editItem->name ?? '') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                @if(isset($editItem))
                    <div class="text-green-500">Existing: {{ $editItem->name }}</div>
                @endif
                @error('inventorytype')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="w-full {{ isset($editItem) ? 'bg-yellow-500' : 'bg-blue-500' }} rounded-xl px-4 py-2 text-white">
                {{ isset($editItem) ? 'Update' : 'Add' }}
            </button>
        </form>
    </div>
    <div class="w-200">
        <h1 class="text-2xl text-blue-500">Inventory Types List</h1>
        <ul class="border border-gray-200">
        <li class="p-2 font-bold">
                <ul class="flex justify-between">
                    <li class="w-30">S. No</li>
                    <li class="w-70">Name</li>
                    <li class="w-70">Creator</li>
                    <li class="w-30">Action</li>
                </ul>
            </li>

            @foreach($inventorytypes as $inventorytype)
            <li class="even:bg-gray-200 p-2">
                <ul class="flex justify-between">
                    <li class="w-30">{{$inventorytype->id}}</li>
                    <li class="w-70">{{$inventorytype->name}}</li>
                    <li class="w-70">{{$inventorytype->added_by}}</li>
                    {{-- <li class="w-30 flex">
                        <a href="inventorytype/delete/{{$inventorytype->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#000000"><path d="M312-144q-29.7 0-50.85-21.15Q240-186.3 240-216v-480h-48v-72h192v-48h192v48h192v72h-48v479.57Q720-186 698.85-165T648-144H312Zm336-552H312v480h336v-480ZM384-288h72v-336h-72v336Zm120 0h72v-336h-72v336ZM312-696v480-480Z"/></svg>

                        </a>
                        @if (!isset($editItem))
                        <a href="inventorytype/edit/{{$inventorytype->id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
                        </a>
                        @endif
                    </li> --}}
                    <li class="w-30 flex space-x-2">
                        <a href="inventorytype/delete/{{$inventorytype->id}}" class="text-red-600 hover:text-red-800 font-bold">
                            🗑️
                        </a>

                        @if (!isset($editItem))
                        <a href="inventorytype/edit/{{$inventorytype->id}}" class="text-blue-600 hover:text-blue-800 font-bold">
                            ✏️
                        </a>
                        @endif
                    </li>

                </ul>
            </li>
            @endforeach
        </ul>
                <!-- Pagination links -->
<div class="mt-4">
    {{ $inventorytypes->links() }}
</div>
    </div>
</div>
</body>
</html>