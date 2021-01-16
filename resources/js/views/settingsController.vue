<template>
	<div>
			<div 
	    	class="uk-grid" 
	    	style="margin: 0px;">
	    	<div class="uk-width-1-1">
	    		<h2>Настройки</h2>
	    	</div>
	    </div>
	    <hr/>
	    <div 
	    	class="uk-grid" 
	    	style="margin: 0px;">
	    	<div class="uk-width-1-2">
	    		<typesprofit
	    			@refreshCategories="refreshCategories"
	    		></typesprofit>
	    	</div>	
	    	<div class="uk-width-1-2">
	    		<categories
	    			:refreshCategs="refreshCategs"
	    		></categories>
	    	</div>
	    </div>
	    <hr/>
	    <div 
	    	class="uk-grid" 
	    	style="margin: 0px;">
	    	<div class="uk-width-1-1">
	    		<persons></persons>
	    	</div>
	    </div>
		

	</div>
</template>

<script>

import categories from '../components/categories';
import typesprofit from '../components/types_profit';
import persons from '../components/persons';


export default {

	components:{
		categories,
		typesprofit,
		persons
	},

  name: 'settingsController',

  data () {
    return {
    	refreshCategs:false,
    }
  },
  methods:{
  	refreshCategories(){
  		this.refreshCategs=true;
  	},
  }
}
</script>

<style lang="css" scoped>
</style>