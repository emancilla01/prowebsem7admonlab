<template>
<h1>{{ titulo }}</h1>
<img v-bind:src="path_img" alt="">
</template>

<script setup>
defineProps({
        titulo: String, 
        path_img:String
});

</script>

<style>

</style>