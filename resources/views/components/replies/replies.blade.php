@props(['replies'=>[]])
<div x-data="data()"  class="bg-green-400 p-5" >
    @verbatim
    <template x-for="reply in replies" :key="reply.id">
        <div  class="flex w-2/3  overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800 my-3" :id="'reply-'+reply.id">
            <div class="w-2 bg-gray-800 dark:bg-gray-900"></div>

            <div class="flex items-center px-2 py-3 justify-between w-full">
                <div>
                    <div class="flex items-center">
                        <img class="object-cover w-10 h-10 rounded-full" alt="User avatar" :src="reply.owner.avatar">
                        <strong class="pl-2" x-text="reply.owner.name"></strong>
                    </div>
                    <div class="font-thin text-sm text-gray-600" x-text="reply.created_at"></div>
                </div>

                <div class="mx-3">
                    <p class="" x-text="reply.body"> </p>
                </div>

            </div>
        </div>
    </template>
    @endverbatim
</div>

<script>
    let data=()=>{
       return {
           replies:@json($replies)
       }
    }
</script>
