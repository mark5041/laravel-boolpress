<template>
  <div>
        <div class="row text-center">
          <h1>i più venduti</h1>
        </div>
        <Main :cards="cards" @changePage="changePage($event)"></Main>
  </div>
</template>

<script>
import Axios from "axios";
import Main from '../components/Main.vue';
  export default {
    name: 'Home',
    components: {
      Main
    },
    data() {
      return {
        cards: {
          products: null,
          next_page_url: null,
          prev_page_url: null,
          current_page: null,
        }
      }
    },
    created() {
      this.getProducts('http://127.0.0.1:8000/api/v1/products');
    },
    methods: {
      changePage(vs) {
        let url = this.cards[vs];
        if(url) {
          this.getProducts(url);
        }
      },
      getProducts(url){
          Axios.get(url).then(
            (result) => {
              console.log(result.data.results.data);
              this.cards.products = result.data.results.data;
              this.cards.next_page_url = result.data.results.next_page_url;
              this.cards.prev_page_url = result.data.results.prev_page_url;
              this.cards.current_page = result.data.results.current_page;
            });
      }
      
    }
  }
</script>

<style lang="scss" scoped>
.row {
  margin: 2em 0;
  h1 {
    text-transform: uppercase;
  }
}
</style>