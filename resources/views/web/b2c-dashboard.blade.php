<div class="py-3">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="  overflow-hidden shadow-sm sm:rounded-lg">
            <div class=" text-gray-900 dark:text-gray-100">
                <table class="w-full text-sm text-center  text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">#</th>
                            <th scope="col" class="px-6 py-3">Product Name</th>
                            <th scope="col" class="px-6 py-3">Type</th>
                            <th scope="col" class="px-6 py-3">Card</th>
                            <th scope="col" class="px-6 py-3">Payment Status</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach(Auth::user()->purchases as $purchase)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$loop->iteration}}
                            </th>
                            <td class="px-6 py-4">
                                {{$purchase->product->title}}
                            </td>
                            <td class="px-6 py-4">
                                {{$purchase->product->type}}
                            </td>
                            <td class="px-6 py-4">
                                **** **** **** {{$purchase->last_card_digit}}
                            </td>
                            <td class="px-6 py-4">
                                {{$purchase->payment_status}}
                            </td>
                            <td class="px-6 py-4">
                                @if($purchase->status != "Cancelled")
                                <a href="{{route('purchase-cancellation',['purchase_id' => $purchase->id])}}" class="text-pink-500 " type="button">Cancel</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>