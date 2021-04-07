<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <thread :thread="thread"  :time="time"  :author="author"  :path="path"  :canUpdataThread="canUpdataThread"  :repliesCount="repliesCount" ></thread>
        </div>
        <div class="w-2/3">
            <div class="text-center text-3xl">
                add Reply
            </div>
            <form action="" class="w-11/12 mx-auto block" @submit.prevent="addReply">
                <textarea name='body' v-model="form.body" rows="3" class= "w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" >

               </textarea>

                <input type="submit" value="add Reply" class="inline-flex items-center px-6 py-3 bg-blue-500 border border-transparent rounded-md font-semibold  text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-600 focus:outline-none focus:border-blue-600 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
            </form>
        </div>

        <div>
            <replies :replies="replies" ></replies>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout";
    import thread from "@/Jetstream/threads/thread";
    import Replies from "@/Jetstream/replies/replies";
    export default {

        methods:{
            addReply(){
                axios.post(route('replies.store',this.thread), this.form)
                    .then(data=>data).then(data=>{if(data.status==201){
                        this.form.body="";
                       let reply=data.data
                        this.replies.unshift(reply[0]);
                    }})
            },

        },
        name: "Show",
        data(){
            return{
                form: {
                    body: '',
                    thread_id: this.thread.id,
                    user_id: this.$page.props.user.id ,
                },

            }
        },
        components: {
            Replies,
            AppLayout,
            thread
        },
        props:['thread','time','author','path','canUpdataThread','repliesCount','replies']

    }
</script>

<style scoped>

</style>
