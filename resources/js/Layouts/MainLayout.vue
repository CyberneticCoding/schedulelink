<template>
	<header>
		<slot name="header"/>
	</header>
	<main>
		<slot name="main"/>
	</main>
	<footer>
		<slot name="footer"/>
	</footer>
</template>

<script>
export default {
	name: "MainLayout"
}
</script>