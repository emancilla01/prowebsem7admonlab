<template>
  <div>
    <h3>Lista de Grupos</h3>
    <table>
      <thead>
        <tr><th>ID</th><th>Nombre</th></tr>
      </thead>
      <tbody>
        <tr v-for="g in grupos" :key="g.id">
          <td>{{ g.id }}</td>
          <td>{{ g.nombre_grupo ?? g.nombre ?? g.name ?? g.title }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
const grupos = ref([]);

const fetchGrupos = async () => {
  try {
    const res = await fetch('/apigrupos');
    grupos.value = await res.json();
  } catch (e) {
    grupos.value = [];
  }
};

onMounted(() => fetchGrupos());
</script>

<style scoped>
table { width: 100%; border-collapse: collapse; }
th, td { border: 1px solid #ddd; padding: 6px; }
</style>
