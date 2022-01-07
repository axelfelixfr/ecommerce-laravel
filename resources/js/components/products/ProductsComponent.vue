<template>
  <section>
    <material-transition-component tag="div" class="row">
      <product-card-component
        v-for="(product, index) in products"
        :data-index="index"
        :key="product.id"
        v-bind:product="product"
      ></product-card-component>
    </material-transition-component>
  </section>
</template>

<script>
import axios from "axios";
import ProductCardComponent from "./ProductCardComponent.vue";
import MaterialTransitionComponent from "../animations/MaterialTransitionComponent.vue";

export default {
  name: "ProductsComponent",
  data() {
    return {
      products: [
        // {
        //   id: 1,
        //   name: "Camiseta Verde",
        //   price: 200,
        //   description: "Camisa padre"
        // },
        // {
        //   id: 2,
        //   name: "Camiseta Roja",
        //   price: 340,
        //   description: "Camisa padre"
        // }
      ],
      endpoint: "/products"
    };
  },
  created() {
    this.getProducts();
  },
  components: {
    ProductCardComponent,
    MaterialTransitionComponent
  },
  methods: {
    getProducts() {
      axios.get(this.endpoint).then(response => {
        let productsData = response.data.data;
        this.products = productsData;
      });
    }
  }
};
</script>
