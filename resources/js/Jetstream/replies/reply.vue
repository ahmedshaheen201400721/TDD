<template>
    <div class="flex w-2/3  overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800 my-3" :id="'reply-'+reply.id" v-if="show">
        <div class="w-2 bg-gray-800 dark:bg-gray-900"></div>

        <div class="flex items-center px-2 py-3 justify-between w-full">
            <div>
                <div class="flex items-center">
                    <img class="object-cover w-10 h-10 rounded-full" alt="User avatar" :src="reply.owner.profile_photo_path">
                    <strong class="pl-2">{{reply.owner.name}}</strong>
                </div>
                <div class="font-thin text-sm text-gray-600">
                    <timeago :datetime="reply.created_at"></timeago>

                </div>
            </div>

            <div class="mx-3">
                <p class="" v-if="!update"> {{ reply.body}}</p>
                <div v-else-if="update">
                    <textarea name="body"  cols="25" rows="3" v-model="body"></textarea>
                    <button @click="edit"
                            v-if="$page.props.user.id==reply.owner.id"
                            class="inline-flex items-center justify-center px-3 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-600 disabled:opacity-25 transition">
                        update
                    </button>
                    <button @click="cancel"
                                     v-if="$page.props.user.id==reply.owner.id"
                                     class="inline-flex items-center justify-center px-3 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 disabled:opacity-25 transition">
                    cancel
                </button>
                </div>
            </div>

            <div>
                <div v-if="$page.props.user.id" class="text-center">
                    <div class="cursor-pointer flex justify-center" @click="like" >
                        <svg class="h-6 w-6 text-red-500" :fill="liked?'red':'none'" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <div class="text-xs -mt-1">{{likes}} likes</div>


                    <!--                    <div class="cursor-pointer flex justify-center" @click="like" v-else-if="!liked">-->
<!--                        <svg class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
<!--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>-->
<!--                        </svg>-->
<!--                    </div>-->

                    <div>
                        <button @click="remove"
                                v-if="$page.props.user.id==reply.owner.id"
                                class="inline-flex items-center justify-center px-3 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 disabled:opacity-25 transition">
                            delete
                        </button>
                        <button @click="showForm"
                                v-if="$page.props.user.id==reply.owner.id"
                                class="inline-flex items-center justify-center px-3 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-600 disabled:opacity-25 transition">
                            update
                        </button>
                    </div>

                </div>

<!--                <x-like action="{{route('like',$reply)}}" disabled="{{$reply->isLiked()}}"></x-like>-->
            </div>
        </div>
    </div>
</template>

<script>
    import DeleteButton from "@/Jetstream/form/DeleteButton";
    export default {
        name: "reply",
        props:['reply'],
        methods:{
            like(){
                axios.post(route("like",this.reply)).then(data=>
                {
                    if(data.data=='liked'){
                        this.liked=true;
                        this.likes++;
                    }else if(data.data=='unliked'){
                        this.liked=false;
                        this.likes--;

                    }
                })
            },
            remove(){
                axios.delete(route("replies.destroy",this.reply)).then(data=>
                {
                    if(data.status==202){
                        this.show=false;
                        Event.$emit("decrement")
                    }
                })
            },
            edit(){
                axios.patch(route("replies.update",this.reply),{body:this.body}).then(data=>
                {
                    if(data.status==202){
                        this.update=false;
                        this.reply.body=this.body;
                    }
                })
            },
            showForm(){
                this.update=true;
            },
            cancel(){
                this.update=false;
                this.body=this.reply.body;
            }
        },
        components:{DeleteButton},
        data(){
            return{
                show:true,
                likes:this.reply.likes.length,
                update:false,
                body:this.reply.body,
                liked:this.reply.likes.some((item)=>item.user_id==this.$page.props.user.id),
            }
        },
    }
</script>

<style scoped>

</style>
