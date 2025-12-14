<template>
    <div class="fotos-repeat">
        <label>
            cantidad:
            <input type="text" min="1" v-model.number="count" />
        </label>

        <div class="gallery">
            <img v-for="n in count" :key="n" :src="imgSrc" alt="Foto repetida" />
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
const count = ref(3);
const imgSrc = ref('/img/aguila3.jpg');
</script>

<style scoped>
.gallery{
    display:flex;
    gap:8px;
    flex-wrap:wrap;
    margin-top:12px;
}
.gallery img{
    width:220px;
    height:auto;
    border-radius:6px;
}
.fotos-repeat input[type="number"]{
    width:80px;
    margin-left:8px;
}
</style>