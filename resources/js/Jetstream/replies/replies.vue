<template>
<div class="w-11/12 mx-auto">
    <reply v-for="(reply,index) in replies" :key="index" :reply="reply" @decrement="decrement()"></reply>
</div>
</template>

<script>
    import Reply from "@/Jetstream/replies/reply";
    export default {
        name: "replies",
        components: {Reply},
        props:['replies'],
        methods:{
           decrement(){ this.$emit("decrement")},
        }
    }
</script>

<style scoped>

</style>
