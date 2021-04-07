<template>
    <div class="py-6 w-2/3">
        <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden mx-auto w-11/12">
            <div class="bg-gray-200 px-6 py-4">
                <div class="flex justify-between items-center">
                    <div class="uppercase text-xs text-gray-600 font-bold">Author</div>
                    <div class="text-sm">
                        <timeago :datetime="thread.created_at"></timeago>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <a :href="route('profile.index',{'user':author})">

                        <div class="flex items-center pt-3">
                            <div class="bg-blue-700 w-12 h-12 flex justify-center items-center rounded-full uppercase font-bold text-white">
                                <img :src="author.profile_photo_path" alt="">

                            </div>
                            <div class="ml-4">
                                <p class="font-bold">
                                    {{ author.name}}
                                </p>
                            </div>
                        </div>
                    </a>
                    <div v-if="canUpdataThread">
                        <delete-button :item="thread" :routeName="'Threads.destroy'"></delete-button>
                    </div>
                    <div v-else>
                        <subscribe :isSubscribed="thread.isSubscribed"></subscribe>
                    </div>
                </div>
            </div>






            <div class=" items-center px-6 py-4">
                <span class="text-xs "> title</span>

                <div class="bg-orange-600 font-bold uppercase px-2 py-1 rounded-full border border-gray-200 font-bold">
                    <a :href="path">{{ thread.title}}</a>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-gray-200">
                <div class="border rounded-lg p-4 bg-gray-200">
                    {{thread.body}}
                </div>
            </div>

            <div class="bg-gray-200 text-gray-700 text-lg px-6 py-4 flex justify-between items-center">
                <div v-if="canUpdataThread">
                        <delete-button :item="thread" :routeName="'Threads.destroy'"></delete-button>
                </div>

                <div class="hover:text-blue-500 hover:underline"> {{count}} Replies</div>
            </div>

        </div>
    </div>


</template>

<script>
    import DeleteButton from  "@/Jetstream//form/DeleteButton";
    import subscribe from "@/Jetstream/subscription/subscribe";
    export default {
        name: "thread",
        components:{DeleteButton,subscribe},
        props:['thread','time','author','path','profile','canUpdataThread','repliesCount'],
        data(){
            return {
                count:Number(this.repliesCount.slice(0,1)),
            }
        },
        mounted() {
            Event.$on("decrement",()=>this.count--)
        }
    }
</script>

<style scoped>

</style>
