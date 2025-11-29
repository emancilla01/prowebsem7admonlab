<template>
<input type="text" v-model="numero">
        <h2>{{ numero }}</h2>
</template>

<script setup>
    import { ref } from 'vue';
    const numero = ref('');
</script>

<style>

</style>