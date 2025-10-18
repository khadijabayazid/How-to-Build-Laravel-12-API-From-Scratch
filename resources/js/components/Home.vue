<template>
  <div class="grid grid-cols-4 gap-4">
    <div class="space-y-2" v-for="product in products.data" :key="product.id">
      <a href="#">
        <img src="http://placehold.it/300x400" :alt="product.name" />
      </a>
      <a class="text-slate-500 text-xl font-semibold hover:underline" href="#">
        {{ product.name }}
      </a>
      <p>${{ product.price }}</p>
      <p class="prose-slate">{{ product.description }}</p>
    </div>
  </div>

  <TailwindPagination :data="products" @pagination-change-page="getProducts" class="mt-4" />
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { TailwindPagination } from 'laravel-vue-pagination';
// 1. تم إضافة استيراد axios
import axios from 'axios';

// 2. تم تعريف المتغير التفاعلي products
const products = ref({});

const getProducts = async (page = 1) => {
  try {
    const response = await axios.get(`/api/products?page=${page}`);
    products.value = response.data;
  } catch (error) {
    console.error('Error fetching products:', error);
  }
}

// 3. تم استخدام onMounted لاستدعاء الدالة عند تحميل المكون
onMounted(() => {
  getProducts();
});
</script>