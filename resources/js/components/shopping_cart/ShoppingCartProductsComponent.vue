<template>
  <div>
    <material-transition-component tag="div">
      <article
        :key="Math.random() * product.id"
        v-for="(product, index) in products"
        :data-index="index"
        class="card-shopping-cart"
      >
        <div class="row">
          <div class="col-2">
            <strong>{{ index + 1 }}.</strong>
          </div>
          <div class="col-8">
            <strong>{{ product.name }}</strong>
          </div>
          <div class="col-2">
            <span>{{ product.priceMxn }}</span>
          </div>
        </div>
      </article>
    </material-transition-component>
    <article class="total card-shopping-cart">
      <div class="row">
        <div class="col-10">
          <strong>Total a pagar:</strong>
        </div>
        <div class="col-2">
          <span>{{ total }}</span>
        </div>
      </div>
    </article>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "ShoppingCartProductsComponent",
  data() {
    return {
      endpoint: "/cart_products/products",
      products: []
    };
  },
  created() {
    this.fetchProducts();
  },
  computed: {
    total() {
      let cents = this.products.reduce((acumulate, objProduct) => {
        return acumulate + objProduct.priceNumber;
      }, 0);

      return `$${cents / 100}`;
    }
  },
  methods: {
    fetchProducts() {
      axios.get(this.endpoint).then(response => {
        console.log(response);
        this.products = response.data.data;
      });
    }
  }
};
</script>

<style>
</style>