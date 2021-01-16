<template>
	<div>
		<table class="uk-table">
      <tbody v-if="loading">
      	<tr>
      		<span 
      			class="uk-margin-small-right" uk-spinner="ratio: 3"
      			style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);"
      		></span>
      	</tr>
      </tbody>
      <tbody v-if="!loading">
        <tr>	
        	<td class="uk-table-shrink uk-text-nowrap">
        		Тип транзакции
        	</td>
          <td align="left">
          	<select 
          		name="type_profit" 
          		v-model="transaction.type_profit"
          		class="uk-select"
          		@change="change_type_categories()"
          	>
          		<option 
          			v-for="(type_profit, index) in types_profit" 
          			:value="type_profit.id"
          		>{{type_profit.comment}}</option>
          	</select>
          </td>
        </tr>
        <tr>	
        	<td class="uk-table-shrink uk-text-nowrap">
        		Категория
        	</td>
          <td align="left">
          	<select 
          		name="categories" 
          		v-model="transaction.category_id"
          		class="uk-select"
          	>
          		<option 
          			v-for="(category, index) in categories" 
          			:value="category.id"
          		>{{category.name}}</option>
          	</select> 
          </td>
        </tr>
        <tr>	
        	<td class="uk-table-shrink uk-text-nowrap">
        		Персона
        	</td>
          <td align="left">
          	<select 
          		name="persons" 
          		v-model="transaction.person_id"
          		class="uk-select"
          	>
          		<option 
          			v-for="(person, index) in persons" 
          			:value="person.id"
          		>{{person.role}}: {{person.first_name}} {{person.last_name}}</option>
          	</select> 
          </td>
        </tr>
        <tr>	
        	<td class="uk-table-shrink uk-text-nowrap">
        		Сумма
        	</td>
          <td align="left">
          	<input 
          		type="number"
          		class="uk-input"  
          		placeholder="Сумма"
          		v-model="transaction.sum">
          </td>
        </tr>
        <tr>	
        	<td class="uk-table-shrink uk-text-nowrap">
        		Комментарий
        	</td>
          <td align="left">
          	<textarea 
          		class="uk-textarea" 
          		rows="5" 
          		placeholder="Комментарий"
          		v-model="transaction.comment"
          	></textarea>
          </td>
        </tr>
      </tbody>
    </table>
	</div>
</template>

<script>
export default {

  name: 'Transaction',
  props:{
  	transaction:{
  		type: Object,
  		default:{
  			type_profit:'',
  			category_id:'',
  			person_id:'',
  			sum:'',
  			comment:''
  		}
  	},

  },
  data () {
    return {
    	loading:true,
    	types_profit:[],
    	persons:[],
    	categories:[],
    	additional_categories:[],
    }
  },
  mounted(){
  	this.loadBase();
  },
  methods:{
  	loadBase(){
  		axios.get('/api/type_profit').then(res=>{
  			this.types_profit=res.data;
  		})
  		axios.get('/api/persons').then(res=>{
  			this.persons=res.data;
  		})
  		axios.get('/api/categories').then(res=>{
  			this.categories=res.data;
  			this.additional_categories=res.data;
  		}).then(()=>{
  			this.loading=false;
  			//this.change_type_categories();
  		})
  	},
  	change_type_categories(){
  		let add_categories=[];
  		let k=0;
  		for(let i=0; i<this.additional_categories.length; i++)
  		{
  			if(this.transaction.type_profit==this.additional_categories[i].type_id)
  			{
  				add_categories[k]=this.additional_categories[i];
  				k++;
  			}
  		}
  		this.categories=add_categories;
  	},
  }
}
</script>

<style lang="css" scoped>
</style>