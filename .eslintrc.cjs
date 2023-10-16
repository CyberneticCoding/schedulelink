module.exports = {
	"env": {
		"browser": true,
		"es2021": true
	},
	"extends": [
		"eslint:recommended",
		"plugin:vue/vue3-essential",
	],
	"parserOptions": {
		"ecmaVersion": 12,
		"sourceType": "module"
	},
	"plugins": [
		"vue"
	],
	"rules": {
		"indent": [
			"error",
			"tab"
		],
		"vue/html-indent": [
			"error",
			"tab"
		],
		"vue/max-attributes-per-line": [
			"off",
		],
		"vue/html-self-closing": [
			"off",
		],
		"vue/no-reserved-component-names": [
			"off"
		],

		"quotes": [
			"error",
			"double"
		],
	}
}
