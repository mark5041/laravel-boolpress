<template>
  <div class="container">
    <div class="row g-4" v-if="cards.products">
      <div class="col-12 col-md-4" v-for="(product, index) in cards.products" :key="index">
        <div class="card">
          <img src="\storage\app\uploads\default.png" class="card-img-top" :alt="product.title">
          <div class="card-body">
            <h5 class="card-title">{{ product.title }}</h5>
            <p class="card-text">{{ product.description }}</p>
          </div>
          <router-link class="btn btn-secondary" :to="{ name: 'product', params: { id: product.id } }">View</router-link>
        </div>
      </div>
    </div>
    <div v-if="!cards.products == null" class="row text-center">
      <div class="col">
        <h1>Nessun risultato</h1>
      </div>
    </div>
    <div class="row bottom" v-if="cards.prev_page_url || cards.next_page_url">
      <ul class="list-inline d-flex justify-content-center align-items-center">
        <li v-if="!cards.next_page_url && cards.prev_page_url" class="list-inline-item"> 
          <h1> {{cards.current_page}} </h1>
        </li>
        <li class="list-inline-item"> 
          <button v-if="cards.prev_page_url" class="btn btn-primary" @click="changePage('prev_page_url')">Prev</button>
        </li>
        <li v-if="cards.prev_page_url && cards.next_page_url" class="list-inline-item"> 
          <h1>{{cards.current_page}}</h1>
        </li>
        <li class="list-inline-item"> 
          <button v-if="cards.next_page_url" class="btn btn-primary" @click="changePage('next_page_url')">Next</button>
        </li>
        <li v-if="!cards.prev_page_url" class="list-inline-item"> 
          <h1> {{cards.current_page}} </h1>
        </li>
      </ul>
    </div>
  </div>
</template>


<script>
  export default {
    name: "Main",
    props: ['cards'],
    methods: {
      changePage(vs) {
        this.$emit('changePage', vs);
      }
    },
    watch: {
      cards: {
        function () {
          console.log(this.cards);
        }
      }
    }
  }
</script>

<style lang="scss" scoped>
.bottom {
  margin-top: 3em;
}
</style>