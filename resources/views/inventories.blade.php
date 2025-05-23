<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Page</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <x-navbar name="{{ $name }}"></x-navbar>
 @if(session('inventory'))
    <div class=" bg-green-800 text-white pl-5">{{session('inventory')}}</div>
    @endif
    <!-- Centered Form Container -->
    <div class="flex-grow flex flex-col items-center justify-start px-4 space-y-10 py-10 mt-8">
        <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Add Inventory</h2>
            
            <form action="/addinventory" method="post" class="space-y-4">
                @csrf

                <!-- Inventory Name -->
                <input type="text" name="inventory" placeholder="Enter Inventory Name"
                       class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring focus:ring-blue-200">
                @error('inventory')
                <div class="text-red-500" >{{$message}}</div>
                @enderror
                <!-- Inventory Type -->
                <select name="inventorytype"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring focus:ring-blue-200">
                    @foreach($inventorytypes as $inventorytype)
                        <option value="{{ $inventorytype->id }}">{{ $inventorytype->name }}</option>
                    @endforeach
                </select>

                <!-- Length (ft) -->
                <input type="number" step="0.01" name="length" placeholder="Length (ft)"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring focus:ring-blue-200">
                @error('length')
                <div class="text-red-500" >{{$message}}</div>
                @enderror
                <!-- Width (ft) -->
                <input type="number" step="0.01" name="width" placeholder="Width (ft)"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring focus:ring-blue-200">
                @error('width')
                <div class="text-red-500" >{{$message}}</div>
                @enderror
                <!-- Actual Price -->
                <input type="number" step="0.01" name="actual_price" placeholder="Actual Price"
                       class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring focus:ring-blue-200">
                @error('actual_price')
                <div class="text-red-500" >{{$message}}</div>
                @enderror
                <!-- Sell Price -->
                <input type="number" step="0.01" name="sell_price" placeholder="Sell Price"
                       class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring focus:ring-blue-200">
                @error('sell_price')
                <div class="text-red-500" >{{$message}}</div>
                @enderror
                <!-- Discount Price -->
                <input type="number" step="0.01" name="discount_price" placeholder="Discount Price"
                       class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring focus:ring-blue-200">
                @error('discount_price')
                <div class="text-red-500" >{{$message}}</div>
                @enderror
                <!-- Total Stock -->
                <input type="number" name="total_stock" placeholder="Total Stock"
                       class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring focus:ring-blue-200">
                @error('total_stock')
                <div class="text-red-500" >{{$message}}</div>
                @enderror
                <!-- Submit Button -->
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 transition-all duration-200 rounded-xl px-4 py-2 text-white font-medium">
                    Add Inventory
                </button>
            </form>
        </div>
        <div class="w-200">
        <h1 class="text-2xl text-blue-500">Inventory List</h1>
        <ul class="border border-gray-200">
        <li class="p-2 font-bold">
                <ul class="flex justify-between">
                    <li class="w-30">S. No</li>
                    <li class="w-70">Name</li>
                    <li class="w-30">Inventory Type</li>
                    <li class="w-30">Length</li>
                    <li class="w-30">Width</li>
                    <li class="w-30">Actual Price</li>
                    <li class="w-30">Sell Price</li>
                     <li class="w-30">Discount Price</li>
                     <li class="w-30">Total Stock</li>
                </ul>
            </li>
            @foreach($inventories as $inventorieslist)
            <li class="even:bg-gray-200 p-2">
                <ul class="flex justify-between">
                    <li class="w-30">{{$inventorieslist->id}}</li>
                    <li class="w-70">{{$inventorieslist->name}}</li>
                    <li class="w-30">{{$inventorieslist->type_id}}</li>
                    <li class="w-30">{{$inventorieslist->length}}</li>
                    <li class="w-30">{{$inventorieslist->width}}</li>
                    <li class="w-30">{{$inventorieslist->actual_price}}</li>
                    <li class="w-30">{{$inventorieslist->sell_price}}</li>
                    <li class="w-30">{{$inventorieslist->discount_price}}</li>
                    <li class="w-30">{{$inventorieslist->total_stock}}</li>
                  </ul>
            </li>
            @endforeach
        </ul>
        <!-- Pagination links -->
<div class="mt-4">
    {{ $inventories->links() }}
</div>
    </div>
    </div>
</body>
</html>
