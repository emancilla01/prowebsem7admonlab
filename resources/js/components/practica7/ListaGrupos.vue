<template>
  <div>
    <h3>Lista de Grupos</h3>
    <table>
      <thead>
        <tr><th>ID</th><th>Nombre</th><th>Acción</th></tr>
      </thead>
      <tbody>
        <tr v-for="g in grupos" :key="g.id">
          <td>{{ g.id }}</td>
          <td>{{ g.nombre_grupo ?? g.nombre ?? g.name ?? g.title }}</td>
          <td><button @click.prevent="showAlumnos(g.id)">Ver alumnos</button></td>
        </tr>
      </tbody>
    </table>
    <div v-if="meta.total !== undefined" class="pagination" style="display:flex;align-items:center;gap:10px;margin:8px 0;">
      <button :disabled="meta.current_page <= 1" @click.prevent="fetchGrupos(meta.current_page - 1)">Prev</button>
      <div style="font-size:0.95rem">Página <strong>{{ meta.current_page }}</strong> de <strong>{{ meta.last_page }}</strong> — {{ meta.total }} registros</div>
      <button :disabled="meta.current_page >= meta.last_page" @click.prevent="fetchGrupos(meta.current_page + 1)">Next</button>

      <div v-if="meta.last_page && meta.last_page <= 20" style="margin-left:auto">
        <button v-for="p in pagesArray" :key="p" :disabled="p===meta.current_page" @click.prevent="fetchGrupos(p)" style="margin-right:4px">{{ p }}</button>
      </div>

      <select v-else v-model.number="selectedPage" @change="fetchGrupos(selectedPage)" style="margin-left:auto">
        <option v-for="p in pagesToShow" :key="p" :value="p">Ir a {{ p }}</option>
      </select>
    </div>

    <div v-if="alumnos.length">
      <h4>Alumnos del grupo {{ selectedGrupo }}</h4>
      <table>
        <thead><tr><th>ID</th><th>Matricula</th><th>Nombre</th></tr></thead>
        <tbody>
          <tr v-for="a in alumnos" :key="a.id">
            <td>{{ a.id }}</td>
            <td>{{ a.matricula }}</td>
            <td>{{ a.nombre_alumno }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
const grupos = ref([]);
const alumnos = ref([]);
const selectedGrupo = ref(null);
const meta = ref({});

const fetchGrupos = async (page = 1) => {
  try {
    const res = await fetch(`/apigrupos?page=${page}`);
    const json = await res.json();
    // Laravel paginator returns { data: [...], current_page, last_page, per_page, total }
    if (json && json.data) {
      grupos.value = json.data;
      meta.value = {
        current_page: json.current_page || 1,
        last_page: json.last_page || 1,
        per_page: json.per_page || json.perPage || 15,
        total: json.total || 0,
      };
      selectedPage.value = meta.value.current_page || 1;
    } else if (Array.isArray(json)) {
      grupos.value = json;
      meta.value = { current_page: 1, last_page: 1, per_page: json.length, total: json.length };
    } else {
      grupos.value = [];
      meta.value = {};
    }
  } catch (e) {
    grupos.value = [];
    meta.value = {};
  }
};

const pagesToShow = computed(() => {
  const p = meta.value.last_page || 1;
  const cur = meta.value.current_page || 1;
  const pages = [];
  const start = Math.max(1, cur - 3);
  const end = Math.min(p, cur + 3);
  for (let i = start; i <= end; i++) pages.push(i);
  if (pages.length === 0) pages.push(1);
  return pages;
});

const selectedPage = ref(1);
const pagesArray = computed(() => {
  const p = meta.value.last_page || 0;
  return Array.from({ length: p }, (_, i) => i + 1);
});

const showAlumnos = async (grupoId) => {
  selectedGrupo.value = grupoId;
  try {
    const res = await fetch(`/apigrupos/${grupoId}/alumnos`);
    alumnos.value = await res.json();
  } catch (e) {
    alumnos.value = [];
  }
};

onMounted(() => fetchGrupos());
</script>

<style scoped>
table { width: 100%; border-collapse: collapse; }
th, td { border: 1px solid #ddd; padding: 6px; }
</style>
