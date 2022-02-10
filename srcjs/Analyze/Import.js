var AnalyzeImport = new Vue({
	el: '#analyzeImport',
	methods: {
		send() {
			console.log('importfile');
			console.log(this.$rwHttp.getFirstName());
		}
	}
});
