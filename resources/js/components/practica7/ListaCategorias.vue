<template>
  <div>
    <h3>Lista de Categorías</h3>
    <table>
      <thead>
        <tr><th>ID</th><th>Nombre</th></tr>
      </thead>
      <tbody>
        <tr v-for="c in categorias" :key="c.id">
          <td>{{ c.id }}</td>
          <td>{{ c.nombre ?? c.name }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
const categorias = ref([]);

const fetchCategorias = async () => {
  try {
    const res = await fetch('/apicategorias');
    categorias.value = await res.json();
  } catch (e) {
    categorias.value = [];
  }
};

onMounted(() => fetchCategorias());
</script>

<style scoped>
table { width: 100%; border-collapse: collapse; }
th, td { border: 1px solid #ddd; padding: 6px; }
</style>
