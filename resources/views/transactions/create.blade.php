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
                    <div id="product-form">
                        <div class="border mb-6"></div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label for="product" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Pilih produk</label>
                                <select name="product_id" id="product_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 product_id">
                                    @foreach($products as $product)
                                        <option data-unitprice={{$product->unit_price}} data-name={{$product->name}} value="{{ $product->id }}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label for="qty" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Qty</label>
                                <input value="0" name="qty" id="qty" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" placeholder="Qty">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label for="unitprice" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Harga Satuan</label>
                                <input value="{{ old('unitprice') }}" name="unitprice" id="unitprice" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" placeholder="Harga Satuan" readonly>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-4">
                            <div class="w-full px-3">
                                <label for="subtotal" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Subtotal</label>
                                <input value="{{ old('subtotal') }}" name="subtotal" id="subtotal" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" placeholder="Subtotal" readonly>
                            </div>
                        </div>
                        <a href="#" id="btn-add" class="text-white bg-green-500 hover:bg-green-700 p-2 rounded">Add</a>
                        <div class="flex flex-wrap mb-6 bg-white mt-6">
                            <table class="table-auto w-full" id="dataTableAddProduct">
                                <thead>
                                    <tr>
                                        <td class="border p-2">Nama Produk</td>
                                        <td class="border p-2">Nama Produk</td>
                                        <td class="border p-2">Qty</td>
                                        <td class="border p-2">Harga satuan</td>
                                        <td class="border p-2">Sub total</td>
                                        <td class="border p-2">Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="border mt-6"></div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grandTotal" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-4" for="grid-last-name">Grand Total</label>
                            <input value="{{ old('grandTotal') }}" name="grandTotal" id="grandTotal" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" placeholder="Grand total">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="description" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Deskripsi</label>
                            <input value="{{ old('description') }}" name="description" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Transaction Description">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6 transaction-detail-section">
                        <div class="w-full px-3">
                            <label for="transactionDetail" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Tr</label>
                            <input value="{{ old('transactionDetail') }}" name="transactionDetail" id="transaction-detail" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Transaction Description">
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
    $(".transaction-detail-section").hide();
    $(document).ready(function(){
        var tabledata = [];

        $("#product-form").hide();
        $(".transaction_type_id").on('change', function(){
            if($(".transaction_type_id").val() == 1){
                $("#product-form").hide();
            }else{
                $("#product-form").show();
            }
        })

        $("#unitprice").val($('#product_id option:selected').data('unitprice'))
        $("#product_id").on('change', function(){
            $("#unitprice").val($(this).attr("data-unitprice"))
        })

        $('#qty').keyup(function () {
            var unitPrice = $('#product_id option:selected').data('unitprice');
            console.log(unitPrice);
            var qty = $('#qty').val()
            var subtotal = qty * unitPrice
            $('#subtotal').val(subtotal);
        })

        $('#btn-add').click(function () {
            var qty = $('#qty').val()
            if(qty > 0){
                var product = $('#product_id').val()
                var subtotal = $('#subtotal').val()

                var productName = $('#product_id option:selected').data('name');
                var unitPrice = $('#product_id option:selected').data('unitprice');

                tabledata.push({
                    index: tabledata.length + 1,
                    id: product,
                    name: productName,
                    qty: Number(qty),
                    unitPrice: Number(unitPrice),
                    subtotal: Number(subtotal)
                })

                var grandTotal = accumulateSubtotal(tabledata);

                $('#grandTotal').val(grandTotal)

                var stringTableData = ""
                stringTableData += '<tr id="row-' + tabledata.length + '"><td class="border p-2">' 
                    + product + '</td><td class="border p-2">' + productName + '</td><td class="border p-2">' 
                        + qty + '</td><td class="border p-2">' + unitPrice + '</td><td class="border p-2">' 
                            + subtotal + '</td><td class="border p-2"><a href="#" class="text-white p-2 bg-red-500 hover:bg-red-700 rounded delete-item" data-id="' 
                                + tabledata.length + '">Delete</a></td><tr>';

                $('#dataTableAddProduct').append(stringTableData)
                $("#transaction-detail").val(JSON.stringify(tabledata))
            }
        });

        $(document).on('click', '.delete-item', function () {
            var row_id = $(this).attr('data-id')
            var indexRemoved = tabledata.findIndex(function(itemTableData) {
                return itemTableData.index == row_id
            });
            tabledata.splice(indexRemoved, 1)
            $('#row-' + row_id).remove()
            
            var grandTotal = accumulateSubtotal(tabledata);

            $('#grandTotal').val(grandTotal)
            $('#dataTableAddProduct').append(tabledata)
            $("#transaction-detail").val(JSON.stringify(tabledata))
        });

        function accumulateSubtotal(tabledata){
            var grandTotal = tabledata.reduce((accumulator, item) => {
                return accumulator + item.subtotal;
            }, 0);

            return grandTotal
        }
    })
</script>