<template>
  <div>
    <h3>Lista de Períodos</h3>
    <table>
      <thead>
        <tr><th>ID</th><th>Periodo</th><th>Acción</th></tr>
      </thead>
      <tbody>
        <tr v-for="p in periodos" :key="p.id">
          <td>{{ p.id }}</td>
          <td>{{ p.nombre ?? p.periodo ?? p.name }}</td>
          <td><button @click.prevent="showGrupos(p.id)">Ver grupos</button></td>
        </tr>
      </tbody>
    </table>
    <div v-if="meta.total !== undefined" class="pagination" style="display:flex;align-items:center;gap:10px;margin:8px 0;">
      <button :disabled="meta.current_page <= 1" @click.prevent="fetchPeriodos(meta.current_page - 1)">Prev</button>
      <div style="font-size:0.95rem">Página <strong>{{ meta.current_page }}</strong> de <strong>{{ meta.last_page }}</strong> — {{ meta.total }} registros</div>
      <button :disabled="meta.current_page >= meta.last_page" @click.prevent="fetchPeriodos(meta.current_page + 1)">Next</button>

      <div v-if="meta.last_page && meta.last_page <= 20" style="margin-left:auto">
        <button v-for="p in pagesArray" :key="p" :disabled="p===meta.current_page" @click.prevent="fetchPeriodos(p)" style="margin-right:4px">{{ p }}</button>
      </div>

      <select v-else v-model.number="selectedPage" @change="fetchPeriodos(selectedPage)" style="margin-left:auto">
        <option v-for="p in pagesToShow" :key="p" :value="p">Ir a {{ p }}</option>
      </select>
    </div>

    <div v-if="grupos.length">
      <h4>Grupos del periodo</h4>
      <table>
        <thead><tr><th>ID</th><th>Nombre</th></tr></thead>
        <tbody>
          <tr v-for="g in grupos" :key="g.id">
            <td>{{ g.id }}</td>
            <td>{{ g.nombre_grupo ?? g.nombre }}</td>
          </tr>
        </tbody>
      </table>
      <div v-if="gruposMeta.total !== undefined" class="pagination" style="margin-top:6px">
        <button :disabled="gruposMeta.current_page <= 1" @click.prevent="showGrupos(currentPeriodoId, gruposMeta.current_page - 1)">Prev</button>
        <span> Página {{ gruposMeta.current_page }} de {{ gruposMeta.last_page }} — {{ gruposMeta.total }} registros</span>
        <button :disabled="gruposMeta.current_page >= gruposMeta.last_page" @click.prevent="showGrupos(currentPeriodoId, gruposMeta.current_page + 1)">Next</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
const periodos = ref([]);
const grupos = ref([]);
const meta = ref({});
const gruposMeta = ref({});
const currentPeriodoId = ref(null);

const fetchPeriodos = async (page = 1) => {
  try {
    const res = await fetch(`/apiperiodos?page=${page}`);
    const json = await res.json();
    if (json && json.data) {
      periodos.value = json.data;
      meta.value = {
        current_page: json.current_page || 1,
        last_page: json.last_page || 1,
        per_page: json.per_page || 15,
        total: json.total || 0,
      };
      selectedPage.value = meta.value.current_page || 1;
    } else if (Array.isArray(json)) {
      periodos.value = json;
      meta.value = { current_page: 1, last_page: 1, per_page: json.length, total: json.length };
    } else {
      periodos.value = [];
      meta.value = {};
    }
  } catch (e) {
    periodos.value = [];
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

const showGrupos = async (periodoId, page = 1) => {
  currentPeriodoId.value = periodoId;
  try {
    const res = await fetch(`/apiperiodos/${periodoId}/grupos?page=${page}`);
    const json = await res.json();
    if (json && json.data) {
      grupos.value = json.data;
      gruposMeta.value = {
        current_page: json.current_page || 1,
        last_page: json.last_page || 1,
        per_page: json.per_page || 15,
        total: json.total || 0,
      };
    } else if (Array.isArray(json)) {
      grupos.value = json;
      gruposMeta.value = { current_page: 1, last_page: 1, per_page: json.length, total: json.length };
    } else {
      grupos.value = [];
      gruposMeta.value = {};
    }
  } catch (e) {
    grupos.value = [];
    gruposMeta.value = {};
  }
};

onMounted(() => fetchPeriodos());
</script>

<style scoped>
table { width: 100%; border-collapse: collapse; }
th, td { border: 1px solid #ddd; padding: 6px; }
</style>
