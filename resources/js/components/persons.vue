<template>
	<div>
		Добавить Персону
		<table class="uk-table uk-table-small">
      <tbody>
        <tr>	
        	<td class="uk-text-nowrap">
        		<input 
        			class="uk-input" 
        			type="text" 
        			placeholder="Роль"
        			v-model="new_person.role"
        		>
        	</td>
        	<td class="uk-text-nowrap">
        		<input 
        			class="uk-input" 
        			type="text" 
        			placeholder="Имя"
        			v-model="new_person.first_name"
        		>
        	</td>
        	<td class="uk-text-nowrap">
        		<input 
        			class="uk-input" 
        			type="text" 
        			placeholder="Фамилия"
        			v-model="new_person.last_name"
        		>
        	</td>
        	<td class="uk-text-nowrap">
        		<input 
        			class="uk-input" 
        			type="date" 
        			v-model="new_person.date_birth"
        		>
        	</td>
        	<td>
          	<button 
				  		class="uk-button uk-button-primary uk-margin-small-bottom"
				  		@click="create_person()"
				  	>
				  		<span uk-icon="plus"></span>
				  	</button>
          </td>
        </tr>
      </tbody>
    </table>
		<hr/>
		<table class="uk-table uk-table-small" v-if="persons.length!=1">
      <tbody>
        <tr v-for="(person, index) in persons">	
        	<td class="uk-table-shrink uk-text-nowrap">
        		{{person.role}}
        	</td>
        	<td class="uk-table-shrink uk-text-nowrap">
        		{{person.first_name}}
        	</td>
        	<td class="uk-table-shrink uk-text-nowrap">
        		{{person.last_name}}
        	</td>
        	<td class="uk-table-shrink uk-text-nowrap">
        		{{person.date_birth}}
        	</td>
        	<td 
        		v-if="person.length!=1"
        	>
          	<button 
          		class="uk-button uk-button-primary uk-margin-small-bottom"
          		@click="delete_person(person.id)"
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

  name: 'persons',

  data () {
    return {
    	persons:[],
    	new_person:{
    		role:'',
    		first_name:'',
    		last_name:''
    	}
    }
  },
  mounted()
  {
  	this.loadPersons();
  },
  methods:{
  	loadPersons(){
  		axios.get('/api/persons').then(res=>{
  			this.persons=res.data;
  		})
  	},
  	create_person()
  	{
  		axios.post('/api/persons',{
  			role:this.new_person.role,
  			first_name:this.new_person.first_name,
  			last_name:this.new_person.last_name,
  			date_birth:this.new_person.date_birth,
  		}).then(res=>{
  			this.$toast.success("Персона добавлена");
  			this.loadPersons();
  		}).catch(err=>{
  			this.$toast.error("Проверьте введенные данные!");
  		})
  	},
  	delete_person(id)
  	{
  		axios.put('/api/persons/'+id).then(res=>{
  			this.$toast.success("Персона удалена");
  			this.loadPersons();
  		}).catch(err=>{
  			this.$toast.error("Проверьте введенные данные!");
  		})
  	}
  }
}
</script>

<style lang="css" scoped>
</style>