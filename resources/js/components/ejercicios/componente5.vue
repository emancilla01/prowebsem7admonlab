<template>
    <div>
        <h3>Fotos (Con directiva v-model con arreglos)</h3>
        <select name="" id="" v-model="indice_imagen">
            <option value="0">aguila1</option>
            <option value="1">aguila2</option>
            <option value="2">aguila3</option>
        </select>
        <img v-bind:src="imagenes[indice_imagen]" alt="">
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    const indice_imagen = ref(0);
    const imagenes = 
    [
        '/img/aguila1.jpg',
        '/img/aguila2.jpg',
        '/img/aguila3.jpg'
    ];
</script>

<style>

</style>