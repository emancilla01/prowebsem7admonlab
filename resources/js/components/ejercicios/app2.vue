<template>
    <div>
        <h1>Hola desde App2.vue</h1>
        <p>{{ mensaje }}</p>
    </div>
</template>
<script setup>
    import { ref } from 'vue';

    const mensaje = ref('Este es un mensaje desde el script setup en App2.vue');
</script>

<style>
h1 {
    color: white;
    background-color: blue;
}
</style>