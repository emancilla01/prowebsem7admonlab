<template>
  <div>
    <h3>Lista de Períodos</h3>
    <table>
      <thead>
        <tr><th>ID</th><th>Periodo</th></tr>
      </thead>
      <tbody>
        <tr v-for="p in periodos" :key="p.id">
          <td>{{ p.id }}</td>
          <td>{{ p.nombre ?? p.periodo ?? p.name }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
const periodos = ref([]);

const fetchPeriodos = async () => {
  try {
    const res = await fetch('/apiperiodos');
    periodos.value = await res.json();
  } catch (e) {
    periodos.value = [];
  }
};

onMounted(() => fetchPeriodos());
</script>

<style scoped>
table { width: 100%; border-collapse: collapse; }
th, td { border: 1px solid #ddd; padding: 6px; }
</style>
