<div class="m-2">
    {{-- title of the table --}}
    <div class="flex items-center justify-center w-full mb-2 text-2xl font-bold ">
        Transaction History
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
            <thead class="">
                <tr>
                    <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                        Order Id
                    </th>
                    <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                        Amount
                    </th>
                    <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                        Time
                    </th>

                </tr>
            </thead>

            <tbody class="text-center divide-y divide-gray-200">
                @foreach($balanceHistories as $key => $value)
                <tr>
                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                        {{ $value->order_id }}
                    </td>
                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap"> {{ $value->amount }}</td>
                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap"> {{
                        // convert timestamp to date 2021 Mei 12 12:00 AM
                        date('Y M d h:i A', strtotime($value->created_at))
                        }}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>


    {{ $balanceHistories->links() }}
</div>
