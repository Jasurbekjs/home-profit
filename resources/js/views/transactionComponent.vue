<template>
	<div>
		<h2>Создать транзакцию</h2>
			<transaction
				:transaction="transaction"
			></transaction>
    <div
    	class="uk-grid" 
    	style="margin: 0px;">
    	<div class="uk-width-1-3"></div>
    	<div class="uk-width-1-3"></div>
    	<div class="uk-width-1-3" style="padding: 0px;">
     	 <button
	      	class="uk-button uk-button-primary  uk-button-small  uk-width-1-1"
	      	@click="create_transaaction()"
	      >
	      	Создать
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

  name: 'transactionComponent',

  data () {
    return {
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
  	
  },
  methods:{
  	
  	create_transaaction(){
  		axios.post('/api/transactions', {
  			type_profit_id: this.transaction.type_profit,
  			categories_id: this.transaction.category_id,
  			person_id: this.transaction.person_id,
  			sum: this.transaction.sum,
  			comment: this.transaction.comment,
  		}).then(res=>{
  			if(res.data.status)
  			{
  				this.$toast.success("Транзакция добавлена");
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