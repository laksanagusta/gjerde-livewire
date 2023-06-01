<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!! __('Transaction &raquo; Create') !!}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                            There's something wrong!
                        </div>
                        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                            <p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </p>
                        </div>
                    </div>
                @endif
                <form class="w-full" action="{{ route('transactions.store') }}" method="post">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="transactionType" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Tipe Transaksi</label>
                            <select name="transaction_type_id" id="transaction_type_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 transaction_type_id">
                                @foreach($transactionTypes as $transactionType)
                                    <option value="{{ $transactionType->id }}">{{$transactionType->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="border mb-6"></div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label for="transactionType" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Pilih produk</label>
                                <select name="transaction_type_id" id="transaction_type_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 transaction_type_id">
                                    @foreach($transactionTypes as $transactionType)
                                        <option value="{{ $transactionType->id }}">{{$transactionType->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label for="qty" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Qty</label>
                                <input value="{{ old('qty') }}" name="qty" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" placeholder="Qty">
                            </div>
                        </div>
                        <div class="flex flex-wrap mb-6 bg-white">
                            <table class="table-auto w-full">
                                <thead>
                                    <tr>
                                        <td class="border p-2">Nama Produk</td>
                                        <td class="border p-2">Qty</td>
                                        <td class="border p-2">Harga satuan</td>
                                        <td class="border p-2">Sub total</td>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    <div class="border"></div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grandTotal" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-4" for="grid-last-name">Grand Total</label>
                            <input value="{{ old('grandTotal') }}" name="grandTotal" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" placeholder="Grand total">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="description" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Deskripsi</label>
                            <input value="{{ old('description') }}" name="description" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Transaction Description">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="reseller" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Reseller</label>
                            <select name="reseller_id" id="reseller_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                @foreach($resellers as $reseller)
                                    <option value="{{ $reseller->id }}">{{$reseller->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 text-right">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Save Transaction
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $(".transaction_type_id").on('change', function(){

        })
    })
</script>