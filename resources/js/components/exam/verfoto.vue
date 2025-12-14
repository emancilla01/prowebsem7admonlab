<template>
  <div class="photo">
    <img :src="imgSrc" alt="Foto ejemplo" />
  </div>
</template>

<script setup>
import { ref } from 'vue';
// absolute path to public image
const imgSrc = ref('/img/aguila3.jpg');
</script>

<style scoped>
.photo img{
  max-width:100%;
  height:auto;
  display:block;
  margin:0 auto 12px auto;
}
</style>