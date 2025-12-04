<template>
    <ul>
        <li><button @click="vereje1">Ejercicio 1</button></li>
        <li><button @click="vereje2">Ejercicio 2</button></li>
        <li><button @click="vereje3">Ejercicio 3</button></li>
        <li><button @click="vereje4">Ejercicio 4</button></li>
        <li><button @click="vereje5">Ejercicio 5</button></li>
        <li><button @click="vereje6">Ejercicio 6</button></li>
        <li><button @click="vereje7">Ejercicio 7</button></li>
        <hr>    
        <!-- <h2>Propiedades de los componentes</h2>
        <div v-for="(alum,index) in alumnos" :key="index">
        <componentex :titulo="alumnos[index].tit" 
                    :path_img="alumnos[index].path_img"> 
        </componentex>
        </div>  
        <hr>

        <h2>Catalogo de maestros</h2>
        <div v-for="(maestro,index) in maestros" :key="index">
        <componentey :id="maestros[index].id"
                    :nombre="maestros[index].nombre"
                    :apellido_p="maestros[index].apellido_p"
                    :apellido_m="maestros[index].apellido_m"
                    :tel="maestros[index].tel">

        </componentey>
        </div> -->
    </ul>
<componente1 v-if="eje1" ></componente1>
<componente2 v-if="eje2" ></componente2>
<componente3 v-if="eje3" ></componente3>
<componente4 v-if="eje4" ></componente4>
<componente5 v-if="eje5" ></componente5>
<componente6 v-if="eje6" ></componente6>
<componente7 v-if="eje7" ></componente7>
<!--  prueba de dato reactivo (true or false) -->
<!-- {{ eje1 }}  -->
<hr><hr>
<!-- <compfetch1></compfetch1> -->

    <!-- <div>
        <h1>Hola desde App2.vue</h1>
        <p>{{ mensaje }}</p>
        <input type="text" v-model="numero">
        <h2>{{ numero }}</h2>
    </div>
    <div>
        <h3>Fotos (Con directivas :v-bind y v-model)</h3>
        <input type="radio" name="ver" value="/img/aguila1.jpg" v-model="imagen"> aguila1
        <input type="radio" name="ver" value="/img/aguila2.jpg" v-model="imagen"> aguila2
        <input type="radio" name="ver" value="/img/aguila3.jpg" v-model="imagen"> aguila3
        <img v-bind:src="imagen" alt="">
    </div>

    //componente4
    <div>
        <h3>Fotos (Con directivas :v-bind style)</h3>
        <input type="radio" name="ver2" value="/img/aguila1.jpg" v-model="imagen"> aguila1
        <input type="radio" name="ver2" value="/img/aguila2.jpg" v-model="imagen"> aguila2
        <input type="radio" name="ver2" value="/img/aguila3.jpg" v-model="imagen"> aguila3
        <div v-bind:style="{width: '300px',
            height: '300px',
            backgroundImage:'url(' + imagen + ')',
            backgroundSize: 'cover' }"></div>
    </div>
    <hr>
    //componente5
    <div>
        <h3>Fotos (Con directiva v-model con arreglos)</h3>
        <select name="" id="" v-model="indice_imagen">
            <option value="0">aguila1</option>
            <option value="1">aguila2</option>
            <option value="2">aguila3</option>
        </select>
        <img v-bind:src="imagenes[indice_imagen]" alt="">
    </div>
    <hr>

    //componente6
    <div>
        <h3>Lista de fotos (Con directiva v-for)</h3>
        <div v-for="(img,index) in imagenes" :key="index">
            <h4>Imagen {{ index + 1 }}</h4>
            <img :src="img" alt=""></div>
    </div>
    <hr>

    //componente7
    <div>
        <h3>Ver foto segun checkbox (con directiva v-if o v-show)</h3>
        <input type="checkbox" name=""  id="" value="false" v-model="mostrar">Mostrar Imagen
        <div v-if="mostrar" style="display:inline;">
            <img src="img/aguila1.jpg" @click="verimagengrande" style="width: 40px; height: 40px;" alt="">
        </div>
        <div v-if="ver" style="display:inline;">
            <img src="img/aguila1.jpg"  style="width: 400px; height: 400px;" alt="">
        </div>
    </div> -->
</template>
<script setup>
    import componente1 from './componente1.vue';
    import componente2 from './componente2.vue';
    import componente3 from './componente3.vue';
    import componente4 from './componente4.vue';
    import componente5 from './componente5.vue';
    import componente6 from './componente6.vue';
    import componente7 from './componente7.vue';
    import componentex from './componentex.vue';
    import componentey from './componentey.vue';
    import compfetch1 from './fetch/compfetch1.vue';
    import {ref} from 'vue';
    const eje1 = ref(false);
    const eje2 = ref(false);
    const eje3 = ref(false);
    const eje4 = ref(false);
    const eje5 = ref(false);
    const eje6 = ref(false);
    const eje7 = ref(false);
    const tit = ref('Juan Duran sin arreglo');

    const alumnos = [
    {
        tit:"Juan Duran",
        path_img:"img/aguila1.jpg"
    },
    {
        tit:"Enrique Duran",
        path_img:"img/aguila2.jpg"
    },
    {
        tit:"Daniel Duran",
        path_img:"img/aguila3.jpg"
    },
    {
        tit:"Ramon Duran",
        path_img:"img/aguila3.jpg"
    }
    ];
    
    const maestros = [
        {
            id: '100',
            nombre: 'Veronica',
            apellido_p: 'Veloz',
            apellido_m: 'Ramirez',
            tel: '5512345678',
        },
        {
            id: '101',
            nombre: 'Carlos',
            apellido_p: 'Sanchez',
            apellido_m: 'Lopez',
            tel: '5598765432',
        },
        {
            id: '102',
            nombre: 'Ana',
            apellido_p: 'Gomez',
            apellido_m: 'Martinez',
            tel: '5587654321',
        }
    ];

    function vereje1() {
        eje1.value = !eje1.value;
    }
    function vereje2() {
        eje2.value = !eje2.value;
    }
    function vereje3() {
        eje3.value = !eje3.value;
    }
    function vereje4() {
        eje4.value = !eje4.value;
    }
    function vereje5() {
        eje5.value = !eje5.value;
    }
    function vereje6() {
        eje6.value = !eje6.value;
    }
    function vereje7() {
        eje7.value = !eje7.value;
    }

    // import { ref } from 'vue';
    // const mensaje = ref('Este es un mensaje desde el script setup en App2.vue');
    // const numero = ref(15);

    // const imagen = ref('/img/aguila1.jpg');
    // const indice_imagen = ref(1);
    // const imagenes = 
    // [
    //     '/img/aguila1.jpg',
    //     '/img/aguila2.jpg',
    //     '/img/aguila3.jpg'
    // ];

    // const mostrar = ref(false);
    // const ver = ref(false);

    // function verimagengrande() {
    //     ver.value = !ver.value;
    // }
</script>

<style>
h1 {
    color: white;
    background-color: blue;
}
</style>