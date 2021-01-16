<template>
	<div>
		<footer>
	    <div class="uk-container uk-padding-small">
        <p class="uk-text-small" style="color:black;">Mirzaev Jasurbek 	&copy; 2021</p>
	    </div>
		</footer><!--/footer#page-footer-->
	</div>
</template>

<script>
export default {

  name: 'footerComponent',

  data () {
    return {

    }
  }
}
</script>

<style lang="css" scoped>
	footer {
    position: fixed; /* Фиксированное положение */
    height: 40px;
    left: 0; bottom: 0; /* Левый нижний угол */
    padding: 0px 10px 15px 10px; /* Поля вокруг текста */
    background: #f8f8f8; /* Цвет фона */
    color: #fff; /* Цвет текста */
    width: 100%; /* Ширина слоя */
	}

</style>