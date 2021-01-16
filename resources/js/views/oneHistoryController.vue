<template>
	<div>
		<h2>Детали транзакции {{id}}</h2>
		<table class="uk-table uk-table-hover uk-table-small uk-table-divider table">
      <tbody v-if="loading">
      	<tr>
      		<span 
      			class="uk-margin-small-right" uk-spinner="ratio: 3"
      			style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);"
      			
      		></span>
      	</tr>
      </tbody>
      <tbody v-else>
        <tr 
        	:style="[	findType(transaction.type_profit_id, 'type_profit')=='income' ? {'background-color': '#81C784'} : {'background-color': '#E57373'}]"
        >	
        	<td class="uk-table-shrink uk-text-nowrap">
        		Тип транзакции
        	</td>
          <td align="left">
          	{{findType(transaction.type_profit_id, 'comment')}}
          </td>
        </tr>
        <tr>	
        	<td class="uk-table-shrink uk-text-nowrap">
        		Категория
        	</td>
          <td align="left">
          	{{findCategory(transaction.categories_id, 'name')}}
          </td>
        </tr>
        <tr>	
        	<td class="uk-table-shrink uk-text-nowrap">
        		{{findPerson(transaction.person_id,'role')}}
        	</td>
          <td align="left">
          	{{findPerson(transaction.person_id,'first_name')}} {{findPerson(transaction.person_id,'last_name')}} 
          </td>
        </tr>
        <tr>	
        	<td class="uk-table-shrink uk-text-nowrap">
        		Дата
        	</td>
          <td align="left">
          	{{transaction.created_at | formatDate(transaction.created_at)}}
          </td>
        </tr>
        <tr>	
        	<td class="uk-table-shrink uk-text-nowrap">
        		Сумма
        	</td>
          <td align="left">
          	{{transaction.sum}}
          </td>
        </tr>
        <tr>	
        	<td class="uk-table-shrink uk-text-nowrap">
        		Комментарий
        	</td>
          <td align="left">
          	{{transaction.comment}}
          </td>
        </tr>
      </tbody>
    </table>

    <div
    	v-if="!loading" 
    	class="uk-grid" 
    	style="margin: 0px;">
    	<div class="uk-width-1-3">
    		<button
	      	class="uk-button uk-button-primary  uk-button-small  uk-width-1-1"
	      	@click="navigate_update()"
	      >
	      	Редактировать
	      </button>
    	</div>
    	<div class="uk-width-1-3"></div>
    	<div class="uk-width-1-3">
     	 <button
	      	class="uk-button uk-button-danger  uk-button-small  uk-width-1-1"
	      	@click="delete_transaaction()"
	      >
	      	Удалить
	      </button>
     </div>
    </div>
	</div>
</template>

<script>

import moment from 'moment'

export default {

  name: 'oneHistoryController',

  data () {
    return {
    	id:'',
    	loading:true,
    	persons:[],
    	categories:[],
    	type_profit:[],
    	transaction:[],
    }
  },
  mounted(){
  	this.id=this.$route.params.id;
  	this.loadBase();
  },
  methods:{
  	loadBase(){
  		axios.get('/api/type_profit').then(res=>{
  			this.type_profit=res.data;
  		}).then(()=>{
  			this.loadOneHistory(this.id);
  		})

  		axios.get('/api/persons').then(res=>{
  			this.persons=res.data;
  		})
  		axios.get('/api/categories').then(res=>{
  			this.categories=res.data;
  		})
  		
  		
  	},
  	loadOneHistory(id){
  		axios.get('/api/transactions/'+id).then(res=>{
  			this.transaction=res.data;
  			this.loading=false;
  		})
  	},
  	delete_transaaction(){
  		axios.delete('/api/transactions/'+this.id).then(res=>{
  			this.$toast.success("Транзакция удалена");
  			this.$router.push({path:'/history'})
  		})
  	},
  	navigate_update(){
  		this.$router.push({path:'/history/'+this.id+'/update'})
  	},
  	findType(value,arg='comment'){
			for(let i=0; i<this.type_profit.length; i++)
			{
				if(this.type_profit[i].id==value)
				{
					if(arg=='comment')
					{
						return this.type_profit[i].comment
					}
					if(arg=='type_profit')
					{
						return this.type_profit[i].type_profit
					}					
				}
			}
		},
		findCategory(value,arg='name')
		{
			for(let i=0; i<this.categories.length; i++)
			{
				if(this.categories[i].id==value)
				{
					if(arg=='name')
					{
						return this.categories[i].name
					}
				}
			}
		},
		findPerson(value,arg='role')
		{
			for(let i=0; i<this.persons.length; i++)
			{
				if(this.persons[i].id==value)
				{
					if(arg=='role')
					{
						return this.persons[i].role
					}
					if(arg=='first_name')
					{
						return this.persons[i].first_name
					}
					if(arg=='last_name')
					{
						return this.persons[i].last_name
					}
				}
			}
		}
  },
	filters:{
  	formatDate(value){
  		if (value) {
		    return moment(String(value)).format('DD/MM/YYYY hh:mm')
		  }
  	},
  }
}
</script>

<style lang="css" scoped>
</style>