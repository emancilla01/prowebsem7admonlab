<template>
  <div>
    <h2>Consultas con VUE API-Rest</h2>
    <a href="/dashboard">Regresar al inicio</a>
    <nav style="margin-bottom:12px">
      <button @click="sel = 'grupos'">Grupos</button>
      <button @click="sel = 'categorias'">Categorías</button>
      <button @click="sel = 'periodos'">Períodos</button>
    </nav>

    <section>
      <ListaGrupos v-if="sel === 'grupos'" />
      <ListaCategorias v-if="sel === 'categorias'" />
      <ListaPeriodos v-if="sel === 'periodos'" />
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import ListaGrupos from './ListaGrupos.vue';
import ListaCategorias from './ListaCategorias.vue';
import ListaPeriodos from './ListaPeriodos.vue';

const sel = ref('grupos');
</script>

<style scoped>
button { margin-right: 8px; }
</style>
