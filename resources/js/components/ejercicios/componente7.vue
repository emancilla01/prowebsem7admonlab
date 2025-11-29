<template>
    <div>
        <h3>Ver foto segun checkbox (con directiva v-if o v-show)</h3>
        <input type="checkbox" name=""  id="" value="false" v-model="mostrar">Mostrar Imagen
        <div v-if="mostrar" style="display:inline;">
            <img src="img/aguila1.jpg" @click="verimagengrande" style="width: 40px; height: 40px;" alt="">
        </div>
        <div v-if="ver" style="display:inline;">
            <img src="img/aguila1.jpg"  style="width: 400px; height: 400px;" alt="">
        </div>
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
    const mostrar = ref(false);
    const ver = ref(false);

    function verimagengrande() {
        ver.value = !ver.value;
    }
</script>

<style>

</style>