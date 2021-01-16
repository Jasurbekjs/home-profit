<template>
	<nav class="uk-navbar-container uk-margin" uk-navbar>
	  <div class="uk-navbar-left">
			<a class="uk-navbar-item uk-logo" href="#">for Micros</a>
      <ul class="uk-navbar-nav">
        <li v-for="(link, index) in links">
          <router-link :to="link.href">
            {{link.title}}
          </router-link>
        </li>
      </ul>
    </div>
	</nav>
</template>

<script>
export default {

  name: 'headerComponent',

  data () {
    return {
    	links:[
	    	{
	    		title:"Главная",
	    		href:"/"
	    	},
	    	{
	    		title:"Транзакция",
	    		href:"/transaction"
	    	},
	    	{
	    		title:"История транзакций",
	    		href:"/history"
	    	},
	    	{
	    		title:"Настройки",
	    		href:"/settings"
	    	},
    	]
    }
  }
}
</script>

<style lang="css" scoped>
</style>