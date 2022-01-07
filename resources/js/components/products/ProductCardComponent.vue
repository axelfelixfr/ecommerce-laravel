<template>
  <div class="col-12 col-sm-10 col-md-4">
    <div class="card">
      <header class="bg-primary p-2"></header>
      <div class="card-body">
        <h2 class="card-title">{{ product.name }}</h2>
        <h4 class="card-text">{{ product.priceMxn }}</h4>
        <p class="card-text">{{ product.description }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    product: {
      type: Object
    }
  }
};
</script>
