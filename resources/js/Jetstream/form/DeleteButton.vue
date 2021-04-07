<template>
    <button @click="remove" class="inline-flex items-center justify-center px-3 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 disabled:opacity-25 transition">
        delete
    </button>
</template>

<script>

    export default {
        name: "DeleteButton",
        props:['item','routeName'],
        methods:{
            remove(){
                this.$inertia.delete(route(this.routeName,this.item))

            }
        }
    }
</script>

<style scoped>

</style>
