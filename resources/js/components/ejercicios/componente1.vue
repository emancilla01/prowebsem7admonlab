<template>
    <h1>Hola desde App2.vue</h1>
        <p>{{ mensaje }}</p>
</template>

<script setup>
    import { ref } from 'vue';
    const mensaje = ref('Este es un mensaje desde el script setup en App2.vue');
</script>

<style>

</style>