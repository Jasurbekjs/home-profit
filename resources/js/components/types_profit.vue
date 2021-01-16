<template>
	<div>
		Добавить тип
		<table class="uk-table uk-table-small">
      <tbody>
        <tr>	
        	<td class="uk-text-nowrap">
        		<input 
        			class="uk-input" 
        			type="text" 
        			placeholder="Новый тип"
        			v-model="new_type_profit"
        		>
        	</td>
        	<td>
          	<button 
				  		class="uk-button uk-button-primary uk-margin-small-bottom"
				  		@click="create_type_profit()"
				  	>
				  		<span uk-icon="plus"></span>
				  	</button>
          </td>
        </tr>
      </tbody>
    </table>
		<hr/>
		<table class="uk-table uk-table-small" v-if="types_profit.length!=1">
      <tbody>
        <tr v-for="(type_profit, index) in types_profit">	
        	<td class="uk-table-shrink uk-text-nowrap">
        		{{type_profit.comment}}
        	</td>
        	<td 
        		v-if="types_profit.length!=1"
        	>
          	<button 
          		class="uk-button uk-button-primary uk-margin-small-bottom"
          		@click="delete_type_profit(type_profit.id)"
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

  name: 'types_profit',

  data () {
    return {
    	types_profit:[],
    	new_type_profit:'',
    }
  },
  mounted(){
  	this.loadTypesProfits();
  },
  methods:{
  	loadTypesProfits(){
  		axios.get('/api/type_profit').then(res=>{
  			this.types_profit=res.data;
  		})
  	},
  	create_type_profit(){
  		axios.post('/api/type_profit',{
  			type_profit:this.new_type_profit,
  			comment:this.new_type_profit,
  		}).then(res=>{
  			if(res.data.status)
  			{
  				this.new_type_profit='';
  				this.$toast.success("Тип добавлен");
  				this.loadTypesProfits();
  				this.$emit("refreshCategories")
  			}
  			else
  			{
  				this.$toast.error("Проверьте введенные данные!");
  			}
  		})
  	},
  	delete_type_profit(id){
  		axios.delete('/api/type_profit/'+id).then(res=>{
  			if(res.data.status)
  			{
  				this.new_type_profit='';
  				this.$toast.success("Тип удален");
  				this.loadTypesProfits();
  				this.$emit("refreshCategories")
  			}
  			else
  			{
  				this.$toast.error("Проверьте введенные данные!");
  			}
  		}).catch(err=>{
  			this.$toast.error("Проверьте введенные данные!");
  		})
  	}
  },
}
</script>

<style lang="css" scoped>
</style>