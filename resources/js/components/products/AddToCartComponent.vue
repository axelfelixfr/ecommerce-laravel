<template>
  <button @click="addToCart" class="btn btn-success">{{ statusButton }}</button>
</template>

<script>
import axios from "axios";

export default {
  name: "AddToCartComponent",
  data() {
    return {
      statusButton: "Agregar al carrito",
      endpoint: "/shopping_cart"
    };
  },
  props: { product: { type: Object } },
  methods: {
    addToCart() {
      axios({
        method: "POST",
        url: this.endpoint,
        data: {
          product_id: this.product.id
        },
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json"
        }
      }).then(() => {
        console.log("Se agrego al carrito");
        window.store.commit("increment");
      });
    }
  }
};
</script>
