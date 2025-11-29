<template>
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
</template>

<script setup>
    import { ref } from 'vue';
    const imagen = ref('/img/aguila1.jpg');

</script>

<style>

</style>