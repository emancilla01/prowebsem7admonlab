<template>
    <div>
        <h1>Hola desde App2.vue</h1>
        <p>{{ mensaje }}</p>
        <input type="text" v-model="numero">
        <h2>{{ numero }}</h2>
    </div>
    <div>
        <h3>Fotos (Con directivas :v-bind y v-model)</h3>
        <input type="radio" name="ver" value="/img/aguila1.jpg" v-model="imagen"> aguila1
        <input type="radio" name="ver" value="/img/aguila2.jpg" v-model="imagen"> aguila2
        <input type="radio" name="ver" value="/img/aguila3.jpg" v-model="imagen"> aguila3
        <img v-bind:src="imagen" alt="">
    </div>

    <div>
        <h3>Fotos (Con directivas :v-bind style)</h3>
        <input type="radio" name="ver2" value="/img/aguila1.jpg" v-model="imagen"> aguila1
        <input type="radio" name="ver2" value="/img/aguila2.jpg" v-model="imagen"> aguila2
        <input type="radio" name="ver2" value="/img/aguila3.jpg" v-model="imagen"> aguila3
        <div v-bind:style="{width: '300px',
            height: '300px',
            backgroundImage:'url(' + imagen + ')',
            backgroundSize: 'cover' }"></div>
    </div>
    <hr>
    <div>
        <h3>Fotos (Con directiva v-model con arreglos)</h3>
        <select name="" id="" v-model="indice_imagen">
            <option value="0">aguila1</option>
            <option value="1">aguila2</option>
            <option value="2">aguila3</option>
        </select>
        <img v-bind:src="imagenes[indice_imagen]" alt="">
    </div>
    <hr>
    <div>
        <h3>Lista de fotos (Con directiva v-for)</h3>
        <div v-for="(img,index) in imagenes" :key="index">
            <h4>Imagen {{ index + 1 }}</h4>
            <img :src="img" alt=""></div>
    </div>
</template>
<script setup>
    import { ref } from 'vue';

    const mensaje = ref('Este es un mensaje desde el script setup en App2.vue');
    const numero = ref(15);

    const imagen = ref('/img/aguila1.jpg');
    const indice_imagen = ref(1);
    const imagenes = 
    [
        '/img/aguila1.jpg',
        '/img/aguila2.jpg',
        '/img/aguila3.jpg'
    ];

</script>

<style>
h1 {
    color: white;
    background-color: blue;
}
</style>