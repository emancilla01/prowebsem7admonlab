<template>
    <div>
        <h3>Lista de fotos (Con directiva v-for)</h3>
        <div v-for="(img,index) in imagenes" :key="index">
            <h4>Imagen {{ index + 1 }}</h4>
            <img :src="img" alt=""></div>
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