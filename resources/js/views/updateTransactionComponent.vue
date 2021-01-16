<template>
  <div>
    <h2>Изменить транзакцию</h2>
      <transaction
        :transaction="transaction"
      ></transaction>
    <div
      v-if="!loading" 
      class="uk-grid" 
      style="margin: 0px;">
      <div class="uk-width-1-3"></div>
      <div class="uk-width-1-3"></div>
      <div class="uk-width-1-3" style="padding: 0px;">
       <button
          class="uk-button uk-button-small  uk-width-1-1"
          @click="update_transaction()"
          style="background-color: yellow;"
        >
          Изменить
        </button>
     </div>
    </div>
  </div>
</template>

<script>

import transaction from '../components/layouts/Transaction'

export default {

  components:{
    transaction
  },

  name: 'updateTransactionComponent',

  data () {
    return {
      id:'',
      loading:true,
      transaction:{
        type_profit:'',
        person_id:'',
        category_id:'',
        sum:'',
        comment:''
      },
    }
  },
  mounted(){
    this.id=this.$route.params.id;
    this.loadTransaction();
  },
  methods:{
    loadTransaction(){
      axios.get('/api/transactions/'+this.id).then(res=>{
        this.transaction.type_profit=res.data.type_profit_id;
        this.transaction.category_id=res.data.categories_id;
        this.transaction.person_id=res.data.person_id;
        this.transaction.sum=res.data.sum;
        this.transaction.comment=res.data.comment;
        this.loading=false;
      })
    },
    update_transaction(){
      axios.put('/api/transactions/'+this.id, {
        id: this.transaction.id,
        type_profit_id: this.transaction.type_profit,
        categories_id: this.transaction.category_id,
        person_id: this.transaction.person_id,
        sum: this.transaction.sum,
        comment: this.transaction.comment,
      }).then(res=>{
        if(res.data.status)
        {
          this.$toast.success("Транзакция обновлена");
          this.$router.push({path:'/history'})
        }
        else
        {
          this.$toast.error("Проверьте введенные данные!");
        }
      })
    },
  },
}
</script>

<style lang="css" scoped>
</style>