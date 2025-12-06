<template>
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
</template>

<script setup>
import personal from "@/routes/personal";
import {ref, onMounted} from "vue";
const personales = ref([]);


const Obtener = () => {
    fetch('http://admonlab.test/apipersonal')
    .then(response => {return response.json();})
    .then(data => {personales.value = data;})
};
    
onMounted(() => {
    Obtener();
});
</script>