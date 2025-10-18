<template>
  <div>
    <h2>بيانات الفئات:</h2>
    <pre>{{ categories }}</pre>
    <hr>
    <h2>بيانات المنتجات:</h2>
    <pre>{{ products }}</pre>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
// **الاستيراد الضروري:** لجعل طلبات API تعمل
import axios from 'axios'; 

const categories = ref({})
const products = ref({})

const getCategories = async () => {
  await axios.get('/api/categories')
    .then(response => {
      categories.value = response.data.data
    })
    // استخدام console.error أفضل للأخطاء
    .catch(error => console.error("Error fetching categories:", error)) 
}

const getProducts = async () => {
  await axios.get('/api/products')
    .then(response => {
      products.value = response.data.data
    })
    .catch(error => console.error("Error fetching products:", error))
}

onMounted(() => {
  getCategories()
  getProducts()
})
</script>