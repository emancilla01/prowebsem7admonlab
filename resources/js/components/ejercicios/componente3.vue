<template>
    <div>
        <h3>Fotos (Con directivas :v-bind y v-model)</h3>
        <input type="radio" name="ver" value="/img/aguila1.jpg" v-model="imagen"> aguila1
        <input type="radio" name="ver" value="/img/aguila2.jpg" v-model="imagen"> aguila2
        <input type="radio" name="ver" value="/img/aguila3.jpg" v-model="imagen"> aguila3
        <img v-bind:src="imagen" alt="">
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    const imagen = ref('/img/aguila1.jpg');
</script>

<style>

</style>