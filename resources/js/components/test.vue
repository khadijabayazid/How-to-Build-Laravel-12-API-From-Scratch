<template>
  </template>

<script setup>
import { onMounted, ref } from 'vue';
import { TailwindPagination } from 'laravel-vue-pagination';

const categories = ref({});
const products = ref({});

const getCategories = async () => {
  await axios.get('http://demo.test/api/categories')
    .then(response => {
      categories.value = response.data.data
    })
    .catch((error) => console.log(error))
}

const getProducts = async (page = 1) => {
  await axios.get(`http://demo.test/api/products?page=${page}`)
    .then(response => {
      products.value = response.data
    })
    .catch((error) => console.log(error))
}

onMounted(() => {
  getCategories()
  getProducts()
})
</script>