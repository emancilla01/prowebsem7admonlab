<template>
  <div>
    <h3>Lista de Categorías</h3>
    <table>
      <thead>
        <tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>
      </thead>
      <tbody>
        <tr v-for="c in categorias" :key="c.id">
          <td>{{ c.id }}</td>
          <td>{{ c.nombre ?? c.name }}</td>
          <td>
            <button @click.prevent="showEquipos(c.id)">Equipos</button> <br>
            <button @click.prevent="showMobiliario(c.id)">Mobiliario</button>
          </td>
        </tr>
      </tbody>
    </table>
    <div v-if="meta.total !== undefined" class="pagination" style="display:flex;align-items:center;gap:10px;margin:8px 0;">
      <button :disabled="meta.current_page <= 1" @click.prevent="fetchCategorias(meta.current_page - 1)">Prev</button>
      <div style="font-size:0.95rem">Página <strong>{{ meta.current_page }}</strong> de <strong>{{ meta.last_page }}</strong> — {{ meta.total }} registros</div>
      <button :disabled="meta.current_page >= meta.last_page" @click.prevent="fetchCategorias(meta.current_page + 1)">Next</button>
      <select v-if="meta.last_page && meta.last_page <= 20" v-model.number="selectedPage" @change="fetchCategorias(selectedPage)" style="margin-left:auto">
        <option v-for="p in pagesArray" :key="p" :value="p">Ir a {{ p }}</option>
      </select>
    </div>

    <div v-if="items.length">
      <h4>Resultados</h4>
      <table>
        <thead><tr><th>ID</th><th>Codigo</th><th>Descripción</th><th>Tipo</th></tr></thead>
        <tbody>
          <tr v-for="it in items" :key="it.id">
            <td>{{ it.id }}</td>
            <td>{{ it.codigo }}</td>
            <td>{{ it.descripcion }}</td>
            <td>{{ it.tipo }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
const categorias = ref([]);
const items = ref([]);
const meta = ref({});

const fetchCategorias = async (page = 1) => {
  try {
    const res = await fetch(`/apicategorias?page=${page}`);
    const json = await res.json();
    if (json && json.data) {
      categorias.value = json.data;
      meta.value = {
        current_page: json.current_page || 1,
        last_page: json.last_page || 1,
        per_page: json.per_page || json.perPage || 15,
        total: json.total || 0,
      };
      selectedPage.value = meta.value.current_page || 1;
    } else if (Array.isArray(json)) {
      categorias.value = json;
      meta.value = { current_page: 1, last_page: 1, per_page: json.length, total: json.length };
    } else {
      categorias.value = [];
      meta.value = {};
    }
  } catch (e) {
    categorias.value = [];
    meta.value = {};
  }
};

const selectedPage = ref(1);
const pagesArray = computed(() => {
  const p = meta.value.last_page || 0;
  return Array.from({ length: p }, (_, i) => i + 1);
});

const showEquipos = async (categoriaId) => {
  try {
    const res = await fetch(`/apicategorias/${categoriaId}/equipos`);
    items.value = await res.json();
  } catch (e) {
    items.value = [];
  }
};

const showMobiliario = async (categoriaId) => {
  try {
    const res = await fetch(`/apicategorias/${categoriaId}/mobiliario`);
    items.value = await res.json();
  } catch (e) {
    items.value = [];
  }
};

onMounted(() => fetchCategorias());
</script>

<style scoped>
table { width: 100%; border-collapse: collapse; }
th, td { border: 1px solid #ddd; padding: 6px; }
</style>
