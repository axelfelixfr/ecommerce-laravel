<template>
  <a href="/cart_products">Mi carrito {{ productsCount }}</a>
</template>

<script>
export default {
  name: "CartCounterComponent",
  props: ["count"],
  created() {
    window.store.commit("set", this.count);
  },
  computed: {
    productsCount() {
      return window.store.state.productsCount;
    }
  }
};
</script>
