<template>
	<div>
		Добавить категорию
		<table class="uk-table uk-table-small">
      <tbody>
      	<tr>	
        	<td class="uk-text-nowrap">
        		<select 
          		name="type_profit" 
          		v-model="type_profit"
          		class="uk-select"
          	>
          		<option 
          			v-for="(type_profit, index) in types_profit" 
          			:value="type_profit.id"
          		>{{type_profit.comment}}</option>
          	</select>
        	</td>
        	<td>
          	Выберите тип
          </td>
        </tr>
        <tr>	
        	<td class="uk-text-nowrap">
        		<input 
        			class="uk-input" 
        			type="text" 
        			placeholder="Новая категория"
        			v-model="new_category"
        		>
        	</td>
        	<td>
          	<button 
				  		class="uk-button uk-button-primary uk-margin-small-bottom"
				  		@click="create_category()"
				  	>
				  		<span uk-icon="plus"></span>
				  	</button>
          </td>
        </tr>
      </tbody>
    </table>
		<hr/>
		<table class="uk-table uk-table-small">
      <tbody>
        <tr v-for="(category, index) in categories">	
        	<td class="uk-table-shrink uk-text-nowrap">
        		{{category.name}} 
        		<span v-if="types_profit.length>0">
        			({{findType(category.type_id)}})
        		</span>
        	</td>
        	<td 
        		v-if="categories.length!=1"
        	>
          	<button 
          		class="uk-button uk-button-primary uk-margin-small-bottom"
          		@click="delete_category(category.id)"
          	>
          		<span uk-icon="minus"></span>
          	</button>
          </td>
        </tr>
      </tbody>
    </table>
	</div>
</template>

<script>
export default {

  name: 'categories',

  params:{
  	refreshCategs:{
  		type:Boolean,
  		default:false,
  	}
  },

  data () {
    return {
    	categories:[],
    	type_profit:'',
    	types_profit:[],
    	new_category:'',
    }
  },
  mounted(){
  	this.loadCategories();
  },
  methods:{
  	loadCategories(){
  		axios.get('/api/categories').then(res=>{
  			this.categories=res.data;
  		}).then(res=>{
  			axios.get('/api/type_profit').then(res=>{
	  			this.types_profit=res.data;
	  		})
  		})
  	},
  	create_category(){
  		axios.post('/api/categories',{
  			type_id:this.type_profit,
  			name:this.new_category,
  			comment:this.new_category,
  		}).then(res=>{
  			if(res.data.status)
  			{
  				this.new_category='';
  				this.type_profit='';
  				this.$toast.success("Категория добавлена");
  				this.loadCategories();
  			}
  			else
  			{
  				this.$toast.error("Проверьте введенные данные!");
  			}
  		}).catch(err=>{
  			this.$toast.error("Проверьте введенные данные!");
  		})
  	},
  	delete_category(id){
  		axios.delete('/api/categories/'+id).then(res=>{
  			if(res.data.status)
  			{
  				this.new_category='';
  				this.type_profit='';
  				this.$toast.success("Категория удалена");
  				this.loadCategories();
  			}
  			else
  			{
  				this.$toast.error("Проверьте введенные данные!");
  			}
  		}).catch(err=>{
  			this.$toast.error("Проверьте введенные данные!");
  		})
  	},
  	findType(value){
			for(let i=0; i<this.types_profit.length; i++)
			{
				if(this.types_profit[i].id==value)
				{
					console.log(this.types_profit[i].comment)
					return this.types_profit[i].comment
				}
			}
		},
  },
}
</script>

<style lang="css" scoped>
</style>