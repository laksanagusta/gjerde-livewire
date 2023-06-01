<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-10">
            <a href="{{ route('products.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                + Create Product
            </a>
        </div>
        <div class="flex flex-wrap mb-6">
            <div class="w-full">
                <input value="{{ old('name') }}" wire:model="name" class="search-input appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="search-product" type="text" placeholder="Search Product">
            </div>
        </div>
        <div class="bg-white">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        @foreach ($headers as $key => $value)
                        <th width="5%" style="cursor: pointer" wire:click="sort('{{ $key }}')" class="border px-6 py-4">
                            @if($sortColumn == $key) 
                                <span>{!! $sortOrder == 'asc' ? '&#8659;':'&#8657;' !!}</span>
                            @endif
                            {{ is_array($value) ? $value['label'] : $value }}
                        </th>
                        @endforeach
                        <th width="5%" style="cursor: pointer" class="border px-6 py-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($products))
                        @foreach ($products as $item)
                            <tr>
                                @foreach ($headers as $key => $value)
                                    <td class="border px-6 py-4">
                                        {!! is_array($value) ? $value['func']($item->$key) : $item->$key !!}
                                    </td>
                                @endforeach                        
                                <td class="border px-6 py-4">
                                    <a href={{route('products.show', $item->id)}} class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 mx-1 rounded">Detail</a>
                                    <a href={{route('products.edit', $item->id)}} class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 mx-1 rounded">Edit</a>
                                    <a href={{route('products.destroy', $item->id)}} class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 mx-1 rounded">Delete</a>
                                </td>
                            </tr>
                        @endforeach

                    @else
                        <tr><td colspan="{{ count($headers) }}"><h2>No Results Found!</h2></td></tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="text-center mt-5">
            {{ $products->links() }}
        </div>
    </div>
</div>