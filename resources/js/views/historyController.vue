<template>
	<div>
		<h2>История транзакций</h2>
		<div class="uk-overflow-auto">
    	<table class="uk-table uk-table-hover uk-table-small uk-table-divider table">
	      <thead>
	        <tr>
	          <th>№</th>
	          <th>Id</th>
	          <th>Персона</th>
	          <th>Сумма</th>
	          <th>Комментарий</th>
	          <th>Детали</th>
	        </tr>
	      </thead>
        <tbody>
        	<tr
        		v-if="loading"
        	>
        		<span 
        			class="uk-margin-small-right" uk-spinner="ratio: 3"
        			style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);"
        			
        		></span>
        	</tr>
          <tr 
          	v-else
          	v-for="(transaction, index) in transactions"
          >
            <td align="right">
            	{{(index+1)}}
            </td>
            <td align="right">
            	{{(transaction.id)}}
            </td>
            <td align="right">
              {{findPerson(transaction.person_id,'role')}}
            </td>
            <td
            	v-if="types_state[index]=='income'" 
            	align="right"
            	style="background-color: #81C784;"
            >
            	{{transaction.sum}}
            </td>
            <td
            	v-else-if="types_state[index]=='expenses'" 
            	align="right"
            	style="background-color: #E57373;"
            >
            	{{transaction.sum}}
            </td>
            <td
            	v-else 
            	align="right"
            	style="background-color: white;"
            >
            	{{transaction.sum}}
            </td>
            <td align="right">
            	{{transaction.comment}}
            </td>
            <td align="right">
            	<button
            		class="uk-button uk-button-primary  uk-button-small"
            		@click="one_history(transaction.id)"
            	>
            		Детали	
            	</button>
            </td>
          </tr>
          <tr
          	v-if="!loading"
          	:style="[	profit>0 ? {'background-color': '#81C784'} : {'background-color': '#E57373'}]"
          >
          	<td 
          		align="right"
          		colspan="3" 
          	>
          		Итого:
          	</td>
          	<td align="right">
          		{{profit}}
          	</td>
          	<td	colspan="2"></td>
          </tr>
        </tbody>
	    </table>
		</div>
	</div>
</template>

<script>

import axios from 'axios';

export default {

  name: 'historyController',

  data () {
    return {
    	loading:true,
    	transactions:[],
    	persons:[],
    	categories:[],
    	types_profit:[],
    	profit:'',
    	types_state:[],
    }
  },
  mounted(){
  	this.loadBase();
  },
  methods:{
  	loadBase(){
  		axios.get('/api/persons').then(res=>{
  			this.persons=res.data;
  		})
  		axios.get('/api/categories').then(res=>{
  			this.categories=res.data;
  		})
  		axios.get('/api/type_profit').then(res=>{
  			this.types_profit=res.data;
  		}).then(()=>{
  			this.loadTransactions()
  		})
  	},
  	loadTransactions(){
  		axios.get('/api/transactions').then(res=>{
  			this.transactions=res.data;
  			this.loading=false;
  			this.findType();
  		}).then(()=>{
  			this.profit_calculation();
  		});
  	},
  	one_history(id)
  	{
  		this.$router.push('history/'+id);
  	},
  	profit_calculation(){
  		let income=0;
  		let expenses=0;
  		for(let i=0; i<this.transactions.length; i++)
  		{
  			if(this.transactions[i].type_profit_id==1)
  			{
  				income=income+this.transactions[i].sum;
  			}
  			else
  			{
  				expenses=expenses+this.transactions[i].sum;
  			}
  		}
  		this.profit=income-expenses;
  	},
  	findType(){
  		for(let j=0; j<this.transactions.length; j++)
			{
	  		for(let i=0; i<this.types_profit.length; i++)
				{
					if(this.types_profit[i].id==this.transactions[j].type_profit_id)
					{
						this.types_state[this.types_state.length]=this.types_profit[i].type_profit;
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
  }
}
</script>

<style lang="css">
.table{
	border-bottom: 2px solid #E0E0E0;
	border-left: 2px solid #E0E0E0;
	border-right: 2px solid #E0E0E0;
}
thead {border-top:2px solid #E0E0E0;}
.table tbody td{
	border-left: 0.25px solid #e0e0e0;
	border-right: 0.25px solid #e0e0e0;
}
</style>