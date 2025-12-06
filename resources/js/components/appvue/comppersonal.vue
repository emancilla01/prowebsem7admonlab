<template>
<div>
    <div style="margin-bottom:8px">
        <label>Filtrar por nombre: <input type="text" v-model="letras" @input="onInput" placeholder="Escribe letras..." /></label>
    </div>
    <table>
    <tr>
        <th>ID</th>
        <th>RFC</th>
        <th>Nombre</th>
        <th>Email</th>
    </tr>
    <tr v-for="personal in personales" :key="personal.id">
        <td> {{ personal.id }}</td>
        <td> {{ personal.rfc }}</td>
        <td> {{ personal.nombre }}</td>
        <td> {{ personal.email }}</td>
    </tr>
    </table>
    </div>
</template>

<script setup>
// import personal from "@/routes/personal";

import {ref, onMounted} from "vue";
const personales = ref([]);
const letras = ref('');

const obtener = (q) => {
    const url = `/apipersonal?letras=${encodeURIComponent(q ?? '')}`;
    console.log('fetching', url);
    fetch(url)
    .then(response => response.json())
    .then(data => { personales.value = data; })
    .catch(err => { console.error('fetch error', err); personales.value = []; });
};

const onInput = () => {
    obtener(letras.value);
};

onMounted(() => {
    obtener('');
});

// const Obtener = () => {
//     fetch('http://admonlab.test/apipersonal')
//     .then(response => {return response.json();})
//     .then(data => {personales.value = data;})
// };
    
// onMounted(() => {
//     Obtener();
// });
</script>