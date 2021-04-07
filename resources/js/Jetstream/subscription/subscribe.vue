<template>
    <div>

        <button v-if="!Subscribed" @click="subscribe"
        class="px-4 py-2 font-medium tracking-wide text-white capitalize
         transition-colors duration-200 transform bg-blue-600 rounded-md
         dark:bg-gray-800 hover:bg-blue-500 dark:hover:bg-gray-700 focus:outline-none
         focus:bg-blue-500 dark:focus:bg-gray-700">
            subscribe
        </button>

        <button v-if="Subscribed" @click="unsubscribe"
                class="px-4 py-2 font-medium tracking-wide text-white capitalize
         transition-colors duration-200 transform bg-red-600 rounded-md
         dark:bg-gray-800 hover:bg-red-500 dark:hover:bg-gray-700 focus:outline-none
         focus:bg-red-500 dark:focus:bg-gray-700">
            unsubscribe
        </button>

    </div>
</template>

<script>
    export default {
        name: "subscribe",
        props:['isSubscribed'],
        data(){
            return{
                Subscribed:this.isSubscribed,
            }
        },
        methods:{
            subscribe(){
                this.Subscribed=true;
                axios.post(location.href+'/subscribe')
            },
            unsubscribe(){
                this.Subscribed=false;
                axios.delete(location.href+'/subscribe')
            }
        },


    }
</script>

<style scoped>

</style>
