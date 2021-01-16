<template>
	<div>
			<div 
	    	class="uk-grid" 
	    	style="margin: 0px;">
	    	<div class="uk-width-1-1">
	    		<h2>Главная</h2>
	    	</div>
	    </div>
	    <div 
	    	class="uk-grid" 
	    	style="margin: 0px;">
	    	<div class="uk-width-1-1">
	    		<div class="img" width></div>
	    	</div>
	    </div>
	    <hr/>
	    <div 
	    	class="uk-grid" 
	    	style="margin: 0px;">
	    	<div class="uk-width-1-2">
	    		<h4>Laravel 8</h4>
	    		<div>
	    			Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation — freeing you to create without sweating the small things.
	    		</div>
	    	</div>
	    	<div class="uk-width-1-2">
	    		<h4>Vue JS</h4>
	    		<div>
	    			The Progressive JavaScript Framework<br/>
	    			Approachable - Already know HTML, CSS and JavaScript? Read the guide and start building things in no time!<br/>
	    			Versatile - An incrementally adoptable ecosystem that scales between a library and a full-featured framework.<br/>
	    		</div>	
	    	</div>
	     </div>
	    </div>
	</div>
</template>

<script>
export default {

  name: 'index',

  data () {
    return {

    }
  }
}
</script>

<style lang="css" scoped>
.img{
	margin-left: 90px;
	width: 100%;
	background-repeat: no-repeat;
}
</style>