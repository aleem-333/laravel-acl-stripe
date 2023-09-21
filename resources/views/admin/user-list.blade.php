<div class="py-3">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="  overflow-hidden shadow-sm sm:rounded-lg">
            <div class=" text-gray-900 dark:text-gray-100">
                <table class="w-full text-sm text-center  text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">#</th>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Role</th>
                            <th scope="col" class="px-6 py-3">Access</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$loop->iteration}}
                            </th>
                            <td class="px-6 py-4">
                                {{$user->name}}
                            </td>
                            <td class="px-6 py-4">
                                {{$user->email}}
                            </td>
                            <td class="px-6 py-4">
                                @if($user->hasRole(['b2c-customer']))
                                B2C
                                @elseif ($user->hasRole(['b2b-customer']))
                                B2B
                                @else
                                Admin
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <input onchange="accessCancellation(this,'{{$user->id}}')" type="checkbox" {{ ($user->status == 1) ? 'checked' : '' }} name="cancel_access" value="{{$user->id}}" />
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    function accessCancellation(target_obj, user_id) {
        $(target_obj).prop('disabled', true);
        $.get("{{route('access-cancellation')}}", {
            user_id: user_id
        }, function(result) {
            $(target_obj).prop('disabled', false);
            if (result.status == 1) {
                alert('User access granted.');
            } else {
                alert('User access revoked.');
            }
        });
    }
</script>