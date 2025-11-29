<template>
<h1>{{ id }}</h1>
<p>Nombre: {{ nombre }}</p>
<p>Apellido Paterno: {{ apellido_p }}</p>
<p>Apellido Materno: {{ apellido_m }}</p>
<p>Teléfono: {{ tel }}</p>
</template>

<script setup>

defineProps({
        id: String,
        nombre: String,
        apellido_p: String,
        apellido_m: String,
        tel: String
});
</script>