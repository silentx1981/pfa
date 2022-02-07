var app = new Vue({
	el: '#app',
	/*
	data: {
		message: 'Hello Vue!'
	}*/

	data() {
		return {
			message: null
		}
	},
	mounted() {
		axios
			.get('http://localhost:8000/data')
			.then(response => (this.message = response.data.message))
	},
	methods: {
		send() {
			console.log('send');
			/*
			axios
				.post('http://localhost:8000/data', {message: this.message}, {headers: {'Content-Type': 'multipart/form-data'}})
				.then(response => (this.message = response.data.message));
			 */
			var formData = new FormData();
			formData.append('file', this.file);
			formData.append('message', this.message);
			axios
				.post('http://localhost:8000/data', formData, {headers: {'Content-Type': 'multipart/form-data'}})
				.then(response => (this.message = response.data.message));
			console.log('send complete');
		},
		handleFileUpload() {
			this.file = this.$refs.file.files[0];
			console.log('>>>> 1st element in files array >>>> ', this.file);
		}
	}

});
